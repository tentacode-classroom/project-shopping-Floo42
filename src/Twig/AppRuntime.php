<?php

namespace App\Twig;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',', $countryCode = "US")
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        return $price;
    }


    public function convertPrice($price, $countryCode = "US"){
        switch($countryCode){
            case "US":
            print("$");  
            return ($price*1.15);
            case "UK":
            print("£");  
                return ($price*0.87);
            case "FR":
            print("€");    
                return $price;
        }

    }

}