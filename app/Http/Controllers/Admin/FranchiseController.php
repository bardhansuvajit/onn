<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FranchiseController extends Controller
{
    public function index(Request $request) 
    {
        $data = DB::table('subscription_mails')->get();
        return view('admin.mail.index', compact('data'));
    }
}
