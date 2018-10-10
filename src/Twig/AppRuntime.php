<?php

namespace App\Twig;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // this simple example doesn't define any dependency, but in your own
        // extensions, you'll need to inject services using this constructor
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',', $countryCode = "US")
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);

        switch($countryCode){
            case "US":
                return '$'.$price;
            case "UK":
                return '£'.$price;
            case "FR":
                return $price.'€';
        }
    }



}