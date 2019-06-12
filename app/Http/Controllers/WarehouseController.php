<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;

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

    public function indexApi(){
        $articulos = Warehouse::all();
        return response()->json($articulos, 200);
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
    public function store(Request $request)
    {
        $articulo = new Warehouse;
        if($request->foto===NULL){
            $articulo->fill($request->all());
            $articulo->foto = "articule.png";
            $articulo->save();
        }else {
            $articulo->fill($request->all());
            $articulo->foto = $this->createFile("articulo".time(), $request->foto);
            $articulo->save();
        }
        //return redirect()->route("warehouse.index");

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
        $articulo=Warehouse::find($id);
        return view('warehouse.edit', compact('articulo'));
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
        // BUSCAR AL USUARIO EN LA BASE DE DATOS POR ID Y OBTENER LA FOTO ACTUAL
        $articulo = Warehouse::findOrFail($id);
        $foto = $articulo->foto;
        // COMPARAR FOTO EN BD CON FOTO EN REQUEST
        if($foto != $request->foto){
            // SI LA FOTO NO ES IGUAL(HUBO CAMBIO), PREPARAR LA CONSULTA
            $articulo->fill($request->all());
            // CONVERTIR LOS METADATOS A UNA FOTO PNG Y GUARDARLOS EN LA CONSULTA
            $foto = str_ireplace(".png", "",$foto);
            $articulo->foto = $this->createFile($foto, $request->foto);
            // GUARDAR EN BD
            $articulo->save();
        }else {
            // SI ES IGUAL LA FOTO EN LA BD A LA FOTO EN LA REQUEST, PRERPARA CONSULTA Y GUARDAR EN BD
            $articulo->fill($request->all());
            $articulo->save();
        }
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
        $articulo = Warehouse::find($id);
        $articulo->delete();
        return redirect()->route("warehouse.index");
    }


    /**
     * Convierte Metadatos base64 en imagenes en formato PNG
     *
     * @param  string $nombre
     * @param  string $foto
     * @return string $foto
     */
    public function createFile($nombre, $foto) {
        define('UPLOAD_DIR', '../public/img/warehouse/'); //Obtenemos la ruta donde guardaremos la foto
        $data = base64_decode($foto);   //Decodificamos la foto
        $file = UPLOAD_DIR . $nombre . '.png'; //Generamos la ruta completa del archivo
        $img = str_replace('../public/img/warerehouse/', '/', $file);   //Ruta Front-End
        $success = file_put_contents($file, $data); //Creamos la foto en el servidor
        $foto = $nombre.".png";
        return $foto;
    }
}
