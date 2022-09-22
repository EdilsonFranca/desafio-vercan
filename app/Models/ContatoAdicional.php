<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContatoAdicional extends Model
{
    use HasFactory;
    protected $table = 'contato_adicional';
    protected $primaryKey = 'id_contato_adicional';
    protected $fillable = array('nome','empresa','cargo','fornecedor_id');

    public function contatos()
    {
        return $this->hasMany(Contato::class, 'contato_adicional_id');
    }
}
