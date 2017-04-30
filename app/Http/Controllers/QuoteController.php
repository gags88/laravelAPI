<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class QuoteController extends Controller
{
   public function addQuote(Request $request){

       /*if(! $user = JWTAuth::parseToken()->authenticate()){
           return response().json(['message' => 'Invalid User'], 404);
       }*/

       $user = JWTAuth::parseToken()->toUser();

       $quote = new Quote();
       $quote->content = $request->input("content");
       $quote->save();
       return response()->json(['quote' => $quote], 201);
   }

   public function getQuotes(){
       $quotes = Quote::all();
       $response = [
           'quotes' => $quotes
       ];
       return response()->json($response, 200);
   }
}
