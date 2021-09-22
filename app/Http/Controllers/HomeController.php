<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUser = User::all()->count();
        $totalOrder = Transaction::all()->count();
        $totalSales = Transaction::all()->sum('total_transfer');

        return view('dashboard')
        ->with('totalOrder', $totalOrder)
        ->with('totalUser', $totalUser)
        ->with('totalSales', $totalSales)
        ;

    }
}
