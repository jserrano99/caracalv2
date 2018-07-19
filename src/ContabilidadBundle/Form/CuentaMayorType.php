<?php

namespace ContabilidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CuentaMayorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('codigo', TextType::class, array (
                                    "label" => 'Código',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('descripcion', TextType::class, array (
                                    "label" => 'Descripción',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
                ->add('grupoCuenta', EntityType::class, array(
                                    "label"=> 'Grupo Cuentas',
                                    "class" => 'ContabilidadBundle:GrupoCuenta',
                                    "attr" => array("class" => "form-control")))
                ->add('tipoCuenta', EntityType::class, array(
                                    "label"=> 'Tipo de Cuenta',
                                    "class" => 'ContabilidadBundle:TipoCuenta',
                                    "attr" => array("class" => "form-control")))
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
            'data_class' => 'ContabilidadBundle\Entity\CuentaMayor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contabilidadbundle_cuentamayor';
    }


}
