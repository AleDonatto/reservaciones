<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Bookins;
use App\BusinessUnits;
use App\Mesas;
use App\Socios;

class SociosReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $idcompany = Socios::where('idUser', Auth::id())->first();
        $unidades = BusinessUnits::where('idcompany',$idcompany->idCompanies)->get();
        return view('components.socios.consBookings')->with(compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
        $date = date('Y-m-d');
        $booking = DB::table('bookings')
        ->join('clients','clients.idClients','=','bookings.clients')
        ->join('users','users.id','=','clients.idUser')
        ->select('bookings.hour','bookings.pax','bookings.status','users.name','users.lastname')
        ->where('bookings.date',$date)
        ->where('bookings.table',$id)
        ->get();
        return view('components.socios.showBookings')->with(compact('booking'));
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
