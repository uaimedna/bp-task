<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Datasource\ConnectionManager;
/**
 * Simple console wrapper around Psy\Shell.
 */
class YoutubeShell extends Shell
{
    const CREDENTIALS_PATH = ROOT . '/config/Keys/php-yt-oauth2.json';
    const TEST_CHANNEL_ID = 'UCtinbF-Q-fVthA0qrFQTgXQ'; //casey neistat

    protected $client;
    protected $service;

    function __construct() {
        // Define an object that will be used to make all API requests.
        $this->client = $this->getClient();
        $this->service = new \Google_Service_YouTube($this->client);

        $this->loadModel('Videos');
        $this->loadModel('VideoStats');

        if (isset($_GET['code'])) {
            if (strval($_SESSION['state']) !== strval($_GET['state'])) {
                die('The session state did not match.');
            }

            $client->authenticate($_GET['code']);
            $_SESSION['token'] = $this->client->getAccessToken();
            header('Location: ' . $redirect);
        }

        if (isset($_SESSION['token'])) {
            $this->client->setAccessToken($_SESSION['token']);
        }

        if (!$this->client->getAccessToken()) {
            print("no access token, whaawhaaa");
            exit;
        }
        parent::__construct();
    }

    protected function getClient() {
        $client = new \Google_Client();
        // Set to name/location of your client_secrets.json file.
        $client->setAuthConfigFile(ROOT . '/config/Keys/bp-youtube-api.json');
        // Set to valid redirect URI for your project.
        $client->setRedirectUri('http://localhost');

        $client->addScope(\Google_Service_YouTube::YOUTUBE_READONLY);
        $client->setAccessType('offline');

        // Load previously authorized credentials from a file.
        $credentialsPath = $this->expandHomeDirectory(YoutubeShell::CREDENTIALS_PATH);        
        if (file_exists($credentialsPath)) {
            $accessToken = unserialize(file_get_contents($credentialsPath));
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->authenticate($authCode);

            // Store the credentials to disk.
            if(!file_exists(dirname($credentialsPath))) {
                mkdir(dirname($credentialsPath), 0700, true);
            }
            
            //NO SERIALIZATION IN YOUTUBE GETTING STARTED PAGE!@#!@#!
            file_put_contents($credentialsPath, serialize($accessToken));
            printf("Credentials saved to %s\n", $credentialsPath);
        }
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {
            $client->refreshToken($client->getRefreshToken());
            file_put_contents($credentialsPath, serialize($client->getAccessToken()));
        }
        return $client;
    }

    /**
     * Expands the home directory alias '~' to the full path.
     * @param string $path the path to expand.
     * @return string the expanded path.
     */
    function expandHomeDirectory($path) {
        $homeDirectory = getenv('HOME');
        if (empty($homeDirectory)) {
            $homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
        }
        return str_replace('~', realpath($homeDirectory), $path);
    }

    /**
     * Bonus method.. scrapes multiple chanels
     */
    public function scrapeMultiChanel($chanelIds)
    {
        //we could get chanel ids from doing random searching thorugh api or searching for related videos to those videos that we already have
        foreach ($chanelIds as $id) {
            $this->scrapeChanel($id);
        }
    }

    public function scrapeChanel($chanelId = YoutubeShell::TEST_CHANNEL_ID)
    {
        $timeStart = microtime(true);

        $videos = $this->getVideoList($chanelId);
        $connection = ConnectionManager::get('default');

        $viewPerformance = [];
        //create videos. These wont be inserted if a video with the samo video_id already exists
        foreach ($videos as $video) {
            $tags = $video['snippet']['tags'];
            $videoEntity = $this->Videos->newEntity([
                'video_id' => $video['id'],
                'channel_id' => $chanelId,
                'tags' => implode(",", $tags ? $tags : []),
                'performanse_rating' => 1
            ]);
            if ($this->Videos->save($videoEntity)) {
                //if we werent able to save that means that that is a dublicate video id so lets only add statistics for non dublicates
                $videoStatEntity = $this->VideoStats->newEntity([
                    'video_id' => $video['id'],
                    'view_count' => $video['statistics']['viewCount']
                ]);
                $this->VideoStats->save($videoStatEntity);
                
            };
        }

        //finally lets update the performance rating for each video
        //and this is the place where I would still use query builder, but for the sake of the task Ill put raw queries here
        foreach ($videos as $video) {
            $viewPerformance[$video['id']] = $this->getViewCountDiff($video['id'], $connection);
        }
        $viewPerformanceAverage = array_sum($viewPerformance) / count($viewPerformance);

        //and update those to the main video table
        foreach ($videos as $video) {
            $performanceRating = 1000 * (($viewPerformance[$video['id']] / $viewPerformanceAverage) - 1);
            $res = $connection->execute('
                UPDATE videos SET performanse_rating = ? WHERE video_id = ?
            ', [(int)$performanceRating, $video['id']]);
        }
        
        $timeEnd = microtime(true);
        echo 'Update took: ' . ($timeEnd - $timeStart);
    }

    function getViewCountDiff($videoId, $connection) {
        //assuming that we are already scanning this channel when the videos are added. 
        //Then we only need to find all dates from first available date of the video to that date plus an hour
        $res = $connection->execute('
            SELECT * 
            FROM video_stats
            WHERE 
                video_id = ?
                AND DATE_SUB(created, INTERVAL 1 HOUR) <= (
                    SELECT MIN(created) 
                    FROM video_stats
                    WHERE video_id = ?
                )
            ORDER BY created ASC
        ', [$videoId, $videoId])->fetchAll('assoc');
        
        //diference of view count between first and last records
        return $res[count($res)-1]['view_count'] - $res[0]['view_count'];

    }

    function getVideoList($chanelId) {
        //I do realise theres more than 50 results so we would have to go thorugh all available pages 50 results at a time. But this is out of the scope
        $response = $this->service->search->listSearch(
            'snippet, id',
            [
                'channelId' => $chanelId,
                'order' => 'date',
                'maxResults' => 50
            ]
        );

        $videoIds = [];
        foreach ($response['items'] as $item) {
            $videoIds[] = $item['id']['videoId'];
        }

        $response = $this->service->videos->listVideos(
            'statistics, snippet',
            [
                'id' => implode(",", $videoIds),
            ]
        );
        return $response;
    }

}
