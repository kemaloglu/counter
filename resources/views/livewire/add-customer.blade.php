<div class="div">

@if (session()->has('mesaage'))
<div class="alert alert-success">
    {{session('message')}}
    </div>
@endif
    
    @if($updateMode)
  
</form>


    @else
    <form>
  <div class="form-group">
    <label for="InputName">Ad Soyad</label>
    <input wire:model="name" type="text" class="form-control" id="InputName"  placeholder="Ad Soyad giriniz">
    @error('name')
     <div class="text-danger">{{$message}}</div>
    @enderror
</div>
  <div class="form-group">
    <label for="InputEmail">Email</label>
    <input wire:model="email" type="email" class="form-control" id="InputEmail" placeholder="Email">
    @error('email')
    <div class="text-danger"> {{$message}}</div>
    @enderror
</div>
  
  <button type="button"  wire:click='addContact' class="btn btn-primary">Ekle</button>
</form>

    @endif
</div>    

</div>