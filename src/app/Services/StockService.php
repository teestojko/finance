<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Stock;

class StockService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('ALPHA_VANTAGE_API_KEY');
    }

    public function getStockData($symbol)
    {
        $response = Http::get('https://www.alphavantage.co/query', [
            'function' => 'TIME_SERIES_INTRADAY',
            'symbol' => $symbol,
            'interval' => '5min',
            'apikey' => $this->apiKey
        ]);
        if ($response->successful()) {
        $data = $response->json();
        // データをデータベースに保存
        Stock::updateOrCreate(
            ['symbol' => $symbol], // 既存のシンボルを更新
            ['data' => $data]
        );
        return $data;
        }
        return null;
    }
}
