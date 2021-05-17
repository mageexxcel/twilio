<?php
namespace Excellence\Twilio\Api;

use Excellence\Twilio\Model\TwilioInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface TwilioRepositoryInterface 
{
    public function save(TwilioInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(TwilioInterface $page);

    public function deleteById($id);
}
