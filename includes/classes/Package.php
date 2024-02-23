<?php

/**
 * Class Package
 *
 * This class represents a package with a type, name, price, and description.
 */
class Package {

    /**
     * @var string The type of the package.
     */
    public string $type;

    /**
     * @var string The name of the package.
     */
    public string $name;

    /**
     * @var int The price of the package.
     */
    public int $price;

    /**
     * @var string The description of the package.
     */
    public string $description;

    /**
     * Package constructor.
     *
     * @param string $name The name of the package.
     * @param int $price The price of the package.
     * @param string $description The description of the package.
     */
    public function __construct(string $name, int $price, string $description) {
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
}