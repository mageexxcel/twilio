<?php
namespace Excellence\Twilio\Model;
require_once(BP.'/app/code/Excellence/Twilio/Model/Services/Twilio.php');
use Magento\Framework\Model\Context;
use Excellence\Twilio\Helper\Data;
class Twilio extends \Magento\Framework\Model\AbstractModel implements TwilioInterface
{
    const CACHE_TAG = 'excellence_twilio_twilio';
    const API_KEY_PATH='twilio/twilio_settings/api_key';
    const API_TOKEN='twilio/twilio_settings/api_token';
    const SMS_SENDER='twilio/twilio_settings/sms_sender';
    const SMS_ORDER_VERIFICATION='smssection/advancesetting/orderverification';
    protected $scopeConfig;
    protected $_dir;
    protected $coreData;
    public function __construct(Context $context,Data $coreData,\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \Magento\Framework\Filesystem\DirectoryList $dir,
                                 \Magento\Framework\ObjectManagerInterface $objectmanager
    
    )
    {
        $this->coreHelper = $coreData;  
        $this->scopeConfig = $scopeConfig;    
        $this->_dir = $dir;
         $this->_objectManager = $objectmanager;
     
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function sendSMS($to,$message)
    {  
        $accountSid= $this->scopeConfig->getValue(self::API_KEY_PATH,\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $authToken = $this->scopeConfig->getValue(self::API_TOKEN,\Magento\Store\Model\ScopeInterface::SCOPE_STORE);  
        $obj = new \Services_Twilio($accountSid, $authToken);
        $sender = $this->scopeConfig->getValue(self::SMS_SENDER,\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $result = $obj->account->messages->create(array(
            "From" => $sender,
            "To" => $to,
            "Body" => $message
        ));
        return $result;
    }
 
    public function testSMS($user_number) 
    {
        $message =__('This is a Test Message. Your API is Working Fine.');
        try{
            $sms = $this->sendSMS($user_number,$message);
            return 1;
        }
        catch(\Exception $e){
            return 0;
        }
    }
    public function isModuleActive() {
    $smsModule =$this->scopeConfig->getValue(self::SMS_ORDER_VERIFICATION,\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $apiKey = $this->scopeConfig->getValue(self::API_KEY_PATH,\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $apiToken = $this->scopeConfig->getValue(self::API_TOKEN,\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($smsModule && trim($apiKey) != '' && trim($apiToken) != '') {
            return true;
        } else {
            return false;
        }
    }
}
