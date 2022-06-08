<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;


class AddCustomer extends Component
{
    protected $listeners=['updateFunction'=>'updateFunction'];
    public function render()
    {
        return view('livewire.add-customer');
    }
    public $customers, $name, $email;
    public $updateMode = false;
    public $selected_id;
    
    public $rules = [
        'name' => 'required',
        'email' => 'required|email'
    ];
    public $messages = [
        'name.required' => 'Bu alani doldurmak zorundasiniz.',
        'email.required' => 'Bu alani doldurmak zorundasiniz.',
        'email.email' => 'Gecerli bir mail adresi giriniz.'

    ];

    public function addContact(){

        $this->validate();
        $new = Customer::create(['name'=>'name','email'=>'email']);
        $new->name = $this->name;
        $new->email = $this->email;
        $new->save();
        $this->emitself('refresh-me');
        session()->flash('message','Kullanici kaydedildi');
        return redirect()->to('');
    }
    public function editCustomer($id){
        if($id){
            $customer = Customer::where('id',$id)->first();
            $this->name = $customer->name;
            $this->email = $customer->email; 
            $this->updateMode = true;
            $this->selected_id = $customer->id;
        }
    }
    public function updateContact(){
        $customer = Customer::where('id',$this->selected_id)->first();
        $customer->name = $this->name;
        $customer->email = $this->email;
        $customer->save(); 
        session()->flash('message','Kullanici guncellendi');

    }
    public function updateFunction(){
        $this->updateMode = !$this->updateMode;
    }

    public function destroyCustomer($id){
        $customer = Customer::where('id',$id)->first();
        $customer->delete();

    }
}
