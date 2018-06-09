<?php
/**
 * Created by ostashev@shogo.ru (09.06.2018 17:00)
 */

namespace App\DataFixtures;


use App\Entity\Elevator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ApplicationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++) {
            $elevator = new Elevator();
            $elevator->setCurrentFloor(random_int(1, 10));
            $elevator->setIsMoving(false);
            $manager->persist($elevator);
        }
        $manager->flush();
    }
}