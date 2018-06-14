@extends('layouts.app')

@section('content')
   <div class="white-space:nowrap;">
         <div style="display:inline-block;border:1px black solid">Paso 1</div>
         <div style="display:inline-block;border:1px black solid;background:blue;color:white;">Paso 2</div>
   </div>

   <h2>¡Muchas Felicidades!</h2>
   <p>Ya eres un miembro de de la mejor red de medicos y profesionales de la salud <span style="color:red">solo falta que ingreses a tu cuenta de correo para que actives tu cuenta</span></p>

   <p>¿No has resibido el Correo de Confirmación?,puedes intentar reenviarlo</p>



   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalresendMailConfirm">
  Reenviar Correo de Confirmación
   </button>


   <a href="{{route('home')}}" class="btn btn-secondary"> volver a home</a>



@include('users.modalresendMailConfirm')
@endsection
