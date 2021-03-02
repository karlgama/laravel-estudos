<?php


namespace App\Http\Controllers;


use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::all();
        return view('series.index', compact('series'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $nome = $request->nome;
        //opção para escolher os parametros
//        $serie = Serie::create([
//            'nome'=>$nome
//        ]);
        //opção para salvar tudo que receber
        $serie = Serie::create($request->all());

        if($serie){
            echo "Série cadastrada com sucesso, id: " . $serie->id;
        }

    }
}
