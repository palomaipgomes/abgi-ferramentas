<div class="container py-4">
    <h2 class="mb-4">{{ $ferramentaId ? 'Editar' : 'Nova' }} Ferramenta</h2>

    @if (session()->has('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    <form wire:submit.prevent="salvar">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input wire:model.defer="nome" type="text" class="form-control" id="nome">
            @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="versao" class="form-label">Versão</label>
            <input wire:model.defer="versao" type="text" class="form-control" id="versao">
            @error('versao') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select wire:model.defer="status" class="form-control" id="status">
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="path" class="form-label">Path</label>
            <input wire:model.defer="path" type="text" class="form-control" id="path">
            @error('path') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $ferramentaId ? 'Atualizar' : 'Cadastrar' }}
        </button>
    </form>
</div>
