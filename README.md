# ABGI Ferramentas — Sistema de Gestão com Livewire e Modais

Este projeto foi desenvolvido como parte do processo seletivo para a vaga de **Analista de Sistemas Fullstack** na **ABGI Brasil**.  
A aplicação tem como objetivo gerenciar ferramentas utilizadas pela equipe, com foco em uma experiência fluida, moderna e reativa — utilizando **Laravel 10**, **Livewire 2**, **Bootstrap 5** e **SQL Server**.

Todos os cadastros, edições e exclusões são realizados **via modal dinâmico**, sem recarregar a página, garantindo uma navegação mais ágil e responsiva.

---

## 🚀 Tecnologias Utilizadas

- **Laravel 10** — Framework PHP moderno e robusto
- **Livewire 2** — Componentes dinâmicos e reativos em Blade
- **Bootstrap 5** — Interface moderna e responsiva
- **SQL Server** — Banco de dados utilizado
- **PHP 8.1** — Versão mínima recomendada com suporte a `pdo_sqlsrv`
- **Composer** — Gerenciador de dependências PHP

---

## 🧠 Funcionalidades Implementadas

- ✅ Cadastro de nova ferramenta (via modal)
- ✅ Edição de ferramenta existente (via modal com preenchimento automático)
- ✅ Exclusão com confirmação (modal)
- ✅ Filtro por status (Ativo/Inativo)
- ✅ Busca por nome (reativa)
- ✅ Paginação com Livewire
- ✅ Atualização de status com clique
- ✅ Validação com feedback visual
- ✅ Interface 100% reativa com Livewire

---

## 🗂️ Estrutura da Tabela

Tabela: `ferramentas`

| Campo     | Tipo     | Descrição                           |
|-----------|----------|-------------------------------------|
| id        | integer  | Identificador único                 |
| nome      | string   | Nome da ferramenta                  |
| versao    | string   | Versão da ferramenta                |
| status    | enum     | Ativo ou Inativo                    |
| path      | string   | Caminho/Path da ferramenta          |
| created_at / updated_at | datetime | Registro de data de criação e atualização |

---

## 🧪 Como Executar o Projeto

> ⚠️ Este projeto exige **PHP 8.1** com as extensões `sqlsrv` e `pdo_sqlsrv` habilitadas, além de **SQL Server** instalado e funcionando.

### 1. Clonar o repositório

```bash
git clone https://github.com/seu-usuario/abgi-ferramentas.git
cd abgi-ferramentas
```

### 2. Instalar dependências

```bash
composer install
```

### 3. Copiar o `.env` e configurar

```bash
cp .env.example .env
```

Edite o `.env` com as credenciais do seu SQL Server:

```env
DB_CONNECTION=sqlsrv
DB_HOST=127.0.0.1
DB_PORT=1434
DB_DATABASE=abgi_ferramentas
DB_USERNAME=sa
DB_PASSWORD=YourStrong@123
```

### 4. Gerar chave da aplicação

```bash
php artisan key:generate
```

### 5. Executar as migrations

```bash
php artisan migrate
```

### 6. Subir o servidor local

```bash
php artisan serve
```

### 7. Acessar no navegador

```
http://localhost:8000/ferramentas
```

---

## 🧭 Rotas Disponíveis

| Rota                       | Descrição                            |
|----------------------------|----------------------------------------|
| `/ferramentas`             | Listagem com busca e filtros          |
| `/ferramentas/novo`        | Cadastro de nova ferramenta           |
| `/ferramentas/{id}/editar` | Edição de ferramenta existente        |

---

## 💡 Melhorias Futuras

- Exclusão com confirmação
- Exportação de lista para CSV
- Filtros avançados por versão ou diretório
- Autenticação e controle de usuários
- Dashboard com estatísticas de ferramentas

---

## 📌 Considerações Finais

Este projeto foi construído com foco na clareza do código, organização dos componentes, padronização e boa experiência do usuário.  
Está pronto para expansão e integração com outras funcionalidades mais avançadas, conforme o crescimento do uso interno na Abgi Brasil.

**Desenvolvido com 💜 por Paloma Gomes**
