<?php

namespace App\Http\Livewire\Toolbox;

use App\Models\Ferramenta;
use Livewire\Component;
use Livewire\WithPagination;

class Lista extends Component
{
    use WithPagination;

    public $busca = '';
    public $status = '';

    protected $paginationTheme = 'bootstrap';

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
        $ferramentas = Ferramenta::query()
            ->when($this->busca, fn ($query) =>
                $query->where('nome', 'like', '%' . $this->busca . '%')
            )
            ->when($this->status, fn ($query) =>
                $query->where('status', $this->status)
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.toolbox.lista', [
            'ferramentas' => $ferramentas
        ]);
    }
}
