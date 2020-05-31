<?php
// src/Blogger/BlogBundle/Tests/Controller/PageControllerTest.php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient(); // create client
        $crawler = $client->request('GET', '/'); // send request
        $this->assertResponseIsSuccessful(); // 1 test successful reponse
        $this->assertResponseStatusCodeSame(200); // 2 
        $this->assertEquals(200, $client->getResponse()->getStatusCode()); 
        $this->assertSelectorExists('html'); // test that <html> exists
        $this->assertPageTitleSame('sym4blog'); // test page title

        // Vérifie qu'il y a des articles dans la page
        $this->assertTrue($crawler->filter('article.blog')->count() > 0);
        // check section Tag Cloud exists
        $this->assertSelectorTextContains('.section header h3', 'Tag Cloud');
        // test section Latest Comments exists
        $this->assertEquals('Latest Comments',  $crawler->filter('.section header h3')->eq(1)->text());
        

    }
    public function testAbout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about');

        // test successful response 
        $this->assertResponseIsSuccessful();
        // test page title
         $this->assertPageTitleSame('sym4blog-about'); 

         // check section Tag Cloud exists
        $this->assertSelectorTextContains('.section header h3', 'Tag Cloud');
        // test section Latest Comments exists
        $this->assertEquals('Latest Comments',  $crawler->filter('.section header h3')->eq(1)->text());

    } 

/*
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
*/

}