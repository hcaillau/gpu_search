<?php

namespace AppBundle\Form\Type ;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use AppBundle\Form\Data\DocumentSearch;


/**
 * Formulaire de recherche des documents
 */
class DocumentSearchType extends AbstractType {

    /**
     * {@inheritdoc}
     */    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title', TextType::class, array('label' => 'Titre du document'))
            ->add('type', ChoiceType::class, array('choices' => array('' => '', 'PLU'=> 'PLU', 'CC' => 'CC', 'PLUi' => 'PLUi', 'POS' => 'POS', 'SUP' => 'SUP')))
            ->add('sup_cat', ChoiceType::class, array('choices' => array('' => '', 'AC1'=> 'AC1', 'A1' => 'A1', 'A2' => 'A2')))
            ->add('organisme', TextType::class, array('label' => 'Organisme producteur'))
            ->add('submit', SubmitType::class, array(
                'label' => 'Search',
                'attr' => array(
                    'formnovalidate' => 'formnovalidate',
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => DocumentSearch::class
        ));
    }

}
