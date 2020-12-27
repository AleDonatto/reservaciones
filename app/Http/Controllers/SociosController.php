<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Socios;

class SociosController extends Controller
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
            return Socios::all();
        }else{
            $socios = Socios::all();
            return view('components.consultaSocios')->with(compact('socios'));
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
        return view('components.socios');
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
        $validate = $request->validate([
            'RFC' => 'required|string',
            'nameContact' => 'required|string',
            'razonsocial' => 'required|string',
            'correo' => 'required|email',
            'telefono1' => 'required|integer', 
        ]);

        $socio = new Socios;
        $socio->RFC = $request->RFC;
        $socio->name = $request->razonsocial;
        $socio->phone1 = $request->telefono1;
        $socio->phone2 = $request->telefono2;
        $socio->email = $request->correo;
        $socio->website = $request->website;
        $socio->name_contact = $request->nameContact;
        $socio->idUser = 1;
        $socio->save(); 

        $notification = array(
            'messageHeader' => 'Socios',
            'messageDB' => 'Socio agregado con exito!',
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
            'email' => 'required|email',
            'idcompanies' => 'required|integer',
            'name' => 'required|string',
            'name_contact' => 'required|string',
            'phone1' => 'required|string',
            'phone2' => 'required|string',
            'user' => 'required|integer',
            'website' => 'required|string' 
        ]);

        Socios::where('idCompanies', $id)
        ->where('idUser', $request->user)
        ->update([
            'RFC' => $request->RFC,
            'name' => $request->name,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'email' => $request->email,
            'website' => $request->website,
            'name_contact' => $request->name_contact
        ]);

        $notification = array(
            'messageHeader' => 'Socios',
            'messageDB' => 'Datos del socio modificado con exito!',
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
