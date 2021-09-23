<?php
namespace PHPEU;

/**
 * Class EUResponse
 *
 * An instance of this class will be returned after an API call
 */
class EUResponse {

    /**
     * The response code
     * 
     * @var string
     */
    public $status;

    /**
     * The message
     * 
     * @var string
     */
    public $message;

    /**
     * The error message
     * 
     * @var string
     */
    public $error;

    /**
     * Whether the request succeded
     *
     * @return bool
     */
    public function IsSuccess() {
        if ( ( $this->status == '200' || $this->status == '201' ) && $this->error == '' )
            return true;
        else
            return false;
    }

    /**
     * Whether the request failed
     *
     * @return bool
     */
    public function IsError() {
        if ( $this->status != '200' && $this->status != '201' && $this->error != '' )
            return true;
        else
            return false;
    }

    /**
     * Get the error message
     *
     * @return bool
     */
    public function GetErrorMessage() {
        if ( $this->status == 500 || $this->status == 404 )
            return $this->error;
        else
            return $this->message;
    }

    /**
     * Get the status code
     *
     * @return string
     */
    public function GetStatusCode() {
        return $this->status;
    }

    /**
     * Get the message
     *
     * @return bool
     */
    public function GetMessage() {
        return $this->message;
    }
}

/**
 * Class EUParticipantResponse
 * 
 * An instance of this class will be returned after Participant related calls
 */
class EUParticipantResponse extends EUResponse {
    
    /**
     * The participant's representation
     *
     * @var EUParticipantResponseEntity
     */
    public $participant;

    /**
     * Get the participant
     *
     * @return EUParticipantResponseEntity
     */
    public function GetParticipant(){
        return $this->participant;
    }
}

/**
 * Class EUNewsResponse
 * 
 * An instance of this class will be returned after GetNews call
 */
class EUNewsResponse extends EUResponse {
    
    /**
     * The News array
     *
     * @var EUNews[]
     */
    public $news;

    /**
     * Get the News array
     *
     * @return EUNews[]
     */
    public function GetNews(){
        return $this->news;
    }
}

/**
 * Class EUNewsDetailResponse
 * 
 * An instance of this class will be returned after GetNewsDetail call
 */
class EUNewsDetailResponse extends EUResponse {
    
    /**
     * The News
     *
     * @var EUNews
     */
    public $result;

    /**
     * Get the News
     *
     * @return EUNews
     */
    public function GetNews(){
        return $this->result;
    }
}

/**
 * Class EUCustomField
 * 
 * Participant's Custom Field
 */
class EUCustomField {
    
    /**
     * Custom Field Key
     *
     * @var string
     */
    public $key;

    /**
     * Custom Field Value
     *
     * @var mixed
     */
    public $value;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $key
     * @param mixed $value
     * 
     * @return EUCustomField
     */
    public function __construct( $key = '', $value = '' ) {
        $this->key = $key;
        $this->value = $value;
    }
}

/**
 * Class EUParticipantRequest
 * 
 * Participant's representation for registration or login
 */
class EUParticipantRequestEntity {
    
    /**
     * Participant's ID
     *
     * @var int
     */
    public $id;

    /**
     * Participant's Name
     *
     * @var string
     */
    public $name;

    /**
     * Participant's Surname
     *
     * @var string
     */
    public $surname;

    /**
     * Participant's Email
     *
     * @var string
     */
    public $email;

    /**
     * Participant's Username
     *
     * @var string
     */
    public $username;

    /**
     * Participant's Password
     *
     * @var string
     */
    public $password;

    /**
     * Participant's Custom Fields
     *
     * @var CustomField[]
     */
    public $custom_fields;

    /**
     * Participant's Company
     *
     * @var string
     */
    public $company;
    
    /**
     * Participant's Job Title
     *
     * @var string
     */
    public $job_title;    
    
    /**
     * Participant's Avatar URL
     *
     * @var string
     */
    public $remote_avatar_url;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $username
     * @param string $password
     * @param CustomField[] $custom_fields
     * @param string $company
     * @param string $job_title
     * @param string $remote_avatar_url
     */
    public function __construct( $name = '', $surname = '', $email = '', $username = '', $password = '', $custom_fields = array(), $company = '', $job_title = '', $remote_avatar_url = '' ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->custom_fields = $custom_fields;
        $this->company = $company;
        $this->job_title = $job_title;
        $this->remote_avatar_url = $remote_avatar_url;
    }
}

/**
 * Class EUParticipantResponse
 * 
 * Participant's representation after Participant related calls
 */
class EUParticipantResponseEntity extends EUParticipantRequestEntity {

    /**
     * Participant's coupled ID
     *
     * @var mixed
     */
    public $coupled_id;

    /**
     * Participant's UUID
     *
     * @var string
     */
    public $uuid;

    /**
     * Whether the participant is registered
     *
     * @var bool
     */
    public $registered;

    /**
     * Participant's registration date
     *
     * @var DateTime
     */
    public $registration_date;

    /**
     * Whether the participant is accredited
     *
     * @var bool
     */
    public $accredited;

    /**
     * Participant's event ID
     *
     * @var int
     */
    public $event_id;

    /**
     * Whether the participant can invite
     *
     * @var bool
     */
    public $invitation_permission;

    /**
     * Participant's avatar
     *
     * @var string
     */
    public $avatar;

    /**
     * Participant's socials
     *
     * @var array
     */
    public $socials;

    /**
     * Participant's max collaborators
     *
     * @var int
     */
    public $max_collaborators;

    /**
     * Participant's sessions
     *
     * @var int[]
     */
    public $sessions;

    /**
     * Participant's posts to read
     *
     * @var int
     */
    public $posts_to_read;

    /**
     * Participant's QR Code URL
     *
     * @var string
     */
    public $qrcode_url;

    /**
     * Participant's token
     *
     * @var string
     */
    public $token;    
}

/**
 * Class EUImage
 * 
 * Event image
 */
class EUImage {

    /**
     * URL for iPhone
     *
     * @var string
     */
    public $iphone;

    /**
     * URL for iPhone@2x
     *
     * @var string
     */
    public $iphone2x;

    /**
     * URL for iPad
     *
     * @var string
     */
    public $ipad;

    /**
     * URL for iPad@2x
     *
     * @var string
     */
    public $ipad2x;
}

/**
 * Class EUAuthor
 * 
 * Comment Author
 */
class EUAuthor {

    /**
     * Author ID
     *
     * @var int
     */
    public $id;

    /**
     * Author Name
     *
     * @var string
     */
    public $name;

    /**
     * Author Surname
     *
     * @var string
     */
    public $surname;
    
    /**
     * Author Username
     *
     * @var string
     */
    public $username;

    /**
     * Author Company
     *
     * @var string
     */
    public $company;
}

/**
 * Class EUComment
 * 
 * News Comment
 */
class EUComment {

    /**
     * Comment ID
     *
     * @var int
     */
    public $id;

    /**
     * Comment content
     *
     * @var string
     */
    public $content;

    /**
     * Comment date string
     *
     * @var string
     */
    public $date;

    /**
     * Comment date
     *
     * @var DateTime
     */
    public $created_at;

    /**
     * Comment Author
     *
     * @var EUAuthor
     */
    public $author; //Author
}

/**
 * Class EUCondition
 * 
 * News Condition
 */
class EUCondition {

    /**
     * Condition type
     *
     * @var mixed
     */
    public $type;
}

/**
 * Class EUNews
 * 
 * News representation
 */
class EUNews {

    /**
     * News ID
     *
     * @var int
     */
    public $id;

    /**
     * News title
     *
     * @var string
     */
    public $title;

    /**
     * News description
     *
     * @var string
     */
    public $description;

    /**
     * News publication date
     *
     * @var DateTime
     */
    public $data_pubblicazione;

    /**
     * News featured state
     *
     * @var bool
     */
    public $featured;

    /**
     * News image
     *
     * @var EUImage
     */
    public $image;

    /**
     * News likes count
     *
     * @var int
     */
    public $likes;

    /**
     * News user like
     *
     * @var bool
     */
    public $user_like;

    /**
     * News comments
     *
     * @var EUComment[]
     */
    public $comments;

    /**
     * News condition
     *
     * @var EUCondition
     */
    public $condition;
}