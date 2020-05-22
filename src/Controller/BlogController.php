<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;
use App\Entity\Comment;
class BlogController extends AbstractController
{
    /**
     * @Route(
     *      "/{id}/{slug}/{comments}",
     *       name="blog_show",
     *       requirements = { "id" = "\d+"}
     * )
     */
    public function show($id,$slug,$comments = true)
    {
    	$em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository(Blog::class)->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $comments = $em->getRepository(Comment::class)
                   ->getCommentsForBlog($blog->getId());

        return $this->render('blog/show.html.twig', [
            'blog'  => $blog,
            'comments' => $comments
        ]);
    }
}
