<?php

namespace App\Search;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;

class SearchFormGenerator
{
    private FormFactoryInterface $formFactory;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }



    public function getSearchForm(): FormView{
        $form = $this->formFactory->create(UserSearchType::class);
        return $form->createView();
    }

}