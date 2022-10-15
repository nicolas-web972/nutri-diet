<?php

namespace App\Tests\Unit;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    // création de fonction pour respecter le DRY
    public function kernel()
    {
        self::bootKernel();
        $container = static::getContainer();
        return $container;
    }

    public function getEntity(): User
    {
        return (new User())
            ->setFullName('dupont durand')
            ->setPseudo('test')
            ->setEmail('test@test.fr')
            ->setRoles(['test'])
            ->setPlainPassword('test')
            ->setPassword('test')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());
    }

    //test de l'entité contact
    public function testEntityIsValid(): void
    {
        $test = $this->kernel();

        $user = $this->getEntity();

        $errors = $test->get('validator')->validate($user);

        $this->assertCount(0, $errors);
    }

    //test de l'assert not blank, length et not null
    public function testInvalidNotBlank()
    {
        $test = $this->kernel();
        $user = $this->getEntity();

        $user
            ->setFullName('')
            ->setPseudo('')
            ->setEmail('')
            ->setRoles([''])
            ->setPassword('');

        $errors = $test->get('validator')->validate($user);

        $this->assertCount(5, $errors);
    }

    //test de l'assert email
    public function testInvalidEmail()
    {
        $test = $this->kernel();
        $user = $this->getEntity();

        $user
            ->setEmail('test');

        $errors = $test->get('validator')->validate($user);

        $this->assertCount(1, $errors);
    }
}
