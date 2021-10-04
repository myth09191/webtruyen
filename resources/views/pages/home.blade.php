      @extends('../layout')
      @section('slide')
      @include('pages.slide')
      @endsection
      @section('content')
      <style type="text/css">
        .fa {
          font-family: icomanga !important;
          /* speak: none; */
          font-style: normal;
          font-weight: 400;
          font-variant: normal;
          text-transform: none;
          line-height: 1;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
        }

        .fa,
        .fa-stack {
          display: inline-block;
        }

        *,
        :after,
        :before {
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
        }

        user agent stylesheet i {
          font-style: italic;
        }

        .page-title {
          margin: 0;
          font-weight: 400;
          font-size: 20px;
          margin-bottom: 5px;
          text-transform: uppercase;
          color: #2980b9;
        }

        h1 {
          font-size: 2em;
          margin: .67em 0;
        }

        user agent stylesheet h1 {
          font-size: 2em;
          font-weight: bold;
        }

        body {
          font-family: Tahoma, sans-serif, Helvetica, Arial;
          font-weight: 400;
          font-size: 14px;
          background-color: whitesmoke;

        }

        body {
          line-height: 1.42857143;
          color: #333;
        }

        html {
          font-size: 10px;
        }

        html {
          font-family: sans-serif;
          -ms-text-size-adjust: 100%;
          -webkit-text-size-adjust: 100%;
        }

        .fancybox-nav,
        .owl-controls,
        html {
          -webkit-tap-highlight-color: transparent;
        }

        .fa-angle-right:before {
          content: "\f105";
        }

        *,
        :after,
        :before {
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
        }

        *,
        :after,
        :before {
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
        }
      </style>
      <!-- Mới Update -->

      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="items">
              <h1 class="page-title">Truyện mới cập nhật
                <i class="fa fa-angle-right"></i>
              </h1>

              <div class="row">
                @foreach($truyen as $key => $value)
                <div class="item">
                  <div class="box_tootip ">
                    <div class="card" style="width: 18rem;">

                      <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" height="205" width="300">
                      <div class="card-body">
                        <h5>{{$value->tentruyen}}</h5>
                        <p class="card-text">
                          @foreach($value->thuocnhieudanhmuctruyen as $thuocdanh)
                          <a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge badge-dark">{{$thuocdanh->tendanhmuc}}</span></a>
                          @endforeach
                          @foreach($value->thuocnhieutheloaitruyen as $thuocloai)
                          <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge badge-info">{{$thuocloai->tentheloai}}</span></a>
                          @endforeach
                        </p>


                        <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" type="button" class="btn btn-success">Xem ngay</a>
                        <a class="btn btn-success ">
                          <p><i class="far fa-eye"></i>{{$value->views}}</p>
                        </a>



                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col">
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

              .card-header {
                background: whitesmoke !important;
                font-size: 36px;
                border: 3px solid red;
              }

              .card-header1 {
                background: whitesmoke !important;
                font-size: 20px;
                border: 3px solid red;

              }
              .truyendecu{
                border:  solid red;
              }
            </style>
            <h3 class="card-header fas fa-medal "> Top truyện đề cử</h3>
            <div class="truyendecu">
            @foreach($truyendecu as $key => $decu)
            <div class="row mt-2">
              <div class="col-md-5"><img class="img img-responsive" width="100%" class="card-img-top" src="{{asset('public/uploads/truyen/'.$decu->hinhanh)}}" alt="{{$decu->tentruyen}}"></div>

              <div class="col-md-7 sidebar">
                <a href="{{url('xem-truyen/'.$decu->slug_truyen)}}">
                  <p>{{$decu->tentruyen}}</p>

                  <p><i class="fas fa-eye"></i></p>
                </a>
              </div>
            </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>

      </div>









      </div>

      @endsection