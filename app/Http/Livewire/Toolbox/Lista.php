<?php

namespace App\Http\Livewire\Toolbox;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ferramenta;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function exportarCsv()
    {
        $nomeArquivo = 'ferramentas_export_' . date('Y-m-d_H-i-s') . '.csv';

        return new StreamedResponse(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Nome', 'Versão', 'Status', 'Path', 'Criado em']);

            $query = Ferramenta::query();

            if ($this->busca) {
                $query->where('nome', 'like', '%' . $this->busca . '%');
            }

            if ($this->status) {
                $query->where('status', $this->status);
            }

            $query->orderBy('nome')->chunk(200, function ($ferramentas) use ($handle) {
                foreach ($ferramentas as $f) {
                    fputcsv($handle, [
                        $f->id,
                        $f->nome,
                        $f->versao,
                        $f->status,
                        $f->path,
                        $f->created_at->format('Y-m-d H:i'),
                    ]);
                }
            });

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$nomeArquivo\"",
        ]);
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
            'ferramentas' => $query->orderBy('nome')->paginate(10),
        ]);
    }
}
