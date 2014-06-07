<?php

namespace IKTO\TestportalEmu\StorageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IKTO\TestportalEmu\StorageBundle\Entity\Subject;

class LoadSubjects extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \RuntimeException
     */
    public function load(ObjectManager $manager)
    {
        if (($handle = fopen(__DIR__ . '/data/subjects.csv', 'r')) === false) {
            throw new \RuntimeException('Cannot open subjects.csv');
        }

        while (($data = fgetcsv($handle, 0, ';')) !== false) {
            $subject = new Subject();
            $subject->setId($data[0])->setName($data[1]);

            $manager->persist($subject);
            $this->setReference('subject_' . $data[0], $subject);
        }

        $manager->flush();
        fclose($handle);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 10;
    }
}
