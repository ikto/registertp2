<?php

namespace IKTO\TestportalEmu\GuiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IktoTpEmuGuiBundle:Default:index.html.twig');
    }

    public function checkAction(Request $request)
    {
        $year = $request->get('CertYear');
        $number = $request->get('CertNum');
        $pin = $request->get('CertPIN');

        $variables = array(
            'year' => $year,
            'number' => $number,
        );

        if (!preg_match('/^\d{7}$/', $number)) {
            $variables['number_error'] = true;
        }

        if (!preg_match('/^\d{4}$/', $pin)) {
            $variables['pin_error'] = true;
        }

        if (!isset($variables['number_error']) && !isset($variables['pin_error'])) {
            $certificate = $this->getCertificateByAttributes($year, $number, $pin);

            if ($certificate) {
                return $this->render(
                    'IktoTpEmuGuiBundle:Default:show.html.twig',
                    array(
                        'certificate' => $certificate,
                    )
                );
            }
        }

        $variables['not_found'] = true;
        return $this->render('IktoTpEmuGuiBundle:Default:index.html.twig', $variables);
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
