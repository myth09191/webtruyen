@extends('../layout')
{{-- @section('slide')

@include('pages.slide')

@endsection --}}
@section('content')
<style type="text/css">
    .isDisabled {

        color: currentColor;

        pointer-events: none;

        opacity: 0.5;

        text-decoration: none;

    }

    .noidungchuong {
        padding: 20px;
        background: #fff;
        color: #000;
        /*   line-height: 40px !important;
font-size: 25px !important;
font-family: "Palatino Linotype","Arial","Times New Roman",sans-serif !important;*/
    }
    body{margin-top:20px;}

.comment-wrapper .panel-body {
    max-height:650px;
    overflow:auto;
}

.comment-wrapper .media-list .media img {
    width:64px;
    height:64px;
    border:2px solid #e5e7e8;
}

.comment-wrapper .media-list .media {
    border-bottom:1px dashed #efefef;
    margin-bottom:25px;
}
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{url('the-loai/'.$truyen_breadrumb->theloai->slug_theloai)}}">{{$truyen_breadrumb->theloai->tentheloai}}</a></li>
        <li class="breadcrumb-item"><a href="{{url('danh-muc/'.$truyen_breadrumb->danhmuctruyen->slug_danhmuc)}}">{{$truyen_breadrumb->danhmuctruyen->tendanhmuc}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$truyen_breadrumb->tentruyen}}</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12">
        <h4>{{$chapter->truyen->tentruyen}}</h4>
        <p>Chương hiện tại: {{$chapter->tieude}}</p>
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Chọn chương:</label>
                <p class="mt-4"><a href="{{url('xem-chapter/'.$chapter_truoc)}}"><i class="btn btn-danger fas fa-arrow-left {{$chapter->id==$min_id->id ? 'isDisabled' : ''}}"> Tập trước</i></a></p>
                <select name="kichhoat" class="custom-select chon_chapter">
                    @foreach($tatca_chapter as $key => $chap)
                    <option value="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{$chap->tieude}}</option>
                    @endforeach
                </select>
                <p class="mt-4"><a href="{{url('xem-chapter/'.$chapter_sau)}}"><i class="btn btn-danger fas fa-arrow-right {{$chapter->id==$max_id->id ? 'isDisabled' : ''}}"> Tập sau</i></a></p>
            </div>
        </div>
        <div class="noidungchuong">
            {!! $chapter->noidung !!}
        </div>
    </div>

</div>
<div class="container">
    <div class="row bootstrap snippets bootdeys">
        
        <div class="col-md-8 col-sm-12">
            <div class="comment-wrapper">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Bình luận:
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control" placeholder="write a comment..." rows="3"></textarea>
                        <br>
                        <button type="button" class="btn btn-info pull-right">Post</button>
                        <div class="clearfix"></div>
                        <hr>
                        <ul class="media-list">
                            <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                    <span class="text-muted pull-right">
                                        <small class="text-muted">30 min ago</small>
                                    </span>
                                    <strong class="text-success">Huỳnh Tấn Hậu</strong>
                                    <p>
                                        Truyện hay nhứt nách luôn admin ơi ra nhanh nha.
                                        <a href="#">#truyenhayvkl</a>.
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="https://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                    <span class="text-muted pull-right">
                                        <small class="text-muted">28 min ago</small>
                                    </span>
                                    <strong class="text-success">Đặng Thủ Khoa</strong>
                                    <p>
                                        Ảo truyện mất rồi :D <a href="#">#truyenhayvkl </a>.
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="https://bootdey.com/img/Content/user_3.jpg" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                    <span class="text-muted pull-right">
                                        <small class="text-muted">15 min ago</small>
                                    </span>
                                    <strong class="text-success">Admin</strong>
                                    <p>
                                        Cảm ơn đã ủng hộ! <a href="#">#baochapter</a>.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection