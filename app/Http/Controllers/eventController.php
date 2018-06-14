<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\event;
class eventController extends Controller
{
    public function index(){
      $data = event::get(['title','start','end','color']);

      // return view('fullCalendar.fullCalendar');
       return Response()->json($data);
    }

    public function medico_events(){
      $data = event::get(['title','start','end','color']);

      // return view('fullCalendar.fullCalendar');
       return Response()->json($data);
    }
}
