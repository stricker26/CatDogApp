@extends('layout.master', ['title' => 'Dogs List', 'description' => 'Dogs List', 'image' => '', 'className' => 'dogs'])

@section('content')
<div class="container">
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
                     {{ isset($dog->temperament) ? mb_strimwidth($dog->temperament, 0, 50, '...') : 'No description available' }}
                  </p>
                  <a href="{{ route('getDog', urlencode(strtolower($dog->name))) }}" class="btn btn-primary btn-peugeot-blue rounded-0">READ MORE</a>
               </div>
            </div>
         </div>
      @endforeach
   </div>
   <div class="row">
      <div class="col">
         <ul class="pagination">
            <li class="page-item {{ !app('request')->input('page') || app('request')->input('page') == 1 ? 'disabled' : '' }}">
               <a class="page-link" href="?page={{ !app('request')->input('page') || app('request')->input('page') == 1 ? 1 : app('request')->input('page') - 1 }}">Previous</a>
            </li>
            <li class="page-item {{ count(json_decode($dogs['response'])) < 7 ? 'disabled' : '' }}">
               <a class="page-link" href="?page={{ !app('request')->input('page') || app('request')->input('page') == 1 ? 2 : app('request')->input('page') + 1 }}">Next</a>
            </li>
         </ul>
      </div>
   </div>
</div>
@endsection