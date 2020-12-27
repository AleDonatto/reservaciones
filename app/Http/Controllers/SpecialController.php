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
use App\UserUnits;

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
            $user->rol = 4;
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
            try{
                $fechanow = now()->toDateString();
                $vigencia = Carbon::parse($verificar_code->datedate_expiration); 

                if($fechanow <= $vigencia){

                    
                    $usuario = new User;
                    $usuario->name = $request->FirstName;
                    $usuario->lastname = $request->LastName;
                    $usuario->email = $request->InputEmail;
                    $usuario->password = Hash::make($request->InputPassword);
                    $usuario->rol = 2;
                    $usuario->client_id = '';
                    $usuario->save();
                    
                    $iduser = User::where('name',$request->FirstName)->where('lastname',$request->LastName)->first();

                    $affected = DB::table('companies')
                    ->where('idCompanies', $verificar_code->companies)
                    ->update(['iduser' => $iduser->id]);

                    $iduser->sendEmailVerificationNotification();

                    $registroCorrecto = array(
                        'mensaje' => 'Se ha registrado correctamente',
                        'title' => 'Registro Completado'
                    );
                    if (Auth::attempt(['email' => $request->InputEmail, 'password' => $request->InputPassword])) {
                        // Authentication passed...
                        return redirect()->route('home')->with($registroCorrecto);
                    }
                }else{
                    $error = array(
                        'mensaje' => 'El Codigo Ingresado Expiro',
                        'title' => ' Verifique Codigo'
                    );
                }

            }catch(QueryException $ex){
                $correo = array(
                    'mensaje' => $ex->getMessage(),
                    'title' => 'Email'
                );
                return back()->with($correo);
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
        ->join('clients','clients.idClients','=','bookings.clients')
        ->join('users','users.id','=','clients.idUser')
        ->select('bookings.B_hour','bookings.pax','bookings.status','users.name','users.lastname')
        ->where('bookings.B_date',$fecha)
        ->where('bookings.idtable',$id)
        ->get();
        
        return $booking;
    }

    public function getListUnidades(){
        $unidades = BusinessUnits::all();
        return $unidades;
    }

    public function getClientesResevaciones(){
        $idUsurio = Auth::id();
        $fecha = date('Y-m-d');

        $listBookigns = DB::table('bookings')
        ->join('business_units','bookings.businessUnit_id','=','business_units.idUnits')
        ->join('tables_units','bookings.table_id','=','tables_units.idTables')
        ->select('business_units.idUnits','business_units.nameUnit','business_units.phone1','tables_units.num_mesa','tables_units.number_chairs','bookings.*')
        ->where('bookings.bdate','>',$fecha)
        ->where('bookings.status',1)
        ->where('bookings.usuario_id',$idUsurio)
        ->get();

        return $listBookigns;
    }

    public function getClientesAllReservaciones(){
        $idUsurio = Auth::id();
        $idCliente = Clientes::where('idUser',$idUsurio)->select('idClients')->first();

        $cliente = $idCliente->idClients;

        $fecha = date('Y-m-d');

        $listBookings = DB::table('bookings')
        ->join('business_units','bookings.businessUnit_id','=','business_units.idUnits')
        ->join('tables_units','bookings.table_id','=','tables_units.idTables')
        ->select('business_units.nameUnit','tables_units.num_mesa','bookings.*')
        ->where('bookings.usuario_id',$idUsurio)
        ->get();

        return view('components.clientes.allBookings')->with(compact('listBookings','cliente'));
    }

    public function getAllReservacionCliente($idcliente){
        $listBookings = DB::table('bookings')
        ->join('business_units','bookings.businessUnit','=','business_units.idUnits')
        ->join('tables_units','bookings.idtable','=','tables_units.idTables')
        ->select('business_units.nameUnit','tables_units.num_mesa','bookings.*')
        ->where('bookings.clients',$idcliente)
        ->get(); 
        
        return $listBookings;
    }

    public function getMesasUnidad($id){
        $mesas = Mesas::where('units',$id)->get();
        return json_encode($mesas);
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

        $bookings = new Bookins;
        $bookings->businessUnit_id = $request->businessUnit;
        $bookings->table_id = $request->table;
        $bookings->usuario_id = $idUser;
        $bookings->bdate = $request->fecha;
        $bookings->bhour = $request->hora;
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

    public function getlistaunidades($id){
        $unidades = BusinessUnits::where('idcompany',$id)->get();
        return $unidades;
    }

    public function usuariosUnidad(){
        $idUsuario = Auth::id();
        $idCompany = Socios::where('idUser', $idUsuario)->first();
        $unidades = $this->getlistaunidades($idCompany->idCompanies);
        return view('components.socios.usuarioUnidad')->with(compact('unidades'));
    }

    public function getUsuariosUnidad(){
        $idUsuario = Auth::id();
        $idCompany = Socios::where('idUser', $idUsuario)->first();

        $listausuarios = DB::table('business_units')
        ->join('users_units', 'business_units.idUnits','=','users_units.unit_id')
        ->join('users', 'users_units.user_id','=','users.id')
        ->select('users.name','users.lastname','users.email','business_units.nameUnit')
        ->where('business_units.idcompany', $idCompany->idCompanies)
        ->get();

        return json_encode($listausuarios);
    }

    public function usuariosUnidadStore(Request $request){
         
        $validation = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'unidad' => 'required|integer'
        ]);

        $date = date('Y-m-d H:i:s');
        $rfc = BusinessUnits::where('idUnits', $request->unidad)->select('RFC')->first();
        $unidadUser = UserUnits::where('unit_id',$request->unidad)->count();

        if($unidadUser >= 1){
            $mensaje = array(
                'messageHeader' => 'Usuario de Unidad',
                'messageDB' => 'Ya se a creado un usuario de la unidad seleccionada!',
                'alert-type' => 'info'
            );
            return $mensaje;
        }

        try{
            $user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'email_verified_at' => $date,
                'password' => Hash::make($rfc->RFC),
                'rol' => 3,
                'client_id' => '',
                'created_at' => $date,
                'updated_at' => $date
            ]);

            $selectUser = User::where('email', $request->email)->select('id')->first();
            //$request->email->sendEmailVerificationNotification();

            $userunit = new UserUnits;
            $userunit->user_id = $selectUser->id;
            $userunit->unit_id = $request->unidad;
            $userunit->save();

    
            $mensaje = array(
                'messageHeader' => 'Usuario de Unidad',
                'messageDB' => 'Usuario creado, la contraseña por defecto es el RFC de la unidad de negocio!',
                'alerttype' => 'success'
            );
    
            return $mensaje;
        }catch(QueryException $ex){
            $mensaje = array(
                'messageHeader' => 'Usuario de Unidad',
                'messageDB' => $ex->getMessage(),
                'alerttype' => 'warning'
            );
            return $mensaje;
        }
    }

    public function adminFormReservacion(){
        $unidades = DB::table('business_units')
        ->select('business_units.*')
        ->get();

        return view('components.admin.formBookings')->with(compact('unidades'));
    }

    public function userAdministrador(){
        $usuarios = DB::table('users')
        ->select('users.name', 'users.lastname', 'users.email', 'users.rol')
        ->where('users.rol', 1)
        ->get();

        return view('components.admin.formUserAdmin')->with(compact('usuarios'));
    }

    public function createUserAdmin(Request $request){

        $validation = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email'
        ]);

        $date = date('Y-m-d H:i:s');

        $usuario = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'email_verified_at' => $date,
            'password' => Hash::make('quicktable'),
            'rol' => 1,
            'client_id' => '',
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $usuarios = DB::table('users')
        ->select('users.name', 'users.lastname', 'users.email', 'users.rol')
        ->where('users.rol', 1)
        ->get();
        
        return json_encode($usuarios);
    }



    //clientes
    public function postBuscarMesas(Request $request){

        $hora = $request->hora.':00';

        $mesas = DB::select("SELECT tables_units.* FROM tables_units WHERE NOT EXISTS (SELECT null FROM bookings WHERE bookings.table_id = tables_units.idTables".
        " AND bookings.bdate= "."'$request->fecha'"." AND bookings.bhour="."'$hora'".") AND tables_units.units = ".$request->businessUnit." GROUP BY tables_units.idTables");

        return $mesas;
    }

    public function formClientesReservacion(){
        return view('components.clientes.formReservacion');
    }

    public function cancelarReservacion($id){
        $booking = Bookins::where('idBooking',$id)->first();
        $horaUnidad = BusinessUnits::select('cancelation_time_limit')->where('idUnits',$booking->businessUnit_id)->first();

        $fechaNow = date('Y-m-d');

        $horaNow = Carbon::now();
        $horaNow->subHour(1);

        $horaReserva = Carbon::parse($booking->bhour); //date($booking->B_hour);
        $horapermitida = $horaReserva->subHour($horaUnidad->cancelation_time_limit);

        if( $fechaNow < $booking->bdate ){
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
        else if($fechaNow == $booking->bdate){
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

    public function consAllReservaciones(Request $request){

        if($request->fecha == '' ){
            $reservaciones = DB::table('bookings')
            ->join('users','bookings.usuario_id','=','users.id')
            ->join('tables_units','bookings.table_id','=','tables_units.idTables')
            ->select('users.name','users.lastname','users.rol','tables_units.num_mesa','bookings.*')
            ->where('bookings.businessUnit_id',$request->idNegocios)
            ->orderBy('bookings.created_at','desc')
            ->get();

            return json_encode($reservaciones);
        }
        else if($request->fecha == '' && $request->idNegocios = ''){
            return '';
        }
        else{
            $reservaciones = DB::table('bookings')
                ->join('users','bookings.usuario_id','=','users.id')
                ->join('clients','clients.idUser','=','users.id')
                ->join('tables_units','bookings.table_id','=','tables_units.idTables')
                ->select('users.name','users.lastname','users.rol','tables_units.num_mesa','bookings.*')
                ->where('bookings.businessUnit_id',$request->idNegocios)
                ->where('bookings.bdate', $request->fecha)
                ->orderBy('bookings.created_at','desc')
                ->get();

                return json_encode($reservaciones);
        }
    }

    public function confirmarLegadaReservacion(Request $request){
        $reservacion = Bookins::where('idBoking', $request->id)
        ->update([
            'status' => 3
        ]);

        $notificacion = array(
            'messageHeader' => 'Bookings',
            'messageDB' => 'Reservacion Confirmada!',
            'alert-type' => 'success'
        );

        return $notificacion;
    }

    public function confirmarAusenciaReservacion(Request $request){
        $reservacion = Bookins::where('idBooking', $request->id )
        ->update([
            'status' => 4
        ]);

        $notificacion = array(
            'messageHeader' => 'Bookings',
            'messageDB' => 'Reservacion Actualizada!',
            'alert-type' => 'success'
        );

        return $notificacion;
    }
    // fin clientes

    /** metodos **/
    public function profileUser(){
        return view('components.perfil');
    }

    public function getDatosUserProfile(){
        $idUser = Auth::id();
        $datosUser = User::where('id', $idUser)->first();

        return json_encode($datosUser);
    }

    public function updateDatosUserProfile(Request $request){

        $validation = $request->validate([
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'correo' => 'required|email'
        ]);

        $users = User::where('id',$request->id)
        ->update([
            'name' => $request->nombre,
            'lastname' => $request->apellidos,
            'email' => $request->correo
        ]);

        $notification = array(
            'title' => 'Datos del Pefil',
            'mensaje' => 'Datos actulizados correctamente!',
            'tipo' => 'success'
        );

        return $notification;
    }

    public function updatePassword(Request $request){
        $validation = $request->validate([
            'nueva' => 'required|string',
            'actual' => 'required|string',
            'confirmarNueva' => 'required|string' 
        ]);

        if($request->nueva == $request->confirmarNueva){

            $password = DB::table('users')->select('password')->where('id', Auth::id())->first();
            $passwordActual = $password->password;
            $passwordNueva = Hash::make($request->actual);

            if(Hash::check($request->actual, $passwordActual)){
                
                if($request->nueva != $request->actual ){
                    $updatePass = DB::table('users')
                    ->where('id', Auth::id())
                    ->update([
                        'password' => Hash::make($request->nueva)
                    ]);

                    $mensaje = array(
                        'title' => 'Cambio de Contraseña',
                        'mensaje' => 'La contraseña se actualizo correctamente',
                        'tipo' => 'success' 
                    );
                    return $mensaje;
                }else{
                    $mensaje = array(
                        'title' => 'Cambio de Contraseña',
                        'mensaje' => 'La nueva contraseña no puede ser igual que la anterior',
                        'tipo' => 'error' 
                    );
                    return $mensaje;
                }

            }else{
                $mensaje = array(
                    'title' => 'Cambio de Contraseña',
                    'mensaje' => 'La contraseña (actual) es incorrecta',
                    'tipo' => 'error' 
                );
                return $mensaje;
            }

        }else{
            $mensaje = array(
                'title' => 'Cambio de Contraseña',
                'mensaje' => 'La contraseña que intenta poner como nueva no coinciden',
                'tipo' => 'error' 
            );
            return $mensaje;
        }

    }

    public function getUsersReservaciones(){
        $idUsuario = Auth::id();

        $listBookings = DB::table('bookings')
        ->join('business_units','bookings.businessUnit_id','=','business_units.idUnits')
        ->join('tables_units','bookings.table_id','=','tables_units.idTables')
        ->select('business_units.nameUnit','tables_units.num_mesa','bookings.*')
        ->where('bookings.usuario_id',$idUsuario)
        ->get();

        return view('components.socios.consMisReservaciones')->with(compact('listBookings'));
    }

    public function getAdminReservaciones(){
        $idUsuario = Auth::id();

        $listBookings = DB::table('bookings')
        ->join('business_units','bookings.businessUnit_id','=','business_units.idUnits')
        ->join('tables_units','bookings.table_id','=','tables_units.idTables')
        ->select('business_units.nameUnit','tables_units.num_mesa','bookings.*')
        ->where('bookings.usuario_id',$idUsuario)
        ->get();

        return view('components.admin.consMisReservaciones')->with(compact('listBookings'));
    }

    public function adminAllBookings(){
        $unidades = BusinessUnits::all();
        
        return view('components.admin.consReservaciones')->with(compact('unidades'));
    }

    public function getAdminUsuariosUnidad(){

        $listausuarios = DB::table('business_units')
        ->join('users_units', 'business_units.idUnits','=','users_units.unit_id')
        ->join('users', 'users_units.user_id','=','users.id')
        ->select('users.name','users.lastname','users.email','business_units.nameUnit')
        ->get();

        return json_encode($listausuarios);
    }

    public function viewAdminUserUnits(){
        $unidades = BusinessUnits::all();

        return view('components.admin.usuariosUnidad')->with(compact('unidades'));
    }

}