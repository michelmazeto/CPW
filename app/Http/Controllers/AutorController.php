<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\View;

class AutorController extends Controller
{
  public function index()
  {
    $autores = Autor::orderBy('id')->get();
    return view('autor', ['autores' => $autores]);
  }

  public function create()
  {
    return view('autor-create');
  }

  public function store(Request $request)
  {
    $autor = new Autor();
    $autor->nome = $request->input('nome');

    if ($request->hasFile('foto')) {
      $arquivo = $request->file('foto');
      $destPath = public_path('imagens');
      $imageName = time() . '_' . $arquivo->getClientOriginalName();
      $arquivo->move($destPath, $imageName);
      $autor->foto = $imageName;
    } else {
      $autor->foto = "default_user.jpg";
    }

    if ($autor->save()) {
      return redirect()->route('autor-index')->with('status', 'Autor cadastrado com sucesso!');
    } else {
      return redirect()->route('autor-index')->withErrors('Não foi possivel cadastrar o autor. Tente novamente');
    }
  }

  public function edit($id)
  {
    $autores = Autor::where('id', $id)->first();
    if (!empty($autores)) {
      return view('edit-autor', ['autores' => $autores]);
    } else {
      return redirect()->route('autor-index')->withErrors('Não foi possivel achar o autor. Tente novamente');
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
        'nome' => $request->nome,
        'foto' => $imageName,
      ];
    } else {
      $data = [
        'nome' => $request->nome,
      ];
    }

    if (Autor::where('id', $id)->update($data)) {
      return redirect()->route('autor-index')->with('status', 'Autor alterado com sucesso!');
    } else {
      return redirect()->route('autor-index')->withErrors('Não foi possivel alterar o autor. Tente novamente');
    }
  }

  public function destroy($id)
  {
    if (Autor::where('id', $id)->delete()) {
      return redirect()->route('autor-index')->with('status', 'Autor excluido com sucesso');
    } else {
      return redirect()->route('autor-index')->withErrors('Não foi possivel deletar o autor. Tente novamente');
    }
  }

  public function gerarRelatorioPDF()
  {
      $autores = Autor::all();
      $html = view('relatorio.autores', compact('autores'));
      $pdf = PDF::loadHtml($html)->setPaper('a4');
      return $pdf->download('relatorio_autores.pdf');
  }

}
