<?php

namespace App\Http\Service;

use App\Models\ContatoAdicional;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorService
{

    static function store(Request $request){
        $create = array(
            'observacao' => $request->observacao,
            'ativo'      => $request->ativo,
            'tipo'       => $request->tipo,
        );

        $fornecedor = Fornecedor::create($create);

        if ($request->tipo ==  'pessoa_juridica') {

            $create = array(
                'cnpj'                         => FornecedorService::deixarNumero($request->cnpj),
                'razao_social'                 => $request->razao_social,
                'nome_fantasia'                => $request->nome_fantasia,
                'indicador_inscricao_estadual' => $request->indicador_inscricao_estadual,
                'inscricao_estadual'           => $request->inscricao_estadual,
                'inscricao_municipal'          => $request->inscricao_municipal,
                'situacao_cnpj'                => $request->situacao_cnpj,
                'recolhimento'                 => $request->recolhimento,
            );

            $fornecedor->pessoa_juridica()->create($create);
        }
        else
        {
            $create = array(
                'nome'    => $request->nome,
                'rg'      => FornecedorService::deixarNumero($request->rg),
                'cpf'     => FornecedorService::deixarNumero( $request->cpf),
                'apelido' => $request->apelido,
            );

            $fornecedor->pessoa_fisica()->create($create);
        }

        $create = array();
        foreach ($request->telefone as $x => $tell)
        {
            if (isset($request->tipo_email[$x]))
            {
                $data = array(
                    'telefone'      => FornecedorService::deixarNumero($tell),
                    'tipo_telefone' => $request->tipo_telefone[$x],
                    'email'         => $request->email[$x],
                    'tipo_email'    => $request->tipo_email[$x]
                );

            } else {

                $data = array(
                    'telefone'      => FornecedorService::deixarNumero($tell),
                    'tipo_telefone' => $request->tipo_telefone[$x],
                );
            }
            array_push($create, $data);
        }

        $contato_principal = $fornecedor->contato_principal()->create();

        $contato_principal->contatos()->createMany($create);

        if (isset($request->nome_contato_adicional ) && $request->nome_contato_adicional[0] != null)
        {
            $create = array();

            foreach ($request->nome_contato_adicional as $c => $contato_adicional) {

                $create = array(
                    'nome'           => $request->nome_contato_adicional[$c],
                    'empresa'        => $request->empresa_contato_adicional[$c],
                    'cargo'          => $request->cargo_contato_adicional[$c],
                    'fornecedor_id'  => $fornecedor->id_fornecedor,
                );

                $index_contato     = $c + 1;
                $contato_adicional = ContatoAdicional::create($create);
                $create = array();

                if (count($request->telefone_contato_adicional[$index_contato]) > count($request->email_contato_adicional[$index_contato]))
                {
                    foreach ($request->telefone_contato_adicional[$index_contato] as $x => $telefone)
                    {
                        if (isset($request->email_contato_adicional[$index_contato][$x]))
                        {
                            $data = array(
                                'telefone'      => FornecedorService::deixarNumero($telefone),
                                'tipo_telefone' => $request->tipo_telefone_contato_adicional[$index_contato][$x],
                                'email'         => $request->email_contato_adicional[$index_contato][$x],
                                'tipo_email'    => $request->tipo_email_contato_adicional[$index_contato][$x]
                            );

                        } else {

                            $data = array(
                                'telefone'      => FornecedorService::deixarNumero($telefone),
                                'tipo_telefone' => $request->tipo_telefone_contato_adicional[$index_contato][$x]
                            );

                        }
                        array_push($create, $data);
                    }

                } else {

                    foreach ($request->email_contato_adicional[$index_contato] as $x => $email)
                    {
                        if (isset($request->telefone_contato_adicional[$index_contato][$x]))
                        {
                            $data = array(
                                'telefone'      => FornecedorService::deixarNumero($request->telefone_contato_adicional[$index_contato][$x]),
                                'tipo_telefone' => $request->tipo_telefone_contato_adicional[$index_contato][$x],
                                'email'         => $email,
                                'tipo_email'    => $request->tipo_email_contato_adicional[$index_contato][$x]
                            );

                        } else {

                            $data = array(
                                'email'      => $email,
                                'tipo_email' => $request->tipo_email_contato_adicional[$index_contato][$x]
                            );
                        }
                        array_push($create, $data);
                    }
                }
                $contato_adicional->contatos()->createMany($create);
            }
        }

        $create = array(
            'cep'                => FornecedorService::deixarNumero($request->cep),
            'logradouro'         => $request->logradouro,
            'numero'             => $request->numero,
            'complemento'        => $request->complemento,
            'bairro'             => $request->bairro,
            'referencia'         => $request->ponto_referencia,
            'uf'                 => $request->uf,
            'cidade'             => $request->cidade,
            'condominio'         => $request->condominio,
            'numero_condominio'  => $request->numero_condominio,
            'endereco_condominio' => $request->endereco_condominio,
        );

        $fornecedor->endereco()->create($create);
    }

    static function update(Request $request)
    {
        $fornecedor = Fornecedor::find($request->id);

        $fill = array(
            'observacao' => $request->observacao,
            'ativo'      => $request->ativo,
            'tipo'       => $request->tipo,
        );

        $fornecedor->fill($fill);
        $fornecedor->save();

        if ($request->tipo == 'pessoa_juridica') {

            $update = array(
                'cnpj'                         => FornecedorService::deixarNumero($request->cnpj),
                'razao_social'                 => $request->razao_social,
                'nome_fantasia'                => $request->nome_fantasia,
                'indicador_inscricao_estadual' => $request->indicador_inscricao_estadual,
                'inscricao_estadual'           => $request->inscricao_estadual,
                'inscricao_municipal'          => $request->inscricao_municipal,
                'situacao_cnpj'                => $request->situacao_cnpj,
                'recolhimento'                 => $request->recolhimento,
            );

            $fornecedor->pessoa_juridica()->update($update);

        } else {

            $update = array(
                'nome'    => $request->nome,
                'rg'      => $request->rg,
                'cpf'     => FornecedorService::deixarNumero( $request->cpf),
                'apelido' => $request->apelido,
            );

            $fornecedor->pessoa_fisica()->update($update);
        }

        $update = array(
            'cep'               => FornecedorService::deixarNumero($request->cep),
            'logradouro'        => $request->logradouro,
            'numero'            => $request->numero,
            'complemento'       => $request->complemento,
            'bairro'            => $request->bairro,
            'referencia'        => $request->ponto_referencia,
            'uf'                => $request->uf,
            'cidade'            => $request->cidade,
            'condominio'        => $request->condominio,
            'numero_condominio' => $request->numero_condominio,
            'endereco_condominio' => $request->endereco_condominio,
        );

        $fornecedor->endereco()->update($update);

        $fornecedor->contato_principal()->delete();
        $fornecedor->contato_adicionais()->delete();

        $create = array();
        if (count($request->telefone) > count($request->email))
            foreach ($request->telefone as $x => $tell)
        {
            if (isset($request->tipo_email[$x]))
                $data = array(
                    'telefone'      => FornecedorService::deixarNumero($tell),
                    'tipo_telefone' => $request->tipo_telefone[$x],
                    'email'         => $request->email[$x],
                    'tipo_email'    => $request->tipo_email[$x]
                );

            else
                $data = array(
                    'telefone'      => FornecedorService::deixarNumero($tell),
                    'tipo_telefone' => $request->tipo_telefone[$x],
                );

            array_push($create, $data);
        }
        else
            foreach ($request->email as $x => $email)
            {
                if (isset($request->tipo_telefone[$x]))
                    $data = array(
                        'telefone'      => FornecedorService::deixarNumero($request->telefone[$x]),
                        'tipo_telefone' => $request->tipo_telefone[$x],
                        'email'         => $email,
                        'tipo_email'    => $request->tipo_email[$x]
                    );

                else
                    $data = array(
                        'email'         => $email,
                        'tipo_email'    => $request->tipo_email[$x]
                    );

                array_push($create, $data);
            }

        $contato_principal = $fornecedor->contato_principal()->create();

        $contato_principal->contatos()->createMany($create);

        $create = array();

        if (isset($request->nome_contato_adicional))
            foreach ($request->nome_contato_adicional as $c => $contato_adicional)
           {
            $create = array(
                'nome'           => $request->nome_contato_adicional[$c],
                'empresa'        => $request->empresa_contato_adicional[$c],
                'cargo'          => $request->cargo_contato_adicional[$c],
                'fornecedor_id'  => $fornecedor->id_fornecedor,
            );

            $index_contato = $c + 1;
            $contato_adicional = ContatoAdicional::create($create);
            $create = array();

            if (!isset($request->email_contato_adicional[$index_contato]) ||
                isset($request->telefone_contato_adicional[$index_contato]) && count($request->telefone_contato_adicional[$index_contato]) >
                count($request->email_contato_adicional[$index_contato]))
            {
                foreach ($request->telefone_contato_adicional[$index_contato] as $x => $telefone)
                {
                    if (isset($request->email_contato_adicional[$index_contato][$x]))
                    {
                        $data = array(
                            'telefone'      => FornecedorService::deixarNumero($telefone),
                            'tipo_telefone' => $request->tipo_telefone_contato_adicional[$index_contato][$x],
                            'email'         => $request->email_contato_adicional[$index_contato][$x],
                            'tipo_email'    => $request->tipo_email_contato_adicional[$index_contato][$x]
                        );

                    } else {

                        $data = array(
                            'telefone'      => FornecedorService::deixarNumero($telefone),
                            'tipo_telefone' => $request->tipo_telefone_contato_adicional[$index_contato][$x]
                        );

                    }
                    array_push($create, $data);
                }

            } else {

                foreach ($request->email_contato_adicional[$index_contato] as $x => $email)
                {
                    if (isset($request->telefone_contato_adicional[$index_contato][$x]))
                    {
                        $data = array(
                            'telefone'      => FornecedorService::deixarNumero($request->telefone_contato_adicional[$index_contato][$x]),
                            'tipo_telefone' => $request->tipo_telefone_contato_adicional[$index_contato][$x],
                            'email'         => $email,
                            'tipo_email'    => $request->tipo_email_contato_adicional[$index_contato][$x]
                        );

                    } else {

                        $data = array(
                            'email'      => $email,
                            'tipo_email' => $request->tipo_email_contato_adicional[$index_contato][$x]
                        );

                    }
                    array_push($create, $data);
                }
            }
            $contato_adicional->contatos()->createMany($create);
        }

        return $fornecedor->tipo == 'pessoa_fisica'? $fornecedor->pessoa_fisica->nome : $fornecedor->pessoa_juridica->nome_fantasia;
    }

    static function destroy(Request $request){

        $with = array(
            'pessoa_fisica',
            'pessoa_juridica'
        );

        $fornecedor = Fornecedor::where('id_fornecedor', $request->id)->with($with)->first();

        $nome  = $fornecedor->tipo == 'pessoa_fisica'?
                 $fornecedor->pessoa_fisica->nome :
                 $fornecedor->pessoa_juridica->nome_fantasia;

        $fornecedor->pessoa_fisica()->delete();
        $fornecedor->pessoa_juridica()->delete();
        $fornecedor->contato_principal()->delete();
        $fornecedor->contato_adicionais()->delete();
        $fornecedor->endereco()->delete();
        $fornecedor->delete();

        return $nome;
    }

    static function deixarNumero($string): string
    {
        return preg_replace("/[^0-9]/", "", $string);
    }

    static function getTemplateDropMenu($row): string
    {
        return "<div class='dropdown'>
                <button class='btn btn-sm btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'> </button>
                <ul class='dropdown-menu'>
                    <li><a class='dropdown-item small' href='fornecedor/$row->id_fornecedor/ver'>Ver</a></li>
                    <li><a class='dropdown-item small' href='fornecedor/$row->id_fornecedor/editar'>Editar</a></li>
                    <li><hr class='dropdown-divider'></li>
                    <li><a class='dropdown-item small' href='fornecedor/$row->id_fornecedor/remover'>Remover</a></li>
                </ul>
            </div>";
    }
}
