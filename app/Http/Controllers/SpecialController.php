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

        $listBookigns = DB::table('bookings')
        ->join('business_units','bookings.businessUnit','=','business_units.idUnits')
        ->join('tables_units','bookings.table','=','tables_units.idTables')
        ->select('business_units.idUnits','business_units.nameUnit','business_units.phone1','tables_units.num_mesa','tables_units.number_chairs','bookings.*')
        ->get();

        return $listBookigns;
    }

    public function getMesasUnidad($id){
        $mesas = Mesas::where('units',$id)->get();
        return $mesas;
    }

    public function postReservacion(Request $request){
        return $request;
    }
}
