@extends('layouts.main')


@section('title', 'Meus Eventos')


@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">

 @if(count($event) > 0)
  
   <table class="table">
     <thead>
       <tr>
       <th scope="col">Id</th>
       <th scope="col">Evento</th>
       <th scope="col">Participantes</th>
       <th scope="col">Acões</th>
       </tr>
     </thead>
     

   <tbody>
     @foreach($event as $events)
     <tr>
       <td scropt="row">{{ $loop->index +1 }}</td>
       <td><a href="/events/{{ $events->id }}">{{ $events->title }}</a></td>
       <td>{{ count($events->users) }}</td>
       <td><a href="/events/edit/{{ $events->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a>
          <form action="/events/{{ $events->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Deletar</button>
          </form>
      </td>
       
     </tr>
     @endforeach
   </tbody>
   </table>
  </div>




  <div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Participando de:</h1>
  </div> 

    <div class="col-md-10 offset-md-1 dashboard-events-container">
      @if(count($events_as_participant) > 0)
     
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Evento</th>
            <th>Participantes</th>
            <th>Ação</th>
          
          </tr>
        </thead>
        <tbody>
          @foreach ($events_as_participant as $event)
          <tr>
          <td scropt="row">{{ $loop->index +1 }}</td>
          <td scope="col"><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
          <td scope="col">{{ count($event->users) }}</td>
          <td scope="col">

              <form action="/events/leave/{{ $event->id }}" method="POST">
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Sair do Evento</button>
              </form>
             

          </td>
        </tr> 
          
        @endforeach
        </tbody>
      </table>
    </div>

      @else
      <p>Você não está participando de nenhum evento!!! <a href="/">Veja Todos Os Eventos</a></p>
      @endif
  


 @else
 <p>Você ainda não tem eventos</p>
 @endif






@endsection