<?php
namespace DavidMorales\VitlCoupons\Model;

use Psr\Log\LoggerInterface;
use Magento\SalesRule\Api\Data\CouponInterface;
use Magento\SalesRule\Api\CouponRepositoryInterface;

class Coupon
{
    public function __construct(
        protected CouponRepositoryInterface $couponRepository,
        protected CouponInterface $coupon,
        private LoggerInterface $logger
    ) {}

    public function createCoupon($orderId) {
        $coupon = $this->coupon;
        $coupon->setCode($orderId . '_VITL')
            ->setIsPrimary(0)
            ->setRuleId(1);

        $coupon = $this->couponRepository->save($coupon);
        return $coupon->getCouponId();
    }
}
