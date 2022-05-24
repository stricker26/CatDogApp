@extends('layout.master', ['title' =>  $pet[0]->name, 'description' => $pet[0]->name, 'image' => $petImage, 'className' => ''])

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-6">
         <img src="{{ $petImage }}" alt="{{ $pet[0]->name }}" class="w-100" />
      </div>
      <div class="col-md-6">
         <h3>{{ $pet[0]->name }}</h3>
         @if($is_dog)
            <label class="d-block"><strong>Bred For:</strong> {{ isset($pet[0]->bred_for) ? $pet[0]->bred_for : '' }}</label>
            <label class="d-block"><strong>Bred Group:</strong> {{ isset($pet[0]->breed_group) ? $pet[0]->breed_group : '' }}</label>
            <label class="d-block"><strong>Life Span:</strong> {{ isset($pet[0]->life_span) ? $pet[0]->life_span : '' }} Years</label>
            <label class="d-block"><strong>Height (Metric):</strong> {{ isset($pet[0]->height->metric) ? $pet[0]->height->metric : '' }}</label>
            <label class="d-block"><strong>Weight (Metric):</strong> {{ isset($pet[0]->weight->metric) ? $pet[0]->weight->metric : '' }}</label>
         @else
            <label class="d-block"><strong>Origin:</strong> {{ $pet[0]->origin }}</label>
            <label class="d-block"><strong>Temperament:</strong> {{ $pet[0]->temperament }}</label>
            <label class="d-block"><strong>Life Span:</strong> {{ $pet[0]->life_span }} Years</label>
            <label class="d-block"><strong>Adaptability:</strong></label>
            <div class="progress mb-2">
               <div class="progress-bar" role="progressbar" style="width: {{ ($pet[0]->adaptability * 10) }}%" aria-valuenow="{{ $pet[0]->adaptability }}" aria-valuemin="0" aria-valuemax="10"></div>
            </div>
            <label class="d-block"><strong>Child Friendly:</strong></label>
            <div class="progress mb-2">
               <div class="progress-bar" role="progressbar" style="width: {{ ($pet[0]->child_friendly * 10) }}%" aria-valuenow="{{ $pet[0]->child_friendly }}" aria-valuemin="0" aria-valuemax="10"></div>
            </div>
            <label class="d-block"><strong>Dog Friendly:</strong></label>
            <div class="progress mb-2">
               <div class="progress-bar" role="progressbar" style="width: {{ ($pet[0]->dog_friendly * 10) }}%" aria-valuenow="{{ $pet[0]->dog_friendly }}" aria-valuemin="0" aria-valuemax="10"></div>
            </div>
            <label class="d-block"><strong>Intelligence:</strong></label>
            <div class="progress mb-2">
               <div class="progress-bar" role="progressbar" style="width: {{ ($pet[0]->intelligence * 10) }}%" aria-valuenow="{{ $pet[0]->intelligence }}" aria-valuemin="0" aria-valuemax="10"></div>
            </div>
         @endif
      </div>
   </div>
   <div class="row pt-3">
      <div class="col">
         <p>{{ $is_dog ? $pet[0]->temperament : $pet[0]->description }}</p>
      </div>
   </div>
</div>
@endsection