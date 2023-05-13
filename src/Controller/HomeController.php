<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $searchRequest = $request->query->get('q');

        if($searchRequest){
            return $this->render('home/list_business.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);

    }
}
