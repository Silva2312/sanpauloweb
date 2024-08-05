<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Function_;
use PhpParser\Node\Stmt\TryCatch;
//acomodar la fecha
use Carbon\Carbon;

//para obtener el id del admin
use Illuminate\Support\Facades\Session;

//paginacion
use Livewire\Components;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Facades\App;
//Para descargar el pdf
use Barryvdh\DomPDF\Facade\Pdf;

//correo
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarPassword;

class UsuarioController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        // Validaciones
    /*$request->validate([
        'usuario' => 'required|max:255',
        'password' => 'required'
    ]); */
    
    $validator = Validator::make($request->all(), [
        'usuario' => 'required|max:255',
        'password' => 'required'
    ]);

    $usuario = $request->input('usuario');
    $password = $request->input('password');

    if ($validator->fails()) {
        return redirect()->route('login_try')
            ->withErrors($validator)
            ->withInput();
    }

    $validacion = DB::select('SELECT * FROM supervisor WHERE supervisor.Nombre = ? AND supervisor.Contraseña = ?', [$usuario, $password]);
    
        // Si las credenciales son válidas
        if($validacion != null){
            foreach ($validacion as $supervisorr) {
                Session::put('cargo_supervisor', $supervisorr->IdCargo);
                Session::put('Id_supervisor', $supervisorr->Idsup);
                Session::put('passwd_supervisor', $supervisorr->Contraseña);
            }

            $datos = $request->input();
            // Guardar el nombre de usuario en una variable global
            $request->session()->put('usuario', $datos['usuario']);

            // Redireccionar a la URL del menu
            return redirect()->route('dashboard');

        } else {
            
            if ($validacion == null) {
                session()->flash('status', 'Nombre de Usuario o Password incorrecto, vuelve a intentarlo');
                return redirect()->route('login_try')
                    ->withErrors($validator)
                    ->withInput();
            }

        }
    }

    //al intentar iniciar sesion, ingresar usuario o password incorrectos
    public function Inicio_Login(){
        return view('welcome');
    }

    //recuperar password part 1
    public function Inicio_recuperarPassword(){
        //abrir el modal de recuperar password
        session()->flash('correoFlash', 'cambiar password');

        return view('welcome');
    }

    //recuperar password part 2
    public function RecuperarPassword(Request $request){
        
        $this->deleteFlashVariable();
        $id_supervisor="";
        $update="";

        $validator = Validator::make($request->all(), [
            'correo' => 'required|email:rfc,dns'
        ]);
        $correo = $request->input('correo');
        

        if ($validator->fails()) {
            //return redirect('Usuario/create')
            session()->flash('correoFlash', 'cambiar password');
            return redirect()->route('log_pass')
                ->withErrors($validator)
                ->withInput();
        }

        $query=DB::select('select Correo, Idsup from supervisor where supervisor.Correo = ?', [$correo]);

        if($query != null){
            // Generar una nueva contraseña aleatoria
            $nuevaContrasena = $this->generarContrasenaAleatoria();

            //obtener el ID del supervisor
            foreach ($query as $key => $qr) {
                $id_supervisor = $qr->Idsup;
            }

            //actualizar la contrasena
            $update =  DB::table('supervisor')->where('Idsup', $id_supervisor)
                ->update(array( 
                            'Contraseña' => $nuevaContrasena));
            if ($update!=null) {
                //enviando el nuevo password al correo asociado
                $this->enviarCorreo($correo, $nuevaContrasena);
                
                session()->flash('actualizar', 'registro Modificado Correctamente');
                return view('Menu.Save2', ['msg'=>'Se ha restablecido la contraseña para '. $correo .'. Se ha enviado una nueva contraseña al correo electrónico asociado.']);
                
            }else{
                if ($query==null) {
                    session()->flash('correo_error', 'Error al reestablecer el correo');
                    return redirect()->route('log_pass')
                        ->withErrors($validator)
                        ->withInput();
                }
            }

        }else{

            if ($query==null) {
                session()->flash('correo_error', 'Correo no esta registrado en la base de datos');
                return redirect()->route('log_pass')
                    ->withErrors($validator)
                    ->withInput();
            }

        }
    }
    //recuperar password part 3
    public function generarContrasenaAleatoria(){
        $longitud = 8; // Longitud de la contraseña
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $contrasena = '';
        
        for ($i = 0; $i < $longitud; $i++) {
            $contrasena .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        
        return $contrasena;
    }
    //recuperar password part 4
    public function enviarCorreo($destinatario, $contrasena){

        //a que correo se va a enviar
        $toEmail = $destinatario;

        $from_cuenta = "luisokokoa@gmail.com";
        $reply_cuenta = "silva23062001@hotmail.com";

        // Asunto del correo electrónico
        $asunto = "Contraseña restablecida";
    
        $passwd = $contrasena;

        Mail::to($toEmail)->send(new RecuperarPassword($asunto, $passwd, $from_cuenta, $reply_cuenta));

        //dd($respuesta);
    }
    
    /**
     * Insert - Part 1
     */
    public function create()
    {
        $this->deleteFlashVariable();

        session()->flash('addUser', 'registro en proceso de modificarse');

        //redirecciona al menu cuando se inserta un nuevo registro para la paginacion      
        return redirect()->route('dashboard_insert');
        
    }

    //insertar - paginacion
    public function MenuInsertar(){
        
        //datos para la tabla
        $totalPaginacion = 10;

            //tabla del menu
            $lista = DB::table('usuario')
            ->join('cargos', 'usuario.IdCargo', '=', 'cargos.IdCargo')
            ->join('horarios', 'usuario.IdHorario', '=', 'horarios.IdHorario')
            ->select('usuario.*', 'cargos.*', 'horarios.Turno as turno')
            ->orderBy('usuario.Nombres', 'asc')
            //->get();
            ->paginate($totalPaginacion);
        //para el modal
        $cargos = DB::select('SELECT * FROM cargos');
        $horarios = DB::select('SELECT * FROM horarios');

        return view('Menu.index', compact('lista'),['cargos'=>$cargos, 'horarios'=>$horarios]);
    }

    /**
     * Insert - guardar - control de errores
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //ya permite el domicilio el simbolo #
            'nombre' => 'required|string|max:50|regex:/^[^\d]+$/',
            'paterno' => 'required|string|max:50|regex:/^[^\d]+$/',
            'materno' => 'required|string|max:50|regex:/^[^\d]+$/',
            'domicilio' => 'required|max:100|regex:/^[a-zA-Z0-9\s#]+$/',
            'telefono' => 'required|digits:10',
            'codigo' => 'required|digits:4',
            'cargo' => 'required',
            'horario' => 'required'
        ]);

        $nombre = $request->input('nombre');
        $paterno = $request->input('paterno');
        $materno = $request->input('materno');
        $domicilio = $request->input('domicilio');
        $telefono = $request->input('telefono');
        $codigo = $request->input('codigo');
        $cargo = $request->input('cargo');
        $horario = $request->input('horario');

        if ($validator->fails()) {
            session()->flash('addUser', 'registro en proceso de modificarse');
            return redirect('/Menu/Insertar')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            DB::table('usuario')->insert(
                array(
                       'Nombres'     =>   $nombre, 
                       'Apellido1'   =>   $paterno,
                       'Apellido2' => $materno,
                       'Domicilio' => $domicilio,
                       'Telefono' => $telefono,
                       'Codigo' => $codigo,
                       'IdCargo' => $cargo,
                       'IdHorario' => $horario
                )
           );
        
           session()->flash('insertar', 'registro agregado Correctamente');
            return view('Menu.Save', ['msg'=>'registro agregado correctamente']);

        } catch (Exception $th) {
            echo "Error";
        }

    }

    //crear un nuevo supervisor
    public function CreateAdmin()
    {
        $this->deleteFlashVariable();

        session()->flash('addAdmin', 'registro en proceso de modificarse');
        //redireccionar para la paginacion
        return redirect()->route('dashboard_insert');
    }
    //para la paginacion al crear un nuevo supervisor
    public function NuevoAdmin(Request $request)
    {

        $validator = Validator::make($request->all(), [
        
            'telefono' => 'required|digits:10',
            'nombre_usuario' => 'required|string|min:4|max:50|regex:/^[a-zA-Z_]+[0-9]*$/',
            'correo' => 'required|email:rfc,dns',
            'password1' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,20}$/',
            'password2' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,20}$/'
        ]);

        $nombre_usuario = $request->input('nombre_usuario');
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');
        $passwd1 = $request->input('password1');
        $passwd2 = $request->input('password2');

        //en caso de algun error volver al metodo anterior
        if ($validator->fails()) {
            session()->flash('addAdmin', 'registro en proceso de modificarse');
            return redirect('/Menu/Insertar')
                ->withErrors($validator)
                ->withInput();
        }

        //control de errores, no se repitan datos de la base de datos
        $validarNombreUsuario = DB::select('SELECT Nombre FROM supervisor WHERE supervisor.Nombre = ?', [$nombre_usuario]);

        $validarCorreo = DB::select('SELECT Correo FROM supervisor WHERE supervisor.Correo = ?', [$correo]);

        $validarTelefono = DB::select('SELECT NumTelefono FROM supervisor WHERE supervisor.NumTelefono = ?', [$telefono]); 

        $contadorErrores = 0;
       
        //si hay un registro con ese nombre
        if($validarNombreUsuario != null){
            $contadorErrores++;
            session()->flash('insert_error1', 'Nombre de usuario ya esta ocupado, vuelve a intentarlo');
        }

        //si ya existe ese correo registrado
        if($validarCorreo != null){
            $contadorErrores++;
            session()->flash('insert_error2', 'Correo ya esta ocupado, vuelve a intentarlo');
        }
        //si el telefono ya esta registrado
        if ($validarTelefono != null) {
            $contadorErrores++;
            session()->flash('insert_error3', 'Telefono ya esta ocupado, vuelve a intentarlo');
        }
        //si no coincide el password
        if($passwd1 != $passwd2){
            $contadorErrores++;
            session()->flash('insert_error4', 'Las contraseñas no coinciden');
        }

        //si hay por lo menos un error
        if($contadorErrores > 0){
            session()->flash('addAdmin', 'agregando un nuevo supervisor');
            //en caso de que se repita algun valor

            return redirect('/Menu/Insertar')
                ->withErrors($validator)
                ->withInput();
            }

            try {
                
                DB::table('supervisor')->insert(
                    array(
                        'Nombre' => $nombre_usuario, 
                        'Correo' => $correo, 
                        'NumTelefono' => $telefono
                    )
            );
            
                session()->flash('insertar', 'registro agregado Correctamente');
                return view('Menu.Save', ['msg'=>'registro Modificado correctamente']);
                
            } catch (Exception $th) {
                echo "Error";
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * update part 1
     */
    public function edit(string $id)
    {
        $this->deleteFlashVariable();
        //para el modal de actualizar
        session()->flash('newRegister', 'registro en proceso de modificarse');

        //para la paginacion
        return redirect('/Menu/' .$id. '/Actualizar');
    }

    //paginacion, al dar clic en el boton de actualizar
    public function MenuActualizar(string $id){

        //datos modal de actualizar
        $usuario = DB::table('usuario')
            ->select('usuario.*')
            ->where('usuario.idusuario', '=', $id, )
            ->get()
            ->first();

        $totalPaginacion = 10;

        //tabla del menu
            $lista = DB::table('usuario')
            ->join('cargos', 'usuario.IdCargo', '=', 'cargos.IdCargo')
            ->join('horarios', 'usuario.IdHorario', '=', 'horarios.IdHorario')
            ->select('usuario.*', 'cargos.*', 'horarios.Turno as turno')
            ->orderBy('usuario.Nombres', 'asc')
            //->get();
            ->paginate($totalPaginacion);

        //para el modal
        $cargos = DB::select('SELECT * FROM cargos');
        $horarios = DB::select('SELECT * FROM horarios');

        return view('Menu.index', compact('lista'),['list'=>$usuario, 'cargos'=>$cargos, 'horarios'=>$horarios]);
    }

    /**
     * Update part 2 - guardar - control de errores
     */
    public function update(Request $request, string $id)
    {

            $validator = Validator::make($request->all(), [
                
                'nombre' => 'required|string|max:50|regex:/^[^\d]+$/',
                'paterno' => 'required|string|max:50|regex:/^[^\d]+$/',
                'materno' => 'required|string|max:50|regex:/^[^\d]+$/',
                'domicilio' => 'required|max:100|regex:/^[a-zA-Z0-9\s#]+$/',
                'telefono' => 'required|digits:10',
                'codigo' => 'required|digits:4',
                'cargo' => 'required',
                'horario' => 'required'
            ]);
        
            $nombre = $request->input('nombre');
            $paterno = $request->input('paterno');
            $materno = $request->input('materno');
            $domicilio = $request->input('domicilio');
            $telefono = $request->input('telefono');
            $codigo = $request->input('codigo');
            $cargo = $request->input('cargo');
            $horario = $request->input('horario');
            
            if ($validator->fails()) {
                session()->flash('newRegister', 'registro en proceso de modificarse');
                return redirect('/Menu/' .$id. '/Actualizar')
                    ->withErrors($validator)
                    ->withInput();
            }

            $contadorErrores = 0;

            $validarTelefono = DB::select('SELECT * FROM usuario WHERE usuario.Telefono = ? AND usuario.idusuario != ?', [$telefono, $id]);

            $validarCodigo = DB::select('SELECT * FROM usuario WHERE usuario.Codigo = ? AND usuario.idusuario != ?', [$codigo, $id]);

            //en caso de que exista un registro con esos datos
            if($validarTelefono != null){
                $contadorErrores++; 
                session()->flash('update_error1', 'Numero de telefono esta ocupado, vuelve a intentarlo');
            }

            if($validarCodigo != null){
                $contadorErrores;
                session()->flash('update_error2', 'Codigo esta ocupado, vuelve a intentarlo');
            }

            if($contadorErrores > 0 ){
                session()->flash('newRegister', 'registro en proceso de modificarse');
                return redirect('/Menu/' .$id. '/Actualizar')
                    ->withErrors($validator)
                    ->withInput();
            }

            try {
                
                DB::table('usuario')->where('idusuario', $id)
                ->update(array('Nombres' => $nombre, 
                                'Apellido1' => $paterno, 
                                'Apellido2' => $materno,
                                'Domicilio'=>$domicilio,
                                'Telefono'=>$telefono,
                                'Codigo'=>$codigo,
                                'IdCargo'=>$cargo,
                                'IdHorario'=>$horario));

                session()->flash('actualizar', 'registro Modificado Correctamente');

                return view('Menu.Save', ['msg'=>'registro Modificado correctamente']);
                
            } catch (Exception $th) {
                echo "Error";
            }
        
    }

    //obtener datos con javascript para el cuadro modal de eliminar
    public function eliminar(string $id)
    {
        $usuario = DB::table('usuario')
            ->select('usuario.*')
            ->where('usuario.idusuario', '=', $id )
            ->get()
            ->first();
        
        return $usuario;

    }


    /**
     * Eliminar un registro
     */
    public function destroy(Request $request, string $id)
    {
        $identificador = $request->input('Id');

        try {
            
            DB::table('usuario')->where('idusuario', '=',$identificador)->delete();

            session()->flash('eliminar', 'registro Eliminado Correctamente');
            return view('Menu.Save', ['msg'=>'registro Eliminado correctamente']);

        } catch (Exception $e) {
            echo "Error";
        }
    }

    //cuando se inserte, modifique o elimine un registro, para volver al menu principal
    public function MenuPrincipal(Request $request){

        $totalPaginacion = 10;

            //tabla del menu
            $lista = DB::table('usuario')
            ->join('cargos', 'usuario.IdCargo', '=', 'cargos.IdCargo')
            ->join('horarios', 'usuario.IdHorario', '=', 'horarios.IdHorario')
            ->select('usuario.*', 'cargos.*', 'horarios.Turno as turno')
            ->orderBy('usuario.Nombres', 'asc')
            //->get();
            ->paginate($totalPaginacion);

            return view('Menu.index', compact('lista'));
       
    }

    //las opciones del buscador, barra de opciones
    public function search(Request $request){

        $term = $request->get('term');
        
        $result = DB::table('usuario')
            ->where('Nombres','like','%'.$term.'%')
            ->get();
  
            $data = [];

            foreach ($result as $item) {
                # code...
                $data[] = [
                    'label'=>$item->Nombres
                ]; 
            }
            return $data; 
    }
    //buscador al dar enter
    public function Filtro(Request $request){

        $this->deleteFlashVariable();

        $busqueda = $request->input('search');

        //en caso de que se busque un nombre en especifico
        if($busqueda != null){

            return redirect('/Menu/'. $busqueda .'/Filtro');

        }else {

            return redirect()->route('dashboard');

        }

    }

    //cuando se busque algo en el buscador que no sea null
    public function MenuFiltro(string $termino){

        $totalPaginacion = 10;

        $busqueda = $termino;

        $lista = DB::table('usuario')
            ->join('cargos', 'usuario.IdCargo', '=', 'cargos.IdCargo')
            ->join('horarios', 'usuario.IdHorario', '=', 'horarios.IdHorario')
            ->select('usuario.*', 'cargos.*', 'horarios.Turno as turno')
            ->where('usuario.Nombres','LIKE','%'.$busqueda."%")
            ->orderBy('usuario.Nombres', 'asc')
            //->get();
            ->paginate($totalPaginacion);

        return view('Menu.index', compact('lista'));

    }

    //llenar la tabla con el buscador con javascript
    public function buscar(Request $request){

        $totalPaginacion = 10;

        if($request->ajax()){
            $output="";

            $usuarios = DB::table('usuario')
            ->join('cargos', 'usuario.IdCargo', '=', 'cargos.IdCargo')
            ->join('horarios', 'usuario.IdHorario', '=', 'horarios.IdHorario')
            ->select('usuario.*', 'cargos.*', 'horarios.Turno as turno',
            DB::raw("CONCAT(usuario.Apellido1, ' ', usuario.Apellido2) as Apellidos"))
            ->where('Nombres','LIKE','%'.$request->search."%")
            ->orderBy('usuario.Nombres', 'asc')
            //->get();
            ->paginate($totalPaginacion);

            return response()->json($usuarios);
       }
    }

    //Pagina de los reportes
    public Function Reporte(){
        return view('Menu.nuevoReporte');
    }
    //al seleccionar 2 fechas
    public Function GenerarReporte(Request $request){

        //verificar que se seleccionen las 2 fechas
        $this->deleteFlashVariable();

        $validator = Validator::make($request->all(), [
                
            'fechaInicio' => 'required|date_format:Y-m-d',
            'fechaFin' => 'required|date_format:Y-m-d'
        ]);

        $inicio = $request->input('fechaInicio');
        $fin = $request->input('fechaFin');

        if ($validator->fails()) {

            session()->flash('errorReporte', 'No existe ningun registro vuelve a intentarlo');
            return redirect('Reporte')
                ->withErrors($validator)
                ->withInput();
        }

        //acomodando la fecha para que este en un orden Y-m-d
        $fechaInicio = Carbon::createFromFormat('Y-m-d', $inicio);
        $fechaFin = Carbon::createFromFormat('Y-m-d', $fin);

        $mesInicio = $fechaInicio->month;
        $mesFin = $fechaFin->month;

        $diaInicio = $fechaInicio->day;
        $diaFin = $fechaFin->day;

        $registros = DB::table('registrodeacceso')
        ->join('usuario', 'registrodeacceso.Idusuario', '=', 'usuario.idusuario')
        ->select('registrodeacceso.Fecha', 'registrodeacceso.HoraIngreso', 'registrodeacceso.HoraSalida', 'usuario.Nombres',
                DB::raw("CONCAT(usuario.Apellido1, ' ', usuario.Apellido2) as Apellidos"))
        ->whereDate('registrodeacceso.Fecha', '>=', $fechaInicio)
        ->whereDate('registrodeacceso.Fecha', '<=', $fechaFin)
        ->get();

            //solo si existe un registro va a aparecer la tabla        
            if ($registros != null) {
                //cuando se genere un nuevo reporte correctamente
                session()->flash('nuevoReporte', 'Nuevo Reporte');
                return view('Menu.nuevoReporte', ['lista'=>$registros, 'FechaIni'=>$fechaInicio, 'FechaFin'=>$fechaFin, 'mesInicial'=>$mesInicio, 'mesFinal'=>$mesFin, 'diaInicial'=>$diaInicio, 'diaFinal'=>$diaFin]);
            }else{
                //control de errores
                session()->flash('errorReporte', 'No existe ningun registro vuelve a intentarlo');
                return view('Menu.nuevoReporte');
            }
        
    }

    public function DescargarReporte(Request $request){

        $request->validate([
            'fechaInicio' => 'required',
            'fechaFin' => 'required'
        ]);
        
        //obtener una representación de la fecha en forma de cadena en el formato 'Y-m-d' (año-mes-día). 
        $fechaInicio = Carbon::parse($request->input('fechaInicio'))->toDateString();
        $fechaFin = Carbon::parse($request->input('fechaFin'))->toDateString();

        $registros = DB::table('registrodeacceso')
            ->join('usuario', 'registrodeacceso.Idusuario', '=', 'usuario.idusuario')
            //->select('registrodeacceso.Fecha', 'registrodeacceso.HoraIngreso', 'registrodeacceso.HoraSalida', 'usuario.Nombres', 'usuario.Apellido1', 'Apellido2')
            ->select('registrodeacceso.Fecha', 'registrodeacceso.HoraIngreso', 'registrodeacceso.HoraSalida', 'usuario.Nombres',
                DB::raw("CONCAT(usuario.Apellido1, ' ', usuario.Apellido2) as Apellidos"))
            ->whereDate('registrodeacceso.Fecha', '>=', $fechaInicio)
            ->whereDate('registrodeacceso.Fecha', '<=', $fechaFin)
            ->get();

        //solo si existe un registro va a aparecer la tabla        
        if ($registros != null) {
            //cuando se genere un nuevo reporte correctamente
            //descargarlo con DomPDF
            $pdf = Pdf::loadView('Menu.descargarPDF', ['lista'=>$registros, 'FechaIni'=>$fechaInicio, 'FechaFin'=>$fechaFin]);
            return $pdf->stream();
        }
        
    }
    //cambiar password - ingresar la contraseña actual, de lo contrario va a aparecer un msg error
    public function Password(Request $request){

        $this->deleteFlashVariable();
        session()->flash('password', 'deseas cambiar password');
        return redirect()->route('dashboard');

    }
    //al ingresar la nueva contraseña, si no coinciden va a aparecer un msg de error
    public function RepetirPassword(Request $request){

        $this->deleteFlashVariable();
        session()->flash('cambiarPassword', 'repetir password');
        return redirect()->route('dashboard');
    }
    //al ingresar la contraseña actual
    public function CambiarPassword(Request $request){

        $this->deleteFlashVariable();

        $validator = Validator::make($request->all(), [
            'passwd' => 'required'
        ]);

        if ($validator->fails()) {
                //return redirect('/Password')
                session()->flash('password', 'deseas cambiar password');
                return redirect()->route('dashboard')
                ->withErrors($validator)
                ->withInput();
        }

        $passwd = $request->input('passwd');
        $storedPassword = session('passwd_supervisor');

        //en caso de que no se ingrese la contraseña actual del supervisor
        if($passwd != $storedPassword) {
            //return redirect('/Password')
            session()->flash('password', 'Vuelve a intentarlo');
            session()->flash('pass_actual', 'No es tu contraseña, vuelve a intentarlo');
            return redirect()->route('dashboard')
                ->withErrors("Contraseña incorrecta")
                ->withInput();
        }

        // Si la contraseña coincide va a aparecer otra ventana para ingresar la nueva
        session()->flash('cambiarPassword', 'cambiar password en proceso');

        return redirect()->route('dashboard');
    }
    //ingresar la nueva contraseña
    public function NuevoPassword(Request $request){

        $this->deleteFlashVariable();

        //al menos una mayuscula y minuscula y al menos un numero min 4 y max 20
        $validator = Validator::make($request->all(), [
            'passwd' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,20}$/',
            'passwd2' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,20}$/'
        ]);

        //al escribirla 2 veces tienen que coincidir
        if ($validator->fails()) {
            session()->flash('cambiarPassword', 'repetir password');
                return redirect()->route('dashboard')
                ->withErrors($validator)
                ->withInput();
        }

        $passwd = $request->input('passwd');
        $passwd2 = $request->input('passwd2');

        if($passwd != $passwd2) {
            session()->flash('cambiarPassword', 'No coinciden, vuelve a intentarlo');
            session()->flash('pass_actual', 'No coinciden, vuelve a intentarlo');
                return redirect()->route('dashboard')
                ->withErrors($validator)
                ->withInput();
        }

        //nueva contraseña
        DB::table('supervisor')->where('Idsup', session('Id_supervisor'))
                    ->update(array('Contraseña' => $passwd));

                session()->flash('nuevoPassword', 'registro Modificado Correctamente');
                Session::put('passwd_supervisor', $passwd);
                return view('Menu.Save', ['msg'=>'registro Modificado correctamente']);
    }

    //cambiar nombre de usuario o telefono o correo del supervisor
    public function Gestion(){

        $this->deleteFlashVariable();

        session()->flash('newRegister_admin', 'registro en proceso de modificarse');

        return redirect()->route('dashboard_gestion');
    }

    public function MenuGestion(){

        $totalPaginacion = 10;

            //tabla del menu
            $lista = DB::table('usuario')
            ->join('cargos', 'usuario.IdCargo', '=', 'cargos.IdCargo')
            ->join('horarios', 'usuario.IdHorario', '=', 'horarios.IdHorario')
            ->select('usuario.*', 'cargos.*', 'horarios.Turno as turno')
            ->orderBy('usuario.Nombres', 'asc')
            //->get();
            ->paginate($totalPaginacion);

            //para el modal de gestion
            $administrador = DB::table('supervisor')
            ->select('supervisor.*')
            ->where('supervisor.Idsup', '=', session('Id_supervisor'))
            ->get()
            ->first();
            //para abrir el modal

            return view('Menu.index', compact('lista'), ['admin'=>$administrador]);

    }

    public function GestionSupervisor(Request $request){

        $validator = Validator::make($request->all(), [
        
            'telefono' => 'required|digits:10',
            'nombre_usuario' => 'required|string|min:4|max:50|regex:/^[a-zA-Z_]+[0-9]*$/',
            'correo' => 'required|email:rfc,dns'
        ]);

        $nombre_usuario = $request->input('nombre_usuario');
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');

        //en caso de algun error volver al metodo anterior
        if ($validator->fails()) {
            session()->flash('newRegister_admin', 'registro en proceso de modificarse');
            //return redirect('/Configuracion')
            return redirect()->route('dashboard_gestion')
                ->withErrors($validator)
                ->withInput();
        }

        $contadorErrores = 0;

        $validarNombreUsuario = DB::select('SELECT * FROM supervisor WHERE supervisor.Nombre = ? AND supervisor.Idsup != ?', [$nombre_usuario, session('Id_supervisor')]);

        $validarCorreo = DB::select('SELECT * FROM supervisor WHERE supervisor.Correo = ? AND supervisor.Idsup != ?', [$correo, session('Id_supervisor')]);

        $validarTelefono = DB::select('SELECT * FROM supervisor WHERE supervisor.NumTelefono = ? AND supervisor.Idsup != ?', [$telefono, session('Id_supervisor')]); 

        //si hay un registro con ese nombre
        if($validarNombreUsuario != null){
            session()->flash('gestion_error1', 'Nombre de usuario ya esta ocupado, vuelve a intentarlo');
            $contadorErrores++;
        }

        //si ya existe ese correo registrado
        if($validarCorreo != null){
            session()->flash('gestion_error2', 'Correo ya esta ocupado, vuelve a intentarlo');
            $contadorErrores++;
        }
        //si el telefono ya esta registrado
        if ($validarTelefono != null) {
            session()->flash('gestion_error3', 'Telefono ya esta ocupado, vuelve a intentarlo');
            $contadorErrores++;
        }

        //si hay por lo menos un error
        if($contadorErrores > 0){
            session()->flash('newRegister_admin', 'Gestion del supervisor');
            return redirect()->route('dashboard_gestion')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            
            DB::table('supervisor')->where('Idsup', session('Id_supervisor'))
                ->update(array('Nombre' => $nombre_usuario, 
                            'Correo' => $correo, 
                            'NumTelefono' => $telefono));

            session()->flash('actualizar', 'registro Modificado Correctamente');
            //actualizar el nombre de usuario
            Session::put('usuario', $nombre_usuario);
            return view('Menu.Save', ['msg'=>'registro Modificado correctamente']);
            
        } catch (Exception $th) {
            echo "Error";
        }

    }

    //borrar las variables flash cuando se inserte, actualice, cambie contraseña etc
    public function deleteFlashVariable(){
        //borrar variables flash de los cuadros modal para actualizar e insertar y notificacion
        if (session()->has('newRegister')) {
            session()->pull('newRegister');
        }

        if (session()->has('addUser')) {
            session()->pull('addUser');
        }

        if (session()->has('addAdmin')) {
            session()->pull('addAdmin');
        }

        if (session()->has('cambiarPassword')){
            session()->pull('cambiarPassword');
        }

        if (session()->has('insertar')){
            session()->pull('insertar');
        }

        if (session()->has('actualizar')){
            session()->pull('actualizar');
        }

        if (session()->has('eliminar')){
            session()->pull('eliminar');
        }

        if (session()->has('password')){
            session()->pull('password');
        }

        if (session()->has('nuevoReporte')) {
            session()->pull('nuevoReporte');
        }

        if (session()->has('errorReporte')) {
            session()->pull('errorReporte');
        }

        if (session()->has('nuevoPassword')) {
            session()->pull('nuevoPassword');
        }

        if (session()->has('newRegister_admin')) {
            session()->pull('newRegister_admin');
        }

        if(session()->has('insert_error1')){
            session()->pull('insert_error1');
        }

        if(session()->has('insert_error2')){
            session()->pull('insert_error2');
        }

        if(session()->has('insert_error3')){
            session()->pull('insert_error3');
        }

        if(session()->has('insert_error4')){
            session()->pull('insert_error4');
        }

        if(session()->has('update_error1')){
            session()->pull('update_error1');
        }

        if(session()->has('update_error2')){
            session()->pull('update_error2');
        }

        if(session()->has('pass_actual')){
            session()->pull('pass_actual');
        }

        if(session()->has('gestion_error1')){
            session()->pull('gestion_error1');
        }

        if(session()->has('gestion_error2')){
            session()->pull('gestion_error2');
        }

        if(session()->has('gestion_error3')){
            session()->pull('gestion_error3');
        }

        if(session()->has('correoFlash')){
            session()->pull('correoFlash');
        }

        if(session()->has('correo_error')){
            session()->pull('correo_error');
        }

    }

}
