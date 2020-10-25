<?php

namespace App\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Function datatype.
 */
class FunctionType extends Type
{
    const TYPE = 'function_type';

    protected $possibleValues = ["unknown", "port", "rail", "road", "airport", "postal", "multimodal", "fixedtransport", "border"];

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $columns = "";
        foreach ($this->possibleValues as $column) {
            $columns .= "\"$column\",";
        }
        $columns = "SET(" . trim($columns, ",") . ")";

        return $columns;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return explode(',', $value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException('...');
        }

        foreach ($value as $item) {
            if (!in_array($item, $this->possibleValues, true)) {
                throw new \InvalidArgumentException('...');
            }
        }

        return implode(',', $value);
    }

    public function getName()
    {
        return self::TYPE;
    }
}