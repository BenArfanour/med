<?php

namespace NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class newsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre' , 'text')
                 ->add('corps',TextareaType::class,array('attr' => array('rows' => '5','cols' => '5')))
                 ->add('dateDebut',DateType::class , array (
                         'widget'=>'single_text',

                     )

                 )
                 ->add('dateFin',DateType::class , array (

                     'widget'=>'single_text',

                 ))
                ->add('pj',FileType::class, array(
                      'label' => 'Piéce Jointe : ',

                      'data_class' => null

                      ))
                 ->add('type', 'choice', array(
                     'choices' => array('High' => 'High', 'Medium' => 'Medium','Low'=>'Low'),
                     'expanded' => true,
                     'multiple' => false,

                   ))

                 ->add('typePnc','choice', array(
                     'choices'=> array ('Hotesse'=>'Hotesse' , 'Steward'=>'Steward' ,'Chef Cabine'=>'Chef Cabine'),
                     'expanded' => true,
                     'multiple' =>  false,
                 ));


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NewsBundle\Entity\news'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'newsbundle_news';
    }


}
