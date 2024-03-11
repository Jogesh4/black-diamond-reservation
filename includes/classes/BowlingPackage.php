<?php

class BowlingPackage extends Package
{
    public string $type  = 'bowling';
    public bool $shoeRental = true;
    public int $maxPlayers = 6;
    public int $maxHours = 24;

    public function __construct(string $name, float $price, string $description, bool $shoeRental = true, int $maxPlayers = 6, int $maxHours = 24)
    {
        parent::__construct($name, $price, $description);
        $this->shoeRental = $shoeRental;
        $this->maxPlayers = $maxPlayers;
        $this->maxHours = $maxHours;
    }
}