@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')
    @if(!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
    @endif
    <a href="/series/create" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item  d-flex justify-content-between align-items-center btn-sm">
            {{$serie->nome}}
            <form method="post" action="/series/{{$serie->id}}" onsubmit="return confirm('tem certeza que deseja excluir?')">
                @csrf
                @method('DELETE')
                <button href="#" class="btn btn-danger">Excluir</button>
            </form>
        </li>
        @endforeach
    </ul>
@endsection
