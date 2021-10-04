@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật truyện</div>
                @if (session('status'))
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{route('truyen.update',[$truyen->id])}}" enctype='multipart/form-data'>
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên truyện</label>
                            <input type="text" class="form-control" value="{{$truyen->tentruyen}}" name="tentruyen" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục...">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                            <input type="text" class="form-control" value="{{$truyen->tacgia}}" name="tacgia" placeholder="Tên tác giả...">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug tên truyện</label>
                            <input type="text" class="form-control" value="{{$truyen->slug_truyen}}" name="slug_truyen" id="convert_slug" placeholder="Slug danh mục...">

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Tóm tắt truyện</label>
                            <textarea class="form-control" name="tomtattruyen" id="exampleFormControlTextarea1" rows="5" style="resize:none">{{$truyen->tomtattruyen}}</textarea>
                        </div>
                        <label for="exampleInputEmail1">Danh mục truyện</label>
                            @foreach($danhmuc as $key => $muc)
                            <div class="form-check">
                                <input class="form-check-input" @if( $thuocdanhmuc->contains($muc->id) ) checked @endif
                                name="danhmuc[]" type="checkbox" id="danhmuc_{{$muc->id}}" value="{{$muc->id}}">
                                <label class="form-check-label" for="danhmuc_{{$muc->id}}">{{$muc->tendanhmuc}}</label>
                            </div>
                            @endforeach
                            <label for="exampleInputEmail1">Thể loại</label>
                            @foreach($theloai as $key => $the)
                            <div class="form-check">
                                <input class="form-check-input" @if( $thuoctheloai->contains($the->id) ) checked @endif
                                name="theloai[]" type="checkbox" id="theloai_{{$the->id}}" value="{{$the->id}}">
                                <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                            </div>
                            @endforeach
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
                                <input type="text" class="form-control" value="{{$truyen->tukhoa}}" name="tukhoa" placeholder="Từ khóa...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hình ảnh truyện</label>
                                <input type="file" class="form-control-file" name="hinhanh">
                                <td><img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="50" width="50"></td>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                                <select class="custom-select" name="kichhoat" aria-label="Default select example">
                                    @if($truyen->kichhoat ==0)
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                    @else
                                    <option value="0">Kích hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tình trạng</label>
                                <select class="custom-select" name="tinhtrang" aria-label="Default select example">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Truyện nổi bật</label>
                            <select class="custom-select" name="truyennoibat" aria-label="Default select example">
                                @if($truyen->truyen_noibat==0)
                                <option selected value="0">Truyện mới</option>
                                <option value="1">Truyện nổi bật</option>
                                <option value="2">Truyện xem nhiều</option>
                                <option value="3">Truyện đề cử nhiều</option>
                                @elseif($truyen->truyen_noibat==1)
                                <option  value="0">Truyện mới</option>
                                <option  selected value="1">Truyện nổi bật</option>
                                <option value="2">Truyện xem nhiều</option>
                                <option value="3">Truyện đề cử nhiều</option>
                                @elseif($truyen->truyen_noibat==2)
                                <option  value="0">Truyện mới</option>
                                <option  value="1">Truyện nổi bật</option>
                                <option selected value="2">Truyện xem nhiều</option>
                                <option value="3">Truyện đề cử nhiều</option>
                                @else
                                <option  value="0">Truyện mới</option>
                                <option  value="1">Truyện nổi bật</option>
                                <option  value="2">Truyện xem nhiều</option>
                                <option selected value="3">Truyện đề cử nhiều</option>
                                @endif
                            </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hoàn thiện</label>
                                <select class="custom-select" name="hoanthien" aria-label="Default select example">
                                    <option value="0">Đã hoàn thành</option>
                                    <option value="1">Còn update</option>
                                </select>
                            </div>
                        </div>
                            <button type="submit" name="capnhap" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection