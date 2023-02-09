<?php
namespace DavidMorales\VitlCoupons\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\SalesRule\Api\Data\CouponInterface;
use Magento\SalesRule\Api\CouponRepositoryInterface;

class Coupon
{
    public function __construct(
        protected CouponRepositoryInterface $couponRepository,
        protected CouponInterface $coupon
    ) {}

    /**
     * Creates coupon codes, the use of 'clone' allows creating multiple codes from observer
     * The name of the coupon code depends on the $orderId param.
     *
     * @param $orderId
     * @param $ruleId
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function createCoupon($orderId, $ruleId) {
        $coupon = clone $this->coupon;
        $coupon->setCode($orderId . "_" . $this->generateRandomCouponName())
            ->setIsPrimary(0)
            ->setRuleId($ruleId);

        try {
            $this->couponRepository->save($coupon);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
    }

    /**
     * Generate random string for the coupon name
     *
     * @return string
     */
    private function generateRandomCouponName() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($permitted_chars), 0, 5);
    }
}
