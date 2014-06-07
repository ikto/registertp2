<?php

namespace IKTO\TestportalEmuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IktoTestportalEmuBundle:Default:index.html.twig');
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
            $certificateRepository =
                $this->getDoctrine()
                    ->getManager()
                    ->getRepository('IktoTestportalEmuBundle:Certificate');

            $certificates = $certificateRepository->findBy(array(
                'year' => $year,
                'number' => $number,
                'pin' => $pin,
            ));

            if (is_array($certificates) && (count($certificates) == 1)) {
                return $this->render(
                    'IktoTestportalEmuBundle:Default:show.html.twig',
                    array(
                        'certificate' => $certificates[0],
                    )
                );
            }
        }

        $variables['not_found'] = true;
        return $this->render('IktoTestportalEmuBundle:Default:index.html.twig', $variables);
    }
}
