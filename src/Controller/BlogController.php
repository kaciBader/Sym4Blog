<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;

class BlogController extends AbstractController
{
    /**
     * @Route("/{id}", name="blog_show", requirements = { "id" = "\d+"})
     */
    public function show($id)
    {


    	$em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository(Blog::class)->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $this->render('blog/show.html.twig', ['blog'  => $blog]);



       // return $this->render('blog/show.html.twig', [
           // 'controller_name' => 'BlogController',
        //]);
    }
}
