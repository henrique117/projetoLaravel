<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Aviso;
use App\Models\User;
use App\Models\AvisoUser;

class Push extends Component
{
    use WithPagination;

    public $body = "";
    public $editId = 0;
    public $title = "";

    public $userId = [];
    public $avisoId = [];
    public $avisoUserMessage = '';

    protected $rules = [
        'title' => 'required|min:5|max:255',
        'body' => 'required|min:5|max:255',
    ];

    public function render()
    {
        $avisoUsers = AvisoUser::all();
        foreach ($avisoUsers as $avisoUser) {
            array_push($this->userId, $avisoUser->user_id);
            array_push($this->avisoId, $avisoUser->aviso_id);
        }
        $this->userId = array_unique($this->userId);
        $this->avisoId = array_unique($this->avisoId);
        $users = User::whereNotNull('token')->paginate(10);
        $avisos = Aviso::paginate(10);
        return view('livewire.push', compact('avisos', 'users'))->layout('restrict.avisos');
    }

    public function store()
    {
        $this->validate();

        if($this->editId == 0) {
            $aviso = new Aviso();
        } else {
            $aviso = Aviso::findOrFail($this->editId);
        }
        $aviso->title = $this->title;
        $aviso->body = $this->body;
        $aviso->save();

        $this->limpar();
    }

    public function edit(Aviso $aviso)
    {
        $this->title = $aviso->title;
        $this->body = $aviso->body;
        $this->editId = $aviso->id;
    }

    public function limpar()
    {
        $this->title = '';
        $this->body = '';
        $this->editId = 0;
    }

    public function destroy(Aviso $aviso)
    {
        $aviso->delete();
    }

    public function avisoUser(){
        if (count($this->avisoId) > 0 && count($this->userId) >0){
            $status = false;
            foreach ($this->avisoId as $aviso){
                foreach ($this->userId as $user){
                    $avisoUser = avisoUser::where('aviso_id', $aviso)
                    ->where('user_id', $user)->get();
                    if (count($avisoUser) === 0){
                        $avisoMessageUser = new AvisoUser();
                        $avisoMessageUser->aviso_id = $aviso;
                        $avisoMessageUser->user_id = $user;
                        $avisoMessageUser->save();
                        $status = true;
                    }
                }    
            }
            if (!$status) {
                $this->avisoUserMessage = "Nenhuma mensagem enviada!!!";
            }else{
                $this->avisoUserMessage = "Mensagem enviada com sucesso!!!";
                $this->avisoId = [];
                $this->userId = [];
            }
        } else {
            $this->avisoUserMessage = "Marque ao menos uma mensagem e um usuário!!!";
        }
    }
}