<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
	
	public function visits() {
		return $this->hasMany('App\Models\Visit');
	}
	
	protected $fillable = [
        'name',
        'file_path'
    ];
}
