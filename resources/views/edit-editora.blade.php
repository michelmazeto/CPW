@extends('layout')

@section('tittle', 'Editar Editora')

@section('content')

<h1>Editar Editora</h1>
<form action="{{ route('editora-update', ['id'=>$editoras->id]) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" value="{{ $editoras->nome }}" name="nome">
    <img src="imagens/{{ $editoras->foto }}" alt="">
    <label for="foto" class="form-label">Foto</label>
    <input type="file" class="form-control" id="foto" name="foto">
    </br>
    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
</form>

@endsection