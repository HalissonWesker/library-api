<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition()
    {
        return [
            'book_id' => Book::factory(),
            'user_id' => User::factory(), // Assumindo que `user_id` se refere ao usuário que pegou o empréstimo
            'borrow_date' => $this->faker->date(),
            'return_date' => $this->faker->date(),
        ];
    }
}
