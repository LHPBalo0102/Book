<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Services\CartService;
use Doctrine\ORM\EntityManager;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
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
    public function searchAction(Request $request, BookRepository $bookRepository, CartService $cartService): Response
    {
        $form = $this->createFormBuilder()
            ->add('code', TextType::class)
            ->add('Submit', SubmitType::class, [
                'label' => 'Submit'
            ])
            ->getForm();

        $form->handleRequest($request);
        $code = $form->getData();
        $results = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $code = $form->getData();

            $results = $bookRepository->findOneBy(['code' => $code]);

            if ($results == null) {
                $this->addFlash('warning', 'Sorry!! Please type exactly the CODE of Book');
            } else {
                $this->addFlash('success', 'Here is your Book');
                $cartService->add($code['code']);
            }
        }

        $cartWithData = $cartService->getFullCart();

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'results' => $results,
            'code' => $code['code'],
            'items' => $cartWithData
        ]);
    }

    /**
     * @Route("/searchForm/remove/{code}", name="cart_remove", methods={"DELETE"})
     */
    public function remove($code, CartService $cartService)
    {
        $cartService->remove($code);

        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/searchForm/export/{code}", name="cart_export", methods={"DELETE"})
     */
    public function export($code, CartService $cartService, BookRepository $bookRepository)
    {
        $book = $bookRepository->findOneBy(['code' => $code]);
        $qtyInHouse = $book->getQuantity();
        $qtyOfItem = $cartService->getQuantityOfItem($code);

        $qtyAfterExport = $qtyInHouse - $qtyOfItem;
        $book->setQuantity($qtyAfterExport);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($book);
        $entityManager->flush();

        $cartService->remove($code);

        $response = new Response();
        $response->send();
    }
}
