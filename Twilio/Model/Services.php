<?php
namespace Excellence\Twilio\Model;
use Magento\Framework\Model\Context;

class Services extends \Magento\Framework\Model\AbstractModel implements ServicesInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'excellence_twilio_services';

    public function __construct(Context $context,\Magento\Framework\Registry $registry)
    {
    	// print_r('In Model'); die();
        parent::__construct($context,$registry);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function send_sms( $sid, $token, $to, $from, $body ) 
    {
	    $uri = 'https://api.twilio.com/2010-04-01/Accounts/' . $sid . '/SMS/Messages';
	    $auth = $sid . ':' . $token;
	    $fields = 
	        '&To=' .  urlencode( $to ) . 
	        '&From=' . urlencode( $from ) . 
	        '&Body=' . urlencode( $body );
	    $res = curl_init();
	    curl_setopt( $res, CURLOPT_URL, $uri );
	    curl_setopt( $res, CURLOPT_POST, 3 ); 
	    curl_setopt( $res, CURLOPT_POSTFIELDS, $fields );
	    curl_setopt( $res, CURLOPT_USERPWD, $auth ); 
	    curl_setopt( $res, CURLOPT_RETURNTRANSFER, true );
	    $result = curl_exec( $res );
	    return $result;
    }
}
