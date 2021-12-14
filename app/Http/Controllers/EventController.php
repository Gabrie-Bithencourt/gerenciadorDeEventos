<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Events;
use App\Models\User;


class EventController extends Controller
{

  // PESQUISAR //
    public function index(){

        $search = request('search');

        if ($search) {
            
            $events = Events::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        } else {
            $events = Events::all();
        }



        return view('welcome', ['events' => $events, 'search' => $search]);

    }


    public function create(){
        return view('/events/create');

    }
  

    // Upload no BANCO DE DADOS  --store add no BANCO//
     public function store(Request $request){
        
         $event = new Events;

         $event->title = $request->title;
         $event->date = $request->date;
         $event->city = $request->city;
         $event->private = $request->private;
         $event->description = $request->description;
         $event->items = $request->items;


         /* UPLOAD DA IMAGEM */
         if($request->hasFile('image') && $request->file('image')->isValid()) {
           
            $requestImage = $request->image;

            $extension =  $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }


           /* Verificar se o usuario esta logado e passa o id dele pra variável $user_id  */
           /*  Tornando possível identificar os eventos do usuario no MODEL/USER E MODEL/EVENTS */

             $user = auth()->user();
             $event->user_id = $user->id;

             $event->save();
        
        /* WITH É UM CAIXA DE ALERTA */

             return redirect('/')->with('msg', 'Evento cadastrado com sucesso!!!'); 
  
    }



   
   // Mostrar as informações do evento(id) - Name - city - private... // 
    public function show($id){

    $event = Events::findOrFail($id);

    $user = auth()->user();
    $hasUserJoined = false;

    if($user) {
        
      $userEvents = $user->eventsAsParticipant->toArray();

      foreach($userEvents as $user_Event){
         if ($user_Event['id'] == $id) {
             $hasUserJoined = true;
         }

      }

    }

    $eventOwner = User::where('id', $event->user_id)->first()->toArray();



    return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
        
    }


   
    // dashboard LISTA DE EVENTOS DO USUARIO //
    public function dashboard(){
     
    $user = auth()->user();

    $event = $user->events;

    $events_as_participant = $user->eventsAsParticipant;

     return view('events.dashboard', ['event' => $event , 'events_as_participant'=> $events_as_participant]);

   }


   // entrando no CRUD - |Delete| pra passar o método é só ->método = ->delete,  auth(), save() //
   // Crud = ->delete(), ->update()

   public function destroy($id){
     
    Events::findOrFail($id)->delete();

    return redirect('/dashboard')->with('msg', 'Evento Excluido Com Sucesso');

   }


    
   // EDITANDO os dados do EVENTO = (update) //

   public function edit($id){


     $event = Events::findOrFail($id);

     $user = auth()->user();
   
     /* Validação pra que só o DONO DO EVENTO possa edita-lo!!! */

     if ($user->id != $event->user_id) {
         return redirect('/dashboard');
     }
  /* ================================================ */

     return view('events.edit', ['event' => $event]);

   }
   


   /* ATUALIZANDO DADOS DO BANCO!!! */
    
   public function update(request $request){

     $data = $request->all();

     /* ------------------------------- */

      /* UPLOAD DA IMAGEM */
      if($request->hasFile('image') && $request->file('image')->isValid()) {
           
        $requestImage = $request->image;

        $extension =  $requestImage->extension();

        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
        
        $requestImage->move(public_path('img/events'), $imageName);

        $data['image'] = $imageName;
    }

      Events::findOrFail($request->id)->update($data);

      return redirect('/dashboard')->with('msg', 'Evento editado com Sucesso');

   }

    /* ------------------------------- */



   public function joinEvent($id){

    $user = auth()->user();

    $user->eventsAsParticipant()->attach($id);

    $event = Events::findOrFail($id);

    return redirect('/dashboard')->with('msg', 'Sua Presença Está Confirmada No evento: '. $event->title);

   }

   /* =============================================== */


   /* SAIR DO EVENTO (Cancelar presença) */

   public function leaveEvent($id){

    $user = auth()->user();

    $user->eventsAsParticipant()->detach($id);

    $event = Events::findOrFail($id);

    return redirect('/dashboard')->with('msg', 'Você Saiu Do Evento: '.$event->title);

   }


     
  }