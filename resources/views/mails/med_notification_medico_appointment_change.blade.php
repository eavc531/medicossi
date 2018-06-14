<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Notificación Cambio de Fecha de Cita MédicosSi"</h2>

    <p>Un Cordial saludo: {{$medico->name}} {{$medico->lastName}}, se ha cambiado la fecha de la cita con el paciente: {{$patient->name}} {{$patient->lastName}}, estipulada para la fecha:{{$before_date}}, a la Nueva Fecha: {{\Carbon\Carbon::parse($event->start)->format('d-m-Y')}}, Hora:{{\Carbon\Carbon::parse($event->start)->format('H:i')}}.Feliz Dia.

</body>
</html>
