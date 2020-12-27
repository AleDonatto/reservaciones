<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Mesas;
use App\Socios;
use App\BusinessUnits;
use App\Bookins;

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
        if($request->ajax()){

            $mesas = DB::table('tables_units')
            ->select('tables_units.*')
            ->where('tables_units.units',$request->idUnidad)
            ->get();

            return $mesas;
        }

        $idUser = Auth::id();
        $idSocio = Socios::select('idCompanies')->where('idUser',$idUser)->first();
        $unidades = BusinessUnits::where('idcompany', $idSocio->idCompanies)->get();

        return view('components.socios.consMesas')->with(compact('unidades'));
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
        $dateNow = now();
        $idUnidad = $id;
        
        $mesas = Mesas::where('units',$id)->get();

        $bookings = DB::table('clients')
        ->join('users','users.id','=','clients.idUser')
        ->join('bookings','bookings.usuario_id','=','users.id')
        ->select('users.name','users.lastname','clients.phone','bookings.*')
        ->where('bookings.businessUnit_id',$id)
        ->where('bookings.bdate',$dateNow->toDateString())
        ->where('bookings.status',1)
        ->get();

        return view('components.socios.showMesas')->with(compact('idUnidad','mesas','bookings'));
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
            'num_mesa' => 'required|string',
            'number_chairs' => 'required|integer',
            'status' => 'required|string'
        ]);

        $units = Mesas::where('idTables',$request->idTables)
        ->update([
            'num_mesa' => $request->num_mesa,
            'number_chairs' => $request->number_chairs,
            'status' => $request->status
        ]);

        $notification = array(
            'messageHeader' => 'Mesas',
            'messageDB' => 'Mesa actualizada con exito!',
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
