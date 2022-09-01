<?php

namespace App\Search\Admin;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Routing\RouterInterface;

class HourlyAdminSearchFormGenerator
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

    public function getHourlyAdminSearchForm(): FormView{
        $form =$this->formFactory->create(HourlyAdminSearchType::class, new HourlyAdminSearch(), ['action'=> $this->router->generate('hourlySearchAdmin')]);
        return $form->createView();
    }
}