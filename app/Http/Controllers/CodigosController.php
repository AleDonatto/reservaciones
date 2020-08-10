<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Socios;
use App\Codigos;

class CodigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $socios = Socios::all();
        $codigos = Codigos::all();
        return view('componets.codigoseguridad')->with(compact('socios','codigos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            'codigo' => 'required|integer',
            'fecha' => 'required|date',
            'socio' => 'required'
        ]);

        $codigo = new Codigos;
        $codigo->code_verification = $request->codigo;
        $codigo->date_expiration = $request->fecha;
        $codigo->user = Auth::id();
        $codigo->companies = $request->socio;
        $codigo->save();

        $notification = array(
            'messageHeader' => 'Codigos',
            'messageDB' => 'Codigo se seguridad agregado al socio!',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
