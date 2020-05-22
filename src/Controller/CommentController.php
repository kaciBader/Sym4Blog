<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Blog;
use App\Entity\Comment;
use App\Form\CommentType;
class CommentController extends AbstractController
{
    /**
     * @Route(
     *      "/comment",
     *       name="comment"
     * )
     */
    public function index()
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    /**
    * @Route(
    *       "/comment/{blog_id}",
    *        name = "comment_create",
    *        requirements = {"blog_id" = "\d+"}
    * )
    */
    public function createAction($blog_id, Request $request)
    {

        $em = $this->getDoctrine()
                    ->getManager();

        $blog = $em->getRepository(Blog::class)->find($blog_id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $comment  = new Comment();
        $comment->setBlog($blog);
        $form    = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // TODO: Persist the comment entity
            $em = $this->getDoctrine()
                       ->getManager();
            $em->persist($comment);
            $em->flush();
            
            return $this->redirectToRoute('blog_show', [
                'id' => $comment->getBlog()->getId(),
                'slug'  => $comment->getBlog()->getSlug()
            ].'#comment-' . $comment->getId()
            );
        }

        return $this->render('/Comment/create.html.twig', [
            'comment' => $comment,
            'form'    => $form->createView()
        ]);
    }
}
