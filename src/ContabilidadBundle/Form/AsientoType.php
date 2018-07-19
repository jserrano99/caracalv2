<?php

namespace ContabilidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AsientoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ejercicio', EntityType::class, array(
                                    "label"=> 'Ejercicio',
                                    "class" => 'ContabilidadBundle:Ejercicio',
                                    "disabled" => true,
                                    "attr" => array("class" => "form-control")))
                ->add('numero', TextType::class, array (
                                    "label" => 'Nº Asiento',
                                    "required" => true,
                                    "attr" => array ("class" => "form-control")))
                ->add('fecha', DateType::class, array (
                                    "label" => 'Fecha',
                                    "required" => 'required',
                                    'widget' => 'single_text',
                                    "attr" => array (
                                        'class' => 'form-control js-datepicker',
                                        'data-date-format' => 'dd-mm-yyyy')))
                ->add('descripcion', TextType::class, array (
                                    "label" => 'Descripción',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('observaciones', TextareaType::class, array (
                                    "label" => 'Observaciones',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                                ->add('importeDebe')
                ->add('importeDebe', TextType::class, array (
                                    "label" => 'Importe Debe',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('importeHaber', TextType::class, array (
                                    "label" => 'Importe Haber',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('proyecto', EntityType::class, array(
                                    "label"=> 'Proyecto',
                                    "class" => 'ContabilidadBundle:Proyecto',
                                    'placeholder' => " Seleccione Proyecto....",
                                    "required" => false,
                                    "attr" => array("class" => "form-control")))
                
                ->add('Guardar', SubmitType::class, array(
                                    "attr" => array("class" => "btn btn-success")))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContabilidadBundle\Entity\Asiento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contabilidadbundle_asiento';
    }


}
