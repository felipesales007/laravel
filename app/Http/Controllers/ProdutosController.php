<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use App\Produtos;

class ProdutosController extends Controller
{
    public function index() {
        $produtos = Produtos::paginate(4);
        //$produtos = Produtos::all();
        // echo "<pre>";
        // print_r($produtos);
        // echo "</pre>";
        return view('produtos.index', array('produtos' => $produtos, 'buscar' => null, 'ordem'=> null));
    }

    public function show($id) {
        $produto = Produtos::find($id);
        // echo "<pre>";
        // print_r($produto);
        // echo "</pre>";
        return view('produtos.show', array('produto' => $produto));
    }

    public function create() {
        if (Auth::check()) {
            return view('produtos.create');
        } else {
            return redirect('login');
        }
    }

    public function store(Request $request) {
        $this->validate($request,[
            'sku' => 'required | min:3 | unique:produtos',
            'titulo' => 'required | min:3',
            'descricao' => 'required | min:10',
            'preco' => 'required | numeric'
        ]);

        $produto = new Produtos();
        $produto->sku = $request->input('sku');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');

        if($produto->save()) {
            return redirect('produtos/create')->with('success', 'Produto cadastrado com sucesso');
        }
    }

    public function edit($id) {
        if (Auth::check()) {
            $produto = Produtos::find($id);
            return view('produtos.edit', compact('produto', 'id'));
        } else {
            return redirect('login');
        }
    }

    public function update(Request $request, $id) {
        $produto = Produtos::find($id);

        $this->validate($request,[
            'sku' => 'required | min:3',
            'titulo' => 'required | min:3',
            'descricao' => 'required | min:10',
            'preco' => 'required | numeric'
        ]);

        if($request->hasFile('imgproduto')) {
            $imagem = $request->file('imgproduto');
            $nomearquivo = md5($id).".".$imagem->getClientOriginalExtension();
            $request->file('imgproduto')->move(public_path('./img/produtos/'), $nomearquivo);
        }

        $produto->sku = $request->get('sku');
        $produto->titulo = $request->get('titulo');
        $produto->descricao = $request->get('descricao');
        $produto->preco = $request->get('preco');

        if($produto->save()) {
            return redirect('produtos/'.$id.'/edit')->with('success', 'Produto atualizado com sucesso');
        }
    }

    public function destroy($id) {
        $produto = Produtos::find($id);
        if (file_exists("./img/produtos/".md5($id).".jpg")) {
            unlink("./img/produtos/".md5($id).".jpg");
        }
        $produto->delete();
        return redirect()->back()->with('info', 'Produto deletado com sucesso');
    }

    public function busca(Request $request) {
        $buscaInput = $request->input('busca');
        
        $produtos = Produtos::where('titulo', 'LIKE', '%'.$buscaInput.'%')
        ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
        ->paginate(4);
        //->get();

        return view('produtos.index', array('produtos' => $produtos, 'buscar' => $buscaInput, 'ordem'=> null));
    }

    public function ordem(Request $request) {
        $ordemInput = $request->input('ordem');

        if ($ordemInput == 1) {
            $campo = 'titulo';
            $tipo = 'asc';
        } else if ($ordemInput == 2) {
            $campo = 'titulo';
            $tipo = 'desc';
        } else if ($ordemInput == 3) {
            $campo = 'preco';
            $tipo = 'desc';
        } else if ($ordemInput == 4) {
            $campo = 'preco';
            $tipo = 'asc';
        }
        
        $produtos = Produtos::orderBy($campo, $tipo)->paginate(4);

        return view('produtos.index', array('produtos' => $produtos, 'buscar' => null, 'ordem'=> $ordemInput));
    }
}
