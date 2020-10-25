<?php
namespace App\Normalizer;

class LocodeNormalizer
{

    /**
     * Locode constructor.
     */
    public function __construct()
    {
    }

    public function normalizeObject(\App\Entity\Locode $locode){
        return  [
            'Country' => $locode->getCountry(),
            'Location' => $locode->getLocation(),
            'Name' => $locode->getName(),
            'NameWoDiacritics' => $locode->getNameWoDiacritics(),
            'Subdivision' => $locode->getSubdivision(),
            'Function' => $locode->getFunction(),
            'Status' => $locode->getStatus(),
            'Date' => $locode->getDate(),
            'IATA' => $locode->getIata(),
            'Coordinates' => $locode->getCoordinates(),
            'Remarks' => $locode->getRemarks()
        ];
    }

    public function normalizeList($list) {
        $result = [];

        if (empty($list)) return $result;

        foreach($list as $locode) {
            $result[] = $this->normalizeObject($locode);
        }

        return $result;
    }
}