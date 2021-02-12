<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $title = $request->query('title', '');
    $movies = Movie::search($title)->get();
    return response()->json($movies);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateMovieRequest $request)
  {
    $data = $request->validated();
    $movie = Movie::create($data);
    return response()->json($movie);
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
    return response()->json($movie);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateMovieRequest $request, $id)
  {
    $data = $request->validated();
    $movie = Movie::findOrFail($id);
    $movie->update($data);
    return response()->json($movie);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $movie = Movie::findOrFail($id);
    $movie->delete();
    return response()->json($movie);
  }
}
