<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $codigos = DB::table('code_verifications')
        ->join('companies','companies.idCompanies','=','code_verifications.companies')
        ->select('code_verifications.*','companies.name')
        ->get();

        return view('components.codigoseguridad')->with(compact('socios','codigos'));
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
            'code' => 'required',
            'fecha' => 'required|date',
            'companies' => 'required'
        ]);


        $codigo = new Codigos;
        $codigo->code_verification = $request->code;
        $codigo->date_expiration = $request->fecha;
        $codigo->user = Auth::id();
        $codigo->companies = $request->companies;
        $codigo->save();

        $codigos = DB::table('code_verifications')
        ->join('companies','companies.idCompanies','=','code_verifications.companies')
        ->select('code_verifications.*','companies.name')
        ->get();

        return json_encode($codigos);
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
        $validation = $request->validate([
            'companies' => 'required|integer',
            'fecha' => 'required',
            'idCode' => 'required|integer',
            'numero' => 'required|string',
            'user' => 'required|string'
        ]);

        Codigos::where('idCode', $id)
        ->where('user', $request->user)
        ->where('companies', $request->companies)
        ->update([
            'date_expiration' => $request->fecha,
        ]);

        $notification = array(
            'messageHeader' => 'Codigos de Registro',
            'messageDB' => 'Codigo Modificado con exito!',
            'alert-type' => 'success'
        );

        return $notification;


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
