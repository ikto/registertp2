<?php

namespace IKTO\TestportalEmu\StorageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IKTO\TestportalEmu\StorageBundle\Entity\Certificate;

class LoadCertificates extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \RuntimeException
     */
    public function load(ObjectManager $manager)
    {
        if (($handle = fopen(__DIR__ . '/data/certificates.csv', 'r')) === false) {
            throw new \RuntimeException('Cannot open subjects.csv');
        }

        $counter = 0;
        $batch = 0;
        while (($data = fgetcsv($handle, 0, ';')) !== false) {
            $cert = new Certificate();
            $cert
                ->setId($data[0])
                ->setYear($data[1])
                ->setName($data[2])
                ->setNumber($data[3])
                ->setPin($data[4])
                ->setSubject1($this->getReference('subject_' . $data[5]))
                ->setValue1($data[6])
                ->setSubject2($this->getReference('subject_' . $data[7]))
                ->setValue2($data[8])
                ->setSubject3($this->getReference('subject_' . $data[9]))
                ->setValue3($data[10]);

            $manager->persist($cert);
            $counter++;

            if ($counter >= 500) {
                $batch += 500;
                printf("%5d FLUSH\n", $batch);
                $manager->flush();
                $manager->clear();
                $counter = 0;
                # Only for dev environment (insufficient memory)
//                if ($batch >= 12000) {
//                    break;
//                }
            }
        }

        if ($counter > 0) {
            $manager->flush();
        }
        fclose($handle);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 20;
    }
}
