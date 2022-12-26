<?php

namespace ProjetNormandie\PartnerBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use ProjetNormandie\PartnerBundle\Entity\Partner;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PartnerAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'pnpartnerbundle_admin_partner';

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->remove('export');
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('libPartner', TextType::class, ['label' => 'label.libPartner'])
            ->add(
                'status',
                ChoiceType::class,
                [
                    'label' => 'label.status',
                    'choices' => Partner::getStatusChoices(),
                ]
            )
            ->add('url', TextType::class, ['label' => 'label.url'])
            ->add('contact', EmailType::class, ['label' => 'label.contact', 'required' => false])
            ->add(
                'description',
                TextareaType::class,
                ['label' => 'label.description', 'required' => false, 'attr' => ['rows' => 10]]
            )
            ->add(
                'comment',
                TextareaType::class,
                ['label' => 'label.comment', 'required' => false, 'attr' => ['rows' => 10]]
            );
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('libPartner', null, ['label' => 'label.libPartner'])
            ->add('status', null, ['label' => 'label.status']);
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id', null, ['label' => 'label.id'])
            ->add('libPartner', null, ['label' => 'label.libPartner'])
            ->add('status', null, ['label' => 'label.status'])
            ->add('url', 'text', ['label' => 'label.url'])
            ->add('contact', 'text', ['label' => 'label.contact'])
            ->add('_action', 'actions', ['actions' => ['show' => [], 'edit' => []]]);
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id', null, ['label' => 'label.id'])
            ->add('libPartner', null, ['label' => 'label.libPartner'])
            ->add('status', null, ['label' => 'label.status'])
            ->add('url', null, ['label' => 'label.url'])
            ->add('contact', null, ['label' => 'label.contact'])
            ->add('description', null, ['label' => 'label.description'])
            ->add('comment', null, ['label' => 'label.comment']);
    }
}
