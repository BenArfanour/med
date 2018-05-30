<?php

namespace RammassageBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class rammassageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('date',DateTimeType::class, array (
        'attr' => ['class' => 'js-datepicker'],
        'label'       => 'Date de Rammassage',
        'html5' => true,
        'time_widget'   => 'single_text',
        'date_format'   => \IntlDateFormatter::SHORT,
        'with_seconds'  => false,


                     ))
                ->add('adresse');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RammassageBundle\Entity\rammassage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rammassagebundle_rammassage';
    }


}
