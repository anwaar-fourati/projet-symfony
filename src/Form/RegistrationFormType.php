<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\{
    TextType,
    EmailType,
    PasswordType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom complet',
            'attr' => ['placeholder' => 'Votre nom']
        ])
        ->add('email', EmailType::class, [
            'attr' => ['placeholder' => 'exemple@email.com']
        ])
        ->add('telephone', TextType::class, [
            'label' => 'Téléphone',
            'attr' => ['placeholder' => '123456789']
        ])
        ->add('plainPassword', PasswordType::class, [
            'mapped' => false,
            'label' => 'Mot de passe',
            'attr' => ['autocomplete' => 'new-password'],
        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
