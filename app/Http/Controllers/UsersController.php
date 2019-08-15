<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\User;
use App\Http\Controllers\HoursController;
use DB;
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
        $hoursController = new HoursController();
        return view("users.index")->with(["users"=>$users,"hoursController"=>$hoursController ]);
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
        $hoursController = new HoursController();
        return view("users.show")->with(["user"=>$user,"hoursController"=>$hoursController ]);
    }
    public function search(Request $request)
    {
        $query = $request->search;        
        $users = DB::table('users')
        ->where('nombres', 'LIKE', '%' . $query . '%')
        ->orWhere('apellidos', 'LIKE', '%' . $query . '%')->get();
        $hoursController = new HoursController();
        $users = json_decode(json_encode($users),true);
        // var_dump($users);

        return view("users.index")->with(["users"=>$users,"hoursController"=>$hoursController ]);
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
        // dd($request->all()["foto"]);
        $user = User::findOrFail($id);
      
        $data = $this->validateStoreInputs($request->all());
        //ACTUALIZAMOS LA FOTO DEL USUARIO Y OBTENEMOS EL NOMBRE DEL ARCHIVO
        if($data["foto"] == null && ($user["foto"] == "user-man.png" || $user["foto"] == "woman-man.png"))
            $data["foto"]  = $this->changeDefaultPicture($data["sexo"], $user["foto"]);
        else
            $data["foto"] = $this->updatePicture($data["foto"], $user["foto"],$user["email"], $data["email"]);
        $user -> update($data);
        // dd($data["foto"]);
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

    private function updatePicture($dataFoto, $fileFoto, $email, $dataEmail){
        // dd($dataFoto, $fileFoto, $email, $dataEmail);
        $rutaImages ="../public/img/users/";
        $oldName = $rutaImages."$email.png";
        $newName = $rutaImages."$dataEmail.png";

        if($dataFoto == null && ($dataEmail != $email)){
            // renombrar foto del usuario
            rename($oldName, $newName);
            return "$dataEmail.png";
        }
        elseif($dataFoto != null && ($dataEmail != $email)){
            rename($oldName, $newName);
            return $this->createPicture($dataEmail, $dataFoto, "hombre");
        }
        elseif($dataFoto != null && ($dataEmail == $email)){
            return $this->createPicture($dataEmail, $dataFoto, "hombre");
        }
        else{
            return $fileFoto;
        }
    }

    private function createPicture($email, $foto, $sexo){
        if($foto == null){
            if($sexo == "mujer")
                return $fileName = "user-woman.png";
            if($sexo == "hombre")
                return $fileName = "user-man.png";         
        }
        else{
            define('UPLOAD_DIR', '../public/img/users/'); //definimos la ruta donde guardaremos la foto
            $picture = base64_decode($foto);   //Decodificamos la foto
            $fileName = $email . '.png'; //Generamos la ruta completa del archivo
            file_put_contents(UPLOAD_DIR .$fileName, $picture); //Creamos la foto en el servidor
            return $fileName;
        }
    }

        private function changeDefaultPicture($sexo, $fotoName){
            // se comprueba que la foto actual sea alguna de las de defecto
            if($fotoName == "user-woman.png" || $fotoName == "user-man.png"){
                if($sexo == "mujer")
                    return "user-woman.png";
                if($sexo == "hombre")
                    return "user-man.png";       
            }
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

     public  function getFotoURL($id){
        $user = User::findOrFail($id);
        return $user->foto;
     }

}
