<?php

namespace Codegis\GoogleCalendar;

use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarFactory
{
    public static function createForCalendarId($calendarId): GoogleCalendar
    {
        $config = config('laravel-google-calendar');

        $scopes = implode(' ', array( Google_Service_Calendar::CALENDAR ) );
        $credentialsPath = expandHomeDirectory($config['client_secret_json']);
        $application_name = "Job target calendar";

        $client = new Google_Client();

        $client->setApplicationName($application_name);
        $client->setScopes($scopes);
        $client->setAuthConfig($config['client_secret_json']);
        $client->setAccessType('offline');

        $accessToken = json_decode(file_get_contents($credentialsPath), true);
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
        }
        //$client->setAssertionCredentials($credentials);

        $service = new Google_Service_Calendar($client);

        return new GoogleCalendar($service, $calendarId);
    }
}
