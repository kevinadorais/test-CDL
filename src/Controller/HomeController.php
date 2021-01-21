<?php

namespace App\Controller;

use App\Data\SearchBook;
use App\Form\SearchBookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use DateTime;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, BookRepository $books): Response
    {
        $search = new SearchBook();
        $form = $this->createForm(SearchBookType::class, $search);
        $form->handleRequest($request);

        // Si le formulaire est soumis, on récupère les données et les envoie au repository pour effectuer une query
        // et les renvoyer dans la vue.
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();

            return $this->render('home/index.html.twig', [
                "books" => $books->findWithSearch($search),
                'form' => $form->createView(),
            ]);
        }

        // Sinon on renvoie la totalité des books dans la vue.
        return $this->render('home/index.html.twig', [
            "books" => $books->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
