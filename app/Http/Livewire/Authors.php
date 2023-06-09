<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

class Authors extends Component
{

    use WithPagination;
    public $name, $email, $username, $author_type, $direct_publisher;
    public $search;
    public $perPage = 8;

    protected $listeners = [
        'resetForms'
    ];


    //in order to search the author even not found in the pagination
    public function updatingSearch(){
        $this->resetPage();
    }


    public function resetForms(){             //reset forms when modal is exited
        $this->name = $this->email = $this->username = $this->author_type = $this->direct_publisher = null;
        $this->resetErrorBag();
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

            $default_password = Random::generate(8);

            $author = new User();
            $author->name = $this->name;
            $author->email = $this->email;
            $author->username = $this->username;
            $author->password = Hash::make($default_password);
            $author->type = $this->author_type;
            $author->direct_publish = $this->direct_publisher;
            $saved = $author->save();


            $data = array(
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $default_password,
                'url' => route('author.profile'),
            );


            $author_email = $this->email;
            $author_name = $this->name;


            if($data){

                Mail::send('new-author-email-template', $data, function($message) use ($author_email, $author_name){
                    $message->from('noreply@example.com', 'Larablog');
                    $message->to($author_email, $author_name)
                            ->subject('Account Creation');
                });

                $this->showToastr('New author has been added to blog', 'success');
                $this->name = $this->email = $this->username = $this->author_type = $this->direct_publisher = null;
                $this->dispatchBrowserEvent('hide_add_author_modal');

            } else {
                $this->showToastr('Something went wrong', 'error');
            }



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



    public function render()
    {
        // return view('livewire.authors', ['authors'=>User::all()]);
        return view('livewire.authors', [
            'authors'=>User::search(trim($this->search))
                            ->where('id', '!=', auth()->id())->paginate($this->perPage)
        ]);
    }
}
