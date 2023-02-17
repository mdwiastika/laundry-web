<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paket>
 */
class PaketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_outlet' => Arr::random([1, 2, 3]),
            'jenis' => Arr::random(['kiloan', 'selimut', 'bedcover', 'kaos', 'lain']),
            'nama_paket' => fake()->colorName(),
            'harga' => Arr::random([10000, 12500, 30000, 37900, 50000]),
        ];
    }
}
