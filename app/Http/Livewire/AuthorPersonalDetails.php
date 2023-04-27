<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AuthorPersonalDetails extends Component
{

    public $author;
    public $name, $username, $email, $biography;


    public function mount(){
        $this->author = User::find(auth('web')->id());
        $this->name = $this->author->name;
        $this->username = $this->author->username;
        $this->email = $this->author->email;
        $this->biography = $this->author->biography;
    }

    
    public function UpdateDetails(){
        $this->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users,username,'.$this->author->id
        ]);

        $user = User::find($this->author->id);
        $user->name = $this->name;
        $user->username = $this->username;
        $user->biography = $this->biography;
        $user->save();

        $this->emit('updateAuthorProfileHeader');   //sends to controller livewire updateAuthorProfileHeader to refresh that certain component only.
        $this->emit('updateTopHeader');

        $this->showToastr('Your Profile info have been successfully updated.', 'success');
    }


    public function showToastr($message, $type){
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }


    public function render(){
        return view('livewire.author-personal-details');
    }
}
