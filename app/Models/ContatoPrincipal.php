<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContatoPrincipal extends Model
{
    use HasFactory;
    protected $table = 'contato_principal';
    protected $primaryKey = 'id_contato_principal';
    protected $fillable = array('id_contato_principal','fornecedor_id');

    public function contatos()
    {
        return $this->hasMany(Contato::class, 'contato_principal_id');
    }
}
