<?php

namespace AuthentificationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class userType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username')
                ->add('nom')
                ->add('prenom')

                ->add('dateNaiss',DateType::class , array (

                'widget'=>'single_text',

                  ))
                 ->add('email')
                 ->add('adresse')

                 ->add('type', ChoiceType::class, array(
                'choice_list' => new ChoiceList(
                    array('Chef Cabine'  ,'Steward' , 'Hotesse'),
                    array('Chef Cabine', 'Steward', 'Hotesse')
                          )
                         ))
               ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
               ));

    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AuthentificationBundle\Entity\user'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'authentificationbundle_user';
    }


}
