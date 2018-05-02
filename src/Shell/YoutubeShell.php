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
        //we could get chanel ids from doing random searching thorugh api or searching for related videos to those that we already have
        foreach ($chanelIds as $id) {
            $this->scrapeChanel($id);
        }
    }

    public function scrapeChanel($chanelId = YoutubeShell::TEST_CHANNEL_ID)
    {
        $videos = $this->getVideoList($chanelId);

        //create videos
        foreach ($videos as $video) {
            $tags = $video['snippet']['tags'];
            $videoEntity = $this->Videos->newEntity([
                'video_id' => $video['id'],
                'channel_id' => $chanelId,
                'tags' => implode(",", $tags ? $tags : []),
                'performanse_rating' => 1
            ]);
            $this->Videos->save($videoEntity);
        }

        //update statistics
        foreach ($videos as $video) {
            $videoStatEntity = $this->VideoStats->newEntity([
                'video_id' => $video['id'],
                'view_count' => $video['statistics']['viewCount']
            ]);
            $this->VideoStats->save($videoStatEntity);
        }

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
