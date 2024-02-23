<?php

include_once __DIR__. '/classes/Package.php';
include_once __DIR__. '/classes/BirthdayFunPackage.php';
include_once __DIR__. '/classes/PoolPackage.php';

$basicPackage = new BirthdayFunPackage(
    'Basic Package',
    165.90,
    'For 1 hour of bowling, shoe rental, 2 jugs of pop, 1 Pringels snack stack per kid , plates, forks, and use of the tables behind your lanes for cake and presents. We do not allow any other outside food or drink to be brought in. Additional Pringles snack packs for $.50 each Additional jugs of pop for $6.00 each',
    ['bowling' => '1 hour', 'shoe rental' => true, 'pop' => 2, 'pringles' => 1, 'plates' => true, 'forks' => true]
);

$deluxePackage = new BirthdayFunPackage(
    'Deluxe Package',
    194.25,
    'For 1 hour of bowling, shoe rental, 2 jugs of pop, plates, forks, 1 hotdog for each child, 1 Pringels snack stack per kid and the use of the tables behind your lanes. We do not allow any other outside food or drink to be brought in. . Additional Pringles snack packs for $.50 each Additional jugs of pop for $6.00 each.',
    ['bowling' => '1 hour', 'shoe rental' => true, 'pop' => 2, 'hotdog' => 1, 'pringles' => 1, 'plates' => true, 'forks' => true]
);

$ultimatePackage = new BirthdayFunPackage(
    'Ultimate Package',
    222.60,
    'For 1 hour of bowling, shoe rental, 2 jugs of pop, plates, forks, 3 medium pizzas, choice of cheese, ham and pineapple or pepperoni. 1 Pringels snack stack per kid and the use of the tables behind your lanes. We do not allow any other outside food or drink to be brought in. Additional Pringles snack packs for $.50 each. Additional jugs of pop for $6.00 each.',
    ['bowling' => '1 hour', 'shoe rental' => true, 'pop' => 2, 'pizza' => 3, 'pringles' => 1, 'plates' => true, 'forks' => true]
);

$dayDeal = new PoolPackage('Day Deal', 15, 'prices are per PERSON and include tax All-you-can-play from Open- 5pm');
$nightDeal = new PoolPackage('Night Deal', 15, 'prices are per PERSON and include tax All-you-can-play from 5pm-Close');
$dayDeal2 = new PoolPackage('Day Deal', 25, 'prices are per PERSON and include tax All you can play from Open - Close');
$challengeMatch = new PoolPackage('Challenge Match', 7.50, 'prices are per PERSON and include tax for league members');

$allPackages = [
    $basicPackage,
    $deluxePackage,
    $ultimatePackage,
    $dayDeal,
    $nightDeal,
    $dayDeal2,
    $challengeMatch
];

function kebabCase($string): string
{
    return strtolower(str_replace(' ', '-', $string));
}

function findPackage($type, $name, $allPackages): array
{
    $packages = [];
    foreach ($allPackages as $package) {
        if ($package->type == $type && kebabCase($package->name) == kebabCase($name)) {
            $packages[] = $package;
        }
    }

    return $packages;
}

function displayPackage($type, $name, $allPackages): void
{
    $packages = findPackage($type, $name, $allPackages);
    if (count($packages) == 0) {
        echo "No packages found with the type of $type and the name of $name.\n";
    } else {
        foreach ($packages as $package) {
            echo "Type: $package->type\n";
            echo "Name: $package->name\n";
            echo "Price: $$package->price\n";
            echo "Description: $package->description\n";
            if (isset($package->additionalItems)) {
                echo "Additional Items: " . implode(', ', array_keys($package->additionalItems)) . "\n";
            }
            echo "\n";
        }
    }
}