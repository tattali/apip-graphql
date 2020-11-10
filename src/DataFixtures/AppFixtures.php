<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; ++$i) {
            $user = new User();
            $user->setFirstname('firstname '.$i);
            $user->setLastname('lastname '.$i);
            $user->getActualRemuneration()->setFixedSalary(random_int(20, 200));
            $user->getActualRemuneration()->setFullPackage(random_int(20, 200));
            $user->getExpectedRemuneration()->setFixedSalary(random_int(20, 200));
            $user->getExpectedRemuneration()->setFullPackage(random_int(20, 200));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
