<?php

/**
 * Class Package
 *
 * This class represents a package with a type, name, price, and description.
 */
class Package {
    const PRICE_TYPE_FIXED = 'fixed';
    const PRICE_TYPE_HOURLY = 'hourly';


    /**
     * @var string The type of the package.
     */
    public string $type;

    /**
     * @var string The name of the package.
     */
    public string $name;

    /**
     * @var float The price of the package.
     */
    public float $price;

    /**
     * @var string The description of the package.
     */
    public string $description;

    public string $priceType = self::PRICE_TYPE_FIXED;

    /**
     * Package constructor.
     *
     * @param string $name The name of the package.
     * @param float $price The price of the package.
     * @param string $description The description of the package.
     */
    public function __construct(string $name, float $price, string $description) {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    /**
     * Get the formatted type of the package.
     *
     * @return string The formatted type of the package.
     */
    public function formattedType(): string
    {
        return ucfirst($this->type);
    }

    public function formattedPrice(): string
    {
        return $this->priceType === self::PRICE_TYPE_HOURLY ? '$' . $this->price . '/hr' : '$' . $this->price;
    }
}