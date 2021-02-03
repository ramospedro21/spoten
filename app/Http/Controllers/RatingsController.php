<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rating;

use Auth;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $ratings = Rating::all();

            return response()->json($ratings);

        }catch(\Exception $error){

            return response()->json([
                'message' => 'Não foi possivel listar as avaliações',
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
        try{

            $data = $request->validate([
                'movie_id' => 'required',
                'rating' => 'required',
                'notes' => 'nullable'
            ]);

            $data['user_id'] = Auth::user()->id;

            $rating = new Rating($data);

            $rating->save();

            return response()->json([
                'success' => true
            ], 201);

        }catch(\Exception $error){

            return response()->json([
                'message' => 'Não foi possivel cadastrar a avaliação',
                'errors' => [
                    'message' => $error->getMessage(),
                    'line' => $error->getLine(),
                ]
            ], 500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rating = Rating::findOrFail($id);

        try{

            return response()->json($rating);

        }catch(\Exception $error){

            return response()->json([
                'message' => 'Não foi possivel encontrar a avaliação',
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
