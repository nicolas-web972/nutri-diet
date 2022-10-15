<?php

namespace App\Tests\Unit;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContactTest extends KernelTestCase
{
    // création de fonction pour respecter le DRY
    public function kernel()
    {
        self::bootKernel();
        $container = static::getContainer();
        return $container;
    }

    public function getEntity(): Contact
    {
        return (new Contact())
            ->setFullName('dupont durand')
            ->setEmail('test@test.fr')
            ->setSubject('test')
            ->setMessage('test de l\'entité contact')
            ->setCreatedAt(new \DateTimeImmutable());
    }

    //test de l'entité contact
    public function testEntityIsValid(): void
    {
        $test = $this->kernel();

        $contact = $this->getEntity();

        $errors = $test->get('validator')->validate($contact);

        $this->assertCount(0, $errors);
    }

    //test de l'assert not blank et length
    public function testInvalidNotBlank()
    {
        $test = $this->kernel();
        $contact = $this->getEntity();

        $contact
            ->setFullName('')
            ->setEmail('')
            ->setSubject('')
            ->setMessage('');

        $errors = $test->get('validator')->validate($contact);

        $this->assertCount(4, $errors);
    }

    //test de l'assert email
    public function testInvalidEmail()
    {
        $test = $this->kernel();
        $contact = $this->getEntity();

        $contact
            ->setEmail('test');

        $errors = $test->get('validator')->validate($contact);

        $this->assertCount(1, $errors);
    }
}
