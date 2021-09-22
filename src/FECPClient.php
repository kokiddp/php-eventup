<?php
namespace PHPEU;

use GuzzleHttp\Client;
use \Psr\Http\Message\ResponseInterface;
use Karriere\JsonDecoder\JsonDecoder;

require_once 'Model.php';
require_once 'Transformers.php';

class EUClient {

    /**
     * The Guzzle Http client
     *
     * @var Client
     */
    private $client;

    /**
     * The base URL
     *
     * @var string
     */
    private $baseUrl;

    /**
     * The Authorization Token
     *
     * @var string
     */
    private $token;

    /**
     * The JsonDecoder
     *
     * @var JsonDecoder
     */
    private $decoder;

    /**
     * Constructor
     *
     * @param string $baseUrl   The base URL
     * @param string $token     The Authorization Token
     * @return EUClient
     */
    public function __construct( $baseUrl, $token = '' ) {
        $this->baseUrl = $baseUrl;
        $this->token = $token;

        $this->client = new Client([
			'base_uri' => $this->baseUrl,
            'headers' => [
				'content-type' => 'application/json',
                'Authorization' => '' . $this->token . '"'
            ],
            'http_errors' => false,
        ]);
        
        $this->decoder = new JsonDecoder();
    }

    /**
     * Check if the request was a success
     * 
     * @param ResponseInterface $response    The Guzzle Client response
     * @return bool
     */
    private function isSuccess( $response ) {
        $status_code = $response->getStatusCode();
        if ( $status_code == 200 || $status_code == 201 ) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Handles EventUp API errors
     *
     * @param ResponseInterface $response    The Guzzle Client response
     * @return EUError
     */
    private function handleError( $response ) {
        $body = $response->getBody();
        $body_contents = $body->getContents();
        $body_object = json_decode( $body_contents );
        return new EUError( $body_object->errors[0]->code, $body_object->errors[0]->description );
    }

}