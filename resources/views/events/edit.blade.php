@extends('layouts.main')

@section('title', 'Editando: '. $event->title)

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $event->title }}</h1>
    <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
     @csrf
     @method('PUT')
     <div class="form-group">
         <label for="image">Foto do evento:</label>
         <input type="file" id="image" name="image" class="from-control-file">
         <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
     </div>

     <div class="form-group">
         <label for="title">Evento:</label>
         <input placeholder="Nome do evento" type="text" class="form-control" id="title" name="title" value="{{ $event->title }}">
     </div>
     <div class="form-group">
         <label for="date">Data do evento:</label>
         <input placeholder="Data do evento"  class="form-control" id="date" name="date" value="{{ date('d-m-y', strtotime($event->date)) }}">
     </div>

     <div class="form-group">
         <label for="title">Cidade:</label>
         <input placeholder="Nome do evento" type="text" class="form-control" id="city" name="city" value="{{ $event->city }}"> 
     </div>

     <div class="form-group">
         <label for="title">O evento é privado?</label>
         <select name="private" id="private" class="form-control">
             <option value="0">Não</option>
             <option value="1" {{ $event->private == 1 ? "selected='selected'":"" }}>Sim</option>
         </select>
     </div>

     <div class="form-group">
         <label for="description">Descrição:</label>
         <textarea placeholder="O que vai acontecer no eventos" name="description" id="description"  class="form-control" >{{ $event->description }}</textarea>
     </div>
     <div class="form-group">
         <label for="title">Dados Da Infraestrutura:</label>
         <div class="form-group">
             <input type="checkbox" name="items[]" value="cadeiras">Cadeiras
            </div>
            <div class="form-group">
             <input type="checkbox" name="items[]" value="palco">Palco
            </div>
            <div class="form-group">
             <input type="checkbox" name="items[]" value="bebida">Bebidas Grátis
            </div>
            <div class="form-group">
             <input type="checkbox" name="items[]" value="brinde">Brinde
            </div>
     </div>
     <input type="submit" class="btn btn-primary" value="Atualizar Evento">
    </form>
</div>



@endsection