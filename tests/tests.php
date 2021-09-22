<?php
require '../vendor/autoload.php';

use PHPEU\EUClient;
use PHPEU\EUParticipantRequestEntity;
use PHPEU\EUCustomField;

$token = '767dffb9ffb6fb30a3dc7eb7e985e1f8';
$baseUrl = 'https://inbellezza-staging.kotukodev.it/api/business/v1/';
$event_id = 2;

$client = new EUClient( $baseUrl, $token );

$participant = new EUParticipantRequestEntity(
    "Test",
    "User",
    "test.user@kotuko.it",
    "test.user",
    "kotuko",
    array(
        new EUCustomField(
            "active",
            true
        )
    )
);
echo json_encode( $participant ) . PHP_EOL;


//IsUsernameAvailable
$isUsernameAvailable = $client->IsUsernameAvailable( $event_id, 'test.user' );
if ( $isUsernameAvailable->IsSuccess() ) {
    echo $isUsernameAvailable->GetMessage() . PHP_EOL;    

    //RegisterParticipant
    $registerParticipant = $client->RegisterParticipant( $event_id, $participant );
    if ( $registerParticipant->IsSuccess() ) {
        echo $registerParticipant->GetMessage() . PHP_EOL;
        echo json_encode( $registerParticipant->GetParticipant() ) . PHP_EOL;
    }
    else {
        echo $registerParticipant->GetErrorMessage() . PHP_EOL;
    }
}
else {
    echo $isUsernameAvailable->GetErrorMessage() . PHP_EOL;
}

//LoginParticipant
$loginParticipant = $client->LoginParticipant( $event_id, $participant->username, $participant->password );
if ( $loginParticipant->IsSuccess() ) {
    echo $loginParticipant->GetMessage() . PHP_EOL;
    echo json_encode( $loginParticipant->GetParticipant() ) . PHP_EOL;
}
else {
    echo $loginParticipant->GetErrorMessage() . PHP_EOL;
}

/*

//UpdateParticipant
$participant->name = "Di Prova";
$participant->surname = "Utente";
$updateParticipant = $client->UpdateParticipant( $event_id, $participant );
if ( $updateParticipant->IsSuccess() ) {
    echo $updateParticipant->GetMessage() . PHP_EOL;
    echo json_encode( $updateParticipant->GetParticipant() ) . PHP_EOL;
}
else {
    echo $updateParticipant->GetErrorMessage() . PHP_EOL;
}

//ChangePassword
$changePassword = $client->ChangeParticipantPassword( $event_id, $participant->username, $participant->password, 'okutok' );
if ( $changePassword->IsSuccess() ) {
    echo $updateParticipant->GetMessage() . PHP_EOL;
    echo json_encode( $updateParticipant->GetParticipant() ) . PHP_EOL;    
}
else {
    echo $changePassword->GetErrorMessage() . PHP_EOL;
}

*/