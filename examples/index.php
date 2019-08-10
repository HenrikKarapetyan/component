<?php

use henrik\component\Component;

require "../vendor/autoload.php";

class Simple extends Component{
    private $x;

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }
}

$simple = new Simple();
$simple->x = 45;  //accessing the private property of `Simple` class
var_dump($simple->x); //
