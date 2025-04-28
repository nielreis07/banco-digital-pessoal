<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoa>
 */
class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'cpf' => fake()->unique()->numerify('###########'),
            'data_nascimento' => fake()->date(),
            'telefone' => fake()->numerify('###########'),
            'bairro' => fake()->word(),
            'cidade' => fake()->word(),
            'estado' => fake()->randomElement(['DF', 'GO', 'SP', 'RJ']),
            'complemento' => fake()->word(),
            'cep' => fake()->numerify('########'),
            'perfil' => fake()->randomElement(['funcionario', 'cliente']),
            'usuario_id' => fake()->numberBetween(1, 1),
        ];
    }
}
