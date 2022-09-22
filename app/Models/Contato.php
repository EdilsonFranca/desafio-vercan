<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'contato';
    protected $primaryKey = 'id_contato';
    protected $fillable = array('telefone','tipo_telefone','email','tipo_email','contato_principal_id');
}

