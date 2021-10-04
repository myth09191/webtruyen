@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm truyện</div>
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

                    <form method="POST" action="{{route('chapter.store')}}" enctype='multipart/form-data'>
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Thêm chapter truyện</label>
                            <input type="text" class="form-control" value="{{old('tieude')}}" name="tieude" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên chapter...">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug chapter</label>
                            <input type="text" class="form-control" value="{{old('slug_chapter')}}" name="slug_chapter" id="convert_slug" placeholder="Slug chapter...">

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Tóm tắt chapter</label>
                            <textarea class="form-control" name="tomtat" id="exampleFormControlTextarea1" rows="3" style="resize:none"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Nội dung chapter</label>
                            <textarea class="form-control" name="noidung" id="noidungchapter" rows="5" style="resize:none"></textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Thuộc truyện</label>
                         <select name="truyen_id" class="custom-select">
                          @foreach($truyen as $key => $value)
                          <option value="{{$value->id}}">{{$value->tentruyen}}</option>
                          @endforeach
                        </select>
                        
                      </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                            <select class="custom-select" name="kichhoat" aria-label="Default select example">
                                <option value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            </select>
                        </div>
                        <button type="submit" name="themtruyen" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection