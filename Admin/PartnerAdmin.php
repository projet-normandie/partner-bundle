<?php

namespace ProjetNormandie\PartnerBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use ProjetNormandie\PartnerBundle\Entity\Partner;

class PartnerAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'pnpartnerbundle_admin_partner';


    /**
     * @inheritdoc
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('export');
    }

    /**
     * @inheritdoc
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('idPartner', 'text', ['label' => 'idPartner', 'attr' => ['readonly' => true]])
            ->add('libPartner', 'text', ['label' => 'libCategory'])
            ->add(
                'status',
                ChoiceType::class,
                [
                    'label' => 'Status',
                    'choices' => Partner::getStatusChoices(),
                ]
            )
            ->add('url', 'text', ['label' => 'URL'])
            ->add('contact', 'email', ['label' => 'Contact [@]', 'required' => false])
            ->add('description', 'textarea', ['label' => 'Description', 'required' => false, 'attr' => ['rows' => 10]])
            ->add('comment', 'textarea', ['label' => 'Comment', 'required' => false, 'attr' => ['rows' => 10]]);
    }

    /**
     * @inheritdoc
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('libPartner')
            ->add('status');
    }

    /**
     * @inheritdoc
     * @throws \RuntimeException When defining wrong or duplicate field names.
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('idPartner')
            ->add('libPartner', null, ['label' => 'libPartner'])
            ->add('status')
            ->add('url', 'text', ['label' => 'URL'])
            ->add('contact', 'text', ['label' => 'Contact'])
            ->add('_action', 'actions', ['actions' => ['show' => [], 'edit' => []]]);
    }

    /**
     * @inheritdoc
     * @throws \RuntimeException When defining wrong or duplicate field names.
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('idPartner')
            ->add('libPartner')
            ->add('status')
            ->add('url')
            ->add('contact')
            ->add('description')
            ->add('comment');
    }
}
