<?php
namespace PHPEU;

/**
 * Class EUError
 *
 * An instance of this class will be returned if the API call fails
 */
class EUError {

    /**
     * The error code
     * 
     * @var string
     */
    public $code;

    /**
     * The error description
     * 
     * @var string
     */
    public $description;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $code
     * @param string $description
     */
    public function __construct( $code = '', $description = '' ) {
        $this->code = $code;
        $this->description = $description;
    }

}