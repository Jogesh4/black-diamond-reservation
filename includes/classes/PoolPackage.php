<?php

class PoolPackage extends Package
{
    public string $type  = 'pool';

    public function __construct(string $name, float $price, string $description, bool $isHourly = false)
    {
        parent::__construct($name, $price, $description);
        $this->priceType = $isHourly ? self::PRICE_TYPE_HOURLY : self::PRICE_TYPE_FIXED;
    }
}