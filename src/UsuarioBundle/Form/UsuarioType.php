<?php

namespace UsuarioBundle\Form;

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

class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('login', TextType::class, array (
                                    "label" => 'Username',
                                    "required" => 'required',
                                    "attr" => array ("class" => "form-login form-control"
                )))
                ->add('nombre', TextType::class, array (
                                    "label" => 'Nombre',
                                    "required" => 'required',
                                    "attr" => array ("class" => "form-nombre form-control"
                )))
                ->add('estado', ChoiceType::class, array(
                                    "label"=>'Estado',
                                    "required" => "required",
                                    "choices" => array( "Activo" => 1,
                                                        "Cambio Contraseña" => 2,
                                                        "Bloqueado" => 3 ),
                                   "attr"=> array("class" => "form-estado form-control"
                )))
                ->add('email', EmailType::class, array(
                                    "label"=>'Correo Electrónico',
                                    "required" => "required",
                                    "attr"=> array("class" => "form-email form-control"
                )))
                
                ->add('perfil', ChoiceType::class, array(
                                    "label"=>'Perfil',
                                    "required" => "required",
                                    "choices" => array( "Administrador" => 'ROLE_ADMIN',
                                                        "Usuario" => 'ROLE_USER',
                                                        "Junta Directiva" => 'ROLE_JUNTA'),
                                   "attr"=> array("class" => "form-perfil form-control"
                )))
                ->add('Guardar', SubmitType::class, array(
                                    "attr" => array("class" => "form-submit btn btn-success")
                                )
                );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UsuarioBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usuariobundle_usuario';
    }


}
