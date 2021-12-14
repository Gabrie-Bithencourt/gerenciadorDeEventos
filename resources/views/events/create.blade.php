@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
     @csrf
     <div class="form-group">
         <label for="image">Foto do evento:</label>
         <input type="file" id="image" name="image" class="from-control-file">
     </div>

     <div class="form-group">
         <label for="title">Evento:</label>
         <input placeholder="Nome do evento" type="text" class="form-control" id="title" name="title">
     </div>
     <div class="form-group">
         <label for="date">Data do evento:</label>
         <input placeholder="Data do evento" type="date" class="form-control" id="date" name="date">
     </div>

     <div class="form-group">
         <label for="title">Cidade:</label>
         <input placeholder="Nome do evento" type="text" class="form-control" id="city" name="city">
     </div>

     <div class="form-group">
         <label for="title">O evento é privado?</label>
         <select name="private" id="private" class="form-control">
             <option value="0">Não</option>
             <option value="1">Sim</option>
         </select>
     </div>

     <div class="form-group">
         <label for="description">Descrição:</label>
         <textarea placeholder="O que vai acontecer no eventos" name="description" id="description" class="form-control"></textarea>
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
     <input type="submit" class="btn btn-primary" value="Criar evento">
    </form>
</div>



@endsection