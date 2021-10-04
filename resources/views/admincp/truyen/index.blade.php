@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Truyện</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table table-striped table-reponsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên truyện</th>
                                <th scope="col">Tên tác giả</th>
                                <th scope="col">Hình ảnh truyện</th>
                                <th scope="col">Slug truyện</th>
                                <!-- <th scope="col">Tóm tắt</th> -->
                                <th scope="col">Danh mục</th>
                                <th scope="col">Thể loại</th>
                                <th scope="col">Từ khóa</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày update</th>
                                <th scope="col">Kích hoạt</th>
                                <th scope="col">Hoàn thiện</th>
                                <th scope="col">Nổi bật</th>
                                <th scope="col">Quản lí </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list_truyen as $key => $truyen)
                            <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$truyen->tentruyen}}</td>
                                <td>{{$truyen->tacgia}}</td>
                                <td><img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="50" width="50"></td>
                                <td>{{$truyen->slug_truyen}}</td>
                               <!--  <td>{{$truyen->tomtattruyen}}</td> -->
                                <td>{{$truyen->danhmuctruyen->tendanhmuc}}</td>
                                <td>{{$truyen->theloai->tentheloai}}</td>
                                <td>{{$truyen->tukhoa}}</td>
                                <!-- <td>{{$truyen->created_at}}</td>
                                <td>{{$truyen->updated_at}}</td> -->
                                <td>
                                    {{$truyen->created_at}} - {{$truyen->created_at->diffforHumans()}}
                                </td>
                                </td>
                                <td>
                                    @if($truyen->updated_at!='')
                                    {{$truyen->updated_at}} - {{$truyen->updated_at->diffforHumans()}}</td> 
                                    @endif 
                                </td>
                                <td>
                                    @if($truyen->kichhoat==0)
                                    <span class="text text-success">Kích hoạt</span>
                                    @else
                                    <span class="text text-danger">Không kích hoạt</span>
                                    @endif
                                </td>
                                <td>
                                    @if($truyen->hoanthien==0)
                                    <span class="text text-success">Đã hoàn thành</span>
                                    @else
                                    <span class="text text-primary">Còn update</span>
                                    @endif
                                </td>
                                <td width="10%">
                         @if($truyen->truyen_noibat==0)
                         <form>
                             @csrf
                                <select class="custom-select truyennoibat" data-truyen_id="{{$truyen->id}}" name="truyennoibat" aria-label="Default select example">
                               
                                <option selected value="0">Truyện mới</option>
                                <option value="1">Truyện nổi bật</option>
                                <option value="2">Truyện xem nhiều</option>
                                <option value="3">Truyện đề cử nhiều</option>
                               
                            </select>
                         </form>
                        @elseif($truyen->truyen_noibat==1)
                        <form>
                        @csrf
                            <select class="custom-select truyennoibat" data-truyen_id="{{$truyen->id}}" name="truyennoibat" aria-label="Default select example">
                                
                                <option  value="0">Truyện mới</option>
                                <option selected value="1">Truyện nổi bật</option>
                                <option value="2">Truyện xem nhiều</option>
                                <option value="3">Truyện đề cử nhiều</option>
                                
                            </select>
                        </form>
                        @elseif($truyen->truyen_noibat==2)
                           <form>
                           @csrf
                                <select class="custom-select truyennoibat " data-truyen_id="{{$truyen->id}}" name="truyennoibat" aria-label="Default select example">
                                
                                <option  value="0">Truyện mới</option>
                                <option value="1">Truyện nổi bật</option>
                                <option selected value="2">Truyện xem nhiều</option>
                                <option value="3">Truyện đề cử nhiều</option>
                                
                            </select>
                           </form>
                        @else
                        <form>
                        @csrf
                            <select class="custom-select truyennoibat" data-truyen_id="{{$truyen->id}}" name="truyennoibat" aria-label="Default select example">
                                
                                <option value="0">Truyện mới</option>
                                <option value="1">Truyện nổi bật</option>
                                <option value="2">Truyện xem nhiều</option>
                                <option selected value="3">Truyện đề cử nhiều</option>
                                
                            </select>
                        </form>
                        @endif
                                </td>
                              

                                <td>
                                    <a href="{{route('truyen.edit',[ $truyen-> id])}}" class=" btn btn-primary">Edit</a>
                                    <form action="{{route('truyen.destroy',[$truyen-> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có muốn xóa truyện này không?')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection