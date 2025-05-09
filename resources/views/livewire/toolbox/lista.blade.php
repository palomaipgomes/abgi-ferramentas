<div>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Ferramentas</h2>
            <button wire:click="abrirModal" class="btn btn-success">+ Nova Ferramenta</button>
        </div>

        @if (session()->has('sucesso'))
            <div class="alert alert-success">
                {{ session('sucesso') }}
            </div>
        @endif

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
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ferramentas as $f)
                    <tr>
                        <td>{{ $f->nome }}</td>
                        <td>{{ $f->versao }}</td>
                        <td>
                            <span class="badge bg-{{ $f->status == 'Ativo' ? 'success' : 'secondary' }}">
                                {{ $f->status }}
                            </span>
                        </td>
                        <td>{{ $f->path }}</td>
                        <td>
                            <button wire:click="editar({{ $f->id }})" class="btn btn-sm btn-primary">Editar</button>
                            <button wire:click="atualizarStatus({{ $f->id }})" class="btn btn-sm btn-warning">
                                {{ $f->status === 'Ativo' ? 'Inativar' : 'Ativar' }}
                            </button>
                            <button wire:click="confirmarExclusao({{ $f->id }})" class="btn btn-sm btn-danger">Excluir</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhuma ferramenta encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $ferramentas->links() }}
    </div>

    {{-- Modal Livewire sem Alpine --}}
    @if($modalAberto)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="salvar">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $ferramentaId ? 'Editar' : 'Nova' }} Ferramenta</h5>
                            <button type="button" class="btn-close" wire:click="$set('modalAberto', false)"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nome</label>
                                <input wire:model.defer="nome" type="text" class="form-control">
                                @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>Versão</label>
                                <input wire:model.defer="versao" type="text" class="form-control">
                                @error('versao') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select wire:model.defer="status" class="form-control">
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>Path</label>
                                <input wire:model.defer="path" type="text" class="form-control">
                                @error('path') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="$set('modalAberto', false)" class="btn btn-secondary">Cancelar</button>
                            <button type="submit" class="btn btn-primary">
                                {{ $ferramentaId ? 'Atualizar' : 'Cadastrar' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal de confirmação --}}
    @if($confirmandoExclusao)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Exclusão</h5>
                        <button type="button" wire:click="$set('confirmandoExclusao', false)" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir esta ferramenta?</p>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="$set('confirmandoExclusao', false)" class="btn btn-secondary">Cancelar</button>
                        <button wire:click="excluir({{ $confirmandoExclusao }})" class="btn btn-danger">Sim, excluir</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
