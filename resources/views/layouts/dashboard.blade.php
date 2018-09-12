@if(Auth::check() and Auth::user()->hasRole('admin'))
    @include('layouts.dashboard_include.admin')
@elseif(Auth::check() and Auth::user()->role == 'medico')
    @include('layouts.dashboard_include.medico')
<!-- Hasta aqui -->
@elseif(Auth::check() and Auth::user()->role == 'promotor')
    @include('layouts.dashboard_include.promoter')

@elseif(Auth::check() and Auth::user()->role == 'Paciente')
    @include('layouts.dashboard_include.patient')

@elseif(Auth::check() and Auth::user()->role == 'medical_center')
    @include('layouts.dashboard_include.medical_center')
@endif
