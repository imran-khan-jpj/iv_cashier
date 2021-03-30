<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 4242424242424242
// 42122222222
class ChargeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function charge(Request $request){
        // dd($request->user());
        try {
        
            $stripeCharge = $request->user()->charge(
                100, $request->payment_method
            );

            // return redirect('/');
            if($stripeCharge->status === 'succeeded'){
                return redirect('/');
            }
        
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
