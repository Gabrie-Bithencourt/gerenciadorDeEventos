<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;


     // Transforma uma varíavel em array e manda pro banco //
     protected $casts = [
         'items' => 'array'
        ];

      protected $date = ['date'];  


      // --Possibilita atualizar Tudo!! //
      protected $guarded = [];

      
      // exclarece a quem pertence o event (Dono do evento) //
      public function user(){
         return $this->belongsTo('App\Models\User');
      }

      
      // Pro evento ter MUITOS USUÁRIOS (Presença confirmada no EVENTO) //

      public function users(){
        return $this->belongsToMany('App\Models\User');

      }

}
