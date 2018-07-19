<?php

namespace ContabilidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use ContabilidadBundle\Repository\CuentaMayorRepository;

class ApunteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numero', TextType::class, array (
                                    "label" => 'Número',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('descripcion', TextType::class, array (
                                    "label" => 'Descripcion',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('cuentaDebe', EntityType::class, array(
                                    "label"=> 'Cuenta Debe',
                                    "placeholder" => " Seleccione Cuenta de Mayor.... ",
                                    "required" => false,
                                    'query_builder' => function (CuentaMayorRepository $er) {
                                                        return $er->createQueryBuilder('u')
                                                        ->orderBy('u.codigo', 'ASC');},
                                    "class" => 'ContabilidadBundle:CuentaMayor',
                                    "attr" => array("class" => "form-control")))
                ->add('importeDebe', TextType::class, array (
                                    "label" => 'Importe Debe',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('cuentaHaber', EntityType::class, array(
                                    "label"=> 'Cuenta Haber',
                                    "placeholder" => " Seleccione Cuenta de Mayor.... ",
                                    "class" => 'ContabilidadBundle:CuentaMayor',
                                    "required" => false,
                                    'query_builder' => function (CuentaMayorRepository $er) {
                                                        return $er->createQueryBuilder('u')
                                                        ->orderBy('u.codigo', 'ASC');},
                                    "attr" => array("class" => "form-control")))
                ->add('importeHaber', TextType::class, array (
                                    "label" => 'Importe Haber',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('observaciones', TextareaType::class, array (
                                    "label" => 'Observaciones',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
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
            'data_class' => 'ContabilidadBundle\Entity\Apunte'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contabilidadbundle_apunte';
    }


}
