<?php

namespace App\Controller;

use App\Entity\FocusVille;
use App\Repository\FocusVilleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FocusVilleController extends AbstractController
{
    /**
     * @Route("/focus_ville", name="focus_ville")
     */
    public function index(FocusVilleRepository $repo)
    {
        $focus= $repo->findAll();

        return $this->render('focus_ville/index.html.twig', [
            'focus' => $focus
        ]);
    }

    /**
     * Permet d'afficher une seul annonce
     *
     * @Route("/focus_ville/{slug}", name="focus_show_ville")
     * 
     * @return Response
     */
    public function show(FocusVille $focus){
        return $this->render('focus_ville/show.html.twig', [
            'focus' => $focus,
        ]);
    }
}
