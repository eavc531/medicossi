<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Notificación Consulta Médica Cancelada"</h2>

    <p>Un Cordial saludo: {{$patient->name}} {{$patient->lastName}},su Cita estipulada para la fecha {{\Carbon\Carbon::parse($event->start)->format('d-m-Y')}}, Hora:  {{\Carbon\Carbon::parse($event->start)->format('H:i')}} con el Médico: {{$medico->name}}  {{$medico->lastName}} ha sido Cancelada o Rechazada, debido a algunos inconvendientes, disculpe las molestias, Feliz Dia.

</body>
</html>
