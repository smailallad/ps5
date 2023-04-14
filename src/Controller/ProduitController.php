<?php

namespace App\Controller;

use Ttskch\PaginatorBundle\Context;
use App\Repository\ProduitRepository;
use Ttskch\PaginatorBundle\Doctrine\Slicer;

use Ttskch\PaginatorBundle\Doctrine\Counter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'produit_index')]
    public function index(ProduitRepository $produitRepository, Context $context): Response
    {
        $qb = $produitRepository->createQueryBuilder('f');
        $context->initialize('id', new Slicer($qb), new Counter($qb));

        return $this->render('produit/index.html.twig', [
            'foos' => $context->slice,
        ]);
    }
}
