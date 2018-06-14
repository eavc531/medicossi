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

    <p>Un Cordial saludo: {{$patient->name}} {{$patient->lastName}}, usted Agendo una Cita con el Médico: {{$medico->name}} {{$medico->lastName}}, Especialista en: {{$medico->specialty}}, estipulada para la fecha: {{\Carbon\Carbon::parse($event->start)->format('d-m-Y')}}, Hora:{{\Carbon\Carbon::parse($event->start)->format('H:i')}}.
      <p>Pronto resivira un correo de confirmación, en cuanto el Médico: {{$medico->name}} {{$medico->lastName}} verifique su disponibilidad,y confirme la misma. Feliz Día.</p>

</body>
</html>
