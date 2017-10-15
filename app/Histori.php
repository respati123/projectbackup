<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Histori extends Model
{
    //
    protected $table = 'histori_pengguna';
    
    protected $fillable = [
        'hp_id','us_id', 'hp_deskripsi'
    ];
            
    public function sejarah(){
        return $this->belongsTo(User::class);
    }
            
    public static function getHistori(){
        return Histori::all();   
    }

}
