<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Knp\Component\Pager\PaginatorInterface;

use App\Repository\BusinessRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(BusinessRepository $businessRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $searchRequest = $request->query->get('q');
        $pageRequest = $request->query->getInt('page', 1);

        $pageRequest = $pageRequest <= 0 ? 1 : $pageRequest ;

        if(!$searchRequest){
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }

        $business = $businessRepository->findBusinessByLikeTerm($searchRequest);
        
        $itemsPerPage = 10;
        $businessIndex = ( $pageRequest - 1 ) * $itemsPerPage;

        $paginateBusiness = $paginator->paginate(
            $business->getResult(),
            $pageRequest,
            $itemsPerPage
        ); 

        return $this->render('home/list_business.html.twig', [
            'controller_name' => 'HomeController',
            'search_query' => $searchRequest,
            'businesses' => $paginateBusiness,
            'business_index' => $businessIndex,
        ]);
    }

    #[Route('/{slug}', name: 'app_home_detail')]
    public function detail(string $slug, Request $request, BusinessRepository $businessRepository): Response
    {
        $detail = $businessRepository->findOneBy(['slug' => $slug]);

        return $this->render('home/detail_business.html.twig', [
            'controller_name' => 'HomeController',
            'business' => $detail
        ]);
    }
}
