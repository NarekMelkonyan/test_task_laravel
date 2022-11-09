<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Writer;
use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::factory()
            ->count(100)
            ->has(Writer::factory()
                ->count(2)
                ->state(function (array $attributes, Book $book) {
                    return [
                        'book_id' => $book->id,
                    ];
                })
            )
            ->create();
    }
}
