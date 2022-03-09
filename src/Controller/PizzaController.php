<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function randomPizzas(): Response
    {
        $pizzas = ["hawaii", "Salami", "Chicken", "Tonijn"];
        return $this->render("pizza/home.html.twig", [
            'pizzas'=> $pizzas
        ]);
    }
}