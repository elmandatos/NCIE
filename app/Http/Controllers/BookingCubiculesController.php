<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\BookingCubiculesRequest;
use App\BookingCubicules;
use Carbon\Carbon;
class BookingCubiculesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    // LISTA DE LAS RESERVACIONES USUARIOS, CUBICULOS Y HORARIOS
        $reservacionesUsuario = DB::table("booking_cubicules")
        ->join("users", "booking_cubicules.id_user", "=", "users.id")
        ->join("cubicules", "booking_cubicules.id_cubicules", "=", "cubicules.id")
        ->join("schedules", "booking_cubicules.id_schedules", "=", "schedules.id")
        ->select("booking_cubicules.id","users.nombres","users.apellidos","users.email","cubicules.numero","schedules.hora_inicio","schedules.hora_fin")
        ->orderBy("cubicules.numero")
        ->where("booking_cubicules.fecha","=",Carbon::now()->toDateString())
        ->get();
        $reservacionesUsuario = json_decode(json_encode($reservacionesUsuario),true);
        return view("booking_cubicules.index")->with("reservaciones", $reservacionesUsuario);
    }

   public function indexAPI()
    {
    // LISTA DE LAS RESERVACIONES USUARIOS, CUBICULOS Y HORARIOS
        $reservacionesUsuario = DB::table("booking_cubicules")
        ->join("users", "booking_cubicules.id_user", "=", "users.id")
        ->join("cubicules", "booking_cubicules.id_cubicules", "=", "cubicules.id")
        ->join("schedules", "booking_cubicules.id_schedules", "=", "schedules.id")
        ->select("booking_cubicules.id","users.nombres","users.apellidos","users.email","cubicules.numero","schedules.hora_inicio","schedules.hora_fin")
        ->orderBy("cubicules.numero")
        ->where("booking_cubicules.fecha","=",Carbon::now()->toDateString())
        ->get();
        $reservacionesUsuario = json_decode(json_encode($reservacionesUsuario),true);
        return response()->json( $reservacionesUsuario, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horarios = DB::table("schedules")
        ->select("id","hora_inicio","hora_fin")
        ->get();
        
        $horarios = json_decode(json_encode($horarios),true);
        
        $horariosGlobales = [1,2,3,4,5,6,7,8,9,10];
        $horasPorCubiculo = [
            3 =>[],
            4 =>[],
            5 =>[],
            6 =>[],
            7 =>[],
            9 =>[],
            10 =>[],
        ];
       
        //OBTENER LISTA DE CUBICULOS OCUPADOS
        $registrosCubiculos = DB::table("booking_cubicules")
        ->join("cubicules", "booking_cubicules.id_cubicules", "=", "cubicules.id")
        ->select("cubicules.id as cubiculo")
        ->groupBy("cubiculo")
        ->get();
        $registrosCubiculos = json_decode(json_encode($registrosCubiculos),true);

        if(count($registrosCubiculos)  != 0){
            //OBTENER LISTA DE HORAS OCUPADA DE UN CUBICULO
            $registroHoras;
            foreach ($registrosCubiculos as $cubiculo) {
                $horas = DB::table("booking_cubicules")
                ->join("cubicules", "booking_cubicules.id_cubicules", "=", "cubicules.id")
                ->join("schedules", "booking_cubicules.id_schedules", "=", "schedules.id")
                ->select("schedules.id as horario")
                ->where("cubicules.id","=",$cubiculo["cubiculo"])
                ->get();
                $horas = json_decode(json_encode($horas),true);
                $registroHoras[$cubiculo['cubiculo']] = $horas;
            }
    
    
            //LISTA DE HORARIOS OCUPADOS ASOCIADAS A SU CUBICULO
            $horasPorCubiculoDisponibles;
            $registrosCubiculos = json_decode(json_encode($registrosCubiculos),true);
            foreach ($registroHoras as $cubiculo => $horas) {
                foreach ($horas as $key => $value) {
                    $horasPorCubiculo[$cubiculo][] = $value["horario"]; 
                }
            }
    
            // LISTA DE HORARIOS DISPONIBLES
            foreach ($horasPorCubiculo as $cubiculo => $horas) {
                $horasPorCubiculoDisponibles[$cubiculo] = array_diff($horariosGlobales,$horas);
            }
            foreach ($horasPorCubiculoDisponibles as $cubiculo => $horas) {
                foreach ($horas as $index => $idHorario) {
                    $horasPorCubiculoDisponibles[$cubiculo][$index] = $horarios[$index];
                }            
            }        
        }
        else{        
            foreach ($horasPorCubiculo as $cubiculo => $horas) {
                $horasPorCubiculoDisponibles[$cubiculo] = array_diff($horariosGlobales,$horas);
            }
            
            foreach ($horasPorCubiculoDisponibles as $cubiculo => $horas) {
                foreach ($horas as $index => $idHorario) {
                    $horasPorCubiculoDisponibles[$cubiculo][$index] = $horarios[$index];
                }            
            }    
        }
        return view("booking_cubicules.create")->with("horasCubiculos",$horasPorCubiculoDisponibles);
    }


    public function createAPI()
    {
        $horarios = DB::table("schedules")
        ->select("id","hora_inicio","hora_fin")
        ->get();
        
        $horarios = json_decode(json_encode($horarios),true);
        
        $horariosGlobales = [1,2,3,4,5,6,7,8,9,10];
        $horasPorCubiculo = [
            3 =>[],
            4 =>[],
            5 =>[],
            6 =>[],
            7 =>[],
            9 =>[],
            10 =>[],
        ];
       
        //OBTENER LISTA DE CUBICULOS OCUPADOS
        $registrosCubiculos = DB::table("booking_cubicules")
        ->join("cubicules", "booking_cubicules.id_cubicules", "=", "cubicules.id")
        ->select("cubicules.id as cubiculo")
        ->groupBy("cubiculo")
        ->get();
        $registrosCubiculos = json_decode(json_encode($registrosCubiculos),true);

        if(count($registrosCubiculos)  != 0){
            //OBTENER LISTA DE HORAS OCUPADA DE UN CUBICULO
            $registroHoras;
            foreach ($registrosCubiculos as $cubiculo) {
                $horas = DB::table("booking_cubicules")
                ->join("cubicules", "booking_cubicules.id_cubicules", "=", "cubicules.id")
                ->join("schedules", "booking_cubicules.id_schedules", "=", "schedules.id")
                ->select("schedules.id as horario")
                ->where("cubicules.id","=",$cubiculo["cubiculo"])
                ->get();
                $horas = json_decode(json_encode($horas),true);
                $registroHoras[$cubiculo['cubiculo']] = $horas;
            }
    
    
            //LISTA DE HORARIOS OCUPADOS ASOCIADAS A SU CUBICULO
            $horasPorCubiculoDisponibles;
            $registrosCubiculos = json_decode(json_encode($registrosCubiculos),true);
            foreach ($registroHoras as $cubiculo => $horas) {
                foreach ($horas as $key => $value) {
                    $horasPorCubiculo[$cubiculo][] = $value["horario"]; 
                }
            }
    
            // LISTA DE HORARIOS DISPONIBLES
            foreach ($horasPorCubiculo as $cubiculo => $horas) {
                $horasPorCubiculoDisponibles[$cubiculo] = array_diff($horariosGlobales,$horas);
            }
            foreach ($horasPorCubiculoDisponibles as $cubiculo => $horas) {
                foreach ($horas as $index => $idHorario) {
                    $horasPorCubiculoDisponibles[$cubiculo][$index] = $horarios[$index];
                }            
            }        
        }
        else{        
            foreach ($horasPorCubiculo as $cubiculo => $horas) {
                $horasPorCubiculoDisponibles[$cubiculo] = array_diff($horariosGlobales,$horas);
            }
            
            foreach ($horasPorCubiculoDisponibles as $cubiculo => $horas) {
                foreach ($horas as $index => $idHorario) {
                    $horasPorCubiculoDisponibles[$cubiculo][$index] = $horarios[$index];
                }            
            }
        }
        return response()->json( $horasPorCubiculoDisponibles, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingCubiculesRequest $request)
    {
        $prestamos = $request->all();
        $datos;
        for ($i=0; $i < count($prestamos["id_schedules"]); $i++) {
            $datos["id_user"] = $prestamos["id_user"]; 
            $datos["id_cubicules"] = $prestamos["id_cubicules"]; 
            $datos["id_schedules"] = $prestamos["id_schedules"][$i]; 
            $datos["fecha"] = Carbon::now()->toDateString(); 

            $validacionReservacion = DB::table("booking_cubicules")
            ->select("id_user")
            ->where("id_user","=",$datos["id_user"])
            ->where("fecha","=",Carbon::now()->toDateString())
            ->get();
            $validacionReservacion = json_decode(json_encode($validacionReservacion),true);
            if(count($validacionReservacion)<2)
                BookingCubicules::create($datos);
        }
        return redirect()->route("booking_cubicules.index");
    }

        public function storeAPI(BookingCubiculesRequest $request)
    {
        $prestamos = $request->all();
        $datos;
        for ($i=0; $i < count($prestamos["id_schedules"]); $i++) {
            $datos["id_user"] = $prestamos["id_user"]; 
            $datos["id_cubicules"] = $prestamos["id_cubicules"]; 
            $datos["id_schedules"] = $prestamos["id_schedules"][$i]; 
            $datos["fecha"] = Carbon::now()->toDateString(); 

            $validacionReservacion = DB::table("booking_cubicules")
            ->select("id_user")
            ->where("id_user","=",$datos["id_user"])
            ->where("fecha","=",Carbon::now()->toDateString())
            ->get();
            $validacionReservacion = json_decode(json_encode($validacionReservacion),true);
            if(count($validacionReservacion)<2)
                BookingCubicules::create($datos);
        }
        return response()->json(["message" => "Reservación completada"], 201);
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
        BookingCubicules::destroy($id);
        return redirect()->route("booking_cubicules.index"); 

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAPI($id)
    {
        BookingCubicules::destroy($id);
        return response()->json(["message" => "Reservación cancelada"], 201);

    }
}