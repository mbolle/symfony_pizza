<?php

namespace App\Forms;

use App\Entity\Order;
use App\Entity\Size;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('size', EntityType::class , [
                'class' => Size::class,
                'choice_label' => function(Size $size){
                return $size->getName();}])
            ->add('fname', TextType::class , ['label' => 'Voornaam'])
            ->add('sname', TextType::class, ['label' => 'Achternaam'])
            ->add('address', TextType::class, ['label' => 'Adres'])
            ->add('city', TextType::class, ['label' => 'Stad'])
            ->add('zipcode', TextType::class, ['label' => 'Postcode'])
            ->add('email', TextType::class, ['label' => 'Email adres'])
            ->add('save', SubmitType::class, ['label' => 'Bestellen'])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}