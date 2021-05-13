<?php

declare(strict_types=1);

namespace App\Controller;


use App\Form\CalculatorForm;
use App\Repository\CalculationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    /**
     * @var string|null
     */
    private $equation = null;
    /**
     * @Route("/", name="calculator")
     */
    public function index()
    {

    }

    /**
     * @Route("/calculator", name="ajax_calculator")
     *
     * @param Request $request
     * @param CalculationRepository $calculationRepository
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function calculateAction(Request $request, CalculationRepository $calculationRepository): JsonResponse
    {
        if (!$request->isMethod('POST') || !$request->request->has(CalculatorForm::FORM_NAME)) {
            throw new \Exception(sprintf('A calculation must be submitted'));
        }

        $formData = $request->request->get(CalculatorForm::FORM_NAME);

        if(!isset($formData['operator'])) {
            throw new \Exception(
                sprintf('One of the operations must be selected, such as %s',
            CalculatorForm::MULTIPLY)
            );
        }

        if (isset($formData['equation'])) {
            $this->equation = $calculationRepository->fetchEquationByHandle($formData['equation']);
        }

        $equationHelper = new EquationHelper();


        return new JsonResponse([
            'originalEquation' => $this->equation,
            'equationWithValues' => $equationHelper->fillInEquationValues(),
            'answer' => $calculatedValue,
        ]);
    }
}