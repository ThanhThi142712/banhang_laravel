<?php

namespace App\Http\Controllers;

use App\Slide; //khai bao thu vien chua slide
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use Customer;
use Hash;
use App\User;
use required;
use Auth;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex(){
      
      $slide = Slide::all(); //tao bien lay het dl tu csdl
      $new_product = Product::where('new',1)->paginate(4);
      $sanpham_khuyenmai=Product::where('promotion_price','<>',0)->paginate(4);
      //dd($new_product);
     return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));// chuyen bien

    }
    ////////////////////////////////////////////////////////////////////////// 
    public function getLoaiSp($type){
       $sp_theoloai = Product::where('id_type','<>',$type)->paginate(3);
       $sp_khac= Product::where('id_type',$type)->paginate(3);
       $loai =ProductType::all();
       $loai_sp =ProductType::where('id',$type)->first();
       
    	return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }
    ////////////////////////////////////////////////////////////////

    public function getChitiet( Request $req){
      $sanpham = Product::where('id',$req->id)->first();
      $sp_tuongtu = Product::where('id_type',$sanpham->type_id)->paginate(6);
    	return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu'));
    }
    //////////////////////////////////////

    public function getLienHe(){
    	return view('page.lienhe');
    } 
    ///////////////////////////////////////////
    public function getGioiThieu(){
    	return view('page.gioithieu');
    } 
/////////////////////////////////////////////
    public function getAlltoCart(Request $req,$id){
      $product =Product::find($id);
      $oldCart= Session('cart')?Session::get('cart'):null;
      $cart =new Cart($oldCart);
      $cart->add($product,$id);
      $req->Session()->put('cart',$cart);
      return redirect()->back();
    }
    //////////////////////////////////////////////////

     public function getDelItemCart($id){
      $oldCart= Session::has('cart')?Session::get('cart'):null;
      $cart =new Cart($oldCart);
      $cart->removeItem($id);
      if(count($cart->items)>0){
         Session()->put('cart',$cart);
      }
      else{
         Session::forget('cart');
      }
     
      return redirect()->back();



    }
    ////////////////////////////////////////////////
    public function getCheckout (){
      if(Session::has('cart'))
      {
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
      }
      return view('page.dat_hang',['product_cart'=>$cart->items,
                'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
    }
    ///////////////////////////////////////////////////
    public function getLogin(){
      return view('page.dangnhap');
    }
     ///////////////////////////////////////////////
    public function postLogin( Request $req){
       $this->validate($req,
        [
          'email'=>'required|email',
          'password'=>'required|min:6|max:20',
     
          
        ],
        [
          'email.required'=>'Vui lòng nhập email',
          'email.email'=>'Không đúng định dạng email',
          'password.required'=>'Vui lòng nhập mật khẩu',
          'password.min'=>'Mật khẩu ít nhất 6 ký tự',
          'password.max'=>'Mật khẩu không quá 20 ký tự'
        ]);
       $credentials=array('email'=>$req->email,'password'=>$req->password);
          $chuoi='nhanam945@gmail.com';
       if($req->email==$chuoi)
       {
        $admin=array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($admin))
            {
              return redirect()->route('layout');
            }
       }else
       {
       if(Auth::attempt($credentials)){
        return redirect()->route('trang-chu')->with(['flag'=>'success','message'=>'Đăng Nhập Thành công']);
       }
    
       else{
        return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng Nhập Thất bại']);

       }
      }
    }


    //////////////////////////////////////////////////
     public function getSignin(){
      return view('page.dangky');
    }
    ///////////////////////////////////////////
    public function postSignin(Request $req){
      $this->validate($req,
        [
          'email'=>'required|email|unique:users,email',
          'password'=>'required|min:6|max:20',
          'fullname'=>'required',
          're_password'=>'required|same:password'
        ],
        [
          'email.required'=>'Vui lòng nhập email',
          'email.required'=>'Không đúng định dạng email',
          'email.unique'=>'Email đã tồn tại',
          'password.required'=>'Vui lòng nhập mật khẩu  ',
          're_password.same'=>'Mật khẩu không khớp',
          'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]);
      $user =new User();
      $user->full_name=$req->fullname;
      $user->email=$req->email;
      $user->password=Hash::make($req->password);
      $user->phone=$req->phone;
      $user->address=$req->address;
      $user->save();
      return redirect()->route('login')->with(['flag'=>'success','message'=>'Tạo tài khoản thành công']);


    }
    public function getSearch(Request $req){
      $product=Product::where('name','like','%'.$req->key.'%')
                        ->orWhere('unit_price',$req->key)
                        ->get();
      return view('page.search',compact('product'));

    }
    public function postLogout(){
      Auth::logout();
      return redirect()->route('trang-chu');
    }

}
