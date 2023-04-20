<?php

namespace App\Form;

use Ttskch\PaginatorBundle\Entity\AbstractCriteria;

class ProduitCriteria extends AbstractCriteria
{
    public $sort = 'id';
    public $nom;
    public $query;

    public function getFormTypeClass(): ?string
    {
        return ProduitSearchType::class;
    }
}
