<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Track;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TrackController extends Controller
{
  public function Index() 
  {

    $tracks = Track::where('display', true)->orderBy('title')->get();

    return Inertia::render('Track/Index', 
    ['tracks' => $tracks]);
  }

  public function create() {
    return Inertia::render('Track/Create');
  }

  public function store(Request $request) {
    $request->validate([
      'title' => ['string', 'required', 'max:255'],
      'artist' => ['string', 'required', 'max:255'],
      'display' => ['boolean', 'required'],
      'image' => ['image', 'max:255'],
      'music' => ['file', 'required', 'extensions:mp3, wav'],
    ]);

    $uuid = Str::uuid();

    $extension = $request->image->extension();
    $imagePath = $request->image->storeAs('tracks/images', $uuid . '.' . $extension);
    $musicPath = $request->music->storeAs('tracks/musics', $uuid . '.' . $extension);


    Track::create([
      'uuid' => 'trk-' . Str::uuid(),
      'title' => $request->title,
      'artist' => $request->artist,
      'display' => $request->display,
      'image' => $imagePath,
      'music' => $musicPath,

    ]);

    return redirect()->route('tracks.index');

  }
}