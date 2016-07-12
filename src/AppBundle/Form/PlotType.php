<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlotType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array(
                'attr' => array('class' => 'form-control','placeholder'=>'Exemple : Parcelle 6, Le pré froid...'),
                'label' => "Entrer le nom de la parcelle",
                'required' => true,
                'label_attr' => array('class' => 'control-label')
            ))
            ->add('area',TextType::class,array(
                'attr' => array('class' => 'hidden'),
                'label_attr' => array('class' => 'hidden'),
            ))
            ->add('latLngs',TextType::class,array(
                'attr' => array('class' => 'hidden'),
                'label_attr' => array('class' => 'hidden'),
            ))
            ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Plot'
        ));
    }
}
