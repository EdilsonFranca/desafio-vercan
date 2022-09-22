<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;
    protected $table = 'fornecedor';
    protected $primaryKey = 'id_fornecedor';
    protected $fillable = array('observacao','ativo','tipo');


    public function pessoa_fisica()
    {
        return $this->hasOne(PessoaFisica::class, 'fornecedor_id');
    }

    public function pessoa_juridica()
    {
        return $this->hasOne(PessoaJuridica::class, 'fornecedor_id');
    }

    public function contato_principal()
    {
        return $this->hasOne(ContatoPrincipal::class,'fornecedor_id');
    }

    public function contato_adicionais()
    {
        return $this->hasMany(ContatoAdicional::class, 'fornecedor_id');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'fornecedor_id');
    }
}
