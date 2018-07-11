<div class="col-12" style="text-align:center;font-size:27px;color:rgb(125, 120, 120);margin-bottom:20px">
  <div class="">
    {{$medico->type_consulting_room}} {{$medico->name_comercial}}
  </div>
  <div class="" style="text-align:center;font-size:20px;color:rgb(125, 120, 120);margin-bottom:20px">
    {{$medico->state}} - {{$medico->city}} - {{\Carbon\Carbon::parse($expedient->date_start)->format('d/m/Y')}}</p>
  </div>
</div>
