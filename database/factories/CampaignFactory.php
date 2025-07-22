<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'reply_to' => $this->faker->safeEmail,
            'preview_text' => $this->faker->text(),
            'subject' => $this->faker->realText(80),
            'html_content' => $this->faker->randomHtml(10),
            'type' => $this->faker->randomElement(['fake']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
