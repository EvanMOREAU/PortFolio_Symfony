<?php

namespace App\Form;

use App\Entity\Documentations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DocumentationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('pdf', FileType::class, [
                'label' => 'PDF File',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '20M', // Spécifiez ici la taille maximale
                        'maxSizeMessage' => 'Le fichier est trop grand. La taille maximale autorisée est {{ limit }}.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documentations::class,
        ]);
    }
}
