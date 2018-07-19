<?php

namespace PersonaBundle\Form;

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

use PersonaBundle\Repository\PersonaRepository;
use CataBundle\Repository\ClubRepository;

class ArqueroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
				->add('licencia', TextType::class, array (
                                    "label" => 'Nº Licencia',
                                    "required" => true,
                                    "attr" => array ("class" => "form-licencia form-control")))
                ->add('persona', EntityType::class, array(
                                    "label"=> 'Persona',
                                    "class" => 'PersonaBundle:Persona',
									"placeholder" => "Seleccionar Persona....",
									'query_builder' => function (PersonaRepository $er) {
											return $er->createQueryBuilder('u')
											->orderBy('u.apellido1', 'ASC');},
							    
									"attr" => array("class" => "form-persona form-control")))
                ->add('club', EntityType::class, array(
                                    "label"=> 'Club',
                                    "class" => 'CataBundle:Club',
                               		"placeholder" => "Seleccionar Club....",
									'query_builder' => function (ClubRepository $er) {
											return $er->createQueryBuilder('u')
											->orderBy('u.descripcion', 'ASC');},
							    
									"attr" => array("class" => "form-club form-control")))
                ->add('categoria', EntityType::class, array(
                                    "label"=> 'Categoría',
                                    "class" => 'CataBundle:Categoria',
									"placeholder" => "Seleccionar Categoria....",
                                    "attr" => array("class" => "form-categoria form-control")))
			
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
            'dat	a_class' => 'PersonaBundle\Entity\Arquero'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'personabundle_arquero';
    }


}
