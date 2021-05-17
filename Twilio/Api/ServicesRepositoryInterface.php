<?php
namespace Excellence\Twilio\Api;

use Excellence\Twilio\Model\ServicesInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ServicesRepositoryInterface 
{
    public function save(ServicesInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(ServicesInterface $page);

    public function deleteById($id);
}
