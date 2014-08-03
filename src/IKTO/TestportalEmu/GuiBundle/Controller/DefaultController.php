<?php

namespace IKTO\TestportalEmu\GuiBundle\Controller;

use IKTO\TestportalEmu\StorageBundle\Entity\Certificate;
use IKTO\TestportalEmu\StorageBundle\Entity\CertificateRepository;
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
        if (
            $request->request->has('CertYear') ||
            $request->request->has('CertNum') ||
            $request->request->has('CertPIN')
        ) {
            return $this->forward('IktoTpEmuGuiBundle:Default:checkCertificateData', array(
                'year' => $request->get('CertYear'),
                'number' => $request->get('CertNum'),
                'pin' => $request->get('CertPIN'),
            ));
        }

        if ($request->request->has('CertFIO')) {
            return $this->forward('IktoTpEmuGuiBundle:Default:checkPersonData', array(
                'name' => $request->get('CertFIO'),
            ));
        }

        return $this->forward('IktoTpEmuGuiBundle:Default:index');
    }

    public function checkCertificateDataAction($year, $number, $pin)
    {
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
            /**
             * @var CertificateRepository $certificateRepository
             */
            $certificateRepository =
                $this->getDoctrine()
                    ->getManager()
                    ->getRepository('IktoTpEmuStorageBundle:Certificate');
            $certificate = $certificateRepository->findByAttributes($year, $number, $pin);

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

    public function checkPersonDataAction($name)
    {
        $variables = array(
            'name' => $name,
        );

        if (!preg_match('/^[абвгґдеєжзиіїйклмнопрстуфхцчшщьюяАБВГҐДЕЄЖЗИІЇЙКЛМНОПРСТУФХЦЧШЩЬЮЯ\s]+$/', $name)) {
            $variables['name_error'] = true;
        }

        if (!isset($variables['name_error'])) {
            /**
             * @var CertificateRepository $certificateRepository
             */
            $certificateRepository =
                $this->getDoctrine()
                    ->getManager()
                    ->getRepository('IktoTpEmuStorageBundle:Certificate');
            /**
             * @var Certificate[] $certificates
             */
            $certificates = $certificateRepository->findByName($name);

            if ($certificates) {
                $years = array_unique(
                    array_map(
                        function (Certificate $e) { return $e->getYear(); },
                        $certificates
                    )
                );
                rsort($years, SORT_NUMERIC);

                $collections = array();
                foreach ($years as $year) {
                    $collections[$year] = array_filter(
                        $certificates,
                        function (Certificate $e) use ($year) { return ($year == $e->getYear()); }
                    );
                }

                return $this->render(
                    'IktoTpEmuGuiBundle:Default:list.html.twig',
                    array(
                        'name' => $name,
                        'years' => $years,
                        'collections' => $collections,
                    )
                );
            }
        }

        $variables['not_found_by_name'] = true;
        return $this->render('IktoTpEmuGuiBundle:Default:index.html.twig', $variables);
    }
}
