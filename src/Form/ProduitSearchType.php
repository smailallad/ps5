<?php

namespace App\Form;

use Ttskch\PaginatorBundle\Form\CriteriaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProduitSearchType extends CriteriaType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('query', SearchType::class, [
            'required' => false,
            'label' => 'Recherche : ',
            'attr' => ['class' => 'mt-3']
        ])
            ->add('nom', SearchType::class, [
                'required' => false,
                'label' => 'Nom : ',
                'attr' => ['class' => 'mt-3']
            ])
            ->add('Rechercher', SubmitType::class, [
                'attr' => ['class' => 'btn btn-lg btn-primary mt-3 save']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitCriteria::class,
            // if your app depends on symfony/security-csrf adding below is recommended
            'csrf_protection' => false,
        ]);
    }
}
