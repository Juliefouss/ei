<?php

namespace App\Search\User;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Routing\RouterInterface;

class HourlySearchFormGenerator
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


    public function getHourlySearchForm(): FormView{
        $form = $this->formFactory->create(HourlySearchType::class, new HourlySearch(), ['action'=>$this->router->generate('hourly-search')]);
        return $form->createView();
    }

}