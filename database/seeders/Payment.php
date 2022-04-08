<?php

namespace Database\Seeders;

use App\Models\Payment as PaymentModel;
use Illuminate\Database\Seeder;

class Payment extends Seeder


{
    private $payments;
    public function __construct()
    {
        $this->payments = [
            [
                'name' => 'Básico',
                'color' => '#89987A',
                'currency' => 'COP',
                'price' => 0
            ],
            [
                'name' => 'Medio',
                'color' => '#7A985B',
                'currency' => 'COP',
                'price' => 6000000
            ],
            [
                'name' => 'Alto',
                'color' => '#7A985B',
                'currency' => 'COP',
                'price' => 9000000
            ],
            [
                'name' => 'Super',
                'color' => '#7A985B',
                'currency' => 'COP',
                'price' => 54900000
            ],
            [
                'name' => 'Super',
                'color' => '#7A985B',
                'currency' => 'COP',
                'price' => 94900000
            ],

        ];
    }


    public function run()
    {
        foreach ($this->payments as $payment) {
            PaymentModel::create([
                'name' => $payment['name'],
                'color' => $payment['color'],
                'currency' => $payment['currency'],
                'price' => $payment['price']
            ]);
        }
    }
}
