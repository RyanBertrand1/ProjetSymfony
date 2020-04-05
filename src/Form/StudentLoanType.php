<?php

namespace App\Form;

use App\Entity\StudentLoan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentLoanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('leavingDate', DateType::class, ['widget' => 'single_text', 'attr' => ['class' => 'js-datepicker'], 'label' => 'Date de départ'])
            ->add('returnDate', DateType::class, ['widget' => 'single_text', 'attr' => ['class' => 'js-datepicker'],'label' => 'Date de retour'])
            ->add('groupTp', TextType::class, ['label' => 'Groupe de tp'])
            ->add('otherStudents', TextareaType::class, ['label' => 'Autres étudiants', 'required' => false])
            ->add('module', TextType::class, ['label' => 'Module'])
            ->add('classes', TextType::class, ['label' => 'Cours'])
            ->add('teacher', TextType::class, ['label' => 'Enseignant'])
            ->add('place', TextType::class, ['label' => 'Lieu'])
            ->add('description', TextareaType::class, ['label' => 'Description'])
            ->add('specificDemand', TextareaType::class, ['label' => 'Demande Spécifique', 'required' => false])
            ->add('submit', SubmitType::class, ['label' => 'Suivant'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StudentLoan::class,
        ]);
    }
}
