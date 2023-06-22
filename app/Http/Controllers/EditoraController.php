<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editora;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\View;

class EditoraController extends Controller
{
  public function index()
  {
    $editoras = Editora::orderBy('id')->get();
    return view('editora', ['editoras' => $editoras]);
  }

  public function create()
  {
    return view('editora-create');
  }

  public function store(Request $request)
  {
    $editora = new Editora();
    $editora->nome = $request->input('nome');

    if ($request->hasFile('foto')) {
      $arquivo = $request->file('foto');
      $destPath = public_path('imagens');
      $imageName = time() . '_' . $arquivo->getClientOriginalName();
      $arquivo->move($destPath, $imageName);
      $editora->foto = $imageName;
    } else {
      $editora->foto = "default.jpg";
    }

    if ($editora->save()) {
      return redirect()->route('editora-index')->with('status', 'Editora criada!');
    } else {
      return redirect()->route('editora-index')->withErrors('Não foi possivel salvar a editora.');
    }
  }

  public function edit($id)
  {
    $editoras = Editora::where('id', $id)->first();
    if (!empty($editoras)) {
      return view('edit-editora', ['editoras' => $editoras]);
    } else {
      return redirect()->route('editora-index')->withErrors('Não foi possivel encontrar a editora.');
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
    if (Editora::where('id', $id)->update($data)) {
      return redirect()->route('editora-index')->with('status', 'Editora alterada!');
    } else {
      return redirect()->route('editora-index')->withErrors('Não foi possivel alterar a editora.');
    }
  }

  public function destroy($id)
  {
    if(Editora::where('id', $id)->delete()){
    return redirect()->route('editora-index');
    }else{
      return redirect()->route('editora-index')->withErrors('Não foi possivel deletar a editora.');
    }
  }

  public function gerarRelatorioPDF()
  {
    $editoras = Editora::all();
    $html = view('relatorio.editoras', compact('editoras'));
    $pdf = PDF::loadHtml($html)->setPaper('a4');
    return $pdf->download('relatorio_editoras.pdf');
  }
}


