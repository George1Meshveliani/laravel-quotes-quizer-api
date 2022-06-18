<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Quotes;

class QuoteController extends Controller
{
    /**
     * Fetch quotes data and store it in database.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchQuotes() {

        $url = 'https://type.fit/api/quotes';
        $quotes = Http::get($url)->json();

        foreach ($quotes as $quote) {
            if (!empty($quote['text']) && !empty($quote['author']))
            Quotes::create([
                'text' => $quote['text'],
                'author' => $quote['author'],
            ])->save();
        }

        return response()->json([
            'quotes' => $quotes,
        ]);

    }
}
