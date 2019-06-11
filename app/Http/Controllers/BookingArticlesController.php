<?php

namespace App\Http\Controllers;

use App\BookingArticles;
use Illuminate\Http\Request;

class BookingArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = BookingArticles::all();
        return view('booking_articles.index', compact('booking') );
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
    public function edit(BookingArticles $bookingArticles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookingArticles  $bookingArticles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingArticles $bookingArticles)
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
