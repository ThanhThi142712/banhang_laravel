<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product; 

class AdminController extends Controller
{
    public function getindex(){
     
    	 return view('admin');

    }

    public function getquantri(){
        $list=Product::all();
    	 return view('backend.dashboard',compact('list'));

    }
    public function delete($id)
    {
        $row=Product::find($id);
        if($row!=null)
        {
            $row->delete();
            return redirect()->route('layout')->with("message",["type"=>"danger","msg"=>"san pham da xoa"]);
        }
        else{
            return redirect()->route('layout');
        }
    }

}
