<?php

namespace SocioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use PersonaBundle\Repository\PersonaRepository;

class SocioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('foto', FileType::class,array(
									"label" => "Fotografía",
									"attr" =>array("class" => "form-control"),
									"data_class" => null,
									"required" => false	))
				->add('persona', EntityType::class, array(
                                    "label"=> 'Persona',
                                    "class" => 'PersonaBundle:Persona',
									'placeholder' => "Seleccione Persona....",
									'query_builder' => function (PersonaRepository $er) {
											return $er->createQueryBuilder('u')
											->orderBy('u.apellido1', 'ASC');},
							        "attr" => array("class" => "form-control")))
				->add('nmsocio', TextType::class, array (
                                    "label" => 'Nº Socio',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
				->add('numeroLicencia', TextType::class, array (
                                    "label" => 'Nº Licencia',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
				->add('licenciaMonitor', TextType::class, array (
                                    "label" => 'Nº Licencia Monitor (si tiene)',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
				->add('fcalta', DateType::class, array (
                                    "label" => 'Fecha Alta',
                                    "required" => 'required',
                                    'widget' => 'single_text',
                                    "attr" => array (
                                        'class' => 'form-control js-datepicker',
                                        'data-date-format' => 'dd-mm-yyyy')))
				->add('fcbaja', DateType::class, array (
                                    "label" => 'Fecha Baja',
                                    "required" => false,
                                    'widget' => 'single_text',
                                    "attr" => array (
                                    'class' => 'form-control js-datepicker',
                                    'data-date-format' => 'dd-mm-yyyy')))				
				->add('observaciones', TextareaType::class, array (
                                    "label" => 'Observaciones',
                                    "required" => false,
                                    "attr" => array ("class" => "form-control")))
				->add('estado', EntityType::class, array(
                                    "label"=> 'Estado',
                                    "class" => 'CataBundle:Estado',
									'placeholder' => "Seleccione Estado....",
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
            'data_class' => 'SocioBundle\Entity\Socio'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sociobundle_socio';
    }


}
