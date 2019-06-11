<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
 use App\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("users.index")->with("users",$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {  
        $data = $this->validateStoreInputs($request->all());
        //GENERAMOS LA FOTO DEL USUARIO Y OBTENEMOS EL NOMBRE DEL ARCHIVO
        $data["foto"] = $this->createPicture($data["email"],$data["foto"],$data["sexo"]);
        User::create($data);//GUARDAMOS INFORMACIÓN DEL NUEVO USUARIO EN LA BASE DE DATOS
        return redirect()->route("users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view("users.show")->with("user",$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("users.edit")->with("user",$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $user = User::findOrFail($id);
     
        $data = $this->validateStoreInputs($request->all());
        //GENERAMOS LA FOTO DEL USUARIO Y OBTENEMOS EL NOMBRE DEL ARCHIVO
        $data["foto"] = $this->createPicture($data["email"],$data["foto"],$data["sexo"]);

        $user -> update($data);
        return redirect()->route("users.index"); 
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route("users.index"); 
    }

    
    private function createPicture($email, $foto, $sexo){
        $pathFile = "";
        define('UPLOAD_DIR', '../public/img/users/'); //definimos la ruta donde guardaremos la foto
        //SI NO SE HA TOMADO FOTO SE ELIGE LA FOTO POR DEFECTO
        if(!$foto){
            if($sexo == "mujer")
                $fileName = "user-woman.png";
            if($sexo == "hombre")
                $fileName = "user-man.png";
        }
        elseif($foto == $email ."png"){

            $fileName = $email . "png";
        }
        else{

            $picture = base64_decode($foto);   //Decodificamos la foto
            $fileName = $email . '.png'; //Generamos la ruta completa del archivo
            file_put_contents(UPLOAD_DIR .$fileName, $picture); //Creamos la foto en el servidor
        }
         return $fileName;
    }

    private function validateStoreInputs($inputs){
        // CONSISTENCIA DE DATOS EN LA BD
        $data = $inputs;
        $validatedData;
        foreach ($data as $key => $value) { 
            if($key ==  "password")
                $validatedData[$key] = bcrypt($value);
            elseif($key == "_token" || $key == "email")
                $validatedData[$key] = $value;
            elseif($key == "nombres" || $key == "apellidos")
                $validatedData[$key] = ucwords($value);
            elseif($key == "foto")
                $validatedData[$key] = $value;
            elseif($key == "matricula" && $value == "")
                $value == NULL;
            else
                $validatedData[$key] = mb_strtolower($value);
        }
        return $validatedData;
    }

}
