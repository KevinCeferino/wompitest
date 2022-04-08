<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $faker = \Faker\Factory::create();
        $nombre = "Kevin Ceferino";
        $id = 564;
        $reference = $faker->uuid() . $nombre[0] . rand(-999999,999999) . mb_strtoupper($nombre[strlen($nombre)-1]). $id*2;
        $price = 4900000;
        $currency = 'COP';
        $integridad = 'test_integrity_HAz40lyhOoiR3Zv2VrwdFm0D3GtCo9Rs';
        $firma = $reference . $price . $currency . $integridad;
        $firma = hash('sha256', $firma);
        $llave = "pub_test_ogo5ljy0RVD5OzZnY4EWHc6WMpgBJfxB";
        return view('welcome',[
            'reference' => $reference,
            'price' => $price,
            'currency' => $currency,
            'firma' => $firma,
            'llave' => $llave
        ]);
    }
}
