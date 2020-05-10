<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert ;

class Enquiry
{
	/**
	* @var string
    *
    * @Assert\NotBlank
	*/
    protected $name;

    /**
    * @var string
    *
    * @Assert\Email
    */
    protected $email;

    /**
    * @var string
    *
    * @Assert\NotBlank
    *
    * @Assert\Length(min = 5)
    */
    protected $subject;

    /**
    * @var string
    *
    * @Assert\Length(min = 5, max = 50)
    */
    protected $body;

    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
}