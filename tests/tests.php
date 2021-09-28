<?php
require '../vendor/autoload.php';

use PHPEU\EUClient;
use PHPEU\EUParticipantRequestEntity;
use PHPEU\EUCustomField;

$token = '';
$baseUrl = 'https://inbellezza-staging.kotukodev.it/api/business/v1/';
$event_id = 2;

$client = new EUClient( $baseUrl, $token );

$participant = new EUParticipantRequestEntity(
    "Test",
    "User",
    "acxcswrwxvrcxunzuc@mrvpt.com",
    "pippo",
    "123456789",
    array(
        new EUCustomField(
            "enabled",
            false
        )
    )
);
echo json_encode( $participant ) . PHP_EOL;

//IsUsernameAvailable
$isUsernameAvailable = $client->IsUsernameAvailable( $event_id, 'test.user3' );
if ( $isUsernameAvailable ) {

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

//LoginParticipant
$loginParticipant = $client->LoginParticipant( $event_id, $participant->username, $participant->password );
if ( $loginParticipant->IsSuccess() ) {
    echo $loginParticipant->GetMessage() . PHP_EOL;
    echo json_encode( $loginParticipant->GetParticipant() ) . PHP_EOL;
}
else {
    echo $loginParticipant->GetErrorMessage() . PHP_EOL;
}

//UpdateParticipant
$participant->id = $loginParticipant->GetParticipant()->id;
$participant->custom_fields = array(
    new EUCustomField(
        "enabled",
        true
    )
);
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

//LoginParticipant
$loginParticipant = $client->LoginParticipant( $event_id, $participant->username, 'okutok' );
if ( $loginParticipant->IsSuccess() ) {
    echo $loginParticipant->GetMessage() . PHP_EOL;
    echo json_encode( $loginParticipant->GetParticipant() ) . PHP_EOL;
}
else {
    echo $loginParticipant->GetErrorMessage() . PHP_EOL;
}

$resetPassword = $client->ResetParticipantPassword( $event_id, $loginParticipant->GetParticipant()->email );
if ( $resetPassword->IsSuccess() ) {
    echo $resetPassword->GetMessage() . PHP_EOL;
}
else {
    echo $resetPassword->GetErrorMessage() . PHP_EOL;
}

$news = $client->GetNews( $event_id );
echo json_encode( $news->GetNews() ) . PHP_EOL;

$pieceOfNews = $client->GetNewsDetail( $event_id, $news->GetNews()[0]->id );
echo json_encode( $pieceOfNews->GetNews() ) . PHP_EOL;