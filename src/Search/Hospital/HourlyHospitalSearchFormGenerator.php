<?php

namespace App\Search\Hospital;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Routing\RouterInterface;

class HourlyHospitalSearchFormGenerator
{

    private FormFactoryInterface $formFactory;
    private RouterInterface $router;

    /**
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     */
    public function __construct(FormFactoryInterface $formFactory, RouterInterface $router)
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    public function getHourlyHospitalSearchForm(): FormView{
        $form = $this->formFactory->create(HourlyHospitalSearchType::class, new HourlyHospitalSearch(), ['action'=>$this->router->generate('hourlyHospitalSearch')]);
        return $form->createView();
    }
}