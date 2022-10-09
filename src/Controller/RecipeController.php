<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeController extends AbstractController
{
    /**
     * controller pour voir toute les recette avec pagination
     *
     * @param RecipeRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/recette', name: 'recipe.index', methods: ['GET'])]
    public function index(RecipeRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $recipes = $paginator->paginate(
            $repository->findBy(['user' => $this->getUser()]),
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('pages/recipe/liste.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    /**
     * controller pour voir toute les recettes publiques
     *
     * @param RecipeRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return response
     */
    #[Route('/recette/publique', name: 'recipe.index.public', methods: ['GET'])]
    public function indexPublic(RecipeRepository $repository, PaginatorInterface $paginator, Request $request): response
    {
        $recipes = $paginator->paginate(
            $repository->findPublicRecipe(null),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/recipe/index_public.html.twig', [
            'recipes' => $recipes
        ]);
    }


    /**
     * controller qui permet de voir une recette publique
     *
     * @param Recipe $recipe
     * @return Response
     */
    #[Security("is_granted('ROLE_USER') and recipe.getIsPublic() === true")]
    #[Route("/recette/{id}", name: "recipe.show", methods: ["get"])]
    public function Show(Recipe $recipe): Response
    {
        return $this->render('pages/recipe/show.html.twig', [
            'recipe' => $recipe
        ]);
    }



    /**
     * controller pour creer une recette
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/recette/creation', name: "recipe.new", methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe, ['route' => 'recipe.new']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recipe = $form->getData();
            $recipe->setUser($this->getUser());

            $manager->persist($recipe);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre recette a été crée avec succès !'
            );

            return $this->redirectToRoute('recipe.index');
        }

        return $this->render('pages/recipe/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * controller pour modifier une recette
     *
     * @param Recipe $recipe
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Security("is_granted('ROLE_USER') and user === recipe.getUser()")]
    #[route('/recette/edition/{id}', name: 'recipe.edit', methods: ['GET', 'POST',])]
    public function edit(Recipe $recipe, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe, ['route' => 'recipe.edit']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recipe = $form->getData();
            $manager->persist($recipe);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre recette a été modifié avec succès !'
            );

            return $this->redirectToRoute('recipe.index');
        }

        return $this->render('pages/recipe/modif.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * controller pour supprimer une recette
     *
     * @param Recipe $recipe
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/recette/suppression/{id}', name: 'recipe.delete', methods: ['GET', 'POST'])]
    public function delete(EntityManagerInterface $manager, Recipe $recipe): Response
    {
        $manager->remove($recipe);
        $manager->flush();

        $this->addFlash(
            'success',
            'la recette a été supprimé avec succès !'
        );

        return $this->redirectToRoute('recipe.index');
    }
}
