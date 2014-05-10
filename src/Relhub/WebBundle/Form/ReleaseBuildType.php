<?php

namespace Relhub\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReleaseBuildType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('actions', 'collection', array(
            'type'   => 'hidden',
        ));
        $builder
           ->add('confirm', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Relhub\WebBundle\Entity\ReleaseBuild'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'relhub_webbundle_releasebuild';
    }
}
