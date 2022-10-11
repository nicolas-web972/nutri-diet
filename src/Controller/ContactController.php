<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{

    /**
     * controller du formulaire de contact
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param MailerInterface $mailer
     * @return Response
     */
    #[Route('/contact', name: 'contact.new')]
    public function index(Request $request, EntityManagerInterface $manager, MailService $mailService): Response
    {
        $contact = new Contact();

        //appel de l'utilisateur connecté pour remplir le formulaire automatiquement

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

            //Email vers administration cree avec le MailService
            $mailService -> sendEmail(
                $contact->getEmail(),
                $contact->getSubject(),
                'emails/mail.html.twig',
                ['contact' => $contact]
            );

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
