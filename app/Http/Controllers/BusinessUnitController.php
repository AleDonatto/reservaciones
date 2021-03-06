<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Socios;
use App\BusinessUnits;
use Illuminate\Support\Facades\DB;

class BusinessUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $units = BusinessUnits::all();
            return $units;
        }else{
            $units = BusinessUnits::all();
            return view('components.consultaUnits')->with(compact('units'));
        }   
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
        return view('components.bussinesUnit')->with(compact('socios'));
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
        $validacion = $request->validate([
            'RFC' => 'required|string',
            'nameUnit' => 'required|string',
            'telefono1' => 'required|string',
            'correo' => 'required|email',
            'namecontact' => 'required|string',
            'horacancelation' => 'required'
        ]);

        if(!$request->file('imagen')){
            $negocios = new BusinessUnits;
            $negocios->idcompany = $request->company;
            $negocios->RFC = $request->RFC;
            $negocios->nameUnit = $request->nameUnit;
            $negocios->phone1 = $request->telefono1;
            $negocios->phone2 = $request->telefono2;
            $negocios->address = $request->correo;
            $negocios->webSite = $request->sitioweb;
            $negocios->nameContact = $request->namecontact;
            $negocios->cancelation_time_limit = $request->horacancelation;
            $negocios->imagen = '';
            $negocios->save();

            $notification = array(
                'messageHeader' => 'Negocios',
                'messageDB' => 'Unidad de negocio agregada con exito!',
                'alert-type' => 'success'
            );
    
            return $notification;
        }else{
            $eliminar = array(" ", ".");
            $nameImagen = mb_strtolower(str_replace($eliminar, "", $request->nameUnit));
            $path = $request->file('imagen')->storeAs('public', $nameImagen.'.jpg');

            $bussinesUnits = new BusinessUnits;
            $bussinesUnits->idcompany = $request->company;
            $bussinesUnits->RFC = $request->RFC;
            $bussinesUnits->nameUnit = $request->nameUnit;
            $bussinesUnits->phone1 = $request->telefono1;
            $bussinesUnits->phone2 = $request->telefono2;
            $bussinesUnits->address = $request->correo;
            $bussinesUnits->webSite = $request->sitioweb;
            $bussinesUnits->nameContact = $request->namecontact;
            $bussinesUnits->cancelation_time_limit = $request->horacancelation;  
            $bussinesUnits->imagen = $path;
            $bussinesUnits->save();

            $notification = array(
                'messageHeader' => 'Unidades de Negocio',
                'messageDB' => 'Unidad agregada con exito!',
                'alert-type' => 'success'
            );

            return $notification;
        }
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
        if (Request::ajax()) {
            $negocio = BusinessUnits::all();
            //$negocio = BusinessUnits::where('idcompany',Request::get('id'))->get();
            //return Response::json($negocio);
            return $negocio;
        }
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
