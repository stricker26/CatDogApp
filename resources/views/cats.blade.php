@extends('layout.master', ['title' => 'Cat List', 'description' => 'Cats List', 'image' => '', 'className' => 'cats'])

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
      <div class="col">
         <ul class="pagination">
            <li class="page-item {{ !app('request')->input('page') || app('request')->input('page') == 1 ? 'disabled' : '' }}">
               <a class="page-link" href="?page={{ !app('request')->input('page') || app('request')->input('page') == 1 ? 1 : app('request')->input('page') - 1 }}">Previous</a>
            </li>
            <li class="page-item {{ count(json_decode($cats['response'])) < 7 ? 'disabled' : '' }}">
               <a class="page-link" href="?page={{ !app('request')->input('page') || app('request')->input('page') == 1 ? 2 : app('request')->input('page') + 1 }}">Next</a>
            </li>
         </ul>
      </div>
   </div>
</div>
@endsection