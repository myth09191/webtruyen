<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Web đọc truyện hay</title>
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
  <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body class="antialiased">
  <div class="container">

    <!-- menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand " href="#">Truyenonline.lnk</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link fas fa-home" href="{{url('/')}}">Trang chủ <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fas fa-list-alt" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Danh mục truyện
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach($danhmuc as $key => $danh) 
              <a class="dropdown-item fas fa-list-alt" href="{{url('danh-muc/'.$danh->slug_danhmuc)}}">{{$danh->tendanhmuc}}</a>
              @endforeach
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fas fa-tags" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Thể loại truyện
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($theloai as $key => $the) 
              <a class="dropdown-item fas fa-tags" href="{{url('the-loai/'.$the->slug_theloai)}}">{{$the->tentheloai}}</a>
              @endforeach
            </div>
          </li>

        </ul>
        <form autocomplete="off" class="form-inline my-2 my-lg-0" action="{{url('tim-kiem')}}" method="GET">
          @csrf
          <input class="form-control mr-sm-2" type="search" name="tukhoa" id="keywords" placeholder="Tìm kiếm tác giả, tên truyện..." aria-label="Search">
          <div id="search_ajax"></div>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
        </form>
      </div>
    </nav>
    <!-- slide -->
    @yield('slide')
    <!-- sách mới -->
    @yield('content')


    <footer class="text-muted py-5">
      <div class="container">
        <p class="float-end mb-1">
          <a href="#">Back to top</a>
        </p>
        <p class="mb-1">Trang web đọc truyện với nhìu truyện hay đặc sắc!</p>
        <p class="mb-0"> <a href="/">Visit the homepage</a> or read our <a href="/docs/5.1/getting-started/introduction/">getting started guide</a>.</p>
      </div>
    </footer>

  </div>
  </div>
  </div>

  </div>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
  <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js') }}"></script>
    <!-- Tìm kiếm nâng cao -->
    <script type="text/javascript">
      $('#keywords').keyup(function() {
          var keywords = $(this).val();
          if(keywords != '')
              {
               var _token = $('input[name="_token"]').val();

               $.ajax({
                url:"{{url('/timkiem-ajax')}}",
                method:"POST",
                data:{keywords:keywords, _token:_token},
                success:function(data){
                 $('#search_ajax').fadeIn();  
                  $('#search_ajax').html(data);
                }
               });

              }else{

                $('#search_ajax').fadeOut();  
              }

          });
   </script>


  <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 3
        },
        1000: {
          items: 5
        }
      }
    })
  </script>
  <script type="text/javascript">
    $('.chon_chapter').on('change',function(){
      var url = $(this).val();
      if(url){
        window.location = url;
      }
      return false;
    });
    current_chapter();
    function current_chapter(){
      var url = window.location.href;
      $('.chon_chapter').find('option[value="'+url+'"]').attr("selected",true);
    }

  </script>

</body>

</html>