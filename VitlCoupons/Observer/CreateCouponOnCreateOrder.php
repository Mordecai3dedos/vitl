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
        private LoggerInterface $logger,
        private Coupon $coupon,
        private Data $helperData
    ) {}

    public function execute(Observer $observer)
    {
        if(!$this->helperData->getModuleStatus()) {
            return;
        }

        $order = $observer->getEvent()->getOrder();
        $skuToCheck = $this->helperData->getConfigOptions('sku');

        foreach ($order['items'] as $item) {
            if ($item['sku'] == $skuToCheck) {
                return $this->coupon->createCoupon($order['increment_id']);
            }
        }
    }
}
