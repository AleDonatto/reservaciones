<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserUnits;
use App\BusinessUnits;
use App\Mesas;

class UserUnitsController extends Controller
{
    //
    public function viewUnidad(){
        $idUser = Auth::id();
        $idunidad = UserUnits::where('user_id', $idUser)->first();
        $unidad = BusinessUnits::where('idUnits',$idunidad->unit_id)->get();

        return view('components.userunits.unidadNegocio')->with(compact('unidad'));
    }

    public function viewFormMesas(){
        $idUser = Auth::id();
        $idunidad = UserUnits::where('user_id', $idUser)->first();
        $unidad = BusinessUnits::where('idUnits',$idunidad->unit_id)->get();

        return view('components.userunits.formMesas')->with(compact('unidad'));
    }

    public function viewConsultaMesas(){
        $idUser = Auth::id();
        $idunidad = UserUnits::where('user_id', $idUser)->first();
        $mesas = Mesas::where('units',$idunidad->unit_id)->get();

        return view('components.userunits.consMesas')->with(compact('mesas'));
    }

    public function viewFormReservaciones(){
        $idUser = Auth::id();
        $idunidad = UserUnits::where('user_id', $idUser)->first();
        $unidad = BusinessUnits::where('idUnits',$idunidad->unit_id)->get();

        return view('components.userunits.formReservaciones')->with(compact('unidad'));
    }

    public function viewConsReservaciones(){
        $idUser = Auth::id();
        $idunidad = UserUnits::where('user_id', $idUser)->first();
        $unidad = BusinessUnits::where('idUnits',$idunidad->unit_id)->get();

        return view('components.userunits.consReservaciones')->with(compact('unidad'));
    }

}
