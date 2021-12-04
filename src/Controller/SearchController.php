<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/searchForm", name="searchForm")
     */
    public function searchAction(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('code', TextType::class)
            ->add('search', SubmitType::class, [
                'label' => 'Search'
            ])
            ->getForm();

        $form->handleRequest($request);

        $results = $this->getDoctrine()->getManager()->getRepository(Book::class)->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $code = $form->getData();
            $results = $this->getDoctrine()->getManager()->getRepository(Book::class)->findBookByCode($code['code']);

            if (count($results) != 1) {
                $this->addFlash('warning', 'Sorry!! Please type exactly the CODE of Book');
                return $this->render('search/index.html.twig', [
                    'form' => $form->createView(),
                    'results' => $results
                ]);
            } else {
                $this->addFlash('success', 'Here is your Book');
                return $this->render('search/index.html.twig', [
                    'form' => $form->createView(),
                    'results' => $results
                ]);
            }
        }


        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'results' => $results
        ]);
    }
}
