<?php

namespace App\DataFixtures;

use App\Entity\Region;
use App\Entity\Winehouse;
use App\Entity\Winemaker;
use App\Entity\WineSource;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $regions = Region::cases();
        $winesources = WineSource::cases();
        for ($i = 0; $i < 20; $i++) {
            $winemaker = new Winemaker(
                true,
                $this->faker->firstName,
                $this->faker->lastName,
                $this->faker->phoneNumber,
                1, //$this->faker->randomElement($winesources)
            );
            $winehouse = new Winehouse(
                $this->faker->name,
                $this->faker->address,
                $this->faker->city,
                1, // $this->faker->randomElement($regions),  // $this->faker->randomElements(Region::class); // https://fakerphp.org/formatters/numbers-and-strings/#randomelements
                $this->faker->numberBetween(10000, 98000),
                "hola",
                $winemaker,
                50 * $this->faker->numberBetween(1, 5)
            );


            $manager->persist($winemaker);
            $manager->persist($winehouse);
            $manager->flush();

        }
    }
}