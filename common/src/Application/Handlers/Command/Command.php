<?php

namespace Common\Application\Handlers\Command;

use ReflectionClass;

abstract class Command implements Port\Command
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        $ref = new ReflectionClass(get_class($this));
        $props = $ref->getProperties();

        dd($props);

        foreach ($props as $prop) {

            dd($prop);
            if ($prop->isPublic()) {
                $propsArray[] = $dtoArray[$prop->getName()];
            }
        }
    }
}