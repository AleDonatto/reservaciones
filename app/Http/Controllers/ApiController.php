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

        $user = DB::table('users')->where('email',$request->email)->first();

        if($user->rol != 4 ){
            return  response()->json([
                'status' => 'invalid_credentials',
                'message' => 'El usuario no es de tipo cliente.',
            ], 401);
        }

        return  response()->json([
            'status' => 'ok',
            'token' => $jwt_token,
            'data' => $user,
        ]);
    }

    public function getAllUnits(){
        $unidades = BusinessUnits::all();

        return response()->json([
            "data" => $unidades,            
        ]);

        //return json_encode($unidades);
    }

    public function getUnit($id){
        $unidades = BusinessUnits::where('idUnits', $id)->get();

        return response()->json([
            "data" => $unidades
        ]);
    }

    public function createBooking(Request $request){
        $validation = $request->validate([
            'unidad' => 'required|integer',
            'fecha' => 'required|date',
            'hora' => 'required',
            'pax' => 'required|integer',
            'mesa' => 'required|integer'
        ]);

        $bookings = new Bookins;
        $bookings->businessUnit_id = $request->unidad;
        $bookings->table_id = $request->mesa;
        $bookings->usuario_id = $request->usuarioId;
        $bookings->bdate = $request->fecha;
        $bookings->bhour = $request->hora;
        $bookings->pax = $request->pax;
        $bookings->status = 1;
        $bookings->save();

        $response = [
            'success' => true,
            'message' => 'Reservacion Creada',
        ];
        
        return response()->json($response,'200');
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
        
        return response()->json([
            "data" => $listBookings
        ]);
    }

    public function getMesasUnidad(Request $request){
        $hora = $request->hora.':00';

        $mesas = DB::select("SELECT tables_units.* FROM tables_units WHERE NOT EXISTS (SELECT null FROM bookings WHERE bookings.table_id = tables_units.idTables".
        " AND bookings.bdate= "."'$request->fecha'"." AND bookings.bhour="."'$hora'".") AND tables_units.units = ".$request->businessUnit." GROUP BY tables_units.idTables");

        $response = [
            'success' => true,
            'data'    => $mesas,
            'message' => 'ok',
        ];
        
        return response()->json($response,'200');
    }
}
