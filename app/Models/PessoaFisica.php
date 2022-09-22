<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    use HasFactory;
    protected $table = 'pessoa_fisica';
    protected $primaryKey = 'id_pessoa_fisica';
    protected $fillable = array('nome','cpf','apelido','rg');
}
