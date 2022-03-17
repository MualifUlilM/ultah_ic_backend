<?php

namespace App\Http\Controllers;

use App\Models\Art;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arts= Art::all();
        $response = [
            'message' => 'List of all arts',
            'total' => $arts->count(),
            'data' => $arts,
        ];

        return response()->json($response, 200);
    }

    public function like($id){
        $art = Art::find($id);
        $art->like = $art->like + 1;
        $art->save();
        $response = [
            'message' => 'Like updated',
            'data' => $art,
        ];

        return response()->json($response, 200);
    }

    public function unlike($id){
        $art = Art::find($id);
       if ($art->like != 0){
        $art->like = $art->like - 1;
        $art->save();
        $response = [
            'message' => 'Like updated',
            'data' => $art,
        ];

        return response()->json($response, 200);
       }else{
           return response()->json('You cannot unlike', 400);
       }
    }

    public function addArt(Request $request){


        $art = new Art();
        $art->title = $request->title;
        $art->description = $request->description;
        $art->category = $request->category;
        $art->social_media = $request->social_media;
        $art->like = 0;
        // upload image from file
        // /home/ul/Dev/IC/ultah_ic_backend/public/storage/images/
        $art->image = env('APP_URL') . '/storage/' . $request->file('image')->store('images');
        // dd($request->image);
        $art->save();
        $response = [
            'message' => 'Art added',
            'data' => $art,
        ];

        return response()->json($response, 200);
    }

    public function storagelink(){
        // run link storage
        try {
            Artisan::call('storage:link');
            return response()->json('Storage link created', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
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
        //
    }
}
