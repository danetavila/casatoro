<?php

namespace App\Http\Controllers;

use App\Models\Inventory as InventoryModel;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= InventoryModel::with('product')->whereNull('sale_id')->orderByDesc('created_at')->get();
        
        return view('report.index',compact('data'));
    }

    public function create()
    {   
        $data= DB::select('SELECT products.id, products.name, products.price, SUM(qty) AS cant FROM sales INNER JOIN products ON sales.product_id=products.id GROUP BY product_id ORDER BY cant DESC LIMIT 5');
        return view('report.index2',compact('data'));

    }

    public function show()
    {
        //
    }
}
