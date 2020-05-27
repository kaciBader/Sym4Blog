<?php
// src/tests/Entity/BlogTest.php

namespace App\tests\Entity;

use App\Entity\Blog;

class BlogTest extends \PHPUnit\Framework\TestCase
{
	public function testSlugify()
	{
		$blog  = new Blog();
		$this->assertEquals('hello-world', $blog->slugify('Hello World'));
		$this->assertTrue('hello-world' == $blog->slugify('Hello World'));
		$this->assertFalse('hello world' == $blog->slugify('Hello World'));
		$this->assertEquals('hello-world', $blog->slugify(' Hello-world'));
		$this->assertEquals('hello-world', $blog->slugify(' Hello-world '));
		$this->assertEquals('a-day-with-symfony4', $blog->slugify('A Day With Symfony2'));

	}

	public function testSetSlug()
	{
	    $blog = new Blog();

	    $blog->setSlug('Symfony2 Blog');
	    $this->assertEquals('symfony2-blog', $blog->getSlug());
	}

	public function testSetTitle()
	{
	    $blog = new Blog();

	    $blog->setTitle('Hello World');
	    $this->assertEquals('hello-world', $blog->getSlug());
	}
}