<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ArticlesBlog;
use App\Entity\CommentBlog;
use App\Form\ArticleType;
use App\Form\CommentBlogType;
use App\Repository\ArticlesBlogRepository;


class BlogController extends AbstractController
{ 
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticlesBlogRepository $repo)
    {
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/article/{id}/edit", name="blog_edit")
     */
    public function form(ArticlesBlog $article = null, Request $request, ObjectManager $manager)
    {
        if (!$article) {
            $article = new ArticlesBlog;
        }

        //Crée les champs du form à afficher dans twig
        $form = $this->createForm(ArticleType::class, $article);

        //Analyse la requête et prend en compte le contenu des inputs
        $form->handleRequest($request);

        //Vérifie si le form a été envoyé et si il est valide
        if ($form->isSubmitted() && $form->isValid()) {
            //Si l'article est nouveau 
            if (!$article->getId()) {
                //Donne une date 
                $article->setCreatedAt(new \DateTime());
            }
            //Envoye à la bdd
            $manager->persist($article);
            $manager->flush();
            //Redirige vers la vue d'une nouvelle article
            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            // Verif si l'article à un id si oui change les param bu bouton dans twig
            'editMode' => $article->getId() !== null
        ]);
    }

    /** 
     * @Route("/blog/article/{id}", name="blog_show")
     */
    public function show(ArticlesBlog $article, Request $request, ObjectManager $manager)
    {
        $comment = new CommentBlog();
        $form = $this->createForm(CommentBlogType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                ->setIdArticle($article);
            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute('blog_show', ['id'=>$article->getId()]);
        }
        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }
}
