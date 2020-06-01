<?php
// src/Blogger/BlogBundle/Tests/Controller/PageControllerTest.php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{

    public function testIndex()
    {
        // create client
        $client = static::createClient(); 
        // send request
        $crawler = $client->request('GET', '/'); 
         //  test successful reponse
        $this->assertResponseIsSuccessful();
        // test stateCode of the response
        $this->assertResponseStatusCodeSame(200); 
        // test stateCode of the response
        $this->assertEquals(200, $client->getResponse()->getStatusCode()); 
        // test that <html> exists
        $this->assertSelectorExists('html'); 
        // test page title
        $this->assertPageTitleSame('sym4blog'); 

        // check article exsitance in the page
        $this->assertTrue($crawler->filter('article.blog')->count() > 0);
        // check section Tag Cloud exists
        $this->assertSelectorTextContains('.section header h3', 'Tag Cloud');
        // test section Latest Comments exists
        $this->assertEquals('Latest Comments',  $crawler->filter('.section header h3')->eq(1)->text());
        

    }
    public function testAbout()
    {
        // create client
        $client = static::createClient();
        // send request
        $crawler = $client->request('GET', '/about');

        // test successful response 
        $this->assertResponseIsSuccessful();
        // test page title
         $this->assertPageTitleSame('sym4blog-about'); 

         // check section Tag Cloud exists
        $this->assertSelectorTextContains('.section header h3', 'Tag Cloud');
        // test section Latest Comments exists
        $this->assertEquals('Latest Comments',  $crawler->filter('.section header h3')->eq(1)->text());

        // test that about page contains h1 as About sym4blog
        $this->assertEquals(1, $crawler->filter('h1:contains("About sym4blog")')->count());

    } 

    public function testContact()
    {
        $client = static::createClient();
        $crawler =  $client->request('GET','/contact');
        // test that contact page contains h1 as Contact sym4blog
        $this->assertEquals(1, $crawler->filter('h1:contains("Contact sym4blog")')->count());
        // test form 
        $form = $crawler->selectButton("Submit")->form();
        
        $form['enquiry[name]']       = 'name';
        $form['enquiry[email]']      = 'email@email.com';
        $form['enquiry[subject]']    = 'Subject';
        $form['enquiry[body]']       = 'The comment body must be at least 50 characters long as there is a validation constrain on the Enquiry entity';
        $crawler = $client->submit($form);

        // Il faut suivre la redirection
        //$crawler = $client->followRedirect();
        //$this->assertEquals(1, $crawler->filter('.blogger-notice:contains("Your contact enquiry was successfully sent. Thank you!")')->count());


    // On vérifie que l'email a bien été envoyé
    if ($profile = $client->getProfile())
    {
        $swiftMailerProfiler = $profile->getCollector('swiftmailer');

        // Seul 1 message doit avoir été envoyé
        $this->assertEquals(1, $swiftMailerProfiler->getMessageCount());

        // On récupère le premier message
        $messages = $swiftMailerProfiler->getMessages();
        $message  = array_shift($messages);

        $symblogEmail = $client->getContainer()->getParameter('blogger_blog.emails.contact_email');
        //dump($symblogEmail);
        // On vérifie que le message a été envoyé à la bonne adresse
        $this->assertArrayHasKey($symblogEmail, $message->getTo());

         // On suit la redirection
    $crawler = $client->followRedirect();

    $this->assertTrue($crawler->filter('.blogger-notice:contains("Your contact enquiry was successfully sent. Thank you!")')->count() > 0);
    }

        
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