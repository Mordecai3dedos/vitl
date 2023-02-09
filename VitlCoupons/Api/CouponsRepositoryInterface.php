<?php
namespace DavidMorales\VitlCoupons\Api;

/**
 * @api
 * @since 1.0.0
 */
interface CouponsRepositoryInterface
{
    /**
     * @return string
     */
    public function getItems(): string;
}
