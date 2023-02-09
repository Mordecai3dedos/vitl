<?php
namespace DavidMorales\VitlCoupons\Model\Api;

use DavidMorales\VitlCoupons\Api\CouponsRepositoryInterface;
use Magento\SalesRule\Model\ResourceModel\Coupon\CollectionFactory;
use DavidMorales\VitlCoupons\Helper\Data;

class CouponsRepository implements CouponsRepositoryInterface
{
    public function __construct(
        private CollectionFactory $_couponCollection,
        private Data $_helperData
    ) {}

    /**
     * Return all coupon codes for specified rule id in
     *
     * @return string
     */
    public function getItems(): string
    {
        $ruleId = $this->_helperData->getConfigOptions('rule');
        $collection = $this->_couponCollection->create();
        $collection->addFieldToSelect('code');
        $collection->addFieldToFilter('rule_id', $ruleId);

        return json_encode($collection->toArray());
    }
}
