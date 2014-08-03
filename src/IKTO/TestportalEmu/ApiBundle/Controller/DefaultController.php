<?php

namespace IKTO\TestportalEmu\ApiBundle\Controller;

use IKTO\TestportalEmu\ApiBundle\Response\NotFoundResponse;
use IKTO\TestportalEmu\ApiBundle\Response\SuccessResponse;
use IKTO\TestportalEmu\StorageBundle\Entity\CertificateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $year = $request->get('CertYear');
        $number = sprintf('%7d', $request->get('CertNum'));
        $pin = $request->get('CertPIN');

        /**
         * @var CertificateRepository $certificateRepository
         */
        $certificateRepository =
            $this->getDoctrine()
                ->getManager()
                ->getRepository('IktoTpEmuStorageBundle:Certificate');
        $certificate = $certificateRepository->findByAttributes($year, $number, $pin);

        if ($certificate) {
            $response = new SuccessResponse();
            $response->setContentByCertificate($certificate);

            return $response;
        }

        $response = new NotFoundResponse();
        $response->setContentByAttributes($year, $number, $pin);

        return $response;
    }
}
