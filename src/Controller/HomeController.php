<?php

namespace App\Controller;

use App\Form\NewsLetterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/newsletter', name: 'newsletter')]
    public function newsletter(Request $request): Response
    {
        $form = $this->createForm(NewsLetterType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump($form);
        }

        return $this->render('home/newsletter.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
