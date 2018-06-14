
@if(Session::Has('success'))
    <div class="div-alert" style="padding:20px">
      <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         {{Session::get('success')}}
      </div>
    </div>

   @endif

   @if(Session::Has('warning'))
      <div class="div-alert" style="padding:20px">
         <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('warning')}}
         </div>
         </div>
      @endif

   @if(Session::Has('danger'))
      <div class="div-alert" style="padding:20px">
         <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('danger')}}
         </div>
         </div>
      @endif

   @if (count($errors) > 0)
     <div class="div-alert" style="padding:20px">
         <div class="alert alert-warning">
             <button type="button" name="button" class="close" data-dismiss="alert">
                &times;
             </button>
             <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
             </ul>
         </div>
</div>
  @endif

  <div id="alert-success" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
     <strong>ERROR: </strong><span id="text-error-e"></span>
 </div>

 <div id="msg-success" class="alert alert-success alert-dismissible" role="alert" style="display:none;" >
    <button type="button" name="button" class="close" onclick="cerrar()">
      &times;
   </button>
    <span id="msg-send">dfdfs</span>
</div>

<div id="msg-success2" class="alert" role="alert" style="display:none;color:white;background:rgb(12, 80, 182);">
   <button type="button" name="button" class="close" onclick="cerrar()">
     &times;
  </button>
   <span id="msg-send2">dfdfs</span>
</div>
