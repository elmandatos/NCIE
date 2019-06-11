<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use Carbon\Carbon;
use App\Http\Requests\WarehouseRequest;
use DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Warehouse::all();
        return view('warehouse.index', compact('articulos') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseRequest $request)
    {
       $nextId = DB::table('warehouses')->max('id') + 1;
       var_dump($nextId);
       $articulo = $request->all();
        if($articulo["foto"]===NULL)
            $articulo["foto"] = "articule.png";
        else
            $articulo["foto"] = $this->createPicture($nextId, $request->foto);
            Warehouse::create($articulo);
            return redirect()->route("warehouse.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $articulo = Warehouse::findOrFail($id);
        // return view("warehouse.show")->with("user",$user);                             
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo=Warehouse::findOrFail($id);
        return view('warehouse.edit')->with("articulo",$articulo);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseRequest $request, $id)
    {
        // BUSCAR AL USUARIO EN LA BASE DE DATOS POR ID Y OBTENER LA FOTO ACTUAL
        $articulo = Warehouse::findOrFail($id);
        $foto = $articulo->foto;
        // COMPARAR FOTO EN BD CON FOTO EN REQUEST
        if($foto != $request->foto){
            // SI LA FOTO NO ES IGUAL(HUBO CAMBIO), PREPARAR LA CONSULTA
            $articulo->fill($request->all());
            // CONVERTIR LOS METADATOS A UNA FOTO PNG Y GUARDARLOS EN LA CONSULTA
            $articulo->foto = $this->createPicture($articulo->id, $request->foto);
        }else {
            // SI ES IGUAL LA FOTO EN LA BD A LA FOTO EN LA REQUEST, PRERPARA CONSULTA Y GUARDAR EN BD
            $articulo->fill($request->all());
        }
        $articulo->save();
       return redirect()->route("warehouse.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warehouse::destroy($id);
        return redirect()->route("warehouse.index");
    }


    /**
     * Convierte Metadatos base64 en imagenes en formato PNG
     *
     * @param  string $nombre
     * @param  string $foto
     * @return string $foto
     */
    public function createPicture($nombre, $foto) {
        define('UPLOAD_DIR', '../public/img/warehouse/'); //Obtenemos la ruta donde guardaremos la foto
        $picture = base64_decode($foto);   //Decodificamos la foto
        $fileName = $nombre . '.png'; //Generamos la ruta completa del archivo
  
         file_put_contents(UPLOAD_DIR . $fileName, $picture); //Creamos la foto en el servidor
        return $fileName;
    }
}
