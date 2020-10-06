<?php

declare(strict_types=1);

namespace App\Contact;

use Symfony\Component\Validator\Constraints as Assert;

class Dto
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    public $name;

    /**
     * @Assert\NotBlank
     * @Assert\Email
     */
    public $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    public $subject;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=10)
     */
    public $message;
}