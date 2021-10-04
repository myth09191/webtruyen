@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật chapter truyện</div>
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

                    <form method="POST" action="{{route('chapter.update',[$chapter->id])}}" >
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Thêm chapter truyện</label>
                            <input type="text" class="form-control" value="{{$chapter->tieude}}" name="tieude" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên chapter...">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug chapter</label>
                            <input type="text" class="form-control" value="{{$chapter->slug_chapter}}" name="slug_chapter" id="convert_slug" placeholder="Slug chapter...">

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Tóm tắt chapter</label>
                            <textarea class="form-control" name="tomtat" id="exampleFormControlTextarea1" rows="3" style="resize:none">{{$chapter->tomtat}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Nội dung chapter</label>
                            <textarea class="form-control" name="noidung" id="editnoidungchapter" rows="5" style="resize:none">{{$chapter->noidung}}</textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Thuộc truyện</label>
                         <select name="truyen_id" class="custom-select">
                          @foreach($truyen as $key => $value)
                          <option {{ $chapter->truyen_id==$value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->tentruyen}}</option>
                          @endforeach
                        </select>
                        
                      </div>

                        
                      </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kích hoạt</label>
                            <select class="custom-select" name="kichhoat" aria-label="Default select example">
                            @if($chapter->kichhoat ==0)
                                <option selected value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                                @else
                                <option value="0">Kích hoạt</option>
                                <option selected value="1">Không kích hoạt</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="themtruyen" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection