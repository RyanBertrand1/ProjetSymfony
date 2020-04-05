<?php

namespace App\Form;

use App\Entity\TeacherLoan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherLoanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('leavingDate', DateType::class, ['widget' => 'single_text', 'attr' => ['class' => 'js-datepicker'], 'label' => 'Date de départ'])
            ->add('returnDate', DateType::class, ['widget' => 'single_text', 'attr' => ['class' => 'js-datepicker'], 'label' => 'Date de retour'])
            ->add('loanUsage', ChoiceType::class, ['label' => 'Usage', 'choices' => ['En cours' => 'En cours', "Personnel" => 'Personnel']])
            ->add('module', TextType::class, ['label' => 'Module'])
            ->add('classes', TextType::class, ['label' => 'Cours'])
            ->add('submit', SubmitType::class, ['label' => 'Suivant']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TeacherLoan::class,
        ]);
    }
}
