<?php

/**
 *
 * This class take a object and when acceses a property that does not exist, it will return null instead of throwing an error
 */
class Optional
{
    private $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    public function __get($name)
    {
        if (isset($this->object->$name)) {
            return $this->object->$name;
        }

        return null;
    }

}