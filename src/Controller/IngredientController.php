<?php

namespace App\Controller;

use DateTime;
use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Form\ModifyIngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    /**
     * controller pour afficher tout les produits
     *
     * @param IngredientRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/ingredient', name: 'ingredient.index', methods: ['GET'])]
    public function index(IngredientRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $ingredients = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/ingredient/ingredient.html.twig', [
            'ingredients' => $ingredients,

        ]);
    }
    /**
     * controller pour créer un produit
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/ingredient/nouveau', name: "ingredient.new", methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient, ['route' => 'ingredient.new']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();

            $manager->persist($ingredient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre ingrédient a été crée avec succès !'
            );

            return $this->redirectToRoute('ingredient.index');
        }

        return $this->render(
            'pages/ingredient/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * controller pour modifier un produit
     *
     * @param Ingredient $ingredient
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[route('/ingredient/edition/{id}', name: 'ingredient.edit', methods: ['GET', 'POST',])]
    public function edit(Ingredient $ingredient, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient, ['route' => 'ingredient.edit']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();
            $ingredient->setUpDatedAt();
            $manager->persist($ingredient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre ingrédient a été modifié avec succès !'
            );

            return $this->redirectToRoute('ingredient.index');
        }

        return $this->render('pages/ingredient/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * controller pour supprimer un produit
     *
     * @param Ingredient $ingredient
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/ingredient/suppression/{id}', name: 'ingredient.delete', methods: ['GET', 'POST'])]
    public function delete(EntityManagerInterface $manager, Ingredient $ingredient): Response
    {
        $manager->remove($ingredient);
        $manager->flush();

        $this->addFlash(
            'success',
            'l\'ingrédient a été supprimé avec succès !'
        );

        return $this->redirectToRoute('ingredient.index');
    }
}
