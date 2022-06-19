<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quotes;
use Illuminate\Support\Facades\Http;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quotes::factory(10);

        $url = 'https://type.fit/api/quotes';
        $quotes = Http::get($url)->json();

        $database_quotes = [];

        foreach ($quotes as $quote) {
            if (!empty($quote['text']) && !empty($quote['author'])) {
                $database_quote = Quotes::factory()->create([
                    'text' => $quote['text'],
                    'author' => $quote['author'],
                ]);
            }

            if (!in_array($database_quote, $database_quotes)) {
                $database_quotes[] = $database_quote;
            }

        }

        return response()->json([
            'database_quotes' => $database_quotes,
        ]);
    }
}
