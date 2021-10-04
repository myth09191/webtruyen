<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhmucTruyen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillabe  = [
        'tendanhmuc', 'motadanhmuc', 'kichhoat', 'slug_danhmuc'
    ];
    protected $primaryKey = 'id';
    protected $table = 'danhmuc';
    public function truyen(){
        return $this->hasMany('App\Models\Truyen','danhmuc_id', 'id');
    }
}
