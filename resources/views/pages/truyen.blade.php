@extends('../layout')

{{-- @section('slide')

  @include('pages.slide')

@endsection --}}

@section('content')
<style type="text/css">
    .tagcloud06 ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .tagcloud06 ul li {
        display: inline-block;
        margin: 0 0 .3em 1em;
        padding: 0;
    }

    .tagcloud06 ul li a {
        position: relative;
        display: inline-block;
        height: 30px;
        line-height: 30px;
        padding: 0 1em 0 .75em;
        background-color: red;
        border-radius: 0 3px 3px 0;
        color: #fff;
        font-size: 13px;
        text-decoration: none;
        -webkit-transition: .2s;
        transition: .2s;
    }

    .tagcloud06 ul li a::before {
        position: absolute;
        top: 0;
        left: -15px;
        z-index: -1;
        content: '';
        width: 30px;
        height: 30px;
        background-color: red;
        border-radius: 50%;
        -webkit-transition: .2s;
        transition: .2s;
    }

    .tagcloud06 ul li a::after {
        position: absolute;
        top: 50%;
        left: -6px;
        z-index: 2;
        display: block;
        content: '';
        width: 6px;
        height: 6px;
        margin-top: -3px;
        background-color: #fff;
        border-radius: 100%;
    }

    .tagcloud06 ul li span {
        display: block;
        max-width: 100px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .tagcloud06 ul li a:hover {
        background-color: #555;
        color: #fff;
    }

    .tagcloud06 ul li a:hover::before {
        background-color: #555;
    }
</style>
<style>
    .checked {
        color: orange;
    }
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc)}}">{{$truyen->danhmuctruyen->tendanhmuc}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$truyen->tentruyen}}</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" data-holder-rendered="true">
            </div>
            <div class="col-md-9">
                <style type="text/css">
                    .infotruyen {
                        list-style: none;
                    }
                </style>
                <ul class="infotruyen">
                    <li>Tên truyện: {{$truyen->tentruyen}}</li>
                    <li>Tác giả: {{$truyen->tacgia}}</li>
                    <li>Ngày đăng: {{$truyen->created_at->diffforHumans()}}</li>
                    <li>Ngày update: {{$truyen->updated_at->diffforHumans()}}</li>
                    <li> Danh mục truyện :
                        @foreach($truyen->thuocnhieudanhmuctruyen as $thuocdanh)

                        <a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge badge-dark">{{$thuocdanh->tendanhmuc}}</span></a>
                        @endforeach
                    </li>
                    <li> Thể loại truyện :
                        @foreach($truyen->thuocnhieutheloaitruyen as $thuocloai)

                        <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge badge-info">{{$thuocloai->tentheloai}}</span></a>
                    </li>
                    @endforeach<br>
                    <li>
                        <label for="value">Điểm đánh giá: </label>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <!-- <meter id="value" min="0" max="100" low="30" high="75" optimum="80" value="98"></meter></li> -->
                    <li>Số chương: 1000</li>
                    <li>Lượt xem: 99999</li>
                    <li><a href="#">Xem mục lục</a></li>

                    @if($chapter_dau)
                    <li><a href="{{url('xem-chapter/'.$chapter_dau->slug_chapter)}}" class="btn btn-primary">Đọc online</a></li>
                    <li><a href="{{url('xem-chapter/'.$chapter_cuoi->slug_chapter)}}" class="btn btn-success mt-2">Đọc chương mới nhất</a></li>
                    @else
                    <li><a href="" class="btn btn-primary">Chưa cập nhật!</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <h4>Tóm tắt</h4>
            <p>{{$truyen->tomtattruyen}}</p>

        </div>
        <p>Từ khóa tìm kiếm :
            @php
            $tukhoa = explode(",",$truyen->tukhoa);
            @endphp
        <div class="tagcloud06">
            <ul>
                @foreach($tukhoa as $key => $tu)

                <li><a href="#"><span>{{$tu}}</span></a></li>

                @endforeach
            </ul>
        </div>
        </p>
        <hr>
        <h4>Mục lục</h4>
        <ul class="mucluctruyen">
            @php
            $mucluc = count($chapter);

            @endphp
            @if($mucluc>0)
            @foreach($chapter as $key => $chap)
            <li><a href="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{{$chap->tieude}}}</a></li>
            @endforeach
            @else
            <li>Hiện chưa có mục lục, đang cập nhât quay lại sau!</li>
            @endif
        </ul>

        <h4>Sách cùng danh mục</h4>
        <div class="row">
            @foreach($cungdanhmuc as $key => $value)
            <div class="col-md-3">
                <div class="card mb-3 box-shadow">
                    <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" data-holder-rendered="true">

                    <div class="card-body">
                        <h5>{{$value->tentruyen}}</h5>
                        <p class="card-text">{{$value->tomtattruyen}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Xem ngay</a>
                                <a class="btn btn-sm btn-outline-secondary">
                                    <p><i class="far fa-eye"></i>99999</p>
                                </a>
                            </div>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-3">
		<style type="text/css">
			.col-md-7.sidebar a {
			    /* padding: 0; */
			    font-size: 15px;
			    text-decoration: none;
			    color: #000;
			}
			.col-md-7.sidebar {
			    padding: 0;
			}
			.card-header{
				background: whitesmoke !important;
                font-size: auto;
			}
            .card-header1{
				background: whitesmoke!important;
                font-size: 20px;
                
			}
		</style>
    <h3 class="card-header1 fas fa-eye">   Top truyện xem nhiều</h3>
		@foreach($truyenxemnhieu as $key => $xemnhieu)
		<div class="row mt-2 border botttom">
				<div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" src="{{asset('public/uploads/truyen/'.$xemnhieu->hinhanh)}}" alt="{{$xemnhieu->tentruyen}}"></div>
				
				<div class="col-md-7 sidebar" >
					<a href="{{url('xem-truyen/'.$xemnhieu->slug_truyen)}}">
					<p>{{$xemnhieu->tentruyen}}</p>

					<p><i class="fas fa-eye"></i></p>
						</a>
				</div>
		</div>
		@endforeach
        <h3 class="card-header fas fa-medal">    Top truyện đề cử</h3>
		@foreach($truyendecu as $key => $decu)
		<div class="row mt-2">
				<div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" src="{{asset('public/uploads/truyen/'.$decu->hinhanh)}}" alt="{{$decu->tentruyen}}"></div>
				
				<div class="col-md-7 sidebar" >
					<a href="{{url('xem-truyen/'.$decu->slug_truyen)}}">
					<p>{{$decu->tentruyen}}</p>

					<p><i class="fas fa-eye"></i></p>
						</a>
				</div>
		</div>
		@endforeach
      
    </div>
</div>
@endsection