@extends('template')
@section('content')
<div class="jumbotron mt-3">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/2.jpg" alt="Second slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</div>

<div class="jumbotron">
  <h3>Produk Terbaru</h3>
    <div class="owl-carousel owl-theme text-center">
      

      @foreach ($datas as $student)
        <div class="item">
            <div class="card">
                <img src="{{asset('img/icon-image.jpg')}}"  alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title">{{ $student->name }}</h5>
                <h6 class="card-subtitletext-muted">Rp. {{ $student->quantity }}</h6>
                {{-- <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a> --}}
                </div>
            </div>


            {{-- <div class="card">
                <div> Your Content </div>
            </div> --}}


        </div>
        
        @endforeach
      </div>
</div>


@endsection