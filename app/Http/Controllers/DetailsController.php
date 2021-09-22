<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\TransactionDetail;

use Illuminate\Support\Facades\DB;


class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user['listUser'] = TransactionDetail::all();
        // return view ('details')-> with($user);

        $product['listProduct'] = Product::all();

        return view ('details')-> with($user)-> with($product);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     dd('ok');
    //     $details = TransactionDetail::where('id', $id)->first();
    //     return view ('details');
    //     -> with($details);


    //     $userData = UserData::find($id);
    //     return view('details.show',compact('transaction'));

    //     $user ['transactiondetails'] = TransactionDetail::select('select * from transaction_id')
    //     ->where('transaction_id', $id)
    //     ->first();
    //     return view('details',['users'=>$user]);
    // }

    public function show($id)
    {
        $user = TransactionDetail::where('id', $id)->first();

        if($user) {

            return view ('details')-> with($user);

            // return $user->delete();
            // return view ('user')-> with($user);
            echo "Record deleted successfully.<br/>";
            echo '<a href = "/view-records">Click Here</a> to go back.';
            // echo "Record deleted successfully.";
            // echo 'Click Here to go back.';

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
