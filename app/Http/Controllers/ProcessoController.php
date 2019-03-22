<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Processo;
use App\Fluxo;

use Illuminate\Http\Request;

use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class ProcessoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function upload(Request $request)
    {
        if ($request->hasfile('image') && $request->image->isvalid())
        {
            $nome = $request->image->getClientOriginalName();
           // $extensao = $request->image->extension();
            $arquivo = $nome;
            //.$extensao;
            $diretorio ='public/a'.Auth::user()->id;

            $upload = $request->image->storeAs($diretorio, $arquivo);
           // dd($upload);

                if(!$upload)
                {
                    return redirect()->back()->with('Erro upload')->withInput();
                }
        }

    }

    private function download()
    {

        $caminho = 'a'.Auth::user()->id.'/'.'cismep servico.txt';
        $url = Storage::url($caminho);

       return $url;
    }




    public function index()
    {
        $processos = new Processo;
        $fluxo = Fluxo::distinct()->select('processo_id')->get();

        // $existe = $fluxo->contains('processo_id','25');
        // dd($existe);

        if (request()->has('processo')){
            $processos = $processos->where('processo', 'like', '%' . request('processo') . '%');
        }

        $atual = Auth::user()->id;

        $url = $this->download();

        $processos = $processos->where('atual','=', $atual);
        $processos = $processos->orderby('created_at', 'desc')->paginate(10);


        return view('processos.index', compact('processos','url','fluxo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('processos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $uploads = $this->upload($request);
        Processo::create($request->all());

        Session::flash('create_processo', 'processo cadastrado com sucesso!');

        return redirect(route('processos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $processo = Processo::findOrFail($id);

           return view('processos.show', compact('processo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $processo = Processo::findOrFail($id);

        return view('processos.edit', compact('processo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $processo = Processo::findOrFail($id);

        $processo->update($request->all());

        Session::flash('edited_processo', 'processo alterado com sucesso!');

        return redirect(route('processos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Processo::findOrFail($id)->delete();

        Session::flash('deleted_processo', 'processo excluído com sucesso!');

        return redirect(route('processos.index'));
    }
}
