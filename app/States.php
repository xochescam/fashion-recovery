<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class States extends Model
{

    public static function get()
    {
        return [
            "Baja California" => "Baja California",
            "Baja California Sur" => "Baja California Sur",
            "Campeche" => "Campeche",
            "Chihuahua" => "Chihuahua",
            "Chiapas" => "Chiapas",
            "Ciudad de México" => "Ciudad de México",
            "Coahuila" => "Coahuila",
            "Colima" => "Colima",
            "Durango" => "Durango",
            "Estado de México" => "Estado de México",
            "Guanajuato" => "Guanajuato",
            "Guerrero" => "Guerrero",
            "Hidalgo" => "Hidalgo",
            "Jalisco" => "Jalisco",
            "Michoacán" => "Michoacán",
            "Morelos" => "Morelos",
            "Nayarit" => "Nayarit",
            "Nuevo León" => "Nuevo León",
            "Oaxaca" => "Oaxaca",
            "Puebla" => "Puebla",
            "Querétaro" => "Querétaro",
            "Quintana Roo" => "Quintana Roo",
            "San Luis Potosí" => "San Luis Potosí",
            "Sinaloa" => "Sinaloa",
            "Sonora" => "Sonora",
            "Tabasco" => "Tabasco",
            "Tamaulipas" => "Tamaulipas",
            "Tlaxcala" => "Tlaxcala",
            "Veracruz" => "Veracruz",
            "Yucatán" => "Yucatán",
            "Zacatecas" => "Zacatecas"
        ];

    }
}
