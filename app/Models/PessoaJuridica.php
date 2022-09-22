<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    use HasFactory;
    protected $table = 'pessoa_juridica';
    protected $primaryKey = 'id_pessoa_juridica';
    protected $fillable = array('cnpj','razao_social','nome_fantasia','indicador_inscricao_estadual','inscricao_estadual','inscricao_municipal','situacao_cnpj','recolhimento');
}
