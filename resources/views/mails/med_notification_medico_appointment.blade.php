<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Notificación de Nueva Cita Medicossi"</h2>

    <p>Un Cordial saludo: {{$medico->name}} {{$medico->lastName}}, usted Agendo una Cita con el Paciente: {{$patient->name}} {{$patient->lastName}}, estipulada para la fecha: {{\Carbon\Carbon::parse($event->start)->format('d-m-Y')}}, Hora:{{\Carbon\Carbon::parse($event->start)->format('H:i')}}.Para mayor Informacion puede ingresar a su cuenta de MedicosSi, Feliz Dia.

</body>
</html>
