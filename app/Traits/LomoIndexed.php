<?php
namespace App\Traits;
use GuzzleHttp\Client;
use DB;

trait LomoIndexed{

    public $endpoint = "";
    public $key = "";

    public function getAll(){

        $currentPage = 1;
        $totalPages = 1;
        $totalItems = 1;
        $allItems = [];

        $tempData = $this->getPage($currentPage);
        $currentPage++;

        $totalItems = $tempData['meta']['total_entries'];
        $currentPage = $tempData['meta']['page'];
        $totalPages = ceil($totalItems/20);

        $allItems = array_merge($tempData[$this->key], $allItems);

        for($currentPage; $currentPage <= $totalPages; $currentPage++){
            $tempData = $this->getPage($currentPage);
            $allItems = array_merge($tempData[$this->key], $allItems);
        }

        return $allItems;

    }

    public function getPage($page){

        $client = new Client();
        $response = $client->request('GET', $this->endpoint, [
            'query' =>
            [
                'api_key' => env('LOMOGRAPHY_API_KEY'),
                'page' => $page
            ]
        ]);

        //usleep(500000);

        return json_decode($response->getBody(),true);
    }

}
