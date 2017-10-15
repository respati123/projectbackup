<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sejarah;
use App\KategoriSejarah;
use Session;

class SejarahControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $data = Sejarah::all();
        return view('sejarah.show_data')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listKategori = KategoriSejarah::all();
        return view('sejarah.s_input')->with('data',$listKategori);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'nama_sejarah'          => 'required|max:50',
            'kategori_sejarah'      => 'required',
            'images'                => 'required|image|mimes:png,jpeg,jpg|max:2048',
            'alamat'                => 'required',
            'lat'                   => 'required',
            'lng'                   => 'required',
            'description'           => 'required',
            'link'                  => 'required'    

        ]);

        $file    = $request->file('images');
        $data    = [

            'ks_id'         => $request->kategori_sejarah,
            'sj_nama'       => $request->nama_sejarah,
            'sj_alamat'     => $request->alamat,
            'sj_deskripsi'  => $request->description,
            'sj_lat'        => $request->lat,
            'sj_lng'        => $request->lng,
            'sj_youtube'    => $request->link,
            'sj_gambar'     => $file->getClientOriginalName()

        ];

        KategoriSejarah::IncreaseCount($request->kategori_sejarah);

        Sejarah::create($data);
        $destinationPath = public_path('/images/sejarah');
        $upload = $file->move($destinationPath, $file->getClientOriginalName());

        return redirect()->back()->with('success','Successfully')->withInput();

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

        $data = Sejarah::findOrFail($id);
        $listKategori = KategoriSejarah::all();

        return view('sejarah.s_edit')->with(['sejarah'=>$data,'kategori'=>$listKategori]);
        
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
        $sejarah = new Sejarah();
        if($request->hasFile('images')){

            $this->validate($request, [

                'nama_sejarah'          => 'required|max:50',
                'kategori_sejarah'      => 'required',
                'alamat'                => 'required',
                'lng'                   => 'required',
                'lat'                   => 'required',
                'description'           => 'required',
                'link'                  => 'required',
                'images'                => 'required|image|mimes:jpg,png,jpeg'

            ]);

            $file  = $request->file('images');

            $data  = [

                'sj_nama'       => $request->nama_sejarah,
                'ks_id'         => $request->kategori_sejarah,
                'sj_alamat'     => $request->alamat,
                'sj_lng'        => $request->lng,
                'sj_lat'        => $request->lat,
                'sj_deskripsi'  => $request->description,
                'sj_youtube'    => $request->link,
                'sj_gambar'     => $file->getClientOriginalName(),


            ];
            
            $sejarah::find($id)->update($data);
            $path       = public_path('/images/sejarah');
            $upload     = $file->move($path, $file->getClientOriginalName());

            Session::flash('success', 'Updated Successfully!!');
            
            return redirect()->back();
        } 

        $this->validate($request, [
            
            'nama_sejarah'          => 'required|max:50',
            'kategori_sejarah'      => 'required',
            'alamat'                => 'required',
            'lng'                   => 'required',
            'lat'                   => 'required',
            'description'           => 'required',
            'link'                  => 'required',

        ]);

        $data  = [
            
            'sj_nama'       => $request->nama_sejarah,
            'ks_id'         => $request->kategori_sejarah,
            'sj_alamat'     => $request->alamat,
            'sj_lng'        => $request->lng,
            'sj_lat'        => $request->lat,
            'sj_deskripsi'  => $request->description,
            'sj_youtube'    => $request->link,


        ];

        

        $sejarah::find($id)->update($data);

        Session::flash('success', 'Updated Successfully!!');
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $sejarah = Sejarah::find($id);
        $sejarah->delete();

        // redirect
        Session::flash('message', 'Successfully deleted!');
        return redirect()->back();
    }
}
