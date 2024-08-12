<!DOCTYPE html>
<html>
<head>
    <title>Novo Empréstimo de Livro</title>
</head>
<body>
    <h1>Olá, {{ $loan->user->name }}</h1>
    <p>Você acabou de fazer um empréstimo do livro "{{ $loan->book->title }}".</p>
    <p>Data do Empréstimo: {{ $loan->borrow_date }}</p>
    <p>Por favor, devolva o livro até a data: {{ $loan->return_date ?? 'a ser definida' }}.</p>
</body>
</html>
