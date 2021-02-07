<div>
    <div {{$attributes->merge(['class'=>"alert alert-$tipo alert-dismissible fade show"])}} role="alert">
        <strong>{{$title}}</strong> {{$slot}} {{$attributes['signo']}} {{$attributes['caracter']}} {{$txt()}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
</div>