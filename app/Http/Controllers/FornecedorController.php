<?php

namespace App\Http\Controllers;

use App\Http\Service\FornecedorService;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Route;


class FornecedorController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard/fornecedor/list');
    }

    public function list(Request $request)
    {
        $select = array(
            'pessoa_juridica.nome_fantasia',
            'pessoa_juridica.razao_social',
            'pessoa_juridica.cnpj',
            'fornecedor.ativo',
            'fornecedor.id_fornecedor',
            'pessoa_fisica.nome',
            'pessoa_fisica.cpf',
            'pessoa_fisica.apelido'
        );

        $data = Fornecedor::latest('fornecedor.created_at')->leftJoin('pessoa_juridica', "fornecedor.id_fornecedor", "pessoa_juridica.fornecedor_id")
                                                           ->leftJoin('pessoa_fisica', "fornecedor.id_fornecedor", "pessoa_fisica.fornecedor_id")
                                                           ->select($select)->get();

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($row) {
                return FornecedorService::getTemplateDropMenu($row);
            })
            ->addColumn('nome_fantasia', function ($row) {
                return $row->nome_fantasia ?? $row->apelido;
            })
            ->addColumn('razao_social', function ($row) {
                return $row->razao_social ?? $row->nome;
            })
            ->addColumn('cnpj', function ($row) {
                return $row->cnpj ?? $row->cpf;
            })
            ->rawColumns(['action', 'nome_fantasia', 'razao_social', 'cnpj'])
            ->with([
                'tipo' => $request->tipo,
                'msn' => $request->msn,
            ])
            ->toJson();
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard/fornecedor/form');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        FornecedorService::store($request);
        return redirect()->route('fornecedores');
    }

    public function show(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $uri = explode("/", Route::getFacadeRoot()->current()->uri());
        $uri = $uri[count($uri) - 1];

        $with = array(
            'pessoa_fisica',
            'pessoa_juridica',
            'contato_principal.contatos',
            'contato_adicionais.contatos',
            'endereco'
        );

        $fornecedor = Fornecedor::where('id_fornecedor', $request->id)->with($with)->first();

        return view('dashboard/fornecedor/form_edite')->with('fornecedor', $fornecedor)->with('type', $uri);
    }


    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $nome = FornecedorService::update($request);

        $return = array(
            'tipo' => 'success',
            'msn'  => "Fornecedor $nome editado !",
        );

        return redirect()->route('fornecedores', $return);
    }

    public function remove(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $with = array(
            'pessoa_fisica',
            'pessoa_juridica',
        );

        $fornecedor = Fornecedor::where('id_fornecedor', $request->id)->with($with)->first();

        return view('dashboard/fornecedor/delete')->with('fornecedor', $fornecedor);
    }

    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        $nome = FornecedorService::destroy($request);

        return redirect()->route('fornecedores', ['tipo' => 'success', 'msn' => "Fornecedor $nome removido !"]);
    }
}
