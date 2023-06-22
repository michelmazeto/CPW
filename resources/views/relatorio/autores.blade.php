<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Autores</title>
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
        .author-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <h1>Relatório de Autores</h1>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>ID</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($autores as $autor)
                <tr>
                    <td><img src="imagens/{{ $autor->foto }}" class="author-image"></td>
                    <td>{{ $autor->id }}</td>
                    <td>{{ $autor->nome }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
