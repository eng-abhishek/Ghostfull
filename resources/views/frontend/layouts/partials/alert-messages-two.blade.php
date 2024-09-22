   @if (session('status'))
   @if(session('class'))
   <div class="alert alert-{{session('class')}}" role="alert">
    {{ session('status') }}
</div>
@else
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
@endif