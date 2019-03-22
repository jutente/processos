<?php

namespace App\Http\Controllers;

use App\Fluxo;
use App\Processo;
use App\Setor;
use App\User;

use Illuminate\Http\Request;

use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class FluxoController extends Controller
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
    public function index()
    {
        $processos = new Processo;

        if (request()->has('processo')){
            $processos = $processos->where('processo', 'like', '%' . request('processo') . '%');
        }
        $atual = Auth::user()->id;
       // dd($atual);

        $processos = $processos->where('user_id','=', $atual)->where('atual','<>', $atual);
        $processos = $processos->orderby('created_at', 'desc')->paginate(10);

        return view('fluxo.index', compact('processos'));
    }

    public function respondido()
    {
        $fluxos = new Fluxo;
        $processos = new Processo;

        if (request()->has('processo')){
            $processos = $processos->where('processo', 'like', '%' . request('processo') . '%');
        }

        $processos = $processos->where('atual','<>',Auth::user()->id);
        $processos = $processos->wherenotin('id', function($fluxos)
                                            {   $id = Auth::user()->id;
                                                $fluxos->select('processo_id')->from('fluxos')->where('user_id','=',$id);
                                            })->paginate(10);

        return view('fluxo.respondido', compact('processos'));
    }

    public function passagem($id)
    {

        $fluxos = new Fluxo;

        if (request()->has('processo')){
            $processos = $processos->where('processo', 'like', '%' . request('processo') . '%');
        }

        $fluxos = $fluxos->where('processo_id','=', $id);
        $fluxos = $fluxos->orderby('created_at', 'desc')->paginate(10);

        return view('fluxo.detalhar', compact('fluxos'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $setors = Setor::orderBy('setor')->pluck('setor', 'id');
        $users = User::orderBy('name')->pluck('name', 'id');
        $id = Session::get('key');
        Session::forget('key');
        $processos = Processo::find($id);
     //   dd($id);


        return view('fluxo.create', compact('setors','users','processos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $processo = Processo::findOrFail($request->processo_id);
        $user = User::where('setor_id', $request->setordestino)->first();
        $processo->atual = $user->id;
      //  dd($user->id);
        $processo->update();

        Fluxo::create($request->all() + ['setor_id' => $request->setordestino]);

        Session::flash('create_fluxo', 'fluxo cadastrado com sucesso!');

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
        session()->put('key', $id);
        return redirect(route('fluxo.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
