<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\Routing\Annotation\Route ;
use App\Entity\Enquiry;
use App\Form\EnquiryType;
use App\Entity\Blog;
use Symfony\Component\HttpFoundation\Request;


class PageController extends AbstractController 
{

	/**
	* @Route("/", name = "blog_homepage", requirements ={ "method" = "GET"})
	*/
	public function index()
	{

		$em = $this->getDoctrine()
                   ->getManager();


        $blogs  = $em->getRepository(Blog::class)->getLatestBlogs();
       /* $blogs = $em->createQueryBuilder()
                    ->select('b')
                    ->from(Blog::class,  'b')
                    ->addOrderBy('b.created', 'DESC')
                    ->getQuery()
                    ->getResult();*/

		return $this->render('Page/index.html.twig',['blogs' =>$blogs]);
	}

	/**
	* @Route("/about", name ="blog_about")
	*/
	public function about()
	{
		return $this->render('Page/about.html.twig');
	}

	/**
	* @Route("/contact", name = "blog_contact", requirements = { "method" = "GET|POST"})
	*/
	public function contact(Request $request, \Swift_Mailer $mailer)
	{
		$enquiry = new Enquiry();
    	$form = $this->createForm(EnquiryType::class, $enquiry);

    	//$request = $this->getRequest();

    	$form->handleRequest($request);
    	if ($request->getMethod() == 'POST') {
       	 	//$form->bindRequest($request);

        	if (($form->isSubmitted()) && ($form->isValid())) {
	            // Perform some action, such as sending an email

	        $message = (new \Swift_Message())
            ->setSubject('Contact enquiry from symblog')
            ->setFrom('email1@email.com')
            ->setTo('email@email.com')
            ->setBody($this->renderView('Page/contactEmail.txt.twig', array('enquiry' => $enquiry)));
        $mailer->send($message);

	            // Redirect - This is important to prevent users re-posting
	            // the form if they refresh the page
            	return $this->redirect($this->generateUrl('blog_contact'));
        	}
    	}

    	return $this->render('Page/contact.html.twig', array(
       	 'form' => $form->createView()
    	));

	}

} 