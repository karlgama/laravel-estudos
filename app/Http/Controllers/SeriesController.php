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
        $request->validate([
            'nome'=>'required|min:2'
        ]);
        //opção para escolher os parametros
//        $serie = Serie::create([
//            'nome'=>$nome
//        ]);
        //opção para salvar tudo que receber
        $serie = Serie::create($request->all());

        $request->session()
            ->flash(
                'mensagem',
                "Série: {$serie->id} criada com sucesso {$serie->nome}"
            );
        return redirect('/series');

    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Série removida com sucesso"
            );
        return redirect('/series');
    }
}
