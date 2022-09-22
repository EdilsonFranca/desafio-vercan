<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $table = 'endereco';
    protected $primaryKey = 'id_endereco';
    protected $fillable = array('cep','logradouro','numero','complemento','bairro','referencia','uf','cidade','condominio','numero_condominio','endereco_condominio');
}
