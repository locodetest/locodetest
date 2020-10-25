<?php
namespace App\Controller;

use App\Parameters\Code;
use App\Parameters\NameWoDiacritics;
use App\Services\LocodeService;
//use Nelmio\ApiDocBundle\Tests\Functional\Controller\FOSRestController;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\View\View;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiController extends AbstractFOSRestController
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var LocodeService Service
     */
    private $locode;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * ApiController constructor.
     */
    public function __construct(
        RequestStack $requestStack,
        ValidatorInterface $validator,
        LocodeService $locode
    )
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->locode = $locode;
        $this->validator = $validator;
    }

    /**
     * @Route("/api/v1.0/locationsByCode/{code}", name="apiLocationByCode")
     * @return View
     */
    public function locationByCode($code)
    {
        $codeParams = new Code($code);
        $errors = $this->validator->validate($codeParams);

        if (count($errors) > 0) {
            return View::create('Bad parameters', Response::HTTP_BAD_REQUEST);
        }

        $data = $this->locode->getLocationsByCode($code);

        if (empty($data)) {
            return View::create('No content', Response::HTTP_NO_CONTENT);
        }

        return View::create($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/v1.0/locationsByNameWoDiacritics/{nameWoDiacritics}", name="apiLocationByNameWoDiacritics")
     * @return View
     */
    public function locationByNameWoDiacritics($nameWoDiacritics)
    {
        $nameWoDiacriticsParams = new NameWoDiacritics($nameWoDiacritics);
        $errors = $this->validator->validate($nameWoDiacriticsParams);

        if (count($errors) > 0) {
            return View::create('Bad parameters', Response::HTTP_BAD_REQUEST);
        }

        $data = $this->locode->getLocationsByNameWoDiacritics($nameWoDiacritics);

        if (empty($data)) {
            return View::create('No content', Response::HTTP_NO_CONTENT);
        }

        return View::create($data, Response::HTTP_OK);
    }
}
