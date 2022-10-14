<?php

namespace App\Tests\Unit;

use App\Entity\Mark;
use App\Entity\User;
use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RecipeTest extends KernelTestCase
{
    // création de fonction pour respecter le DRY
    public function kernel()
    {
        self::bootKernel();
        $container = static::getContainer();
        return $container;
    }

    public function getEntity(): Recipe
    {
        return (new Recipe())
            ->setName('Recipe #1')
            ->setTime(200)
            ->setNbPeople(4)
            ->setDifficulty(3)
            ->setDescription('Description #1')
            ->setPrice(10.2)
            ->setIsFavorite(true)
            ->setIsPublic(false)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());
    }

    //test de l'entité recipe
    public function testEntityIsValid(): void
    {
        $test = $this->kernel();

        $recipe = $this->getEntity();

        $errors = $test->get('validator')->validate($recipe);

        $this->assertCount(0, $errors);
    }

    //test de l'assert not blank et (length min:2, max:50 de name)
    public function testInvalidNotBlank()
    {
        $test = $this->kernel();
        $recipe = $this->getEntity();

        $recipe
        ->setName('')
        ->setDescription('');

        $errors = $test->get('validator')->validate($recipe);

        $this->assertCount(3, $errors);
    }

    //test des assert positive
    public function testInvalidPositive()
    {
        $test = $this->kernel();
        $recipe = $this->getEntity();
        
        $recipe
        ->setTime(-1)
        ->setNbPeople(-1)
        ->setDifficulty(-1)
        ->setPrice(-1);

        $errors = $test->get('validator')->validate($recipe);

        $this->assertCount(4, $errors);
    }

    //test des assert less than
    public function testInvalidPeople()
    {
        $test = $this->kernel();
        $recipe = $this->getEntity();
        
        $recipe
        ->setTime(1442)
        ->setNbPeople(52)
        ->setDifficulty(7)
        ->setPrice(1002);

        $errors = $test->get('validator')->validate($recipe);

        $this->assertCount(4, $errors);
    }


    public function testGetAverage()
    {
        $recipe = $this->getEntity();
        $user = $this->kernel()->get('doctrine.orm.entity_manager')->find(User::class, 1);

        for ($i = 0; $i < 5; $i++) {
            $mark = new Mark();
            $mark->setMark(2)
                ->setUser($user)
                ->setRecipe($recipe);

            $recipe->addMark($mark);
        }

        $this->assertTrue(2.0 === $recipe->getAverage());
    }
}
