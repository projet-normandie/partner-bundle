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
        $form->add('id', TextType::class, ['label' => 'id', 'attr' => ['readonly' => true]])
            ->add('libPartner', TextType::class, ['label' => 'libCategory'])
            ->add(
                'status',
                ChoiceType::class,
                [
                    'label' => 'Status',
                    'choices' => Partner::getStatusChoices(),
                ]
            )
            ->add('url', TextType::class, ['label' => 'URL'])
            ->add('contact', EmailType::class, ['label' => 'Contact [@]', 'required' => false])
            ->add(
                'description',
                TextareaType::class,
                ['label' => 'Description', 'required' => false, 'attr' => ['rows' => 10]]
            )
            ->add(
                'comment',
                TextareaType::class,
                ['label' => 'Comment', 'required' => false, 'attr' => ['rows' => 10]]
            );
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('libPartner')
            ->add('status');
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')
            ->add('libPartner', null, ['label' => 'libPartner'])
            ->add('status')
            ->add('url', 'text', ['label' => 'URL'])
            ->add('contact', 'text', ['label' => 'Contact'])
            ->add('_action', 'actions', ['actions' => ['show' => [], 'edit' => []]]);
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')
            ->add('libPartner')
            ->add('status')
            ->add('url')
            ->add('contact')
            ->add('description')
            ->add('comment');
    }
}
