<?php


namespace App\Parameters;

use Symfony\Component\Validator\Constraints as Assert;

class NameWoDiacritics{
    /**
     * @Assert\Regex("/\w/") //alphanumeric
     * @Assert\NotBlank
     */
    private $nameWoDiacritics;

    /**
     * @return mixed
     */
    public function getNameWoDiacritics()
    {
        return $this->nameWoDiacritics;
    }

    /**
     * NameWoDiacritics constructor.
     */
    public function __construct($nameWoDiacritics)
    {
        $this->nameWoDiacritics = $nameWoDiacritics;
    }
}