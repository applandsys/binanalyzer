<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function allbin(){
		$BinList = new BinList();
		$allbin = $BinList->paginate(50);
		return view('admin.allbin_view')->with(compact('allbin'));
	}
}
