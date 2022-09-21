<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Aviso;

class Push extends Component
{
    use WithPagination;

    public $body = "";
    public $editId = 0;
    public $title = "";

    protected $rules = [
        'title' => 'required|min:5|max:255',
        'body' => 'required|min:5|max:255',
    ];

    public function render()
    {
        $avisos = Aviso::paginate(10);
        return view('livewire.push', compact('avisos'))->layout('restrict.avisos');
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
}