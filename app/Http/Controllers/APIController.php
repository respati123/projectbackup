<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transformers\KategoriSejarahTransformer;
use App\Transformers\ListSejarahTransformer;
use App\Transformers\DetailSejarahTransformer;
use App\Transformers\RandomSejarahTransformer;
use App\Transformers\ListMapsSejarahTransformer;
use App\KategoriSejarah;
use App\Sejarah;

class APIController extends Controller
{

    public function getSliderSejarah(){
        $kategori = Sejarah::inRandomOrder()->limit(5)->get();
        $response = fractal()
            ->collection($kategori)
            ->transformWith(new RandomSejarahTransformer)
            ->toArray();

        return response()->json($response,200); 
        
    }

    public function getMapsSejarah(){
        $kategori = Sejarah::all();
        $response = fractal()
            ->collection($kategori)
            ->transformWith(new ListMapsSejarahTransformer)
            ->toArray();

        return response()->json($response,200); 
        
    }

    public function getKategoriSejarah(){
        $kategori = KategoriSejarah::all();
        $response = fractal()
            ->collection($kategori)
            ->transformWith(new KategoriSejarahTransformer)
            ->toArray();

        return response()->json($response,200); 
        
    }

    public function getListSejarah($id){
        $listSejarah = Sejarah::where('ks_id','=',$id)->get();
    
        $response = Fractal()
                ->collection($listSejarah)
                ->transformWith(new ListSejarahTransformer)
                ->toArray();
    
        return response()->json($response, 200);
    }
    
    public function getDetailSejarah($id){    
        $detailSejarah = Sejarah::where('sj_id','=',$id)->get();
        $response = Fractal()
                ->collection($detailSejarah)
                ->transformWith(new DetailSejarahTransformer)
                ->toArray();
    
        return response()->json($response, 200);
    }

}
