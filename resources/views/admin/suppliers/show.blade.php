@extends('adminlte::page')

@section('title', 'Visualizar Fornecedor')

@section('content_header')
    <h1>Visualizar Fornecedor</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $supplier->id }}&nbsp;</dd>
                        <dt>Razão Social:</dt>
                        <dd>{{ $supplier->name }}&nbsp;</dd>
                        <dt>Nome Fantasia:</dt>
                        <dd>{{ $supplier->fantasy_name }}&nbsp;</dd>
                        <dt>CNPJ:</dt>
                        <dd>{{ $supplier->cnpj }}&nbsp;</dd>
                        <dt>Inscrição Estadual:</dt>
                        <dd>{{ $supplier->ie }}&nbsp;</dd>
                        <dt>Inscrição Municipal:</dt>
                        <dd>{{ $supplier->im }}&nbsp;</dd>
                        <dt>Telefone:</dt>
                        <dd>{{ $supplier->phone }}&nbsp;</dd>
                        <dt>Celular:</dt>
                        <dd>{{ $supplier->mobile }}&nbsp;</dd>
                        <dt>E-mail:</dt>
                        <dd>{{ $supplier->email }}&nbsp;</dd>
                        <dt>Website:</dt>
                        <dd>{{ $supplier->url }}&nbsp;</dd>
                        @if ($supplier->address)
                            <dt>Endereço:</dt>
                            <dd>{{ $supplier->address[0]->address }}, {{ $supplier->address[0]->number }}&nbsp;</dd>
                            @if ($supplier->address[0]->complement)
                                <dt>Complemento:</dt>
                                <dd>{{ $supplier->address[0]->complement }}&nbsp;</dd>
                            @endif
                            <dt>Bairro:</dt>
                            <dd>{{ $supplier->address[0]->neighborhood }}&nbsp;</dd>
                            <dt>CEP:</dt>
                            <dd>{{ $supplier->address[0]->cep }}&nbsp;</dd>
                            <dt>Cidade/Estado/País:</dt>
                            <dd>{{ $supplier->address[0]->city->name }} / {{ $supplier->address[0]->state->name }} / {{ $supplier->address[0]->country->name }}&nbsp;</dd>
                        @endif

                        @if ($supplier->info)
                            <h4>Pessoas de Contato</h2>
                            <table style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Setor</th>
                                        <th>E-mail</th>
                                        <th>Telefone</th>
                                        <th>Ramal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supplier->info as $contact)
                                        <tr>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->sector }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->branch_line }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        <dt>Criado em:</dt>
                        <dd>{{ $supplier->created }}&nbsp;</dd>
                        <dt>Modificado em:</dt>
                        <dd>{{ $supplier->modified }}&nbsp;</dd>
                    </dl>
                    <img src="{{ Storage::url($supplier->image) }}">

                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.suppliers.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary">
                                        <i class="fa fa-file"></i> Adicionar
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script  type="text/javascript" src="{{ asset('js/admin/utils/deleteConfirm.js') }}"></script>
@endpush
