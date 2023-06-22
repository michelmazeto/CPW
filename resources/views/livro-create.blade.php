@extends('layout')

@section('tittle', 'Novo Livro')

@section('content')

<h1>Cadastro de Livro</h1>
<form action="{{ route('livro-store') }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="nome" class="form-label">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo">
    </br>
    <label for="foto" class="form-label">Foto</label><br />
    <input id="foto" name="foto" type="file" accept="image/jpeg" class="form-control"/>
    <br>
    <label for="nome" class="form-label">Quantidade</label>
    <input type="number" class="form-control" id="quantidade" name="quantidade">
    </br>
    <label for="nome" class="form-label">Autor</label>
    <select class="form-select" id="autor_id" name="autor_id">
      @foreach($autores as $autor)
      <option value="{{$autor->id}}">{{$autor->nome}}</option>
      @endforeach
    </select>
    </br>
    <label for="nome" class="form-label">Genero</label>
    <select class="form-select" id="genero_id" name="genero_id">
      @foreach($generos as $genero)
      <option value="{{$genero->id}}">{{$genero->nome}}</option>
      @endforeach
    </select>
    </br>
    <label for="nome" class="form-label">Editora</label>
    <select class="form-select" id="editora_id" name="editora_id">
      @foreach($editoras as $editora)
      <option value="{{$editora->id}}">{{$editora->nome}}</option>
      @endforeach
    </select>
    </br>
    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
</form>

@endsection