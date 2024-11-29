<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StockService;

class StockController extends Controller
{
    protected $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index()
    {
        // データベースから全ての株価データを取得
        $stocks = Stock::all();

        return view('stocks.index', ['stocks' => $stocks]);
    }


    public function show($symbol)
    {
        $data = $this->stockService->getStockData($symbol);
        return $data
            ? view('stocks.show', ['stockData' => $data])
            : back()->withErrors(['msg' => 'データ取得に失敗しました。']);
    }
}
