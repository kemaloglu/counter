<div class="div">
@if($updateMode)
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
  
  <button type="button"  wire:click='updateContact()' class="btn btn-primary">Guncelle</button>
</form>


    @endif


<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">AD Soyad </th>
      <th scope="col">Email</th>
      <th scope="col">Islem</th>
      
    </tr>
  </thead>
  <tbody>
      @foreach($customers as $customer)
    <tr>
    
        <td scope="row"> {{$customer->id}}</td>
        <td>{{$customer->name}}</td>
        <td>{{$customer->email}}</td>
        <td>
        <a wire:click.prevent="editCustomer({{$customer->id}})" href="#" ><span class="material-symbols-outlined">
edit
</span></i></a>
@if($deleteUser && $customer->id == $deleteUserID)


   <div class="deleteUser">
        <button wire:click='delete({{$customer->id}})'>Evet</button>
        <button wire:click='cancel'>Hayir</button>

   </div>
   @else
        <a wire:click.prevent="destroyCustomer({{$customer->id}})" href="#"><span class="material-symbols-outlined">
delete

</span></a>
@endif
        
      </td>
    </tr>
    @endforeach
  
  </tbody>
</table>



</div>