<?php


namespace App\Enum;


use Spatie\Enum\Enum;

class BaseEnum extends Enum
{
    static public function getAll(): array
    {
        $indices = self::getIndices();
        $all = [];
        foreach ($indices as $index) {
            $enum = self::make($index);
            $all[] = [
                'name' => $enum->getName(),
                'index' => $enum->getIndex(),
                'value' => $enum->getValue(),
            ];
        }

        return  $all;
    }
}
