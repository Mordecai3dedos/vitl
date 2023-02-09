<?php declare(strict_types=1);

namespace DavidMorales\VitlCoupons\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use DavidMorales\VitlCoupons\Model\Coupon;
use DavidMorales\VitlCoupons\Helper\Data;
use Psr\Log\LoggerInterface;

class CreateCouponOnCreateOrder implements ObserverInterface
{
    public function __construct(
        private Coupon $coupon,
        private Data $helperData
    ) {}

    /**
     * @param Observer $observer
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute(Observer $observer)
    {
        if(!$this->helperData->getModuleStatus()) {
            return;
        }

        $order = $observer->getEvent()->getOrder();
        $skuToCheck = $this->helperData->getConfigOptions('sku');
        $ruleId = $this->helperData->getConfigOptions('rule');

        foreach ($order['items'] as $item) {
            if ($item['sku'] == $skuToCheck) {
                for($i = 0; $i < $item['qty_ordered']; $i++) {
                    $this->coupon->createCoupon($order['increment_id'], $ruleId);
                }
                /** Only one product is needed/accepted so we can stop searching **/
                return;
            }
        }
    }
}
