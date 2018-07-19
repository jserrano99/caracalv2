<?php

namespace CompeticionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PartiRondaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('inscrito',ChoiceType::class, array(
								  "label" => 'Inscrito',
									'choices' => array(
												'Si' => 'S',
												'No' => 'N',
										)))
				->add('pagado',ChoiceType::class, array(
								  "label" => 'Pagado',
									'choices' => array(
												'Si' => 'S',
												'No' => 'N',
										)))
				->add('puntos', TextType::class, array (
                                    "label" => 'Puntos',
                                    "required" => false,
                                    "attr" => array ("class" => "form-puntos form-control")))
				
				->add('onces',TextType::class, array (
                                    "label" => "11's",
                                    "required" => false,
                                    "attr" => array ("class" => "form-onces form-control")))
				->add('dieces',TextType::class, array (
                                    "label" => "10's",
                                    "required" => false,
                                    "attr" => array ("class" => "form-dieces form-control")))
				
				->add('presentado', ChoiceType::class, array(
									'choices' => array(
												'Si' => 'S',
												'No' => 'N',
										)))
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
            'data_class' => 'CompeticionBundle\Entity\PartiRonda'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'competicionbundle_partironda';
    }


}
