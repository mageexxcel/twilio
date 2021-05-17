<?php
namespace Excellence\Twilio\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_twilioFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Excellence\Twilio\Model\TwilioFactory $twilioFactory
        )
    {
        $this->_twilioFactory=$twilioFactory;
        return parent::__construct($context);
    }
     
    public function execute()
    {
        $model= $this->_twilioFactory->create();
        $data=$model->intialize();
        
    } 
}
