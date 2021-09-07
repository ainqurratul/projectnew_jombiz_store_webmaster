<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;


class TransactionController extends Controller
{
    public function index()
    {
        $transactionPending['listPending'] = Transaction::whereStatus("PENDING")->get();
        $transactionComplete['listComplete'] = Transaction::where("Status", "NOT LIKE", "%PENDING%")->get();

        return view ('transaction')-> with($transactionPending)-> with($transactionComplete);
    }

    public function cancel($id){
        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();
        
        $this->pushNotif('Transaction Cancelled', "Hey , your order ".$transaction->details[0]->product->name." has been cancelled.", $transaction->users->fcm);

        $transaction->update([
            'status' => "CANCELLED"
        ]);
        return redirect('transaction');

    }

    public function confirm($id){
        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();
        
        $this->pushNotif('Product Processed', "Hey , your order ".$transaction->details[0]->product->name." will be delivered today!", $transaction->users->fcm);

        $transaction->update([
            'status' => "PROCESS"
        ]);
        return redirect('transaction');

    }

    public function deliver($id){
        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();

        $this->pushNotif('Product Delivered', "Hey , your order ".$transaction->details[0]->product->name." successfully delivered!", $transaction->users->fcm);

        $transaction->update([
            'status' => "DELIVERED"
        ]);
        return redirect('transaction');

    }

    public function complete($id){
        $transaction = Transaction::with(['details.product', 'users'])->where('id', $id)->first();

        $this->pushNotif('Transaction Completed', "Hey , your order ".$transaction->details[0]->product->name." completed.", $transaction->users->fcm);

        $transaction->update([
            'status' => "COMPLETED"
        ]);
        return redirect('transaction');
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
}
