<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {

        $faker = \Faker\Factory::create();
        $this->reference = $faker->uuid();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'currency' => $this->currency,
            'price' => $this->price,
            'reference' => $this->reference,
            'integrity' => config('services.wompi.integrity'),
            'concat' => $this->reference . $this->price . $this->currency . config('services.wompi.integrity'),
            'firma' => hash('sha256', $this->reference . $this->price . $this->currency . config('services.wompi.integrity')),
            'llave' => config('services.wompi.key'),
            'user_email' => 'kevin.ceferino000@gmail.com',
            'user_name' => 'Kevin Ceferino',
            'user_phone' => 3142665212,
            'user_legal_id_type' => 'CC',
            'user_legal_id' => 1001272228
        ];
    }
}
