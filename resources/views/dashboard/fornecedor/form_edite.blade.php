@extends('dashboard.layout')
@section('conteudo')
    <link href={{ asset("css/form.css") }} rel="stylesheet"/>
    <link href={{ asset("lib/css/bootstrap.css") }} rel="stylesheet"/>
    <link href={{ asset("lib/css/prettify.css") }} rel="stylesheet"/>
    <link href={{ asset("lib/css/wysiwyg-color.css") }} rel="stylesheet"/>

    <link href={{ asset("wysihtml5/bootstrap-wysihtml5.css") }} rel="stylesheet"/>
    <div class="clone col-md-12 row email_clone">
        <div class="mb-3 col-md-6">
            <label for="email" class="form-label fw-bold">E-mail</label>
            <input name="email[]" value="" class="form-control rounded-0" id="email">
        </div>
        <div class="mb-3 col-md-6">
            <label for="tipo_email" class="form-label fw-bold">Tipo</label>
            <select name="tipo_email[]" class="form-control rounded-0" id="tipo_email">
                <option value="">Selecione</option>
                <option value="pessoal">Pessoal</option>
                <option value="comercial">Comercial</option>
                <option value="outros">Outro</option>
            </select>
        </div>
        <a class="text-dark remover_email"><small class=" cursor_pointer">Remover</small></a>
    </div>
    <div class="clone col-md-12 row telefone_clone">
        <div class="mb-3 col-md-6">
            <label for="telefone" class="form-label fw-bold obrigatorio">Telefone</label>
            <input name="telefone[]" value="" required class="form-control rounded-0 telefone"
                   data-mask="(00) 00000-0000">
        </div>

        <div class="mb-3 col-md-6">
            <label for="tipo_telefone" required class="form-label fw-bold obrigatorio">Tipo</label>
            <select name="tipo_telefone[]" class="form-control rounded-0" id="tipo_telefone">
                <option value="">Selecione</option>
                <option value="residencial">
                    Residencial
                </option>
                <option value="comercial">
                    Comercial
                </option>
                <option value="celular">
                    Celular
                </option>
            </select>
        </div>

        <a class="text-dark remover_telefone"><small class=" cursor_pointer">Remover</small></a>
    </div>
    <div class="clone p-3 row px-0 contato_adicionais contato_adicionais_clone" data-number="1">

        <div class="col-md-6 row telefone_box d-flex align-content-start flex-wrap">
            <div class="col-md-12 row">

                <div class="mb-3 col-md-12">
                    <label for="nome_contato_adicional" class="form-label fw-bold">Nome</label>
                    <input disabled name="nome_contato_adicional[]" class="form-control rounded-0">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="telefone_contato_adicional" class="form-label fw-bold">Telefone</label>
                    <input disabled name="telefone_contato_adicional[1][]" class="telefone_contato_adicional form-control rounded-0 telefone" data-mask="(00) 00000-0000">
                </div>

                <div class="mb-3 col-md-6">

                    <label for="tipo_telefone" class="form-label fw-bold">Tipo</label>
                    <select disabled name="tipo_telefone_contato_adicional[1][]" class="tipo_telefone_contato_adicional form-control rounded-0">
                        <option value="">Selecione</option>
                        <option value="residencial">Residencial</option>
                        <option value="comercial">Comercial</option>
                        <option value="celular">Celular</option>
                    </select>
                </div>
            </div>

            <a class="text-dark adicionar_telefone" data-type="adicionais"><small class=" cursor_pointer">Adicionar</small></a>
        </div>

        <div class="col-md-6 row  email_box d-flex align-content-start flex-wrap">
            <div class="col-md-12 row">

                <div class="mb-3 col-md-6">
                    <label for="empresa_contato_adicional" class="form-label fw-bold">Empresa</label>
                    <input disabled name="empresa_contato_adicional[]" class="form-control rounded-0">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="cargo_contato_adicional" class="form-label fw-bold">Cargo</label>
                    <input disabled name="cargo_contato_adicional[]" class="form-control rounded-0">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="email_contato_adicional" class="form-label fw-bold">E-mail</label>
                    <input disabled name="email_contato_adicional[1][]" class="email_contato_adicional form-control rounded-0">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="tipo_email_contato_adicional[]" class="form-label fw-bold">Tipo</label>
                    <select disabled name="tipo_email_contato_adicional[1][]" class="tipo_email_contato_adicional form-control rounded-0">
                        <option value="">Selecione</option>
                        <option value="pessoal">Pessoal</option>
                        <option value="comercial">Comercial</option>
                        <option value="outros">Outro</option>
                    </select>
                </div>
            </div>
            <a class="text-dark adicionar_email" data-type="adicionais"><small class=" cursor_pointer">Adicionar</small></a>
        </div>

        <p class="text-end d-flex">
            <span class="d-block border-bottom border-1 mb-1" style="width: 90%"></span>
            <a class="text-dark remover_contato_adicionais"><small class=" cursor_pointer">Remover</small></a>
        </p>
    </div>
    <div class="d-flex py-2 align-items-center w-100">
        <div class="col-6 d-flex"><h5 class="ms-2">Fornecedores </h5><span class="ms-2">Editar</span></div>
    </div>
    <div class=" section-conteudo-body">
        <input type="hidden" value="{{ $type }}" id="tipo_de_acao">
        <form action="update" method="POST" class="form-create">
            @csrf
            <div class="accordion mb-3" id="accordionExample">
                <div class="accordion-item  border-top border-4">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button text-secondary bg-white" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                            Dados do Fornecedor
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show position-relative"
                         aria-labelledby="headingOne"
                         data-bs-parent="#accordionExample">
                        <div class="p-3">

                            <div class="form-check form-check-inline">
                                <input
                                    {{  $fornecedor->tipo == "pessoa_juridica" ? "checked" : ''}}  class="form-check-input"
                                    name="tipo" type="radio" id="pessoa_juridica_input" value="pessoa_juridica">
                                <label class="form-check-label" for="pessoa_juridica_input"> Pessoa Jur??dica</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input
                                    {{  $fornecedor->tipo == "pessoa_fisica" ? "checked" : ''}}  class="form-check-input"
                                    name="tipo" type="radio" id="pessoa_fisica_input" value="pessoa_fisica">
                                <label class="form-check-label" for="pessoa_fisica_input">Pessoa F??sica</label>
                            </div>
                        </div>

                        <div id="pessoa_fisica"
                             style="{{  $fornecedor->tipo == "pessoa_fisica" ? "display:block" : 'display:none'}}">

                            <div class="p-3 row">
                                <div class="mb-3 col-md-3">
                                    <label for="cpf" class="form-label fw-bold obrigatorio">CPF</label>
                                    <input name="cpf"
                                           value="@if( isset($fornecedor->pessoa_fisica)) {{$fornecedor->pessoa_fisica->cpf }} @endIf "
                                           class="form-control rounded-0" id="cpf" data-mask="000.000.000-00">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nome" class="form-label fw-bold obrigatorio">Nome</label>
                                    <input name="nome" class="form-control rounded-0" id="nome"
                                           value="@if( isset($fornecedor->pessoa_fisica)) {{$fornecedor->pessoa_fisica->nome }} @endIf ">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="apelido" class="form-label fw-bold">Apelido</label>
                                    <input name="apelido" class="form-control rounded-0" id="apelido"
                                           value="@if( isset($fornecedor->pessoa_fisica)) {{$fornecedor->pessoa_fisica->apelido }} @endIf ">
                                </div>
                            </div>

                            <div class="p-3 row">
                                <div class="mb-3 col-md-3">
                                    <label for="rg" class="form-label fw-bold obrigatorio">RG</label>
                                    <input name="rg" class="form-control rounded-0" id="rg"
                                           value="@if( isset($fornecedor->pessoa_fisica)) {{$fornecedor->pessoa_fisica->rg }} @endIf ">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="ativo" class="form-label fw-bold obrigatorio">Ativo</label>
                                    <select name="ativo" required class="form-control rounded-0" id="ativo"
                                            value="@if( isset($fornecedor->pessoa_fisica)) {{$fornecedor->pessoa_fisica->ativo }} @endIf ">
                                        <option value="">Selecione</option>
                                        <option
                                            {{  $fornecedor->pessoa_fisica && $fornecedor->pessoa_fisica->ativo == 0 ? "selected" :''}} value="0">
                                            N??o
                                        </option>
                                        <option
                                            {{  $fornecedor->pessoa_fisica && $fornecedor->pessoa_fisica->ativo == 1 ? "selected" :''}} value="1"
                                            selected>Sim
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="pessoa_juridica"
                             style="{{  $fornecedor->tipo == "pessoa_juridica" ? "display:block" : 'display:none'}}">
                            <div class="p-3 row">
                                <div class="mb-3 col-md-3">
                                    <label for="cnpj" class="form-label fw-bold obrigatorio">CNPJ</label>
                                    <input name="cnpj" required minlength="18" maxlength="18"
                                           value="@if( isset($fornecedor->pessoa_juridica)) {{$fornecedor->pessoa_juridica->cnpj }} @endIf "
                                           class="form-control rounded-0" id="cnpj" data-mask="00.000.000/0000-00">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="razao_social" class="form-label fw-bold obrigatorio">Raz??o Social</label>
                                    <input name="razao_social" required class="form-control rounded-0"
                                           value="@if( isset($fornecedor->pessoa_juridica)) {{$fornecedor->pessoa_juridica->razao_social }} @endIf "
                                           id="razao_social">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="nome_fantasia" class="form-label fw-bold obrigatorio">Nome Fantasia</label>
                                    <input name="nome_fantasia" required class="form-control rounded-0"
                                           value="@if( isset($fornecedor->pessoa_juridica)) {{$fornecedor->pessoa_juridica->nome_fantasia }} @endIf "
                                           id="nome_fantasia">
                                </div>
                            </div>
                            <div class="p-3 row">
                                <div class="mb-3 col-md-3">
                                    <label for="indicador_inscricao_estadual" class="form-label fw-bold obrigatorio">Indicador de Inscri????o Estadual</label>

                                    <select required name="indicador_inscricao_estadual" class="form-control rounded-0" id="indicador_inscricao_estadual">
                                        <option value="">Selecione</option>
                                        <option
                                            {{  $fornecedor->pessoa_juridica && $fornecedor->pessoa_juridica->indicador_inscricao_estadual == "contribuinte" ? "selected" :''}} value="contribuinte">
                                            Contribuinte
                                        </option>
                                        <option
                                            {{  $fornecedor->pessoa_juridica && $fornecedor->pessoa_juridica->indicador_inscricao_estadual == "contribuinte_isento" ?"selected" :''}} value="contribuinte_isento">
                                            Contribuinte Isento
                                        </option>
                                        <option
                                            {{  $fornecedor->pessoa_juridica && $fornecedor->pessoa_juridica->indicador_inscricao_estadual == "nao_contribuinte" ?"selected" :''}} value="nao_contribuinte">
                                            N??o Contribuinte
                                        </option>
                                    </select>

                                </div>

                                <div class="mb-3 col-md-3">
                                    <label for="inscricao_estadual" class="form-label fw-bold">Inscri????o Estadual</label>
                                    <input name="inscricao_estadual" class="form-control rounded-0  disabled"
                                           value="@if( isset($fornecedor->pessoa_juridica)) {{$fornecedor->pessoa_juridica->inscricao_estadual }} @endIf "
                                           id="inscricao_estadual">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="inscricao_municipal" class="form-label fw-bold">Inscri????o Municipal</label>
                                    <input name="inscricao_municipal" class="form-control rounded-0"
                                           value="@if( isset($fornecedor->pessoa_juridica)) {{$fornecedor->pessoa_juridica->inscricao_municipal }} @endIf "
                                           id="inscricao_municipal">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="situacao_cnpj" class="form-label fw-bold">Situa????o CNPJ</label>
                                    <input name="situacao_cnpj" class="form-control rounded-0 disabled"
                                           value="@if( isset($fornecedor->pessoa_juridica)) {{$fornecedor->pessoa_juridica->situacao_cnpj }} @endIf "
                                           id="situ_cnpj">
                                </div>

                            </div>

                            <div class="p-3 row">
                                <div class="mb-3 col-md-3">

                                    <label for="recolhimento"
                                           class="form-label fw-bold obrigatorio">Recolhimento</label>
                                    <select name="recolhimento" required class="form-control rounded-0"
                                            id="recolhimento">
                                        <option value="">Selecione</option>
                                        <option
                                            {{  $fornecedor->pessoa_juridica && $fornecedor->pessoa_juridica->recolhimento == "recolher" ? "selected" :''}} value="recolher">
                                            A Recolher pelo Prestador
                                        </option>
                                        <option
                                            {{  $fornecedor->pessoa_juridica && $fornecedor->pessoa_juridica->recolhimento == "retido" ? "selected" :''}} value="retido">
                                            Retido pelo Tomador
                                        </option>
                                    </select>

                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="ativo" class="form-label fw-bold obrigatorio">Ativo</label>
                                    <select name="ativo" required class="form-control rounded-0" id="ativo">
                                        <option value="">Selecione</option>
                                        <option
                                            {{  $fornecedor->pessoa_juridica && $fornecedor->pessoa_juridica->ativo == 0 ? "selected" :''}} value="0">
                                            N??o
                                        </option>
                                        <option
                                            {{  $fornecedor->pessoa_juridica && $fornecedor->pessoa_juridica->ativo == 1 ? "selected" :''}} value="1"
                                            selected>Sim
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="accordion mb-3" id="accordionExample1">
                <div class="accordion-item border-top border-4">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed text-secondary  bg-white" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                                aria-controls="collapseTwo">
                            Contato Principal
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                         data-bs-parent="#accordionExample1">
                        <div class="accordion-body">
                            <div>
                                <div class="p-3 row px-0">
                                    <div class="col-md-6 row telefone_box d-flex align-content-start flex-wrap">
                                        <div class="col-md-12 row">

                                            <div class="mb-3 col-md-6">
                                                <label for="telefone"
                                                       class="form-label fw-bold obrigatorio">Telefone</label>
                                                <input name="telefone[]"
                                                       required
                                                       value="{{ $fornecedor->contato_principal->contatos[0]->telefone ?? '' }}"
                                                       class="form-control rounded-0 telefone"
                                                       data-mask="(00) 00000-0000">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="tipo_telefone" required
                                                       class="form-label fw-bold obrigatorio">Tipo</label>
                                                <select name="tipo_telefone[]" class="form-control rounded-0"
                                                        id="tipo_telefone">
                                                    <option value="">Selecione</option>
                                                    <option
                                                        value="residencial" {{ isset($fornecedor->contato_principal) && $fornecedor->contato_principal->contatos[0]->tipo_telefone == 'residencial' ? "selected" :''}}>
                                                        Residencial
                                                    </option>
                                                    <option
                                                        value="comercial" {{ isset($fornecedor->contato_principal) && $fornecedor->contato_principal->contatos[0]->tipo_telefone == 'comercial' ? "selected" :''}}>
                                                        Comercial
                                                    </option>
                                                    <option
                                                        value="celular" {{ isset($fornecedor->contato_principal) && $fornecedor->contato_principal->contatos[0]->tipo_telefone == 'celular' ? "selected" :''}}>
                                                        Celular
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <a class="text-dark adicionar_telefone"><small class="cursor_pointer">Adicionar</small></a>
                                        @isset($fornecedor->contato_principal)
                                            @foreach ($fornecedor->contato_principal->contatos as $ix =>  $contato)
                                                @if($ix == 0) @continue  @endif
                                                @if( $contato->telefone)

                                                    <div class="col-md-12 row">

                                                        <div class="mb-3 col-md-6">
                                                            <label for="telefone"
                                                                   class="form-label fw-bold obrigatorio">Telefone</label>
                                                            <input name="telefone[]"
                                                                   required
                                                                   value="{{ $contato->telefone ?? '' }}"
                                                                   class="form-control rounded-0 telefone"
                                                                   data-mask="(00) 00000-0000">
                                                        </div>

                                                        <div class="mb-3 col-md-6">
                                                            <label for="tipo_telefone" required
                                                                   class="form-label fw-bold obrigatorio">Tipo</label>
                                                            <select name="tipo_telefone[]"
                                                                    class="form-control rounded-0"
                                                                    id="tipo_telefone">
                                                                <option value="">Selecione</option>
                                                                <option
                                                                    value="residencial" {{ $contato->tipo_telefone == 'residencial' ? "selected" :''}}>
                                                                    Residencial
                                                                </option>
                                                                <option
                                                                    value="comercial" {{ $contato->tipo_telefone == 'comercial' ? "selected" :''}}>
                                                                    Comercial
                                                                </option>
                                                                <option
                                                                    value="celular" {{ $contato->tipo_telefone == 'celular' ? "selected" :''}}>
                                                                    Celular
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <a class="text-dark remover_telefone"><small class=" cursor_pointer">Remover</small></a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </div>

                                    <div class="col-md-6 row  email_box d-flex align-content-start flex-wrap">
                                        <div class="col-md-12 row">
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label fw-bold">E-mail</label>
                                                <input name="email[]"
                                                       value="{{ $fornecedor->contato_principal->contatos[0]->email ?? '' }}"
                                                       class="form-control rounded-0" id="email">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="tipo_email" class="form-label fw-bold">Tipo</label>
                                                <select name="tipo_email[]" class="form-control rounded-0"
                                                        id="tipo_email">
                                                    <option value="">Selecione</option>
                                                    <option
                                                        value="pessoal" {{ isset($fornecedor->contato_principal) && $fornecedor->contato_principal->contatos[0]->tipo_email == 'pessoal' ? "selected" :''}}>
                                                        Pessoal
                                                    </option>
                                                    <option   value="comercial"  {{ isset($fornecedor->contato_principal) &&  $fornecedor->contato_principal->contatos[0]->tipo_email == 'comercial' ? "selected" :''}}>
                                                        Comercial
                                                    </option>
                                                    <option   value="outros"  {{ isset($fornecedor->contato_principal) &&  $fornecedor->contato_principal->contatos[0]->tipo_email == 'outros' ? "selected" :''}}>
                                                        Outro
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <a class="text-dark adicionar_email"><small class="cursor_pointer">Adicionar</small></a>
                                        @isset($fornecedor->contato_principal)
                                            @foreach ($fornecedor->contato_principal->contatos as $ix =>  $contato)
                                                @if($ix == 0) @continue  @endif
                                                @if( $contato->email)

                                                        <div class="col-md-12 row">
                                                            <div class="mb-3 col-md-6">
                                                                <label for="email" class="form-label fw-bold">E-mail</label>
                                                                <input name="email[]"
                                                                       value="{{ $contato->email ?? '' }}"
                                                                       class="form-control rounded-0" id="email">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label for="tipo_email" class="form-label fw-bold">Tipo</label>
                                                                <select name="tipo_email[]" class="form-control rounded-0" id="tipo_email">
                                                                    <option value="">Selecione</option>
                                                                    <option value="pessoal" {{ $contato->tipo_email == 'pessoal' ? "selected" :''}}>
                                                                        Pessoal
                                                                    </option>
                                                                    <option value="comercial" {{ $contato->tipo_email == 'comercial' ? "selected" :''}}>
                                                                        Comercial
                                                                    </option>
                                                                    <option value="outros"  {{ $contato->tipo_email == 'outros' ? "selected" :''}}>
                                                                        Outro
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <a class="text-dark remover_email"><small
                                                                    class=" cursor_pointer">Remover</small></a>
                                                        </div>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-end"><a class="text-dark cursor_pointer add_contato_adicionais">ADICIONAR</a></p>

            <div class="accordion mb-3" id="accordionExample2">
                <div class="accordion-item border-top border-4">
                    <h2 class="accordion-header" id="headingTwo" style="display: none">
                        <button class="accordion-button collapsed text-secondary  bg-white" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                                aria-controls="collapseTwo">
                            Contatos Adicionais
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                         data-bs-parent="#accordionExample2">
                        <div class="accordion-body">
                            <div class="box_contato_adicionais">

                                <p class="text-center text-muted mensagem_sem_contato"
                                   @if( count($fornecedor->contato_adicionais)) style="display: none" @endIf >N??O H??
                                    CONTATOS ADICIONAIS.</p>

                                @foreach ($fornecedor->contato_adicionais as $key => $contato_adicional)
                                    @php
                                        $index = $key + 1
                                    @endphp
                                    <div class="p-3 row px-0 contato_adicionais" style="display: flex" data-number="{{ $index}}">

                                        <div class="col-md-6 row telefone_box d-flex align-content-start flex-wrap">
                                            <div class="col-md-12 row">

                                                <div class="mb-3 col-md-12">
                                                    <label for="nome_contato_adicional"
                                                           class="form-label fw-bold">Nome</label>
                                                    <input name="nome_contato_adicional[]"
                                                           value="@if(isset($fornecedor) && isset($contato_adicional)) {{ $contato_adicional->nome }} @endIf "
                                                           class="form-control rounded-0">
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="telefone_contato_adicional" class="form-label fw-bold">Telefone</label>
                                                    <input name="telefone_contato_adicional[{{$index}}][]"
                                                           class="form-control rounded-0 telefone"
                                                           data-mask="(00) 00000-0000"
                                                           value="@if(count($contato_adicional->contatos) > 0) {{ $contato_adicional->contatos[0]->telefone}} @endIf ">
                                                </div>

                                                <div class="mb-3 col-md-6">

                                                    <label for="tipo_telefone" class="form-label fw-bold">Tipo</label>
                                                    <select name="tipo_telefone_contato_adicional[{{ $index }}][]"
                                                            class="form-control rounded-0">
                                                        <option value="">Selecione</option>
                                                        <option
                                                            {{ count($contato_adicional->contatos) > 0 && $contato_adicional->contatos[0]->tipo_telefone  == 'residencial' ? "selected" :'' }}  value="residencial">
                                                            Residencial
                                                        </option>
                                                        <option
                                                            {{count($contato_adicional->contatos) > 0 &&  $contato_adicional->contatos[0]->tipo_telefone == 'comercial' ? "selected" :'' }}  value="comercial">
                                                            Comercial
                                                        </option>
                                                        <option
                                                            {{count($contato_adicional->contatos) > 0 &&  $contato_adicional->contatos[0]->tipo_telefone == 'celular' ? "selected" :'' }}  value="celular">
                                                            Celular
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <a class="text-dark adicionar_telefone" data-type="adicionais"><small
                                                    class=" cursor_pointer">Adicionar</small></a>

                                            @foreach ($contato_adicional->contatos as $indice => $contato)

                                                @if($indice == 0) @continue  @endif
                                                @if($contato->telefone)
                                                    <div class="col-md-12 row ">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="telefone"
                                                                   class="form-label fw-bold obrigatorio">Telefone</label>
                                                            <input name="telefone_contato_adicional[{{$index}}][]"
                                                                   value="{{ $contato ? $contato->telefone: '' }}"
                                                                   required class="form-control rounded-0 telefone"
                                                                   data-mask="(00) 00000-0000">
                                                        </div>

                                                        <div class="mb-3 col-md-6">
                                                            <label for="tipo_telefone" required
                                                                   class="form-label fw-bold obrigatorio">Tipo</label>
                                                            <select name="tipo_telefone_contato_adicional[{{$index}}][]"
                                                                    class="form-control rounded-0" id="tipo_telefone">
                                                                <option value="">Selecione</option>
                                                                <option
                                                                    {{ $contato && $contato->tipo_telefone == 'residencial' ? "selected" :'' }} value="residencial">
                                                                    Residencial
                                                                </option>
                                                                <option
                                                                    {{ $contato && $contato->tipo_telefone == 'comercial' ? "selected" :'' }} value="comercial">
                                                                    Comercial
                                                                </option>
                                                                <option
                                                                    {{ $contato && $contato->tipo_telefone == 'celular'  ? "selected" :''}} value="celular">
                                                                    Celular
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <a class="text-dark remover_telefone"><small
                                                                class=" cursor_pointer">Remover</small></a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="col-md-6 row  email_box d-flex align-content-start flex-wrap">
                                            <div class="col-md-12 row">

                                                <div class="mb-3 col-md-6">
                                                    <label for="empresa_contato_adicional" class="form-label fw-bold">Empresa</label>
                                                    <input name="empresa_contato_adicional[]"
                                                           value="@if(count($contato_adicional->contatos) > 0  ) {{ $contato_adicional->empresa }} @endIf "
                                                           class="form-control rounded-0">
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="cargo_contato_adicional" class="form-label fw-bold">Cargo</label>
                                                    <input name="cargo_contato_adicional[]"
                                                           value="@if(count($contato_adicional->contatos) > 0  ) {{ $contato_adicional->cargo }} @endIf "
                                                           class="form-control rounded-0">
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="email_contato_adicional" class="form-label fw-bold">E-mail</label>
                                                    <input name="email_contato_adicional[{{$index}}][]"
                                                           class="form-control rounded-0"
                                                           value="@if(count($contato_adicional->contatos) > 0  ) {{ $contato_adicional->contatos[0]->email}} @endIf ">
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="tipo_email_contato_adicional[]" class="form-label fw-bold">Tipo</label>
                                                    <select name="tipo_email_contato_adicional[{{$index}}][]"  class="form-control rounded-0">
                                                        <option value="">Selecione</option>
                                                        <option
                                                            {{count($contato_adicional->contatos) > 0 &&  $contato_adicional->contatos[0]->tipo_email == 'pessoal' ? "selected" :'' }}  value="pessoal">
                                                            Pessoal
                                                        </option>
                                                        <option
                                                            {{ count($contato_adicional->contatos) > 0 && $contato_adicional->contatos[0]->tipo_email == 'comercial' ? "selected" :'' }}  value="comercial">
                                                            Comercial
                                                        </option>
                                                        <option
                                                            {{ count($contato_adicional->contatos) > 0 && $contato_adicional->contatos[0]->tipo_email == 'outros' ? "selected" :'' }}  value="outros">
                                                            Outro
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <a class="text-dark adicionar_email" data-type="adicionais"><small
                                                    class=" cursor_pointer">Adicionar</small></a>
                                            @foreach ($contato_adicional->contatos as $indice => $contato)
                                                @if($indice == 0) @continue  @endif
                                                @if($contato->email)
                                                    <div class="col-md-12 row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="email" class="form-label fw-bold">E-mail</label>
                                                            <input name="email_contato_adicional[{{$index}}][]"
                                                                   value="{{ $contato ? $contato->email: '' }}"
                                                                   class="form-control rounded-0" id="email">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="tipo_email" class="form-label fw-bold">Tipo</label>
                                                            <select name="tipo_email_contato_adicional[{{$index}}][]" class="form-control rounded-0" id="tipo_email">
                                                                <option value="">Selecione</option>
                                                                <option
                                                                    {{ $contato && $contato->tipo_email == 'pessoal' ? "selected" :'' }}value="pessoal">
                                                                    Pessoal
                                                                </option>
                                                                <option
                                                                    {{ $contato && $contato->tipo_email == 'comercial' ? "selected" :'' }} value="comercial">
                                                                    Comercial
                                                                </option>
                                                                <option
                                                                    {{ $contato && $contato->tipo_email == 'outros' ? "selected" :'' }} value="outros">
                                                                    Outro
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <a class="text-dark remover_email"><small
                                                                class=" cursor_pointer">Remover</small></a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <p class="text-end d-flex">
                                            <span class="d-block border-bottom border-1 mb-1" style="width: 90%"></span>
                                            <a class="text-dark remover_contato_adicionais"><small class=" cursor_pointer">Remover</small></a>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion mb-3" id="accordionExample3">
                <div class="accordion-item border-top border-4">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed  text-secondary  bg-white" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true"
                                aria-controls="collapseThree">
                            Dados de Endere??o
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree"
                         data-bs-parent="#accordionExample3">
                        <div class="accordion-body">
                            <div>
                                <div class="p-3 row">
                                    <div class="mb-3 col-md-3">
                                        <label for="CEP" class="form-label fw-bold obrigatorio">CEP</label>
                                        <input name="cep"
                                               value="@if( isset($fornecedor->endereco)) {{$fornecedor->endereco->cep }} @endIf "
                                               required class="form-control rounded-0" id="CEP" data-mask="00000-000">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="logradouro"
                                               class="form-label fw-bold obrigatorio">Logradouro</label>
                                        <input name="logradouro"
                                               value="@if( isset($fornecedor->endereco)) {{$fornecedor->endereco->logradouro }} @endIf "
                                               required class="form-control rounded-0" id="logradouro">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="numero" class="form-label fw-bold obrigatorio">Numero</label>
                                        <input name="numero"
                                               value="@if( isset($fornecedor->endereco)) {{$fornecedor->endereco->numero }} @endIf "
                                               required class="form-control rounded-0" id="numero">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="complemento" class="form-label fw-bold">Complemento</label>
                                        <input name="complemento"
                                               value="@if( isset($fornecedor->endereco)) {{$fornecedor->endereco->complemento }} @endIf "
                                               class="form-control rounded-0" id="complemento">
                                    </div>
                                </div>
                                <div class="p-3 row">
                                    <div class="mb-3 col-md-3">
                                        <label for="Bairro" class="form-label fw-bold obrigatorio">Bairro</label>
                                        <input name="bairro"
                                               value="@if( isset($fornecedor->endereco)) {{$fornecedor->endereco->bairro }} @endIf "
                                               required class="form-control rounded-0" id="Bairro">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="ponto_referencia" class="form-label fw-bold">Ponto de
                                            Refer??ncia</label>
                                        <input name="ponto_referencia"
                                               value="@if( isset($fornecedor->endereco)) {{$fornecedor->endereco->referencia }} @endIf "
                                               class="form-control rounded-0" id="ponto_referencia">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="uf" class="form-label fw-bold obrigatorio">UF</label>
                                        <div class="dropdown-center">
                                            <a class="btn dropdown-toggle form-control rounded-0 border border-1 d-flex justify-content-around  align-items-center"
                                               id="selected_uf" type="button" data-bs-toggle="dropdown"
                                               aria-expanded="false">
                                                @if( isset($fornecedor->endereco)){{ $fornecedor->endereco->uf }}  @else
                                                    Selecione @endIf
                                            </a>
                                            <ul class="dropdown-menu rounded-0">

                                                <div class="uf_box">
                                                    <div class="m-2">
                                                        <input type="text" id="filter_uf"
                                                               class="form-control rounded-0">
                                                    </div>
                                                    <input type="radio" hidden name="uf" checked
                                                           value="{{ $fornecedor->endereco->uf }} ">
                                                    <input type="radio" hidden name="cidade" checked
                                                           value="{{ $fornecedor->endereco->cidade }} ">

                                                    <label class="label_uf"><input type="radio" name="uf" value="AC">AC</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="AL">AL</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="AP">AP</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="AM">AM</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="BA">BA</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="CE">CE</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="DF">DF</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="ES">ES</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="GO">GO</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="MA">MA</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="MS">MS</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="MT">MT</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="MG">MG</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="PA">PA</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="PB">PB</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="PR">PR</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="PE">PE</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="PI">PI</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="RJ">RJ</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="RN">RN</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="RS">RS</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="RO">RO</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="RR">RR</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="SC">SC</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="SP">SP</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="SE">SE</label>
                                                    <label class="label_uf"><input type="radio" name="uf" value="TO">TO</label>
                                                </div>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="cidade" class="form-label fw-bold obrigatorio">Cidade</label>
                                        <div class="dropdown-center">
                                            <a class="disabled  btn dropdown-toggle form-control rounded-0 border border-1 d-flex justify-content-around  align-items-center"
                                               id="selected_cidade" type="button" data-bs-toggle="dropdown"
                                               aria-expanded="false">
                                                @if( isset($fornecedor->endereco->cidade)){{ $fornecedor->endereco->cidade }}  @else
                                                    Selecione @endIf
                                            </a>
                                            <ul class="dropdown-menu rounded-0">

                                                <div class="cidade_box" id="cidade_box">
                                                    <div class="m-2">
                                                        <input type="text" id="filter_cidade"
                                                               class="form-control rounded-0">
                                                    </div>
                                                </div>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 row">
                                    <div class="mb-3 col-md-3">
                                        <label for="condominio"
                                               class="form-label fw-bold obrigatorio">Condom??nio?</label>
                                        <select name="condominio" class="form-control rounded-0" id="condominio">
                                            <option value="" selected="">Selecione</option>
                                            <option
                                                {{  $fornecedor->endereco && $fornecedor->endereco->condominio == 0 ? "selected" :''}}  value="0">
                                                N??o
                                            </option>
                                            <option
                                                {{  $fornecedor->endereco && $fornecedor->endereco->condominio == 1 ? "selected" :''}}  value="1">
                                                Sim
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-3 box_condominio_endereco">
                                        <label for="endereco" class="form-label fw-bold">Endere??o</label>
                                        <input name="endereco" class="form-control rounded-0" id="endereco">
                                    </div>
                                    <div class="mb-3 col-md-3  box_condominio_endereco">
                                        <label for="numero_condominio" class="form-label fw-bold">N??mero</label>
                                        <input name="numero_condominio" class="form-control rounded-0"
                                               id="numero_condominio">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion mb-3" id="accordionExample4">
                <div class="accordion-item border-top border-4">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed text-secondary  bg-white" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true"
                                aria-controls="collapseThree">
                            Observa????o
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour"
                         data-bs-parent="#accordionExample4">
                        <div class="accordion-body">
                            <div>
                                <div class="p-3 row">
                                    <div class="mb-3 col-md-12">

                                        <textarea name="observacao" class="form-control rounded-0 textarea w-100" style="height: 200px">@if( $fornecedor->observacao) {{$fornecedor->observacao}} @endIf</textarea>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                @if($type != "ver")
                    <button type="submit" class="btn btn-success d-flex align-items-center me-2">
                        <svg width="16" height="16" fill="#FFF" class="bi bi-plus-lg me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                        <span>Cadastrar</span>
                    </button>
                @endif
            </div>
        </form>
    </div>

    <script type="text/javascript" src="{{asset('js/form_fornecedor.js')}}"></script>

    <script src="{{asset('lib/js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('lib/js/prettify.js')}}"></script>

    <script type="text/javascript" src="{{asset('wysihtml5/bootstrap-wysihtml5.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.mask.js')}}"></script>

    <script>
        $('.textarea').wysihtml5();
    </script>
@stop
