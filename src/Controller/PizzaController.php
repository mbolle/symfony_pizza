<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Pizza;
use App\Forms\OrderType;
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
     * @Route ("/contact", name="pizza_contact")
     */
    public function contact(): Response
    {
        return $this->render("pizza/contact.html.twig");
    }

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
     * @Route("/order/{id}", name="app_order");
     */
    public function order(Request $request, Pizza $pizza, ManagerRegistry $managerRegistry)
    {
        $pizzaName = $pizza->getName();

        $entityManager = $managerRegistry->getManager();
        $order = new Order();
        $order->setPizza($pizza);
        $order->setStatus("in progress");
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();
            $entityManager->persist($order);
            $entityManager->flush();
            return $this->redirectToRoute('app_contact');
        }
        return $this->renderForm('order/order.html.twig', [
            'pizza' => $pizzaName,
            'form' => $form,]);
    }
}
