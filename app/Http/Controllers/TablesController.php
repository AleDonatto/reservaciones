<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessUnits;
use App\Mesas;

class TablesController extends Controller
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
        $unidades = BusinessUnits::all();
        return view('components.tablesUnits')->with(compact('unidades'));
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
            'numMesa' => 'required',
            'numerosillas' => 'required|integer' 
        ]);

        $mesas = new Mesas;
        $mesas->units = $request->negocio;
        $mesas->num_mesa = $request->numMesa;
        $mesas->number_chairs = $request->numerosillas;
        $mesas->status = '0';
        $mesas->save();

        $notification = array(
            'messageHeader' => 'Mesas',
            'messageDB' => 'Mesa agregada a la unidad!',
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
