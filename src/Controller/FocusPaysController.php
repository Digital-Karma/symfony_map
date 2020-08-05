<?php

namespace App\Controller;

use App\Entity\FocusPays;
use App\Repository\FocusPaysRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FocusPaysController extends AbstractController
{
    /**
     * @Route("/focus_pays", name="focus_pays")
     */
    public function index(FocusPaysRepository $repo)
    {
        $focus= $repo->findAll();

        return $this->render('focus_pays/index.html.twig', [
            'focus' => $focus
        ]);
    }

    /**
     * Permet d'afficher une seul annonce
     *
     * @Route("/focus_pays/{slug}", name="focus_show_pays")
     * 
     * @return Response
     */
    public function show(FocusPays $focus){
        return $this->render('focus_pays/show.html.twig', [
            'focus' => $focus,
        ]);
    }
}
