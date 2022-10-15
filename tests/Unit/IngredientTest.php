<?php

namespace App\Tests\Unit;

use App\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IngredientTest extends KernelTestCase
{
    // création de fonction pour respecter le DRY
    public function kernel()
    {
        self::bootKernel();
        $container = static::getContainer();
        return $container;
    }

    public function getEntity(): Ingredient
    {
        return (new Ingredient())
            ->setName('carotte')
            ->setPrice(40)
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setCreatedAt(new \DateTimeImmutable());
    }

    //test de l'entité ingredient
    public function testEntityIsValid(): void
    {
        $test = $this->kernel();

        $ingredient = $this->getEntity();

        $errors = $test->get('validator')->validate($ingredient);

        $this->assertCount(0, $errors);
    }

    //test de l'assert not blank et length
    public function testInvalidNotBlank()
    {
        $test = $this->kernel();
        $ingredient = $this->getEntity();

        $ingredient
            ->setName('');

        $errors = $test->get('validator')->validate($ingredient);

        $this->assertCount(2, $errors);
    }

    //test des assert positive
    public function testInvalidPositive()
    {
        $test = $this->kernel();
        $ingredient = $this->getEntity();

        $ingredient
            ->setPrice(-1);

        $errors = $test->get('validator')->validate($ingredient);

        $this->assertCount(1, $errors);
    }

    //test des assert less than
    public function testInvalidPeople()
    {
        $test = $this->kernel();
        $ingredient = $this->getEntity();

        $ingredient
            ->setPrice(202);

        $errors = $test->get('validator')->validate($ingredient);

        $this->assertCount(1, $errors);
    }
}
