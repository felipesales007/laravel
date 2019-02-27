@extends('layout.app')
@section('title', 'Lista de Produtos')
@section('content')
    <h1>Produtos</h1>
    <div class="row">
        @foreach ($produtos as $produto)
        <div class="col-md-3">
            @if(file_exists("./img/produtos/".md5($produto->id).".jpg"))
                <img src="{{url('img/produtos/'.md5($produto->id).'.jpg')}}" alt="Imagem Produto" class="img-fluid img-thumbnail">
            @endif
            <h4 class="text-center">
                <a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->titulo}}</a>
            </h4>
            <div class="mb-3">
                <a href="{{URL::to('produtos/'.$produto->id.'/edit')}}" class="btn btn-primary">Editar</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection