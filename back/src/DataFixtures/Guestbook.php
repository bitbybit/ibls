<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Ibls;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Guestbook extends Fixture
{

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $product = new Ibls\Guestbook;

            $product
                ->setName('User ' . $i)
                ->setEmail('user' . $i . '@gmail.com')
                ->setMessage('User ' . $i . ' message')
            ;

            $manager->persist($product);
        }

        $manager->flush();
    }

}
