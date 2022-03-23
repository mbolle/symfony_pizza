<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;

class PizzaController extends AbstractController
{
//    /**
//     * @Route("/", name="pizza_homepage")
//     */
//    public function randomPizzas(): Response
//    {
//        $pizzaCategories = ["Vegetarische pizza", "Vlees pizza", "Vis pizza"];
//        return $this->render("pizza/home.html.twig", [
//            'categories'=> $pizzaCategories
//        ]);
//    }
//
    /**
     * @Route ("/contact", name="pizza_contact")
     */
    public function contact(): Response
    {
        return $this->render("pizza/contact.html.twig");
    }

    /**
     * @Route("/", name="pizza_homepage")
     */
    public function homepage(EntityManagerInterface $em){
        $repository = $em->getRepository(Category::class);
        /** @var Category $cat */
        $cat = $repository->findAll();
        return $this->render('pizza/home.html.twig', [
            'cat' => $cat,
        ]);
    }
}