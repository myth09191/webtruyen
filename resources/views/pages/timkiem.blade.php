@extends('../layout')
      @section('content')
      <!-- Mới Update -->
      <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
    </ol>
</nav>
      <h3>Tìm kiếm: {{$tukhoa}}</h3>
        <div class="album py-5 bg-light">
    <div class="container">
      <div class="row"> 
        @php
          $count = count($truyen);
        @endphp
        @if($count==0)
        <div class="col-md-12">
          <div class="card mb-12 box-shadow">
            <div class="card-body">
          <p>Chưa cập nhật thêm...</p>
            </div>
            </div>
          </div>
        @else 
      @foreach($truyen as $key => $value)     
        <div class="col-md-3">
          <div class="card mb-3 box-shadow">
            <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" data-holder-rendered="true">

            <div class="card-body">
                <h5>{{$value->tentruyen}}</h5>
              <p class="card-text">{{$value->tomtattruyen}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Xem ngay</a>
                  <a class="btn btn-sm btn-outline-secondary"><p><i class="far fa-eye"></i>99999</p></a>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
              </div>
            </div>
            @endforeach
            @endif
          </div>
          <a class="btn btn-success" href="">Xem tất cả</a>
        </div>
      </div>  
        @endsection