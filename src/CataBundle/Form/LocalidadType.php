<?php

namespace CataBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LocalidadType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cd', TextType::class, array (
                                    "label" => 'Código',
                                    "required" => 'required',
                                    "attr" => array ("class" => "form-cd form-control")))
            ->add('descripcion', TextType::class, array (
                                    "label" => 'Descripción',
                                    "required" => 'required',
                                    "attr" => array ("class" => "form-descripcion form-control")))
            ->add('provincia', EntityType::class, array(
                                    "label"=> 'Provincia',
                                    "class" => 'CataBundle:Provincia',
                                    "attr" => array("class" => "form-provincia form-control"
            )))
            
            ->add('Guardar', SubmitType::class, array(
                                    "attr" => array("class" => "form-submit btn btn-success")
                                )
                )
          ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CataBundle\Entity\Localidad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelbundle_localidad';
    }


}
