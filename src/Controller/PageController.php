<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\Routing\Annotation\Route ;


class PageController extends Controller 
{

	/**
	* @Route("/", name = "blog_homepage", requirements ={ "method" = "GET"})
	*/
	public function index()
	{
		return $this->render('Page/index.html.twig');
	}

	/**
	* @Route("/about", name ="blog_about")
	*/
	public function about()
	{
		return $this->render('Page/about.html.twig');
	}

} 