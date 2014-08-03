<?php

namespace IKTO\TestportalEmu\StorageBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class CertificateRepository
 * @package IKTO\TestportalEmu\StorageBundle\Entity
 *
 * @method findByName
 */
class CertificateRepository extends EntityRepository
{
    /**
     * @param integer $year
     * @param integer $number
     * @param integer $pin
     * @return null|Certificate
     */
    public function findByAttributes($year, $number, $pin)
    {
        return $this->findOneBy(array(
            'year' => $year,
            'number' => $number,
            'pin' => $pin,
        ));
    }
}
