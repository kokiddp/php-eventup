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
				'content-type'  => 'application/json',
                'accept'        => 'application/json',
                'Authorization' => 'Token token="' . $this->token . '"'
            ],
            'http_errors' => false,
        ]);
        
        $this->decoder = new JsonDecoder();
        $this->decoder->register( new EULoginRegisterParticipantResponseTransformer() );
        $this->decoder->register( new EUParticipantResponseEntityTransformer() );
    }

    /**
     * Check username presence
     *
     * @param int|string $eventId
     * @param string $username
     * @return bool
     */
    public function IsUsernameAvailable( $eventId, $username, $locale = 'en' ) {
        $args = array(
            'username' => $username
        );
        $response = $this->client->request(
            'POST',
            'attendees/check_username/' . $eventId . '?locale=' . $locale,
            ['json' => $args]
        );

        $body = $response->getBody();
        $body_contents = $body->getContents();
        return $this->decoder->decode( $body_contents, EUResponse::class );
    }

    /**
     * Register Participant
     *
     * @param int|string $eventId
     * @param EUParticipantRequestEntity $participant
     * @return EUParticipantResponse
     */
    public function RegisterParticipant( $eventId, $participant, $locale = 'en' ) {
        $response = $this->client->request(
            'POST',
            'attendees/register/' . $eventId . '?locale=' . $locale,
            ['body' => '{"participant":' . json_encode( $participant ) . '}']
        );

        $body = $response->getBody();
        $body_contents = $body->getContents();
        return $this->decoder->decode( $body_contents, EUParticipantResponse::class );
    }

    /**
     * Login Participant
     *
     * @param int|string $eventId
     * @param string $username
     * @param string $password
     * @return EUParticipantResponse
     */
    public function LoginParticipant( $eventId, $username, $password, $locale = 'en' ) {
        $response = $this->client->request(
            'POST',
            'attendees/login/' . $eventId . '?locale=' . $locale,
            ['body' => '{"participant":{"username":"' . $username . '","password":"' . $password . '"}}']
        );

        $body = $response->getBody();
        $body_contents = $body->getContents();
        return $this->decoder->decode( $body_contents, EUParticipantResponse::class );
    }

    /**
     * Update Participant
     *
     * @param int|string $eventId
     * @param Participant $participant
     * @return EUParticipantResponse
     */
    public function UpdateParticipant( $eventId, $participant, $locale = 'en' ) {
        $response = $this->client->request(
            'POST',
            'attendees/update/' . $eventId . '?locale=' . $locale,
            ['body' => '{"participant":' . json_encode( $participant ) . '}']
        );

        $body = $response->getBody();
        $body_contents = $body->getContents();
        return $this->decoder->decode( $body_contents, EUParticipantResponse::class );
    }

    /**
     * Change Participant's Password
     *
     * @param int|string $eventId
     * @param string $username
     * @param string $password
     * @return EUParticipantResponse
     */
    public function ChangeParticipantPassword( $eventId, $username, $oldpassword, $newpassword, $locale = 'en' ) {
        $response = $this->client->request(
            'POST',
            'attendees/change_password/' . $eventId . '?locale=' . $locale,
            ['body' => '{"participant":{"username":"' . $username . '","oldpassword":"' . $oldpassword . '","newpassword":"' . $newpassword . '","confirm_newpwd":"' . $newpassword . '"}}']
        );

        $body = $response->getBody();
        $body_contents = $body->getContents();
        return $this->decoder->decode( $body_contents, EUParticipantResponse::class );
    }

}