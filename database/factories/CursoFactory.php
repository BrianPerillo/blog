<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CursoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Curso::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence();

        return [
            'name'=>$name,
            'description'=>$this->faker->paragraph(),
            'categoria'=>$this->faker->randomElement(['Diseño Web','Desarrollo Web']),
            'slug'=>Str::slug("$name",'_')
        ];
    }
}
