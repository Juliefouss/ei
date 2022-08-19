<?php
namespace App\Search\Admin;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Routing\RouterInterface;

class SearchUsersFormGenerator
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


    public function getSearchForm(): FormView{
        $form = $this->formFactory->create(UserSearchType::class, new SearchUser(), ['action'=>$this->router->generate('admin-search')]);
        return $form->createView();
    }



}