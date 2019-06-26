<?php

namespace App\Http\Controllers;

use App\BookingArticles;
use App\Warehouse;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BookingArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $booking = BookingArticles::where('estado', 'RESERVADO')->orWhere('estado', 'PRESTADO')->distinct()->get(['user_id']);
        $users_id=array();

        foreach($booking as $user){ 
            array_push($users_id, $user['user_id']);
        }
        $users = User::whereIn('id', $users_id)->get();


        return view('booking_articles.index', compact('users') );
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking_articles.create');
    }

    public function createByUser($id)
    {
        return view('booking_articles.create', compact('id'));
    }

    public function createByUserApi(Request $request)
    {
        
        $article = Warehouse::where('id', $request->articulo_id)->first();
        $user = User::where('id', $request->user_id)->first();
        echo ($user->id);
        $cantidadSolicitada = $request->cantidad;
        $cantidadActual = $article->cantidad;
        $booking = new BookingArticles;
        
        if($cantidadActual==0) {
            return response()->json(["message" => "no hay articulos en existencia"],404);  
        } else if($cantidadSolicitada>$cantidadActual) {
            return response()->json(["message" => "no hay suficientes articulos en existencia"],501);  
        } else if($cantidadSolicitada<=$cantidadActual ) {
            $booking->user_id = $user->id;
            $booking->article_id = $article->id;
            $booking->cantidad = $cantidadSolicitada;
            $booking->estado = "RESERVADO";
            $booking->save();
            $cantidadAux = $cantidadActual-$cantidadSolicitada;
            $article->cantidad = $cantidadAux;
            $article->save();
            return response()->json(["message" => "transaccion completada"],201);  
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'descripcion' => 'required',
            'disponible' => 'required', 
            'cantidad' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }

        
        for($i=0; $i<count($request->id); $i++){
            $booking = new BookingArticles;
            $booking->user_id = $request->user_id;
            $booking->article_id = $request->id[$i];
            $booking->cantidad = $request->cantidad[$i];
            $booking->estado = "PRESTADO";
            $booking->save();
            $article = Warehouse::where('id', $request->id)->first();
            $cantidadAux = $request->disponible[$i]-$request->cantidad[$i];
            $article->cantidad = $cantidadAux;
            $article->save();
        }

        $booking = BookingArticles::where('estado', 'RESERVADO')->orWhere('estado', 'PRESTADO')->distinct()->get(['user_id']);
        $users_id=array();

        foreach($booking as $user){ 
            array_push($users_id, $user['user_id']);
        }
        $users = User::whereIn('id', $users_id)->get();


        return view('booking_articles.index', compact('users') );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookingArticles  $bookingArticles
     * @return \Illuminate\Http\Response
     */
    public function show(BookingArticles $bookingArticles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookingArticles  $bookingArticles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = BookingArticles::where('user_id', $id)->where(function($query){
            $query
            ->where('estado', 'RESERVADO')
            ->orWhere('estado', 'PRESTADO');
        })->get();

        $articles_id=array();

        foreach($booking as $bookings){ 
            array_push($articles_id, $bookings['article_id']);
        }

        $articles = array();
        foreach($articles_id as $article_id) {
            $auxnombre = Warehouse::where('id', $article_id)->get()->first();
            array_push($articles, $auxnombre);
        }

        $user_id = $id;
      
        return view('booking_articles.edit', compact('booking', 'articles', 'user_id' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookingArticles  $bookingArticles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingArticles $bookingArticles, $id)
    {
        $book = BookingArticles::where('id', $id)->get()->first();
        $book->estado = "DEVUELTO";
        $book->save();

        $article = Warehouse::where('id', $book->article_id)->get()->first();
        $cantidadDisponible = $book->cantidad + $article->cantidad;
        $article->cantidad = $cantidadDisponible;
        $article->save();


        $booking = BookingArticles::where('user_id', $book->user_id)->where(function($query){
            $query
            ->where('estado', 'RESERVADO')
            ->orWhere('estado', 'PRESTADO');
        })->get();

        $articles_id=array();

        foreach($booking as $bookings){ 
            array_push($articles_id, $bookings['article_id']);
        }

        $articles = array();
        foreach($articles_id as $article_id) {
            $auxnombre = Warehouse::where('id', $article_id)->get()->first();
            array_push($articles, $auxnombre);
        }

        $user_id = $book->user_id;       
      
        return view('booking_articles.edit', compact('booking', 'articles', 'user_id' ) );

    }

    public function updateAll($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookingArticles  $bookingArticles
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingArticles $bookingArticles)
    {
        //
    }
}
