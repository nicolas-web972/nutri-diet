<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{

    #[Route('/contact', name: 'contact.new')]
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        //appel de l'utilisateur connecté
        /**
         * @var UserEntity
         */
        $user = $this->getUser();

        if ($user) {

            $contact->setFullName($user->getFullName())
                ->setEmail($user->getEmail());
        }
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            //Email vers administration
            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('admin@nutridiet.com')
                ->subject($contact->getSubject())
                ->htmlTemplate('emails/mail.html.twig')
                ->context([
                    'contact' => $contact
                ]);

            $mailer->send($email);



            $this->addFlash(
                'success',
                'Votre demande a été envoyé avec succès !'
            );

            return $this->redirectToRoute('contact.new');
        }
        return $this->render('pages/contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
