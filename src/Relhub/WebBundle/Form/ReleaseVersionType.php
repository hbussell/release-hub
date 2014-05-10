<?php

namespace Relhub\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReleaseVersionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            #->add('status')
            ->add('dueDate')
            #->add('startDate')
            ->add('branchNames')
            ->add('actions')
            ->add('approver', 'entity', array(
              'class' => 'Relhub\WebBundle\Entity\User'
              ))
            ->add('project', 'entity', array(
              'class' => 'Relhub\WebBundle\Entity\Project'
            ))
            ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Relhub\WebBundle\Entity\ReleaseVersion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'relhub_webbundle_releaseversion';
    }
}
