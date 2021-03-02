<?php


namespace App\Http\Controllers;


use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');
        return view('series.index', compact('series','mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        //opção para escolher os parametros
//        $serie = Serie::create([
//            'nome'=>$nome
//        ]);
        //opção para salvar tudo que receber
        $serie = Serie::create($request->all());

        if($serie){
            $request->session()
                ->flash(
                    'mensagem',
                    "Série: {$serie->id} criada com sucesso {$serie->nome}"
                );
            echo "Série cadastrada com sucesso, id: " . $serie->id;
            return redirect('/series');
        }
        echo 'Impossível adicionar a sua série';
    }
}
