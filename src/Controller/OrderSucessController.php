<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Mail;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSucessController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/commande/merci/{stripeSessionId}", name="order_sucess")
     */
    public function index(Cart $cart, $stripeSessionId): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);
        //dd($order);
        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }

        if ($order->getState() == 0) {
            //vider la session "cart"
            $cart->remove();

            // Modifier le statut isPaid de la commance en la passsant à 1
            $order->setState(1);
            $this->entityManager->flush();

            // Envoyer un mail à notre client pour lui confirmé la commande

            $mail = new Mail();
            $content = "Bonjour " . $order->getUser()->getFirstname() . "<br/> Merci pour votre commande . <br>  Lorem Ipsum is simply dummy text of the printing and typesetting industry.";

            $mail->send($order->getUser()->getEmail(), $order->getUser()->getFirstname(), 'Votre commande est bien validée', $content);
        }





        // Afficher quelques informations de la commande

        // dd($order);

        return $this->render('order_sucess/index.html.twig', [
            'order' => $order
        ]);
    }
}
