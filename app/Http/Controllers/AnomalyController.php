<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnomalyController extends Controller
{
    public function view($userId){
        $listTransaction = DB::table('transaction')->where("source", $userId)->orWhere("target", $userId)->get();
        $userAccount = DB::table('accountprofile')->get();
        $suspiciousAccounts = DB::table('suspiciousAccounts')->where("is_sus", 1)->get();


        return view("userDetail", compact('listTransaction', 'userId', 'userAccount', 'suspiciousAccounts'));
    }
}
