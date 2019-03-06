@extends('layouts.app')
@section('title', 'Lista de Produtos')
@section('content')
    <h1>Produtos</h1>
    @if($message = Session::get('info'))
        <div class="alert alert-info">
            {{$message}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{url('produtos/busca')}}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" id="busca" name="busca" class="form-control" placeholder="Procurar produto no site" value="{{ $buscar }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form method="POST" action="{{url('produtos/ordem')}}">
                @csrf
                <div class="input-group mb-3">
                    <select id="ordem" name="ordem" class="form-control">
                        <option>Escolha a ordem</option>
                        <option value="1" @if($ordem == 1) selected @endif>Título (A-Z)</option>
                        <option value="2" @if($ordem == 2) selected @endif>Título (Z-A)</option>
                        <option value="3" @if($ordem == 3) selected @endif>Valor (maior-menor)</option>
                        <option value="4" @if($ordem == 4) selected @endif>Valor (menor-maior)</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary">Ordenar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach ($produtos as $produto)
        <div class="col-md-3">
            @if(file_exists("./img/produtos/".md5($produto->id).".jpg"))
                <img src="{{url('img/produtos/'.md5($produto->id).'.jpg')}}" alt="Imagem Produto" class="img-fluid img-thumbnail">
            @endif
            <h4 class="text-center">
                <a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->titulo}}</a>
                @if($produto->preco == $maiscaro)
                <span class="badge badge-danger">Maior preço</span>
                @endif
                @if($produto->preco == $maisbarato)
                <span class="badge badge-success">Menor preço</span>
                @endif
            </h4>
            <p class="text-center">R$ {{number_format($produto->preco, 2, ',', '.')}}</p>
            @if(Auth::check())
            <div class="mb-3">
                <form method="POST" action="{{action('ProdutosController@destroy', $produto->id)}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <a href="{{URL::to('produtos/'.$produto->id.'/edit')}}" class="btn btn-primary">Editar</a>
                    <button class="btn btn-danger">Excluir</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    <div>
        <p><strong>O valor médio dos produtos é: </strong>R$ {{number_format($mediavalor, 2, ',', '.')}}</p>
        <p><strong>O valor total dos produtos é: </strong>R$ {{number_format($somavalor, 2, ',', '.')}}</p>
        <p><strong>O quantidade total dos produtos é: </strong>{{ $contagemP }}</p>
        <p><strong>A quantidade de produtos maior que R$ 10,00 é: </strong>{{ $maiorDezP }}</p>
    </div>
    {{ $produtos->links() }}
@endsection