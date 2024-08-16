<?php

namespace Modules\Book\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Book\App\Models\Book;

class BookFactory extends Factory
{
    /**
     * اسم نموذج هذا المصنع.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * تعريف حالة النموذج الافتراضية.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'book_name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 5, 100),
            'author' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }
}
