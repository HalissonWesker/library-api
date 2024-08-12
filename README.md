
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

Para rodar os testes:

```bash
php artisan test
```
