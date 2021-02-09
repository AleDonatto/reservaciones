<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\BusinessUnits;
use App\Clientes;

class ApiController extends Controller
{
    //
    public function loginApp(Request $request){
        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return  response()->json([
                'status' => 'invalid_credentials',
                'message' => 'Correo o contraseña no válidos.',
            ], 401);
        }

        $user = DB::table('users')->where('email',$request->email)->get();

        return  response()->json([
            'status' => 'ok',
            'token' => $jwt_token,
            'data' => $user,
        ]);
    }

    public function getAllUnits(){
        $unidades = BusinessUnits::all()->toArray();

        return response()->json([
           "data" => $unidades,            
        ]);

        //return json_encode($unidades);
    }

    public function getUnit($id){
        $unidades = BusinessUnits::where('idUnits', $id)->get();

        return json_encode($unidades);
    }

    public function createBooking(Request $request){
        return $request;
    }

    public function getAllMisReservaciones($usuario){
        $idCliente = Clientes::where('idUser',$usuario)->select('idClients')->first();

        $cliente = $idCliente->idClients;

        $listBookings = DB::table('bookings')
        ->join('business_units','bookings.businessUnit','=','business_units.idUnits')
        ->join('tables_units','bookings.idtable','=','tables_units.idTables')
        ->select('business_units.nameUnit','tables_units.num_mesa','bookings.*')
        ->where('bookings.clients',$cliente)
        ->get(); 
        
        return json_decode($listBookings);
    }

    public function getReservacion($id){

    }
}
