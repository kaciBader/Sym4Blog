<?php
// src/Blogger/BlogBundle/Tests/Controller/PageControllerTest.php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    public function testAbout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about');

        $this->assertEquals(1, $crawler->filter('h1:contains("About sym4blog")')->count());
    }


    public function testIndex()
	{
	    $client = static::createClient();

	    $crawler = $client->request('GET', '/');

	    // Vérifie qu'il y a des articles dans la page
	    $this->assertTrue($crawler->filter('article.blog')->count() > 0);

	     // Récupère le premier lien, puis vérifie qu'il amene bien à l'article correspondant
    	$blogLink   = $crawler->filter('article.blog h2 a')->first();
    	$blogTitle  = $blogLink->text();
    	$crawler    = $client->click($blogLink->link());

    	// Vérifie que h2 contient bien le titre de l'article
    	$this->assertEquals(1, $crawler->filter('h2:contains("' . $blogTitle .'")')->count());
	}


}