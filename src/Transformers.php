<?php

namespace PHPEU;

use Karriere\JsonDecoder\Transformer;
use Karriere\JsonDecoder\ClassBindings;
use Karriere\JsonDecoder\Bindings\FieldBinding;
use Karriere\JsonDecoder\Bindings\ArrayBinding;
use Karriere\JsonDecoder\Bindings\DateTimeBinding;

class EUParticipantResponseTransformer implements Transformer
{
    public function register( ClassBindings $classBindings )
    {
        $classBindings->register( new FieldBinding( 'participant', 'participant', EUParticipantResponseEntity::class ) );
    }

    public function transforms()
    {
        return EUParticipantResponse::class;
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

class EUCommentTransformer implements Transformer
{
    public function register( ClassBindings $classBindings )
    {
        $classBindings->register( new FieldBinding( 'author', 'author', EUAuthor::class ) );
        $classBindings->register( new DateTimeBinding( 'created_at', 'created_at', true, 'Y-m-d\TH:i:s.v\Z' ) );
    }

    public function transforms()
    {
        return EUComment::class;
    }
}

class EUNewsTransformer implements Transformer
{
    public function register( ClassBindings $classBindings )
    {
        $classBindings->register( new FieldBinding( 'image', 'image', EUImage::class ) );
        $classBindings->register( new ArrayBinding( 'comments', 'comments', EUComment::class ) );
        $classBindings->register( new DateTimeBinding( 'data_pubblicazione', 'data_pubblicazione', true, 'U' ) );
        $classBindings->register( new FieldBinding( 'condition', 'condition', EUCondition::class ) );
    }

    public function transforms()
    {
        return EUNews::class;
    }
}

class EUNewsResponseTransformer implements Transformer
{
    public function register( ClassBindings $classBindings )
    {
        $classBindings->register( new ArrayBinding( 'news', 'news', EUNews::class ) );
    }

    public function transforms()
    {
        return EUNewsResponse::class;
    }
}

class EUNewsDetailResponseTransformer implements Transformer
{
    public function register( ClassBindings $classBindings )
    {
        $classBindings->register( new FieldBinding( 'result', 'result', EUNews::class ) );
    }

    public function transforms()
    {
        return EUNewsDetailResponse::class;
    }
}