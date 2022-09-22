@extends('dashboard.layout')
@section('conteudo')
    <link href={{ asset("css/form.css") }} rel="stylesheet"/>
    <link href={{ asset("lib/css/bootstrap.css") }} rel="stylesheet"/>

    <div class="d-flex py-2 align-items-center w-100">
        <div class="col-6 d-flex"><h5 class="ms-2">Fornecedores </h5><span class="ms-2">Excluir</span></div>
    </div>
    <div class=" section-conteudo-body">

        <div class="accordion mb-3" id="accordionExample">
            <div class="accordion-item  border-top border-4 p-2">
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
                        <div class="mb-3 col-md-3">
                            <label for="nome_fantasia" class="form-label fw-bold">Razão Social/Nome Fantasia</label>
                            <input  value=" {{ $fornecedor->pessoa_fisica->nome ??  $fornecedor->pessoa_juridica->nome_fantasia }}" required class="form-control rounded-0  disabled" >
                        </div>

                    </div>
                </div>

                <a href="excluir" type="submit" class="btn btn-danger d-flex align-items-center me-2" style="width: 120px">
                    <svg  width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                    </svg>
                    <span>Remover</span>
                </a>
            </div>
        </div>

    </div>

@stop
