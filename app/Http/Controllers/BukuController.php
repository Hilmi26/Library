<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //add data
        $buku = Buku::all();
        $kategori = Kategori::all();
        return view('layouts.buku', compact('buku', 'kategori'));
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
        //add data
        $data = $request->all();
        $data['cover'] = Storage::put('img', $request->file('cover'));
        Buku::create($data);
        return redirect('buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku, $id)
    {
        //edit data
        $buku = Buku::find($id);
        if ($request->file('cover')) {
            $file = $request->file('cover')->store('img');
            $buku->isbn = $request->isbn;
            $buku->judul = $request->judul;
            $buku->cover = $file;
            $buku->sinopsis = $request->sinopsis;
            $buku->penerbit = $request->penerbit;
            $buku->status = $request->status;
            $buku->kategori_id = $request->kategori_id;
            $buku->save();
        } else {
            $buku->isbn = $request->isbn;
            $buku->judul = $request->judul;
            $buku->cover;
            $buku->sinopsis = $request->sinopsis;
            $buku->penerbit = $request->penerbit;
            $buku->status = $request->status;
            $buku->kategori_id = $request->kategori_id;
            $buku->save();
        }
        return redirect('/buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku, $id)
    {
        //delete data
        Buku::find($id)->delete();
        return redirect('buku');
    }
}
