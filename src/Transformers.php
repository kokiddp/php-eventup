<?php

namespace PHPEU;

use Karriere\JsonDecoder\Transformer;
use Karriere\JsonDecoder\ClassBindings;
use Karriere\JsonDecoder\Bindings\FieldBinding;
use Karriere\JsonDecoder\Bindings\ArrayBinding;
use Karriere\JsonDecoder\Bindings\DateTimeBinding;

class EULoginRegisterParticipantResponseTransformer implements Transformer
{
    public function register( ClassBindings $classBindings )
    {
        $classBindings->register( new FieldBinding( 'participant', 'participant', EUParticipantResponseEntity::class ) );
    }

    public function transforms()
    {
        return EURegisterParticipantResponse::class;
    }
}

class EUParticipantResponseEntityTransformer implements Transformer
{
    public function register( ClassBindings $classBindings )
    {
        $classBindings->register( new ArrayBinding( 'custom_fields', 'custom_fields', EUCustomField::class ) );
        $classBindings->register( new DateTimeBinding( 'registration_date', 'registration_date', true, 'Y-m-d H:i:s P' ) );
    }

    public function transforms()
    {
        return EUParticipantResponseEntity::class;
    }
}