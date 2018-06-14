@extends('layouts.app')

@section('content')
<section class="box-register">
<div class="container">
	<div class="register">
		<div class="row">
			<div class="col-12 mb-5">
				<h2 class="text-center font-title">profesionales de la Salud</h2>
			</div>
		</div>
		<div class="row">
			<table class="table table-responsive table-config">
				<tbody>
          <tr>
            <th scope="row">Nombre de la Institucion:</th>
            <td class="text-center">$info->institution</td>
          <tr>
          <tr>
            <th scope="row">Nombre de la Institucion:</th>
            <td class="text-center">$info->specialty</td>
          <tr>
          <tr>
            <th scope="row">Nombre de la Institucion:</th>
            <td class="text-center">$info->from</td>
          <tr>
            <tr>
              <th scope="row">Nombre de la Institucion:</th>
              <td class="text-center">$info->until</td>
            <tr>
            <tr>
              <th scope="row">Nombre de la Institucion:</th>
              <td class="text-center">$info->aditional</td>
            <tr>
				</tbody>
			</table>
		</div>

    {{-- <a href="{{route('info_medico.edit')}}">Editar</a> --}}
	</div>
</div>
</section>


@endsection
