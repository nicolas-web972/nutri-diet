<?php

namespace App\Tests\Unit;

use App\Entity\Mark;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MarkTest extends KernelTestCase
{
    // création de fonction pour respecter le DRY
    public function kernel()
    {
        self::bootKernel();
        $container = static::getContainer();
        return $container;
    }

    public function getEntity(): Mark
    {
        return (new Mark())
            ->setMark(4)
            ->setCreatedAt(new \DateTimeImmutable());
    }

    //test de l'entité ingredient
    public function testEntityIsValid(): void
    {
        $test = $this->kernel();

        $mark = $this->getEntity();

        $errors = $test->get('validator')->validate($mark);

        $this->assertCount(0, $errors);
    }

    //test des assert positive
    public function testInvalidPositive()
    {
        $test = $this->kernel();
        $mark = $this->getEntity();

        $mark
            ->setMark(-1);

        $errors = $test->get('validator')->validate($mark);

        $this->assertCount(1, $errors);
    }

    //test des assert less than
    public function testInvalidPeople()
    {
        $test = $this->kernel();
        $mark = $this->getEntity();

        $mark
            ->setMark(7);

        $errors = $test->get('validator')->validate($mark);

        $this->assertCount(1, $errors);
    }
}
