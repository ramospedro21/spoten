<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $movies = Movie::all();

            return response()->json($movies);

        }catch(\Exception $error){

            return response()->json([
                'message' => 'Não foi possivel listar os filmes',
                'errors' => [
                    'message' => $error->getMessage(),
                    'line' => $error->getLine(),
                ]
            ], 500);

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
        $movie = Movie::findOrFail($id);

        try{

            return response()->json($movie);

        }catch(\Exception $error){

            return response()->json([
                'message' => 'Não foi possivel encontrar o filme',
                'errors' => [
                    'Message' => $error->getMessage(),
                    'Line' => $error->getLine(),
                ]
            ], 500);

        }
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
}
