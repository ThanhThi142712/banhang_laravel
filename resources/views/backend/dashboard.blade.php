@extends('layout')
@section('admin_content')

<section class="wrapper">
		
		
<table class="table table-striped table-dark" id="myTable">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">tên sản phẩm</th>
      <th scope="col">id_type</th>
	  <th scope="col">mô tả</th>
	  <th scope="col">giá bán</th>
	  <th scope="col">giá giảm</th>
	  <th scope="col">Chức Năng</th>

    </tr>
  </thead>
  <tbody>
	  @foreach($list as $item)
	  <tr>
      <th scope="row">{{$item->id}}</th>
      <td>{{$item->name}}</td>
      <td>{{$item->id_type}}</td>
	  <td>{{$item->description}}</td>
	  <td>{{$item->id_type}}</td>
	  <td>{{$item->description}}</td>
	  <td>
		  <a href="{{Route('delete',['id'=>$item->id])}}" class="btn btn-danger">Xóa </a>
	  </td>
    </tr>
	  @endforeach
    
  </tbody>
</table>
		
</section>
@endsection