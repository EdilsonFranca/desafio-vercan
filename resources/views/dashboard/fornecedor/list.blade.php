@extends('dashboard.layout')
@section('conteudo')

    <div class="d-flex py-2 align-items-center w-100">
        @if(Request::get('tipo') )
            <div class="text-center alert alert-{{Request::get('tipo') }} alert-dismissible fade show col-12" role="alert">
                {{ Request::get('msn') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endisset
        <div class="col-6 d-flex"><h5 class="ms-2">Fornecedores </h5><span class="ms-2">Painel de Controle</span></div>
        <div class="col-6 d-flex justify-content-end">
            <a type="button" class="btn btn-success d-flex align-items-center me-2" href="/fornecedor/create">
                <svg width="16" height="16" fill="#FFF" class="bi bi-plus-lg me-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
                <span>Cadastrar</span>
            </a>
        </div>
    </div>
    <div class="border section-conteudo-body ">
        <div class="container mt-5">
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>Razão Social/Nome</th>
                    <th>Nome Fantasia/Apelido</th>
                    <th>CNPJ/CPF</th>
                    <th>Ativo</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function () {

            $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('lista_fornecedores') }}",
                columns: [
                    {data: 'razao_social', name: 'razao_social'},
                    {data: 'nome_fantasia', name: 'nome_fantasia'},
                    {data: 'cnpj', name: 'cnpj'},
                    {data: 'ativo', name: 'ativo'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }
                ]
            });

        });
    </script>
@stop
