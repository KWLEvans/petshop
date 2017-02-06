<?php

class Animal
{
    private $species;
    private $origin;
    private $cost;
    private $diet;
    private $legal = true;

    function __construct($species, $origin, $diet, $cost = 1000)
    {
        $this->species = $species;
        $this->origin = $origin;
        $this->diet = $diet;
        $this->cost = $cost;
    }

    function get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            return "That property does not exist.";
        }
    }

    function set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this[$property] = $value;
        } else {
            return "That property does not exist.";
        }
    }
}

 ?>
