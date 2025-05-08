<div class="container py-4">
    <h2 class="mb-4">Lista de Ferramentas</h2>

    <div class="row mb-3">
        <div class="col-md-6">
            <input wire:model.debounce.500ms="busca" type="text" class="form-control" placeholder="Buscar por nome...">
        </div>
        <div class="col-md-4">
            <select wire:model="status" class="form-control">
                <option value="">Todos os status</option>
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
            </select>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Versão</th>
                <th>Status</th>
                <th>Path</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ferramentas as $ferramenta)
                <tr>
                    <td>{{ $ferramenta->nome }}</td>
                    <td>{{ $ferramenta->versao }}</td>
                    <td>
                        <span class="badge bg-{{ $ferramenta->status == 'Ativo' ? 'success' : 'secondary' }}">
                            {{ $ferramenta->status }}
                        </span>
                    </td>
                    <td>{{ $ferramenta->path }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhuma ferramenta encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $ferramentas->links() }}
</div>
