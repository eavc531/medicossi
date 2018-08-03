<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Notificación Cita Agendad por Paciente a travez de Médicossi"</h2>

    <p>Un Cordial saludo: {{$medico->nameComplete}}, un usario de la plataforma Médicossi: {{$patient->nameComplete}}, con numero de identificaión: {{$patient->identification}}, ha solicitado una cita con usted para la fecha: {{\Carbon\Carbon::parse($event->start)->format('d-m-Y H:i')}}

    <p>Cita estipulada el dia: {{\Carbon\Carbon::now()->format('d-m-Y')}}</p>
    <p>Para Mayor información y confirmarle la realización de la cita, ingrese a su cuenta Médicossi, y verifique en el panel Citas (sin confirmar)</p>

    <p>Feliz Dia</p>
</body>
</html>
