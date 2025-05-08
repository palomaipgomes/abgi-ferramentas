<?php

namespace App\Http\Livewire\Toolbox;

use App\Models\Ferramenta;
use Livewire\Component;

class Dados extends Component
{
    public $ferramentaId;
    public $nome;
    public $versao;
    public $status = 'Ativo';
    public $path;

    protected $rules = [
        'nome' => 'required|string|max:255',
        'versao' => 'required|string|max:100',
        'status' => 'required|in:Ativo,Inativo',
        'path' => 'required|string|max:255',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->ferramentaId = $id;
            $ferramenta = Ferramenta::findOrFail($id);
            $this->nome = $ferramenta->nome;
            $this->versao = $ferramenta->versao;
            $this->status = $ferramenta->status;
            $this->path = $ferramenta->path;
        }
    }

    public function salvar()
    {
        $this->validate();

        Ferramenta::updateOrCreate(
            ['id' => $this->ferramentaId],
            [
                'nome' => $this->nome,
                'versao' => $this->versao,
                'status' => $this->status,
                'path' => $this->path,
            ]
        );

        session()->flash('sucesso', 'Ferramenta salva com sucesso!');
        return redirect()->to('/ferramentas');
    }

    public function render()
    {
        return view('livewire.toolbox.dados');
    }
}
