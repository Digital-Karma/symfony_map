<?php

namespace App\Controller;

use App\Entity\FocusLieu;
use App\Repository\FocusLieuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FocusLieuController extends AbstractController
{
    /**
     * @Route("/focus_lieu", name="focus_lieu")
     */
    public function index(FocusLieuRepository $repo)
    {
        $focus= $repo->findAll();

        return $this->render('focus_lieu/index.html.twig', [
            'focus' => $focus
        ]);
    }

    /**
     * Permet d'afficher une seul annonce
     *
     * @Route("/focus_lieu/{slug}", name="focus_show_lieu")
     * 
     * @return Response
     */
    public function show(FocusLieu $focus){
            return $this->render('focus_lieu/show.html.twig', [
            'focus' => $focus,
        ]);
    }
}
