<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>Cita MédicosSi Confirmada</h2>

    <p>Un Cordial saludo: {{$patient->name}} {{$patient->lastName}}, la cita que solicito con el Médico: {{$medico->name}} {{$medico->lastName}}, Especialista en: {{$medico->specialty}}, estipulada para la fecha: {{\Carbon\Carbon::parse($event->start)->format('d-m-Y')}}, Hora:{{\Carbon\Carbon::parse($event->start)->format('H:i')}}. a sido confirmada, para mayor información puede comunicarse con el Médico enviando un mensaje a su correo: {{$medico->email}}</p>
    <p>Feliz Dia</p>


</body>
</html>
