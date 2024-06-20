<?php

/* 
Access specifiers
-------------------
* public
* private
* protected
*/

class Mic{
    //created a class with some properties
    public $brand;
    public $color;
    public $usb_port;
    public $model;
    public $light;
    public $price;
    private $version;


public function setLight($light){ //'setLight' is function which calls a recent property of an obj($mic1->setLight("blue"))
    echo $light."\n";
    echo $this->light."\n";  //'$this' refers to current executing object .here in $mic1->which is created as an property ($mic1->light = "white")  

}

public function setPrice($price){
    echo "Coupen Code applied: $".$price."\n";
    echo "Actual Price: $".$this->price."\n";
}

public function applyColor($color){
    echo "Customized color: ".$color."\n";
    echo "Actual color: ".$this->color."\n";
}








}




?>