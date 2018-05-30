<?php

namespace PfeBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CompanyEventsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder ->add('title', 'entity', array(
                       'class' => 'AuthentificationBundle\Entity\user',
                       'property' => 'username',
                       'expanded' => false,
                       'multiple' => false,
                       'label'    => 'Matricule',
                       ))
                  ->add('code')
                  ->add('NumVol')
                  ->add('companie')
                  ->add('typeAvion')
                  ->add('escaleDep')
                  ->add('escaleArrive')
                  ->add('startDateTime',DateTimeType::class, array (
                    'attr' => ['class' => 'js-datepicker'],
                    'label'       => 'Date de Départ',
                    'html5' => true,
                    'time_widget'   => 'single_text',
                    'date_format'   => \IntlDateFormatter::SHORT,
                    'with_seconds'  => false,


                ))
                 ->add('endDatetime',DateTimeType::class, array (
                   'attr' => ['class' => 'js-datepicker'],
                   'label'       => 'Date d arrivé',
                   'time_widget'   => 'single_text',
                   'html5' => true,
                   'date_format'   => \IntlDateFormatter::SHORT,
                    'with_seconds'  => false,

                 ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PfeBundle\Entity\CompanyEvents'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfebundle_companyevents';
    }


}
