<?php

namespace PersonaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use CataBundle\Repository\LocalidadRepository;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class PersonaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nif', TextType::class, array (
                                    "label" => 'NIF',
                                    "required" => 'required',
                                    "attr" => array ("class" => "form-nif form-control")))
                ->add('nombre', TextType::class, array (
                                    "label" => 'Nombre',
                                    "required" => 'required',
                                    "attr" => array ("class" => "form-nombre form-control")))
                ->add('apellido1', TextType::class, array (
                                    "label" => 'Primer Apellido',
                                    "required" => 'required',
                                    "attr" => array ("class" => "form-apellido1 form-control")))           
                ->add('apellido2', TextType::class, array (
                                    "label" => 'Segundo Apellido',
                                    "attr" => array ("class" => "form-apellido2 form-control")))
                ->add('fcnac', DateType::class, array (
                                    "label" => 'Fecha Nacimiento',
                                    "required" => true,
                                    'widget' => 'single_text',
                                    "attr" => array (
                                        'class' => 'form-control js-datepicker',
                                        'data-date-format' => 'dd-mm-yyyy')))
                ->add('email', EmailType::class, array(
                                    "label"=>'Correo Electrónico',
                                    "required" => false,
                                    "attr"=> array("class" => "form-email form-control")))
                ->add('domicilio', TextType::class, array (
                                    "label" => 'Domicilio',
									"required" => FALSE,
                                    "attr" => array ("class" => "form-domicilio form-control")))
                ->add('cdpostal', TextType::class, array (
                                    "label" => 'Código Postal',
                                    "required" => FALSE,
                                    "attr" => array ("class" => "form-cdpostal form-control")))
                ->add('provincia', EntityType::class, array(
                                    "label"=> 'Provincia',
                                    "class" => 'CataBundle:Provincia',
									"required" => false,
									"placeholder" => "Selecciona Provincia....",
									"attr" => array("class" => "form-provincia form-control")))
                ->add('localidad', EntityType::class, array(
                                    "label"=> 'Localidad',
                                    "class" => 'CataBundle:Localidad',
									"required" => false,
									"placeholder" => "Selecciona Localidad....",
									'query_builder' => function (LocalidadRepository $er) {
											return $er->createQueryBuilder('u')
											->orderBy('u.descripcion', 'ASC');},
                                    "attr" => array("class" => "form-localidad form-control")))       
                ->add('movil', TextType::class, array (
                                    "label" => 'Móvil',
									"required" => FALSE,
                                    "attr" => array ("class" => "form-movil form-control")))
           
                ->add('telefono', TextType::class, array (
                                    "label" => 'Teléfono',
									"required" => FALSE,
                                    "attr" => array ("class" => "form-telefono form-control")))
				
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
            'data_class' => 'PersonaBundle\Entity\Persona'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'personabundle_persona';
    }


}
