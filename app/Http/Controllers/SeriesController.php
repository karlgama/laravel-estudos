<?php


namespace App\Http\Controllers;


use App\Http\Requests\SeriesFormRequest;
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

    public function store(SeriesFormRequest $request)
    {
        //opção para escolher os parametros
//        $serie = Serie::create([
//            'nome'=>$nome
//        ]);
        //opção para salvar tudo que receber
        $serie = Serie::create(['nome'=> $request->nome]);
        $qtdTemporadas = $request->qtd_temporadas;
        for ($i = 1; $i<= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            
            for ($j=1;$j<=$request->ep_por_temporada; $j++){
                $temporada->episodios()->create(['numero' =>$j]);
            }
        }

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
