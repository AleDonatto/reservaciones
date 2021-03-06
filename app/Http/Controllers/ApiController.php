<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\BusinessUnits;
use App\User;
use App\Clientes;
use App\Bookins;

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
        $bookings->usuario_id = $request->usuario_id;
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

    public function getAllReservacionesCliente($usuario){

        $listBookings = DB::table('bookings')
        ->join('business_units','bookings.businessUnit_id','=','business_units.idUnits')
        ->join('tables_units','bookings.table_id','=','tables_units.idTables')
        ->select('business_units.nameUnit','tables_units.num_mesa','bookings.*')
        ->where('bookings.usuario_id',$usuario)
        ->get(); 

        $response = [
            'success' => true,
            'data'    => $listBookings,
            'message' => 'ok',
        ];
        
        return response()->json($response, '200');
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

    public function modificarReservacion(Request $request){
        $validation = $request->validate([
            'id' => 'required|integer',
            'unidad' => 'required|integer',
            'mesa' => 'required|integer',
            'hora' => 'required',
            'fecha' => 'required',
            'pax' => 'required|integer',
            'usuarioId' => 'required|integer',
        ]);

        Bookins::where('idBooking', $request->id)
        ->where('businessUnit_id', $request->unidad)
        ->where('table_id', $request->mesa)
        ->where('usuario_id', $request->usuarioId)
        ->update([
            'bdate' => $request->fecha,
            'bhour' => $request->hora,
            'pax' => $request->pax,
        ]);

        $response = [
            'success' => true,
            'message' => 'Se a cambiado su reservacion',
        ];
        
        return response()->json($response,'200');
    }

    public function cancelarReservacion($idReservacion){

        $booking = Bookins::where('idBooking',$idReservacion)->first();
        $horaUnidad = BusinessUnits::select('cancelation_time_limit')->where('idUnits',$booking->businessUnit_id)->first();

        $fechaNow = date('Y-m-d');

        $horaNow = Carbon::now();
        $horaNow->subHour(1);

        $horaReserva = Carbon::parse($booking->bhour); //date($booking->B_hour);
        $horapermitida = $horaReserva->subHour($horaUnidad->cancelation_time_limit);

        if( $fechaNow < $booking->bdate ){
            $units = Bookins::where('idBooking',$idReservacion)
            ->update([
                'status' => 2,
            ]);

            $response = [
                'success' => true,
                'message' => 'Se cancelo su reservacion',
            ];
            
            return response()->json($response,'200');
        }
        else if($fechaNow == $booking->bdate){
            if($horaNow->toTimeString() < $horapermitida->toTimeString()){
                $units = Bookins::where('idBooking',$idReservacion)
                ->update([
                    'status' => 2,
                ]);

                $response = [
                    'success' => true,
                    'message' => 'Se cancelo su reservacion',
                ];
                
                return response()->json($response,'200');
            }
            else{
                $response = [
                    'success' => true,
                    'message' => 'Ya no es posible cancelar su reservacion.',
                ];
                
                return response()->json($response,'200');
            }
        }else{
            $response = [
                'success' => true,
                'message' => 'Ya no es posible cancelar su reservacion.',
            ];
            
            return response()->json($response,'200');
        }
    }
}
