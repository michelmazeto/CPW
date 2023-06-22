<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Livros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .book-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <h1>Relatório de Livros</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Título</th>
                <th>Gênero</th>
                <th>Editora</th>
                <th>Autor</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($livros as $livro)
                <tr>
                    <td>{{ $livro->id }}</td>
                    <td><img src="imagens/{{ $livro->foto }}" alt="" class="book-image"></td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->genero->nome }}</td>
                    <td>{{ $livro->editora->nome }}</td>
                    <td>{{ $livro->autor->nome }}</td>
                    <td>{{ $livro->quantidade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
