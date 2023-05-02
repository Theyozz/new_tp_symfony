<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,MailerInterface $mailer, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $email = (new Email())
            ->from('admin@admin.com')
            ->to('admin@admin.com')
            ->subject('Mail récapitulatif')
            ->html("Name : ".$contact->getName()."<br />"." mail : ".$contact->getEmail());

            $mailer->send($email);
            $em->persist($contact);
            $em->flush();

        }

        return $this->renderForm('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
