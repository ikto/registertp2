<?php

namespace IKTO\TestportalEmu\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $year = $request->get('CertYear');
        $number = $request->get('CertNum');
        while (strlen($number) < 7) {
            $number = '0' . $number;
        }
        $pin = $request->get('CertPIN');

        $response = null;

        $res = array($year, $number, $pin);

        $certificate = $this->getCertificateByAttributes($year, $number, $pin);

        if ($certificate) {
            array_push($res, $certificate->getName());

            if ($certificate->getSubject1()) {
                array_push($res, $certificate->getSubject1()->getName());
                array_push($res, sprintf('%.1f', $certificate->getValue1()));
            }

            if ($certificate->getSubject2()) {
                array_push($res, $certificate->getSubject2()->getName());
                array_push($res, sprintf('%.1f', $certificate->getValue2()));
            }

            if ($certificate->getSubject3()) {
                array_push($res, $certificate->getSubject3()->getName());
                array_push($res, sprintf('%.1f', $certificate->getValue3()));
            }

            if ($certificate->getSubject4()) {
                array_push($res, $certificate->getSubject4()->getName());
                array_push($res, sprintf('%.1f', $certificate->getValue4()));
            }

            if ($certificate->getSubject5()) {
                array_push($res, $certificate->getSubject5()->getName());
                array_push($res, sprintf('%.1f', $certificate->getValue5()));
            }
        } else {
            array_push($res, '<не знайдено>');
        }

        return new Response(implode('$$', $res), 200, array(
            'Content-type' => 'text/html; charset=utf-8',
        ));
    }

    /**
     * @param $year
     * @param $number
     * @param $pin
     * @return \IKTO\TestportalEmu\StorageBundle\Entity\Certificate
     */
    protected function getCertificateByAttributes($year, $number, $pin)
    {
        /**
         * @var \Doctrine\ORM\EntityRepository $certificateRepository
         */
        $certificateRepository =
            $this->getDoctrine()
                ->getManager()
                ->getRepository('IktoTpEmuStorageBundle:Certificate');

        return $certificateRepository->findOneBy(array(
            'year' => $year,
            'number' => $number,
            'pin' => $pin,
        ));
    }
}
