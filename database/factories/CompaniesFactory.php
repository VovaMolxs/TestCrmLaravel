<?php

namespace Database\Factories;

use App\Models\Companies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CompaniesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $logo = str_replace('c:/ospanel/domains/zadanie-crm/public/storage/file\\', 'file/', fake()->unique()->image('c:/ospanel/domains/zadanie-crm/public/storage/file') );
        return [
            'name' => fake()->company(),
            'email' => fake()->unique()->email(),
            'phone' => fake()->unique()->phoneNumber(),
            'website' => fake()->unique()->url(),
            'logo' => $logo,
            'note' => fake()->text(250),
        ];
    }
}
