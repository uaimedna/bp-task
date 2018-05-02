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
    protected $client;
    protected $service;

    function __construct() {
        // Define an object that will be used to make all API requests.
        $this->client = $this->getClient();
        $this->service = new \Google_Service_YouTube($this->client);

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

    /**
     * Start the shell and interactive console.
     *
     * @return int|null
     */
    public function main()
    {
        var_dump('test');
        die();
    }

    public function fuck()
    {
        var_dump('before');
        $this->channelsListByUsername($this->service, 'snippet,contentDetails,statistics', array('forUsername' => 'GoogleDevelopers'));
        var_dump('fuck idy');
        die();
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
            file_put_contents($credentialsPath, $client->getAccessToken());
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
    
    protected function channelsListByUsername($service, $part, $params) {
        $params = array_filter($params);
        $response = $this->service->channels->listChannels(
            $part,
            $params
        );

        $description = sprintf(
            'This channel\'s ID is %s. Its title is %s, and it has %s views.',
            $response['items'][0]['id'],
            $response['items'][0]['snippet']['title'],
            $response['items'][0]['statistics']['viewCount']);
        print $description . "\n";
    }

}
