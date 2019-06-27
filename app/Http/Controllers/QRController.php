<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("qr.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //
    }

    
    public function createQR($id){
        QrCode::format('png')->size(399)->generate($id, '../public/img/qr/qrcode_id.png');
    }

        public function sendQR($user){
        if(!$this->is_valid_email($user->email)){
            if(file_exists("../public/img/users/Email-erroneos.txt"))
                unlink('../public/img/users/Email-erroneos.txt');
            $this->emailErrorFile($user);
            $this->downloadErrorEmailFile();
        }
        else{
            Mail::send("qr.email",[],
                function($message) use ($user){
                    $message->from('nodocreativo.itm@gmail.com', 'QR - Favor de no responder a este correo');
                    $message ->attach('../public/img/qr/qrcode_id.png');
                    $message->to($user->email)->subject('QR de acceso al Nodo creativo');
            });
        }
    }
    
    public function createAndSendQR($id){
        $user = User::find($id);
        $this->createQR($id);
        $this->sendQR($user);
        return back();
    }

    public function sendAllQR(){
        if(file_exists("../public/img/users/Email-erroneos.txt"))
        unlink('../public/img/users/Email-erroneos.txt');
        $users = User::all();
        foreach ($users as $user) {
            if($user["nombres"] == "ADMIN")
            continue;
            $this->createQR($user["id"]);
            if(!$this->is_valid_email($user->email)){
                $this->emailErrorFile($user);
            }
            else
            $this->sendQR($user);
        }
        if(file_exists("../public/img/users/Email-erroneos.txt"))
            $this->downloadErrorEmailFile();
        return back();
    }

    /**
     *
     * Valida un email usando filter_var y comprobar las DNS. 
     *  Devuelve true si es correcto o false en caso contrario
     *
     * @param    string  $str la dirección a validar
     * @return   boolean
     *
     */
    public function is_valid_email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function emailErrorFile($user){
            $file = fopen("../public/img/users/Email-erroneos.txt", "a");
            fwrite($file, "$user->nombres $user->apellidos : [$user->email]" . PHP_EOL);
            fclose($file);
    }

    public function downloadErrorEmailFile(){
        $attachment_location = "../public/img/users/Email-erroneos.txt";
        if (file_exists($attachment_location)) {
            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
            header("Cache-Control: public"); // needed for internet explorer
            header("Content-Type: application/txt");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:".filesize($attachment_location));
            header("Content-Disposition: attachment; filename=Email-erroneos.txt");
            readfile($attachment_location);
            exit;
        }
    }
}
