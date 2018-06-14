<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Recordatorio de Cita Médicossi"</h2>

    <p>Un Cordial saludo: {{$event->patient->name}} {{$event->patient->lastName}}, le recordamos que usted tiene una cita pendiente con el Médico: {{$event->medico->name}} {{$event->medico->lastName}}, Especialista en: {{$event->medico->specialty}}, estipulada para Dia de Mañana, fecha: {{\Carbon\Carbon::parse($event->start)->format('d-m-Y')}}, Hora:{{\Carbon\Carbon::parse($event->start)->format('H:i')}}. </p>

    <p>Feliz Día</p>

</body>
</html>
