<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;

class Customers extends Component
{
    public $customers, $name, $email, $selected_id;
    public $updateMode = false;
    public $deleteUser = false;
    public $deleteUserID='';
    

    public function cancel(){
        $this->deleteUser=false;

    }
    public function delete(){
        $customer = Customer::where('id',$this->deleteUserID)->first();
        $customer->delete();

    }

  
    public function updateContact(){
        $customer = Customer::where('id',$this->selected_id)->first();
        $customer->name = $this->name;
        $customer->email = $this->email;
        $customer->save(); 
        session()->flash('message','Kullanici guncellendi');
    }

    public $rules = [
        'name' => 'required',
        'email' => 'required|email'
    ];
    public $messages = [
        'name.required' => 'Bu alani doldurmak zorundasiniz.',
        'email.required' => 'Bu alani doldurmak zorundasiniz.',
        'email.email' => 'Gecerli bir mail adresi giriniz.'

    ];
    protected $listeners=['renderpage'=>'render' , 'refresh-me'=>'$refresh'];
    public function render()
    {
        $this->customers = Customer ::all();

        return view('livewire.customers');
    }
    public function addContact(){
        $this->validate();
        $new = Customer::create(['name'=>'name','email'=>'email']);
        $new->name = $this->name;
        $new->email = $this->email;
        $new->save();
        $this->emitself('refresh-me');

        session()->flash('message','Kullanici kaydedildi');
    }
    public function editCustomer($id){
        if ($id){
            $customer = Customer::where('id',$id)->first();
            $this->name = $customer->name;
            $this->email = $customer->email;
            $this->selected_id = $customer->id;
            $this->updateMode = !$this->updateMode;
            $this->emit(event:'updateFunction');
        }
    }
    public function destroyCustomer($id){
     
            $this->deleteUserID=$id;
            $this->deleteUser=true;

    }
}
