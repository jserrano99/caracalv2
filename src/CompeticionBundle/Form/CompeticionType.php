<?php

namespace CompeticionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use CompeticionBundle\Entity\Competicion;
use CataBundle\Entity\Modo;
use CataBundle\Entity\TiposCompeticion;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class CompeticionType extends AbstractType
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
                
				->add('descripcion', TextType::class, array (
                                    "label" => 'Descripción',
                                    "required" => 'required',
                                    "attr" => array ("class" => "form-descripcion form-control")))
				->add('descontar', TextType::class, array (
                                    "label" => 'Nº Rondas a Descontar',
                                    "required" => false,
                                    "attr" => array ("class" => "form-descontar form-control")))
				->add('modo', EntityType::class, array(
                                    "label"=> 'Modo Competición',
                                    "class" => 'CataBundle:Modo',
                                    "attr" => array("class" => "form-modo form-control")))
    			->add('tipoCompeticion', EntityType::class, array(
                                    "label"=> 'Tipo Competición',
                                    "class" => 'CataBundle:TipoCompeticion',
                                    "attr" => array("class" => "form-tipoCompeticion form-control")))
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
            'data_class' => 'CompeticionBundle\Entity\Competicion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'competicionbundle_competicion';
    }


}
