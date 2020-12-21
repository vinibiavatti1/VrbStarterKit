<?php
/**
 * Example model template
 */
class ExampleModel {
    
    private $id;
    private $name;
    
    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setName($name): void {
        $this->name = $name;
    }
    
}