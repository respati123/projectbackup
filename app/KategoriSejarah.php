<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sejarah;

class KategoriSejarah extends Model
{
    //
    protected $table = 'kategori_sejarah';
    protected $primaryKey = 'ks_id';

    protected $fillable = [
        'ks_id','ks_nama', 'ks_gambar', 'ks_jumlah'
    ];
        
    public function sejarah(){
        return $this->hasMany(Sejarah::class);
    }
    
    public $timestamps = false;

    public static function count(){
        
        $query = KategoriSejarah::all();
        return count($query);
    }

    public static function IncreaseCount($id){

        
        try { 
            $query = KategoriSejarah::find($id)->increment('ks_jumlah', 1);
          } catch(\Illuminate\Database\QueryException $ex){ 
            dd($ex->getMessage()); 
            
          }
    }
}
