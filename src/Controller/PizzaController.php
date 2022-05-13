<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Pizza;
use App\Forms\OrderType;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/", name="pizza_homepage")
     */
    public function homepage(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Category::class);
        /** @var Category $cat */
        $cat = $repository->findAll();
        return $this->render('pizza/home.html.twig', [
            'cat' => $cat,
        ]);
    }

    /**
     * @param int $id
     * @return void
     * @Route("/pizza/{id}")
     */

    public function pizza(int $id, PizzaRepository $pizzaRepository)
    {
        $pizzas = $pizzaRepository->findBy(array("pizza" => $id));
        return $this->render("pizza/pizza.html.twig", [
            "pizzas" => $pizzas
        ]);
    }

    /**
     * @Route("/order/{id}", name="app_order");
     */
    public function order(Request $request, Pizza $pizza, EntityManagerInterface $em)
    {
        $pizzaName = $pizza->getName();

//        $entityManager = $managerRegistry->getManager();
        $order = new Order();
        $order->setPizza($pizza);
        $order->setStatus("in progress");
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();
            $em->persist($order);
            $em->flush();
            return $this->redirectToRoute('pizza_login');
        }
        return $this->renderForm('order/order.html.twig', [
            'pizza' => $pizzaName,
            'form' => $form,]);
    }

    /**
     * @Route ("/contact", name="pizza_contact")
     */
    public function contact(): Response
    {
        return $this->render("pizza/contact.html.twig");
    }

    /**
     * @Route ("/login", name="pizza_login")
     */
    public function login(): Response
    {
        return $this->render("pizza/login.html.twig");
    }
}