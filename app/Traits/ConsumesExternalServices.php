<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Validation\Rules\Exists;

trait ConsumesExternalServices{
    public function makeResquest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [] ){
        $client = new Client([
            'base_uri' => $this->base_uri,
        ]);

        if(method_exists($this, 'resolveAuthorization')){
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        $response = $client->request($method, $requestUrl, [
            'query' => $queryParams,
            'formParams' => $formParams,
            'headers' => $headers
        ]);

        if(method_exists($this, 'decodeResponse')){
            $this->decodeResponse($response);
        }

        if(method_exists($this, 'checkIfErrorResponse')){
            $this->checkIfErrorResponse($response);
        }

        $response = $response->getBody()->getContents();
        return $response;

    }
}
