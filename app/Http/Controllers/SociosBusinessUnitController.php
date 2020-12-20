<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Socios;
use App\BusinessUnits;

class SociosBusinessUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        //
        $idUser = Auth::id();
        //$idSocio = Socios::select('idCompanies')->where('idUser',$idUser)->first();

        $negocios = DB::table('business_units')
        ->join('companies', 'companies.idCompanies', '=', 'business_units.idcompany')
        ->join('users', 'users.id', '=', 'companies.idUser')
        ->where('users.id',$idUser)
        ->select('business_units.*')
        ->get();
        
        if($request->ajax()){
            return $negocios;
        }else{
            return view('components.socios.consNegocios')->with(compact('negocios'));
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
        return view('components.socios.formNegocios');
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
            'RFC' => 'required|string',
            'correo' => 'required|email',
            'horacancelation' => 'required|integer',
            'nameUnit' => 'required|string',
            'namecontact' => 'required|string',
            'sitioweb' => 'required|string',
            'telefono1' => 'required|string',
            'telefono2' => 'required|string' 
        ]);

        $idUser = Auth::id();
        $idSocio = Socios::select('idCompanies')->where('idUser',$idUser)->first();

        if($request->imagen == null){

            $bussinesUnits = new BusinessUnits;
            $bussinesUnits->idcompany = $idSocio->idCompanies;
            $bussinesUnits->RFC = $request->RFC;
            $bussinesUnits->nameUnit = $request->nameUnit;
            $bussinesUnits->phone1 = $request->telefono1;
            $bussinesUnits->phone2 = $request->telefono2;
            $bussinesUnits->address = $request->correo;
            $bussinesUnits->webSite = $request->sitioweb;
            $bussinesUnits->nameContact = $request->namecontact;
            $bussinesUnits->cancelation_time_limit = $request->horacancelation;  
            $bussinesUnits->imagen = '';
            $bussinesUnits->save();

            $notification = array(
                'messageHeader' => 'Unidades de Negocio',
                'messageDB' => 'Unidad agregada con exito!',
                'alert-type' => 'success'
            );
    
            return $notification; 
        }

        $eliminar = array(" ", ".");
        $nameImagen = mb_strtolower(str_replace($eliminar, "", $request->nameUnit));
        $path = $request->file('imagen')->storeAs('public', $nameImagen.'.jpg');

        $bussinesUnits = new BusinessUnits;
        $bussinesUnits->idcompany = $idSocio->idCompanies;
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
        $unidades = BusinessUnits::where('idUnits',$id)->first();

        return view('components.socios.editNegocios')->with(compact('unidades'));
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
            'RFC' => 'required|string',
            'idCompany' => 'required|integer',
            'idUnit' => 'required|integer',
            'telefono1' => 'required|string',
            'telefono2' => 'required|string',
            'correo' => 'required|email',
            'sitioweb' => 'required|string',
            'nameUnit' => 'required|string',
            'namecontact' => 'required|string',
            'horacancelation' => 'required|integer'
        ]);

        if($request->imagen == null){

            $units = BusinessUnits::where('idUnits',$request->idUnit)
            ->where('idcompany',$request->idCompany)
            ->update([
                'RFC' => $request->RFC,
                'nameUnit' => $request->nameUnit,
                'phone1' => $request->telefono1,
                'phone2' => $request->telefono2,
                'address' => $request->correo,
                'webSite' => $request->sitioweb,
                'nameContact' => $request->namecontact,
                'cancelation_time_limit' => $request->horacancelation
            ]);
            
            $notification = array(
                'messageHeader' => 'Unidades de Negocio',
                'messageDB' => 'Datos modificados con exito!',
                'alert-type' => 'success'
            );

            return $notification;

        }else if($request->file('imagen')){

            Storage::delete($request->imagenAnterior);

            $eliminar = array(" ", ".");
            $nameImagen = mb_strtolower(str_replace($eliminar, "", $request->nameUnit));
            $path = $request->file('imagen')->storeAs('public', $nameImagen.'.jpg');    

            $units = BusinessUnits::where('idUnits',$request->idUnit)
            ->where('idcompany',$request->idCompany)
            ->update([
                'RFC' => $request->RFC,
                'nameUnit' => $request->nameUnit,
                'phone1' => $request->telefono1,
                'phone2' => $request->telefono2,
                'address' => $request->correo,
                'webSite' => $request->sitioweb,
                'nameContact' => $request->namecontact,
                'cancelation_time_limit' => $request->horacancelation,
                'imagen' => $path
            ]);

            $notification = array(
                'messageHeader' => 'Unidades de Negocio',
                'messageDB' => 'Datos modificados con exito!',
                'alert-type' => 'success'
            );

            return $notification;
        }
        
        $units = BusinessUnits::where('idUnits',$request->idUnit)
        ->where('idcompany',$request->idCompany)
        ->update([
            'RFC' => $request->RFC,
            'nameUnit' => $request->nameUnit,
            'phone1' => $request->telefono1,
            'phone2' => $request->telefono2,
            'address' => $request->correo,
            'webSite' => $request->sitioweb,
            'nameContact' => $request->namecontact,
            'cancelation_time_limit' => $request->horacancelation
        ]);

        $notification = array(
            'messageHeader' => 'Unidades de Negocio',
            'messageDB' => 'Datos modificados con exito!',
            'alert-type' => 'success'
        );

        return $notification;
        
        //return redirect()->route('socios_negocios.index')->with($notification);
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
