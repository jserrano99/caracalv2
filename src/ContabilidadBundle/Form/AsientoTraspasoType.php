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

use ContabilidadBundle\Repository\CuentaMayorRepository;

class AsientoTraspasoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fecha', DateType::class, array (
                                    "label" => 'Fecha',
                                    "required" => 'required',
                                    'widget' => 'single_text',
                                    "attr" => array (
                                        'class' => 'form-control js-datepicker',
                                        'data-date-format' => 'dd-mm-yyyy')))
                ->add('observaciones', TextareaType::class, array (
                                    "label" => 'Observaciones',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('importe', TextType::class, array (
                                    "label" => 'Importe',
                                    "required" => true,
                                    "attr" => array ("class" => "form-control")))
                ->add('cuentaDestino', EntityType::class, array(
                                    "label"=> 'Destino Traspaso',
                                    "class" => 'ContabilidadBundle:CuentaMayor',
                                    "placeholder" => "Seleccione Cuenta Destino....",
                                    'query_builder' => function (CuentaMayorRepository $er) {
                                                        return $er->createQueryBuilder('u')
                                                        ->andwhere("u.codigo like '570%'")
                                                        ->orderBy('u.codigo', 'ASC');},
                                    "attr" => array("class" => "form-control")
                    ))
                ->add('Guardar', SubmitType::class, array(
                                    "attr" => array("class" => "form-submit btn btn-success")))
   
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContabilidadBundle\Entity\AsientoTraspaso'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
                return 'contabilidadbundle_asientotraspaso';

    }


}
