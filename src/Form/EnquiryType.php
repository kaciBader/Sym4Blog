<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface ;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class EnquiryType extends AbstractType
{
    public function buildForm(FormBuilderInterface  $builder, array $options)
    {
        $builder->add('name',TextType::class);
        $builder->add('email', TextType::class);
        $builder->add('subject', TextType::class);
        $builder->add('body',TextareaType::class);
    }

    public function getName()
    {
        return 'contact';
    }
}