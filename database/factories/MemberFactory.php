<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => fake()->name(),
            'alamat' => fake()->address(),
            'jenis_kelamin' => Arr::random(['Laki-Laki', 'Perempuan']),
            'tlp' => fake()->phoneNumber(),
            'keterangan' => Arr::random(['member', 'non-member']),
        ];
    }
}
