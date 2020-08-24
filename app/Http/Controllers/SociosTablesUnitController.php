<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mesas;
use App\Socios;

class SociosTablesUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->json()){
        }

        $idUser = Auth::id();
        $idSocio = Socios::select('idCompanies')->where('idUser',$idUser)->first();

        $mesas = DB::table('tables_units')
        ->join('business_units','business_units.idUnits','=','tables_units.units')
        ->select('business_units.nameUnit','tables_units.*')
        ->where('business_units.idcompany',$idSocio->idCompanies)
        ->get();

        return view('components.socios.consMesas')->with(compact('mesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('components.socios.formMesas');
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
            'idunidad' => 'required|integer',
            'numeromesa' => 'required|string',
            'sillas' => 'required|integer'
        ]);

        $mesa = new Mesas;
        $mesa->units = $request->idunidad;
        $mesa->num_mesa = $request->numeromesa;
        $mesa->number_chairs = $request->sillas;
        $mesa->status = 0;
        $mesa->save(); 

        $notification = array(
            'messageHeader' => 'Mesas del Negocio',
            'messageDB' => 'Mesa agregada con exito!',
            'alert-type' => 'success'
        );

        return $notification;
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
        $mesas = Mesas::where('units',$id)->get();
        return view('components.socios.showMesas')->with(compact('mesas'));
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
