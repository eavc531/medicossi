<div class="">
   {{-- alert success la seccion imagenes --}}
  @if(Session::Has('success2'))
      <div class="div-alert" style="padding:20px">
        <div class="alert alert-success alert-dismissible" role="alert" style="">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           {{Session::get('success2')}}
        </div>
      </div>
      @section('scriptJS')
        <script type="text/javascript">


        var new_position = $('#imgs').offset();
        window.scrollTo(new_position.left,new_position.top);

        </script>
      @endsection

   @endif



  @if(Session::Has('danger2'))
     <div class="div-alert" style="padding:20px">
        <div class="alert alert-danger alert-dismissible" role="alert" style="max-width:700px">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           {{Session::get('danger2')}}
        </div>
        </div>

        @section('scriptJS')
          <script type="text/javascript">


          var new_position = $('#imgs').offset();
          window.scrollTo(new_position.left,new_position.top);

          </script>
        @endsection

     @endif

     @if(Session::Has('warning2'))
        <div class="div-alert" style="padding:20px">
           <div class="alert alert-warning alert-dismissible" role="alert" style="max-width:700px">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{Session::get('warning2')}}
           </div>
           </div>
           @section('scriptJS')
             <script type="text/javascript">


             var new_position = $('#imgs').offset();
             window.scrollTo(new_position.left,new_position.top);

             </script>
           @endsection

        @endif

</div>
