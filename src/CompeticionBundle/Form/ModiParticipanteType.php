<?php

namespace CompeticionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModiParticipanteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
				->add('dorsal', TextType::class, array (
                                    "label" => 'Nº Dorsal',
                                    "required" => false,
                                    "attr" => array ("class" => "form-dorsal form-control")))
				
				->add('arquero', EntityType::class, array(
                                    "label"=> 'Arquero',
                                    "class" => 'PersonaBundle:Arquero',
									"disabled"=> true,
                                    "attr" => array("class" => "form-arquero form-control")))
    			->add('modalidad', EntityType::class, array(
                                    "label"=> 'Modalidad',
                                    "class" => 'CataBundle:Modalidad',
                                    "attr" => array("class" => "form-modalidad form-control")))
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
            'data_class' => 'CompeticionBundle\Entity\Participante'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'competicionbundle_participante';
    }


}
