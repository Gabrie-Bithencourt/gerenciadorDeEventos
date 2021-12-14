@extends('layouts.main')


@section('title', 'Bithen Events')


@section('content')


<div id="search-container" class="col-md-12">
   <h2>Busque um evento</h2>
   <form action="/" method="GET">
       <input class="form-control" placeholder="Buscar..." type="text" name="search" id="search">
   </form>
</div>

<div id="events-container" class="col-md-15">
    @if($search)
   <h2>Buscando Por: {{ $search }}</h2>
   @else
   <h2>Próximos Eventos:</h2>
   <p>Veja os eventos dos próximos dias</p>
   @endif
   <div id="cards-container" class="row">
       @foreach($events as $event)
       <div class="card col-md-3">
           <img src="/img/events/{{ $event -> image }}" alt="{{ $event -> title }}">
           <div class="card-body">
               <p class="card-date">{{ date('d/m/y', strTotime($event->date)) }}</p>
               <h5 class="card-title">{{ $event->title }}</h5>
               <p class="card-participants">{{ count($event->users) }} Participantes</p>
               <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
           </div>
       </div>
       @endforeach
       @if(count($events) == 0)
       <p>O evento <b>{{ $search }}</b> ainda não existe! <a href="/">Ver eventos</a></p>
       @endif
   </div>
</div>



@endsection
