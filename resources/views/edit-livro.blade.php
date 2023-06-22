@extends('layout')

@section('tittle', 'Editar livro')

@section('content')

<h1>Editar Livro</h1>
<form action="{{ route('livro-update', ['id'=>$livro->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Titulo</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $livro->titulo }}">
        </br>
        <label for="foto" class="form-label">Foto</label><br />
        <img src="imagens/{{ $livro->foto }}" alt="">
        <input type="text" accept="image/jpeg" class="form-control" value="{{ $livro->foto }}" />
        <input type="file" id="foto" name="foto" accept="image/jpeg" class="form-control">
        <br>
        <label for="nome" class="form-label">Quantidade</label>
        <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ $livro->quantidade }}">
        </br>
        <label for="nome" class="form-label">Autor</label>
        <select class="form-select" id="autor_id" name="autor_id" value="{{ $livro->autor->nome }}">
            @foreach($autores as $autor)
            <option value="{{$autor->id}}">{{$autor->nome}}</option>
            @endforeach
        </select>
        </br>
        <label for="nome" class="form-label">Genero</label>
        <select class="form-select" id="genero_id" name="genero_id" value="{{ $livro->genero->nome }}">
            @foreach($generos as $genero)
            <option value="{{$genero->id}}">{{$genero->nome}}</option>
            @endforeach
        </select>
        </br>
        <label for="nome" class="form-label">Editora</label>
        <select class="form-select" id="editora_id" name="editora_id" value="{{ $livro->editora->nome }}">
            @foreach($editoras as $editora)
            <option value="{{$editora->id}}">{{$editora->nome}}</option>
            @endforeach
        </select>
        </br>
        <button class="btn btn-primary" type="submit" name="button">Salvar</button>
</form>

@endsection