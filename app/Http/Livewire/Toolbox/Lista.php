<?php

namespace App\Http\Livewire\Toolbox;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ferramenta;

class Lista extends Component
{
    use WithPagination;

    public $busca = '';
    public $status = '';
    public $ferramentaId;
    public $nome;
    public $versao;
    public $path;
    public $modalAberto = false;
    public $confirmandoExclusao = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nome' => 'required|string|max:255',
        'versao' => 'required|string|max:50',
        'status' => 'required|in:Ativo,Inativo',
        'path' => 'required|string|max:255',
    ];

    public function abrirModal()
    {
        $this->reset(['ferramentaId', 'nome', 'versao', 'status', 'path']);
        $this->status = 'Ativo';
        $this->modalAberto = true;
    }

    public function editar($id)
    {
        $f = Ferramenta::findOrFail($id);
        $this->ferramentaId = $f->id;
        $this->nome = $f->nome;
        $this->versao = $f->versao;
        $this->status = $f->status;
        $this->path = $f->path;
        $this->modalAberto = true;
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
                'path' => $this->path
            ]
        );

        session()->flash('sucesso', $this->ferramentaId ? 'Ferramenta atualizada com sucesso!' : 'Ferramenta criada com sucesso!');
        $this->modalAberto = false;
        $this->reset(['ferramentaId', 'nome', 'versao', 'status', 'path']);
    }

    public function confirmarExclusao($id)
    {
        $this->confirmandoExclusao = $id;
    }

    public function excluir($id)
    {
        Ferramenta::destroy($id);
        session()->flash('sucesso', 'Ferramenta excluída com sucesso!');
        $this->confirmandoExclusao = false;
    }

    public function atualizarStatus($id)
    {
        $f = Ferramenta::findOrFail($id);
        $f->status = $f->status === 'Ativo' ? 'Inativo' : 'Ativo';
        $f->save();
    }

    public function updatingBusca()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Ferramenta::query();

        if ($this->busca) {
            $query->where('nome', 'like', '%' . $this->busca . '%');
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return view('livewire.toolbox.lista', [
            'ferramentas' => $query->orderBy('nome')->paginate(5),
        ]);
    }
}
