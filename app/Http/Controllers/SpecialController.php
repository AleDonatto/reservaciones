<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Socios;
use App\Codigos;
use App\User;
use App\Clientes;
use App\BusinessUnits;
use App\Mesas;
use App\Bookins;

class SpecialController extends Controller
{
    //

    public function sendEmailVerificationNotification()
    {
        $this->notify(new Notifications\VerifyEmail);
    }

    public function RegistroClientes(Request $request){
        $validacion = $request->validate([
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'InputEmail' => 'required|email',
            'InputPassword' => 'required|string',
            'RepeatPassword' => 'required|string',
            'datebirth' => 'required|date',
            'telefono' => 'required|integer'
        ]);

        if($request->InputPassword != $request->RepeatPassword ){
            $password = array(
                'mensaje' => 'Las contraseñas no coinciden',
                'title' => 'Verifique la contraseña'
            );
            
            return back()->with($password);
        }

        try{
            $user = new User;
            $user->name = $request->FirstName;
            $user->lastname = $request->LastName;
            $user->email = $request->InputEmail;
            $user->password = Hash::make($request->InputPassword);
            $user->rol = 3;
            $user->client_id = '';
            $user->save();

            $iduser = User::where('email',$request->InputEmail)->first();

            $cliente = new Clientes;
            $cliente->phone = $request->telefono;
            $cliente->date_birth = $request->datebirth;
            $cliente->idUser = $iduser->id;
            $cliente->save();

            $iduser->sendEmailVerificationNotification();

            $registroCorrecto = array(
                'mensaje' => 'Se ha registrado correctamente',
                'title' => 'Registro Completado'
            );

            if (Auth::attempt(['email' => $request->InputEmail, 'password' => $request->InputPassword])) {
                // Authentication passed...
                return redirect()->route('home')->with($registroCorrecto);
            }
        }catch(QueryException $ex){
            $correo = array(
                'mensaje' => 'El correo que ingreso ya a sido registrado anteriormente',
                'title' => 'Email'
            );
            return back()->with($correo);
        }
    }

    public function RegistroSocios(Request $request){

        $validation = $request->validate([
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'InputEmail' => 'required|string',
            'code' => 'required',
            'InputPassword' => 'required|string',
            'RepeatPassword' => 'required|string'
        ]);

        if($request->InputPassword != $request->RepeatPassword){
            $error = array(
                'mensaje' => 'Las contraseñas no coinciden',
                'title' => 'Verifique Contraseñas'
            );
            return back()->with($error);
        }

        $verificar_code = Codigos::where('code_verification',$request->code)->first();

        if($verificar_code == ''){
            $error = array(
                'mensaje' => 'El codigo ingresado no coincide con ninguno de los registros',
                'title' => 'Verifique Codigo'
            );
            return back()->with($error);
        }else{
            
            $fechanow = now()->toDateString();
            $vigencia = Carbon::parse($verificar_code->datedate_expiration); 

            if($fechanow <= $vigencia){

                User::create([
                    'name' => $request->FirstName,
                    'lastname' => $request->LastName,
                    'email' => $request->InputEmail,
                    'password' => Hash::make($request->InputPassword),
                    'rol' => 2,
                    'client_id' => '',
                ]);
                
                $iduser = User::where('name',$request->FirstName)->where('lastname',$request->LastName)->first();

                $affected = DB::table('companies')
                ->where('idCompanies', $verificar_code->companies)
                ->update(['iduser' => $iduser->id]);

                $iduser->sendEmailVerificationNotification();

                $registroCorrecto = array(
                    'mensaje' => 'Se ha registrado correctamente',
                    'title' => 'Registro Completado'
                );
                return redirect('login_socios')->with($registroCorrecto);
            }else{
                $error = array(
                    'mensaje' => 'El Codigo Ingresado Expiro',
                    'title' => ' Verifique Codigo'
                );
            }
        }
    }

    public function loginClientes(Request $request){
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            $unidades = BusinessUnits::all();

            $array = array($unidades);
            return redirect('/home')->with(compact('unidades'));
        }
        $loginError = array(
            'mensaje' => 'Verifique sus credenciales'
        );
        return back()->with($loginError);
    }

    public function getListBookings($id, $fecha){
        $booking = DB::table('bookings')
        ->join('clients','clients.idCliets','=','bookings.clients')
        ->join('users','users.id','=','clients.idUser')
        ->select('bookings.hour','bookings.pax','bookings.status','users.name','users.lastname')
        ->where('bookings.date',$fecha)
        ->where('bookings.table',$id)
        ->get();
        
        return $booking;
    }

    public function getListUnidades(){
        $unidades = BusinessUnits::all();
        return $unidades;
    }

    public function getClientesResevaciones(){
        $idUsurio = Auth::id();
        $idCliente = Clientes::where('idUser',$idUsurio)->select('idClients')->first();

        $fecha = date('Y-m-d');

        $listBookigns = DB::table('bookings')
        ->join('business_units','bookings.businessUnit','=','business_units.idUnits')
        ->join('tables_units','bookings.idtable','=','tables_units.idTables')
        ->select('business_units.idUnits','business_units.nameUnit','business_units.phone1','tables_units.num_mesa','tables_units.number_chairs','bookings.*')
        ->where('bookings.B_date','>',$fecha)
        ->where('bookings.status',1)
        ->where('bookings.clients',$idCliente->idClients)
        ->get();

        return $listBookigns;
    }

    public function getClientesAllReservaciones(){
        $idUsurio = Auth::id();
        $idCliente = Clientes::where('idUser',$idUsurio)->select('idClients')->first();

        $fecha = date('Y-m-d');

        $listBookings = DB::table('bookings')
        ->join('business_units','bookings.businessUnit','=','business_units.idUnits')
        ->join('tables_units','bookings.idtable','=','tables_units.idTables')
        ->select('business_units.nameUnit','tables_units.num_mesa','bookings.*')
        ->where('bookings.clients',$idCliente->idClients)
        ->get();

        return view('components.clientes.allBookings')->with(compact('listBookings'));
    }

    public function getMesasUnidad($id){
        $mesas = Mesas::where('units',$id)->get();
        return $mesas;
    }

    public function postReservacion(Request $request){
    
        $validation = $request->validate([
            'businessUnit' => 'required|integer',
            'fecha' => 'required|date',
            'hora' => 'required',
            'personas' => 'required|integer',
            'table' => 'required|integer'
        ]);

        $idUser = Auth::id();
        $Cliente = Clientes::where('idUser',$idUser)->select('idClients')->first();

        $bookings = new Bookins;
        $bookings->businessUnit = $request->businessUnit;
        $bookings->idtable = $request->table;
        $bookings->clients = $Cliente->idClients;
        $bookings->B_date = $request->fecha;
        $bookings->B_hour = $request->hora;
        $bookings->pax = $request->personas;
        $bookings->status = 1;
        $bookings->save();

        $notificacion = array(
            'titulo' => 'Listo',
            'mensage' => 'La reservacion se a realizado con exito',
            'tipo' => 'success'
        );

        return $notificacion;
        
    }

    //clientes
    public function postBuscarMesas(Request $request){

        $hora = $request->hora.':00';

        $mesas = DB::select("SELECT tables_units.* FROM tables_units WHERE NOT EXISTS (SELECT null FROM bookings WHERE bookings.idtable = tables_units.idTables".
        " AND bookings.B_date= "."'$request->fecha'"." AND bookings.B_hour="."'$hora'".") AND tables_units.units = ".$request->businessUnit." GROUP BY tables_units.idTables");

        return $mesas;
    }

    public function formClientesReservacion(){
        return view('components.clientes.formReservacion');
    }

    public function cancelarReservacion($id){
        $booking = Bookins::where('idBooking',$id)->first();
        $horaUnidad = BusinessUnits::select('cancelation_time_limit')->where('idUnits',$booking->businessUnit)->first();

        $fechaNow = date('Y-m-d');

        $horaNow = Carbon::now();
        $horaNow->subHour(1);

        $horaReserva = Carbon::parse($booking->B_hour); //date($booking->B_hour);
        $horapermitida = $horaReserva->subHour($horaUnidad->cancelation_time_limit);

        if( $fechaNow < $booking->B_date ){
            $units = Bookins::where('idBooking',$id)
            ->update([
                'status' => 2,
            ]);

            $notificacion = array(
                'mensage' => 'La reservacion se a cancelado con exito',
                'tipo' => 'success'
            );
            $listaReservacion = $this->getClientesResevaciones();
            return compact('notificacion','listaReservacion');
        }
        else if($fechaNow == $booking->B_date){
            if($horaNow->toTimeString() < $horapermitida->toTimeString()){
                $units = Bookins::where('idBooking',$id)
                ->update([
                    'status' => 2,
                ]);
                
                $notificacion = array(
                    'mensage' => 'La reservacion se a cancelado con exito',
                    'tipo' => 'success'
                );
                
                $listaReservacion = $this->getClientesResevaciones();
                return compact('notificacion','listaReservacion');
            }
            else{
                $notificacion = array(
                    'mensage' => 'Ya no es posible cancelar su reservacion.',
                    'tipo' => 'error'
                );
                return $notificacion;
            }
        }else{
            $notificacion = array(
                'mensage' => 'Ya no es posible cancelar su reservacion.',
                'tipo' => 'error'
            );
            return $notificacion;
        }

    }

}
