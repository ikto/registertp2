<?php

namespace IKTO\TestportalEmu\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $year = $request->get('Year');
        $number = $request->get('CertNum');
        $pin = $request->get('PIN');

        $response = null;

        if (!$year || !$number || !$pin) {
            $response = 'ERROR: variables not found ';
        } else {
            $certificate = $this->getCertificateByAttributes($year, $number, $pin);

            if (!$certificate) {
                $response = "ERROR: record not found (Year=$year, CertNum=$number, PIN=$pin)";
            } else {
                $res = array(
                    $certificate->getYear(),
                    $certificate->getName(),
                    $certificate->getNumber(),
                    $certificate->getPin(),
                    $certificate->getSubject1() ? $certificate->getSubject1()->getId() : '',
                    sprintf('%.1f', $certificate->getValue1()),
                    $certificate->getSubject2() ? $certificate->getSubject2()->getId() : '',
                    sprintf('%.1f', $certificate->getValue2()),
                    $certificate->getSubject3() ? $certificate->getSubject3()->getId() : '',
                    sprintf('%.1f', $certificate->getValue3()),
                    $certificate->getSubject4() ? $certificate->getSubject4()->getId() : '',
                    sprintf('%.1f', $certificate->getValue4()),
                    $certificate->getSubject5() ? $certificate->getSubject5()->getId() : '',
                    sprintf('%.1f', $certificate->getValue5()),
                );
                $res = array_map(function($val) { return $val . ';'; }, $res);

                $response = iconv('UTF-8', 'WINDOWS-1251', implode('', $res));
            }
        }

        return new Response($response, 200, array(
            'Content-type' => 'text/html; charset=WINDOWS-1251',
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
