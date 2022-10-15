<?php

namespace App\Tests\Functional;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactFormTest extends WebTestCase
{
    public function testIfSubmitContactFormIsSuccessfull(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact');

        //$this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Formulaire de contact');

        //Récuperer le formulaire
        $submitButton = $crawler->selectButton('Soumettre ma demande');
        $form = $submitButton->form();

        $form["contact[fullName]"] = "Jean Dupont";
        $form["contact[email]"] = "jd@nutridiet.com";
        $form["contact[subject]"] = "Test";
        $form["contact[message]"] = "Test du formulaire";

        //Soumettre le formulaire 
        $client->submit($form);

        //Vérifier le statut HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        //Vérifier l'envoi du mail
        $this->assertEmailCount(1);

        $client->followRedirect();

        //Vérifier la présence du message de succés
        $this->assertSelectorTextContains(
            'div.alert.alert-success.mt-4',
            'Votre demande a été envoyé avec succès !'
        );
    }
}
