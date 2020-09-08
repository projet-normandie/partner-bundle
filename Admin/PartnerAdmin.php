<?php

namespace ProjetNormandie\PartnerBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
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
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('export');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('id', TextType::class, ['label' => 'id', 'attr' => ['readonly' => true]])
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
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('libPartner')
            ->add('status');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('libPartner', null, ['label' => 'libPartner'])
            ->add('status')
            ->add('url', 'text', ['label' => 'URL'])
            ->add('contact', 'text', ['label' => 'Contact'])
            ->add('_action', 'actions', ['actions' => ['show' => [], 'edit' => []]]);
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('id')
            ->add('libPartner')
            ->add('status')
            ->add('url')
            ->add('contact')
            ->add('description')
            ->add('comment');
    }
}
