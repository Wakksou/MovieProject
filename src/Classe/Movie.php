<?php
namespace App\Classe;

class Movie {


    public function getForecast(): ?array
    {
        $curl= curl_init("https://imdb-api.com/en/API/Top250Movies/k_5be2jkv7");
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 5
        ]);
        $data= curl_exec($curl);
        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !==200){
            return null;
        }
        $results = [];
        $data = json_decode($data, true);
        foreach ($data['items'] as $movie) {
            $results[] = [
                'title' => $movie['title'],
                'rank' => $movie['rank'],
                'year' => $movie['year'],
                'image' => $movie['image'],
                'imDbRating' => $movie['imDbRating']
            ];
        }
        return $results;
    }
}