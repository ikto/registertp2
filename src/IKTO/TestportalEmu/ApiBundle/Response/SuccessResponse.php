<?php

namespace IKTO\TestportalEmu\ApiBundle\Response;

use IKTO\TestportalEmu\StorageBundle\Entity\Certificate;
use IKTO\TestportalEmu\StorageBundle\Entity\Subject;

class SuccessResponse extends ApiResponse
{
    public function setContentByCertificate(Certificate $certificate)
    {
        $result = array();

        array_push($result, $certificate->getName());

        $this->appendSubject($result, $certificate->getSubject1(), $certificate->getValue1());
        $this->appendSubject($result, $certificate->getSubject2(), $certificate->getValue2());
        $this->appendSubject($result, $certificate->getSubject3(), $certificate->getValue3());
        $this->appendSubject($result, $certificate->getSubject4(), $certificate->getValue4());
        $this->appendSubject($result, $certificate->getSubject5(), $certificate->getValue5());

        $this->setContent(implode(';', $result));
    }

    private function appendSubject(array &$result, $subject, $value)
    {
        if ($subject instanceof Subject) {
            array_push($result, $subject->getId());
            array_push($result, $value);
        } else {
            array_push($result, '');
            array_push($result, '');
        }
    }
}
