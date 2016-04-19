<?php

namespace MillionsPokemons\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fileUpload', 'file');
    }

    public function getName()
    {
        return 'image';
    }
}