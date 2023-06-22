@extends('layout')

@section('tittle', 'Editar Autor')

@section('content')

<h1>Editar Autor</h1>
<form action="{{ route('autor-update', ['id'=>$autores->id]) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="{{ $autores->nome }}">
    <label for="foto" class="form-label">Foto</label>
    <input type="file" class="form-control" id="foto" name="foto">
    </br>
    <button class="btn btn-success" type="submit" name="button">Salvar</button>
</form>

<img src="akdsjfkasdjf.png" alt="">

@endsection