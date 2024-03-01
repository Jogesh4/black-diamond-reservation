<?php


/**
 * Class BirthdayFunPackage
 *
 * This class represents a Birthday Fun package with a type, name, price, and description.
 */
class BirthdayFunPackage extends Package {

    /**
     * @var string The type of the package.
     */
    public string $type = 'birthday';

    /**
     * @var array The additional items included in the package.
     */
    public array $additionalItems;

    /**
     * BirthdayFunPackage constructor.
     *
     * @param string $name The name of the package.
     * @param float $price The price of the package.
     * @param string $description The description of the package.
     * @param array $additionalItems The additional items included in the package.
     */
    public function __construct(string $name, float $price, string $description, array $additionalItems) {
        parent::__construct($name, $price, $description);
        $this->additionalItems = $additionalItems;
    }
}