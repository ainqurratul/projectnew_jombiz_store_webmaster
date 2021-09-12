<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Validator;


class TransactionController extends Controller
{
    public function store(Request $request){
        //user_id, total_item
        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'total_item' => 'required',
            'total_price' => 'required',
            'name' => 'required',
            'ship_method' => 'required',
            'total_transfer' => 'required',
            'bank' => 'required',
            // 'resit' => 'required',
            'phone' => 'required'

        ]);

        if($validation->fails()){
            $val = $validation->errors()->all();
            return $this->error($val[0]);
        }

        $code_payment = "INV/PYM".now()->format('Y-m-d')."/".rand(100, 999);
        $code_transaction = "INV/PYM".now()->format('H:m')."/".rand(100, 999);
        $code_unique = rand(100, 999);
        $status = "PENDING";
        $expired_at = now()->addDay();

        $dataTransaction = array_merge($request->all(),[
            'code_payment' => $code_payment,
            'code_transaction' => $code_transaction,
            'code_unique' => $code_unique,
            'status' => $status,
            'expired_at' => $expired_at

        ]);

        \DB::beginTransaction();
        $transaction = Transaction::create($dataTransaction);
        foreach ($request->products as $product){
            $details = [
                'transaction_id' => $transaction->id,
                'product_id' => $product['id'],
                'total_item' => $product['total_item'],
                'messages' => $product['messages'],
                'total_price' => $product['total_price']

            ];
            $transactionDetail = TransactionDetail::create($details);

        }
        if(!empty($transaction) && !empty($transactionDetail) ){
            \DB::commit();
            return response()->json([
                'success' => 1,
                'message' => 'Transaction Successful! ',
                'transaction' => collect($transaction)
            ]);
        }else{
            \DB::rollback();
            $this->error('Transaction Failed! ');
        }

    }

    public function history($id){

        $transactions = Transaction::with(['users'])->whereHas('users', function ($query) use ($id){
            $query->whereId($id);
        })->orderBy("id", "desc")->get();

        foreach($transactions as $transaction){
            $details = $transaction->details;
            foreach ($details as $detail){
                $detail->product;
            }
        }

        
        if(!empty($transactions)){
            return response()->json([
                'success' => 1,
                'message' => 'Transaction Successful! ',
                'transactions' => collect($transactions)
            ]);
        }else{
            $this->error('Transaction Failed! ');
        }
    }

    public function cancel($id){
        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();
        if($transaction){
            //update data
            $transaction->update([
                'status' => "CANCELLED"
            ]);

            $this->pushNotif('Transaction Cancelled', "Hey , your order ".$transaction->details[0]->product->name." has been cancelled.", $transaction->users->fcm);

            return response()->json([
                'success' => 1,
                'message' => 'Successful! ',
                'transaction' => $transaction
            ]);
        }else{
            return $this->error('Load Transaction Failed! ');
        }
    }

    public function pushNotif($title, $message, $mFcm) {

        $mData = [
            'title' => $title,
            'body' => $message
        ];

        $fcm[] = $mFcm;

        $payload = [
            'registration_ids' => $fcm,
            'notification' => $mData
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAAyxdC3Hs:APA91bE26NTZeg69NQqzp_MZ0PrFConNJ1shxcEbW_JgfvHQnSnQklYZJ8VeAmJvDpa50Ga28DCrv_peqbjKUFjUJeJX2HDBKxyVygfJnnSVx2c92poCepisuSeYsxZeYdboGknkgDk5"
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = [
            'success' => 1,
            'message' => "Push notif success",
            'data' => $mData,
            'firebase_response' => json_decode($response)
        ];
        return $data;
    }

    public function upload(Request $request, $id){

        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();
        if($transaction){
            //update data

            $fileName = "";
            if($request->image->getClientOriginalName()){ 
                $file = str_replace(' ','',$request->image->getClientOriginalName()) ;
                
                // $upload_path = 'public/transfer';
                // $server_ip = gethostbyname(gethostbyname());
                // $upload_url = 'http://'.$server_ip.'/'.$upload_path.$fileName;

                $fileName = date('ymdHi').rand(1, 999).'_'.$file;
                $request->image->storeAs('public/transfer', $fileName);

            } else {
                return $this->error('Upload Image Failed! ');
            }
            $transaction->update([
                'status' => "PAID",
                'resit' => $fileName
            ]);
            
            $this->pushNotif('Transaction Paid', "Hey , your order ".$transaction->details[0]->product->name." has been cancelled.", $transaction->users->fcm);

            return response()->json([
                'success' => 1,
                'message' => 'Successful! ',
                'transaction' => $transaction
            ]);
        }else{
            return $this->error('Load Transaction Failed! ');
        }
    }

    public function error($message){
        return response()->json([
            'success' => 0,
            'message' => $message
        ]);
    }
}
