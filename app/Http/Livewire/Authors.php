<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Authors extends Component
{

    public $name, $email, $username, $author_type, $direct_publisher;

    protected $listeners = [
        'resetForms'
    ];

    public function resetForms(){             //reset forms when modal is exited
        $this->name = $this->email = $this->username = $this->author_type = $this->direct_publisher = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        // return view('livewire.authors', ['authors'=>User::all()]);
        return view('livewire.authors', ['authors'=>User::where('id', '!=', auth()->id())->get() ]);
    }

    public function addAuthor(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:6|max:20',
            'author_type' => 'required',
            'direct_publisher' => 'required'
        ],[
            'author_type.required' => 'Choose author type',
            'direct_publisher.required' => 'Specify author publication access'
        ]);


        if($this->isOnline()){
            dd('I am online');
        } else {
            $this->showToastr('You are offline, check your connection and submit form again', 'error');
        }
    }


    public function showToastr($message, $type){
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }


    public function isOnline($site = "https://youtube.com/"){
        if(@fopen($site,"r")){
            return true;
        } else {
            return false;
        }
    }
}
