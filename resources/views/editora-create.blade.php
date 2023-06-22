@extends('layout')

@section('tittle', 'Cadastrar Editora')

@section('content')

<h1>Cadastro de Editora</h1>
<form action="{{ route('editora-store') }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" value="" name="nome">
    <label for="foto" class="form-label">Foto</label>
    <input type="file" accept="image/jpeg" class="form-control" id="foto" name="foto">
    </br>
    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
</form>

@endsection