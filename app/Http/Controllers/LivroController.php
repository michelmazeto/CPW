<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Editora;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\View;

class LivroController extends Controller
{
  public function index()
  {
    $livros = Livro::orderBy('id')->get();
    $autores = Autor::all();
    $generos = Genero::all();
    $editoras = Editora::all();
    return view('livro', ['livros' => $livros, 'autores' => $autores, 'generos' => $generos, 'editoras' => $editoras]);
  }

  public function create()
  {
    $generos = Genero::all();
    $editoras = Editora::all();
    $autores = Autor::all();
    return view('livro-create', ['generos' => $generos, 'editoras' => $editoras, 'autores' => $autores]);
  }

  public function store(Request $request)
  {
    $livro = new Livro();
    $livro->titulo = $request->input('titulo');
    $livro->quantidade = $request->input('quantidade');
    $livro->autor_id = $request->input('autor_id');
    $livro->genero_id = $request->input('genero_id');
    $livro->editora_id = $request->input('editora_id');

    if ($request->hasFile('foto')) {
      $arquivo = $request->file('foto');
      $destPath = public_path('imagens');
      $imageName = time() . '_' . $arquivo->getClientOriginalName();
      $arquivo->move($destPath, $imageName);
      $livro->foto = $imageName;
    } else {
      $livro->foto = "default.jpg";
    }

    if ($livro->save()) {
      return redirect()->route('livro-index');
    } else {
      return redirect()->route('livro-index')->withErrors('Não foi possivel salvar o livro.');
    }
  }

  public function edit($id)
  {
    $livro = Livro::where('id', $id)->first();
    if (!empty($livro)) {
      $autores = Autor::all();
      $generos = Genero::all();
      $editoras = Editora::all();
      return view('edit-livro', ['livro' => $livro, 'autores' => $autores, 'generos' => $generos, 'editoras' => $editoras]);
    } else {
      return redirect()->route('livro-index')->withErrors('Não foi possivel encontrar o livro.');
    }
  }

  public function update(Request $request, $id)
  {
    if ($request->hasFile('foto')) {
      $arquivo = $request->file('foto');
      $destPath = public_path('imagens');
      $imageName = time() . '_' . $arquivo->getClientOriginalName();
      $arquivo->move($destPath, $imageName);
      $data = [
        'titulo' => $request->titulo,
        'quantidade' => $request->quantidade,
        'id_genero' => $request->id_genero,
        'id_autor' => $request->id_autor,
        'id_editora' => $request->id_editora,
        'foto' => $imageName,
      ];
    } else {
      $data = [
        'titulo' => $request->titulo,
        'quantidade' => $request->quantidade,
        'id_genero' => $request->id_genero,
        'id_autor' => $request->id_autor,
        'id_editora' => $request->id_editora,
      ];
    }
    if (Livro::where('id', $id)->update($data)) {
      return redirect()->route('livro-index')->with('status', 'Livro alterado!');
    } else {
      return redirect()->route('livro-index')->withErrors('Não foi possivel alterar o livro.');
    }
  }

  public function destroy($id)
  {
    if (Livro::where('id', $id)->delete()) {
      return redirect()->route('livro-index')->with('status', 'Livro deletado!');
    } else {
      return redirect()->route('livro-index')->withErrors('Não foi possivel deletar o livro.');
    }
  }

  public function gerarRelatorioPDF()
  {
    $livros = Livro::all();
    $html = view('relatorio.livros', compact('livros'));
    $pdf = PDF::loadHtml($html)->setPaper('a4');
    return $pdf->download('relatorio_livros.pdf');
  }
}
