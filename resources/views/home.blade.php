@extends('layout.master', ['title' => 'Home', 'description' => 'Welcome to world class pet shop.', 'image' => ''])

@section('content')
<div class="container">
   <div class="row">
      @foreach(json_decode($cats['response']) as $index => $cat)
         @if($index % 4 == 0)
            </div>
            <div class="row">
         @endif
         <div class="col-md-3 mb-4">
            <div class="card rounded-0">
               @if(isset($cat->image->url))
                  <img src="{{ $cat->image->url }}" alt="{{ $cat->name }}" />
               @else
                  <img src="{{ asset('images/cat-default.jpg') }}" alt="{{ $cat->name }}" />
               @endif
               <div class="card-body">
                  <h5 class="card-title">{{ mb_strimwidth($cat->name, 0, 23, '...') }}</h5>
                  <p class="card-text">
                     {{ mb_strimwidth($cat->description, 0, 50, '...') }}
                  </p>
                  <a href="{{ route('getCat', urlencode(strtolower($cat->name))) }}" class="btn btn-primary btn-peugeot-blue rounded-0">READ MORE</a>
               </div>
            </div>
         </div>
      @endforeach
   </div>
   <div class="row">
      @foreach(json_decode($dogs['response']) as $index => $dog)
         @if($index % 4 == 0)
            </div>
            <div class="row">
         @endif
         <div class="col-md-3 mb-4">
            <div class="card rounded-0">
               @if(isset($dog->image->url))
                  <img src="{{ $dog->image->url }}" alt="{{ $dog->name }}" />
               @else
                  <img src="{{ asset('images/dog-default.jpg') }}" alt="{{ $dog->name }}" />
               @endif
               <div class="card-body">
                  <h5 class="card-title">{{ mb_strimwidth($dog->name, 0, 23, '...') }}</h5>
                  <p class="card-text">
                     {{ mb_strimwidth($dog->temperament, 0, 50, '...') }}
                  </p>
                  <a href="{{ route('getDog', urlencode(strtolower($dog->name))) }}" class="btn btn-primary btn-peugeot-blue rounded-0">READ MORE</a>
               </div>
            </div>
         </div>
      @endforeach
   </div>
</div>
@endsection