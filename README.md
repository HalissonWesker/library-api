
# 📚 Library API

Bem-vindo ao **Library API**, uma API para gerenciar livros, autores e empréstimos de livros. Este projeto foi desenvolvido usando Laravel e está preparado para ser executado tanto em ambientes tradicionais quanto em containers Docker.

---

## 🚀 Tecnologias Utilizadas

Este projeto utiliza as seguintes tecnologias:

- ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white) - Framework principal para desenvolvimento backend.
- ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) - Linguagem de programação utilizada.
- ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white) - Banco de dados relacional.
- ![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white) - Plataforma para criação e gerenciamento de containers.

---

## 📂 Estrutura de Pastas

A estrutura de pastas do projeto segue a convenção padrão do Laravel:

```
library-api/
├── app/
│ ├── Console/
│ │ ├── Events/
│ │ └── LoanCreated.php # Evento customizado disparado quando um empréstimo é criado
│ ├── Jobs/
│ │ └── SendLoanNotificationJob.php # Job customizado para envio de notificações de empréstimos
│ ├── Listeners/
│ │ └── SendLoanNotificationListener.php# Listener customizado que responde ao evento LoanCreated
│ ├── Mail/
│ │ └── LoanCreatedMail.php # Classe customizada que define o conteúdo do e-mail enviado após a criação de um empréstimo
│ ├── Models/
│ │ ├── Author.php # Modelo customizado para autores
│ │ ├── Book.php # Modelo customizado para livros
│ │ ├── Loan.php # Modelo customizado para empréstimos
│ └── Services/
│ ├── AuthorService.php # Serviço customizado para a lógica de negócios relacionada a autores
│ ├── BookService.php # Serviço customizado para a lógica de negócios relacionada a livros
│ ├── LoanService.php # Serviço customizado para a lógica de negócios relacionada a empréstimos
│ └── Repositories/
│ ├── AuthorRepository.php # Repositório customizado para acessar dados de autores
│ ├── BookRepository.php # Repositório customizado para acessar dados de livros
│ └── LoanRepository.php # Repositório customizado para acessar dados de empréstimos
├── database/
│ ├── migrations/
│ │ ├── 2024_08_11_223443_create_authors_table.php # Migração customizada para criar a tabela de autores
│ │ ├── 2024_08_11_223444_create_books_table.php # Migração customizada para criar a tabela de livros
│ │ ├── 2024_08_11_223445_create_loans_table.php # Migração customizada para criar a tabela de empréstimos
│ │ └── 2024_08_11_223714_add_super_user_role_to_users_table.php # Migração customizada para adicionar a coluna de superusuário na tabela de usuários
├── tests/
│ ├── Feature/
│ │ ├── AuthorApiTest.php # Teste para o endpoint de autores
│ │ ├── BookApiTest.php # Teste para o endpoint de livros
│ │ └── LoanApiTest.php # Teste para o endpoint de empréstimos           
```

---

## 🛠️ Configuração do Projeto

### Configuração sem Docker

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/seu-usuario/library-api.git
   cd library-api
   ```

2. **Instale as dependências do projeto:**

   ```bash
   composer install
   ```

3. **Copie o arquivo .env.example para .env:**

   ```bash
   cp .env.example .env
   ```

4. **Gere a chave da aplicação:**

   ```bash
   php artisan key:generate
   ```

5. **Configure o banco de dados no arquivo .env.**

6. **Rode as migrações e seeders:**

   ```bash
   php artisan migrate --seed
   ```

7. **Inicie o servidor de desenvolvimento:**

   ```bash
   php artisan serve
   ```

### Configuração com Docker

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/seu-usuario/library-api.git
   cd library-api
   ```

2. **Suba os containers com Docker Compose:**

   ```bash
   docker-compose up -d
   ```

3. **Execute as migrações e seeders dentro do container:**

   ```bash
   docker-compose exec app php artisan migrate --seed
   ```

---

## 📋 Endpoints Disponíveis

### Autenticação

- **Registrar:**

  ```
  POST /api/register
  Payload: name, email, password
  ```

- **Login:**

  ```
  POST /api/login
  Payload: email, password
  ```

- **Logout:**

  ```
  POST /api/logout
  Header: Authorization: Bearer {token}
  ```

### Livros

- **Listar livros (Usuário autenticado):**

  ```
  GET /api/books
  ```

- **Criar livro (Admin):**

  ```
  POST /api/admin/books
  Payload: title, publication_year, author_id
  ```

- **Atualizar livro (Admin):**

  ```
  PUT /api/admin/books/{id}
  Payload: title, publication_year, author_id
  ```

- **Deletar livro (Admin):**

  ```
  DELETE /api/admin/books/{id}
  ```

### Autores

- **Listar autores (Usuário autenticado):**

  ```
  GET /api/authors
  ```

- **Criar autor (Admin):**

  ```
  POST /api/admin/authors
  Payload: name, birth_date
  ```

- **Atualizar autor (Admin):**

  ```
  PUT /api/admin/authors/{id}
  Payload: name, birth_date
  ```

- **Deletar autor (Admin):**

  ```
  DELETE /api/admin/authors/{id}
  ```

### Empréstimos

- **Listar empréstimos (Admin):**

  ```
  GET /api/admin/loans
  ```

- **Criar empréstimo (Admin):**

  ```
  POST /api/admin/loans
  Payload: user_id, book_id, borrow_date, return_date
  ```

- **Atualizar empréstimo (Admin):**

  ```
  PUT /api/admin/loans/{id}
  Payload: return_date
  ```

- **Deletar empréstimo (Admin):**

  ```
  DELETE /api/admin/loans/{id}
  ```

---

## 🔐 RBAC e Autenticação

A API utiliza autenticação JWT para proteger os endpoints. Existem dois papéis principais:

- **Admin:** Pode gerenciar livros, autores e empréstimos.
- **Usuário:** Pode listar livros e autores.

### Fluxo de Autenticação

- **Registrar:**

  ```bash
  curl -X POST http://localhost:8000/api/register -d 'name=Seu Nome&email=seuemail@example.com&password=suaSenha'
  ```

- **Login:**

  ```bash
  curl -X POST http://localhost:8000/api/login -d 'email=seuemail@example.com&password=suaSenha'
  ```

  Isso retornará um `access_token` que deve ser usado nos headers de autorização.

- **Acessar recursos protegidos:**

  Envie o token JWT no header da seguinte forma:

  ```bash
  Authorization: Bearer {token}
  ```

---

## 🧪 Testes

No projeto, foram implementados testes para validar os endpoints principais da API relacionados a autores, livros e empréstimos. Esses testes estão divididos entre testes de funcionalidade (Feature) que verificam se as funcionalidades estão funcionando como esperado ao interagir com a API.

### Testes de Funcionalidade

#### AuthorApiTest.php:

- Verifica se é possível listar autores.
- Testa a criação de novos autores com as informações corretas.
- Verifica a atualização dos dados de um autor existente.
- Testa a exclusão de um autor.

#### BookApiTest.php:

- Verifica se é possível listar livros.
- Testa a criação de novos livros com os dados corretos.
- Verifica a atualização dos dados de um livro existente.
- Testa a exclusão de um livro.

#### LoanApiTest.php:

- Verifica se é possível listar empréstimos.
- Testa a criação de novos empréstimos com os dados corretos.
- Verifica a atualização dos dados de um empréstimo existente.
- Testa a finalização (retorno) de um empréstimo.

### Como Executar os Testes

#### Executar Testes Usando o Laravel

Para executar os testes automatizados que foram implementados, você pode utilizar o comando Artisan do Laravel:

```bash
php artisan test
```

Isso vai rodar todos os testes definidos nos diretórios `Feature` e `Unit`, validando o comportamento esperado das funcionalidades da API.

### Testando Usando Insomnia

O Insomnia é uma ferramenta popular para testar APIs REST. Para testar os endpoints da API `Library API` que você implementou, siga os passos abaixo:

#### Instalação do Insomnia:

Se você ainda não tiver o Insomnia instalado, você pode baixá-lo e instalá-lo a partir do [site oficial](https://insomnia.rest/download).

#### Configuração do Insomnia:

- Abra o Insomnia e crie um novo workspace ou use um existente.
- Dentro do workspace, crie uma nova request e selecione o método HTTP correspondente (GET, POST, PUT, DELETE).

#### Testando Autenticação:

- **Registrar**: Crie uma request do tipo POST para `http://localhost:8000/api/register` com o payload:
  ```json
  {
    "name": "Seu Nome",
    "email": "seuemail@example.com",
    "password": "suaSenha"
  }
  ```

- **Login**: Crie uma request do tipo POST para `http://localhost:8000/api/login` com o payload:
  ```json
  {
    "email": "seuemail@example.com",
    "password": "suaSenha"
  }
  ```

- Copie o `access_token` retornado e adicione-o no header das próximas requests usando:
  ```bash
  Authorization: Bearer {token}
  ```

#### Testando Endpoints de Autores:

- **Listar Autores**: Crie uma request do tipo GET para `http://localhost:8000/api/authors`.

- **Criar Autor**: Crie uma request do tipo POST para `http://localhost:8000/api/admin/authors` com o payload:
  ```json
  {
    "name": "Autor Exemplo",
    "birth_date": "1970-01-01"
  }
  ```

- **Atualizar Autor**: Crie uma request do tipo PUT para `http://localhost:8000/api/admin/authors/{id}` com o payload:
  ```json
  {
    "name": "Autor Atualizado",
    "birth_date": "1975-05-05"
  }
  ```

- **Deletar Autor**: Crie uma request do tipo DELETE para `http://localhost:8000/api/admin/authors/{id}`.

#### Testando Endpoints de Livros:

- **Listar Livros**: Crie uma request do tipo GET para `http://localhost:8000/api/books`.

- **Criar Livro**: Crie uma request do tipo POST para `http://localhost:8000/api/admin/books` com o payload:
  ```json
  {
    "title": "Livro Exemplo",
    "publication_year": 2022,
    "author_id": 1
  }
  ```

- **Atualizar Livro**: Crie uma request do tipo PUT para `http://localhost:8000/api/admin/books/{id}` com o payload:
  ```json
  {
    "title": "Livro Atualizado",
    "publication_year": 2023,
    "author_id": 1
  }
  ```

- **Deletar Livro**: Crie uma request do tipo DELETE para `http://localhost:8000/api/admin/books/{id}`.

#### Testando Endpoints de Empréstimos:

- **Listar Empréstimos**: Crie uma request do tipo GET para `http://localhost:8000/api/admin/loans`.

- **Criar Empréstimo**: Crie uma request do tipo POST para `http://localhost:8000/api/admin/loans` com o payload:
  ```json
  {
    "user_id": 1,
    "book_id": 1,
    "borrow_date": "2024-01-01",
    "return_date": "2024-01-15"
  }
  ```

- **Atualizar Empréstimo**: Crie uma request do tipo PUT para `http://localhost:8000/api/admin/loans/{id}` com o payload:
  ```json
  {
    "return_date": "2024-01-20"
  }
  ```

- **Finalizar Empréstimo**: Crie uma request do tipo DELETE para `http://localhost:8000/api/admin/loans/{id}`.

### Considerações Finais

Testar a API usando o Insomnia permite que você simule as interações reais dos clientes com os endpoints, verificando se tudo está funcionando como esperado. Além disso, a execução dos testes automatizados ajuda a garantir que o comportamento esperado continue consistente mesmo após futuras alterações no código.
