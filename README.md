
# 💼 ABGI Ferramentas — Sistema de Gestão de Ferramentas

Este projeto foi desenvolvido como parte do processo seletivo para a vaga de **Analista de Sistemas Fullstack na Abgi Brasil**, com foco em tecnologias modernas e alinhadas às exigências da posição.

A aplicação tem como objetivo facilitar o gerenciamento de ferramentas utilizadas internamente pela equipe, permitindo o cadastro, edição, visualização com filtros dinâmicos e paginação — tudo em uma interface leve, responsiva e eficiente.

O sistema foi construído utilizando **Laravel 10**, **Livewire 2**, **Bootstrap 5** e banco de dados **SQL Server**, com atenção especial à organização do código, boas práticas, clareza e usabilidade.

---

## 🚀 Tecnologias Utilizadas

- **Laravel 10** — Framework PHP moderno, robusto e produtivo.
- **Livewire 2** — Para interatividade sem sair do Blade.
- **Bootstrap 5** — Layout responsivo e elegante.
- **PHP 8.1** — Compatível com drivers atuais do SQL Server.
- **SQL Server** — Banco de dados relacional utilizado na empresa.
- **Composer** — Gerenciador de dependências PHP.

---

## 🛠️ Funcionalidades

- ✅ Cadastro e edição de ferramentas (nome, versão, status, path)
- ✅ Filtro por status (Ativo/Inativo)
- ✅ Busca dinâmica por nome
- ✅ Paginação
- ✅ Feedbacks visuais e validações com mensagens de erro
- ✅ Interface limpa, responsiva e intuitiva com Bootstrap

---

## 📂 Estrutura da Tabela

Tabela: `ferramentas`

| Campo      | Tipo     | Descrição                             |
|------------|----------|-----------------------------------------|
| id         | integer  | Identificador único                     |
| nome       | string   | Nome da ferramenta                      |
| versao     | string   | Versão da ferramenta                    |
| status     | enum     | Ativo ou Inativo                        |
| path       | string   | Caminho para a ferramenta               |
| created_at | datetime | Data de criação                         |
| updated_at | datetime | Data de atualização                     |

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
