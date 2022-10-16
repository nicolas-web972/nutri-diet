<?php

namespace App\Tests\Functional;

use App\Entity\User;
use App\Entity\Recipe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecipeFormTest extends WebTestCase
{
    public function testIfCreaterecipeIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_POST, $urlGenerator->generate('recipe.new'));

        $form = $crawler->filter('form[name=recipe]')->form([
            'recipe[name]' => "ma recette test",
            'recipe[time]' => 33,
            'recipe[nbPeople]' => 6,
            'recipe[difficulty]' => 3,
            'recipe[description]' => "c'est ma recette de test",
            'recipe[price]' => 20,
            'recipe[isFavorite]' => false
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert.alert-success.mt-4', 'Votre recette a été crée avec succès !');

        $this->assertRouteSame('recipe.index');
    }

    public function testIfListRecipeIsSuccessful()
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $client->request(Request::METHOD_GET, $urlGenerator->generate('recipe.index'));

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('recipe.index');
    }

    public function testIfUpdateAnrecipeIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $recipe = $entityManager->getRepository(Recipe::class)->findOneBy([
            'user' => $user
        ]);

        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('recipe.edit', ['id' => $recipe->getId()])
        );

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter('form[name=recipe]')->form([
            'recipe[name]' => "ma recette test 2",
            'recipe[time]' => 34,
            'recipe[nbPeople]' => 8,
            'recipe[difficulty]' => 2,
            'recipe[description]' => "c'est ma recette de test 2",
            'recipe[price]' => 25,
            'recipe[isFavorite]' => true
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert.alert-success.mt-4', 'Votre recette a été modifié avec succès !');

        $this->assertRouteSame('recipe.index');
    }

    public function testIfDeleteAnIngredientIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $recipe = $entityManager->getRepository(Recipe::class)->findOneBy([
            'user' => $user
        ]);

        $client->loginUser($user);

        $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('recipe.delete', ['id' => $recipe->getId()])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert.alert-success.mt-4', "la recette a été supprimé avec succès !");

        $this->assertRouteSame('recipe.index');
    }
}
