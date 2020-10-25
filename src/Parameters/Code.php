<?php


namespace App\Parameters;

use Symfony\Component\Validator\Constraints as Assert;

class Code{
    /**
     * @Assert\Regex("/\w/") //alphanumeric
     * @Assert\NotBlank
     * @Assert\Length(min = 2, max = 3)
     */
    private $code;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Code constructor.
     */
    public function __construct($code)
    {
        $this->code = $code;
    }
}