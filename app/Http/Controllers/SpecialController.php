<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Socios;
use App\Codigos;
use App\User;

class SpecialController extends Controller
{
    //

    public function sendEmailVerificationNotification()
    {
        $this->notify(new Notifications\VerifyEmail);
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

        if($request->InputPassword !== $request->RepeatPassword){
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
}
