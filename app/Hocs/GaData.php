<?php

namespace Nht\Hocs;

use Google_Client;
use Google_Service_Analytics;

class GaData {

    public function __construct()
    {
        $this->config = config('ga');
    }

    public function fetch($startDate = null, $endDate = null)
    {
        $client = new Google_Client();
        $client->setApplicationName("Analytics Reporting");
        $client->setAuthConfig(base_path().'/keys/'.$this->config['key_file_json']);
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $analytics = new Google_Service_Analytics($client);

        $startDate = $startDate ? $startDate : date('Y-m-d');
        $endDate   = $endDate ? $endDate : date('Y-m-d');

        $results = $analytics->data_ga->get(
           $this->config['ids'],
           $startDate,
           $endDate,
           implode(',', $this->config['metrics'])
        );

        $data = $results->totalsForAllResults;

        return $data;
    }
}