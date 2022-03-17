<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/", name="pizza_homepage")
     */
    public function randomPizzas(): Response
    {
        $pizzaCategories = ["Vegetarische pizza", "Vlees pizza", "Vis pizza"];
        return $this->render("pizza/home.html.twig", [
            'categories'=> $pizzaCategories
        ]);
    }

    /**
     * @Route ("/", name="pizza_contact")
     */
    public function contact(): Response
    {
        return new Response('Future page to show categories');
        return $this->render("pizza/contact.html.twig");
    }
}