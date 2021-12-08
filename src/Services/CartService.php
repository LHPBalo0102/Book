<?php

namespace App\Services;


use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
    protected $bookRepository;

    public function __construct(SessionInterface $session, BookRepository $bookRepository)
    {
        $this->session = $session;
        $this->bookRepository = $bookRepository;
    }

    public function add($code)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$code])) {
            $cart[$code]++;
        } else {
            $cart[$code] = 1;
        }

        $this->session->set('cart', $cart);

    }

    public function remove($code)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$code])) {
            unset($cart[$code]);
        }

        $this->session->set('cart', $cart);
    }

    public function getFullCart()
    {
        $cart = $this->session->get('cart', []);

        $cartWithData = [];

        foreach($cart as $code => $quantity) {
            $cartWithData[] = [
                'book' => $this->bookRepository->findOneBy(['code' => $code]),
                'quantity' => $quantity
            ];
        }

        return $cartWithData;
    }


}