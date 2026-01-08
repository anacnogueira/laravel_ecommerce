@extends('adminlte::page')

@section('title', 'Visualizar Evento')

@section('content_header')
    <h1>Visualizar Evento</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <h2>Informações Gerais</h2>
                        <dt>ID:</dt>
                        <dd>{{ $event->id }}&nbsp;</dd>
                        <dt>Nome:</dt>
                        <dd>{{ $event->name }}&nbsp;</dd>
                        <dt>Descrição:</dt>
                        <dd>{!! $event->description !!}&nbsp;</dd>
                        <dt>Resumo:</dt>
                        <dd>{{ $event->excerpt }}&nbsp;</dd>
                        @if($event->image)
                            <dt>Imagem:</dt>
                            <dd><img src="{{ Storage::url($event->image) }}"></dd>
                        @endif
                        <dt>Vagas:</dt>
                        <dd>{{  $event->vacancies }}</dd>
                        <dt>Valor:</dt>
                        <dd>{{ $event->value }}</dd>
                        <dt>Status:</dt>
						<dd>{{ $event->status }}</dd>
                        <h2>Data e Hora</h2>
                        @if ($event->eventDates)
                            <table class="table table-bordered" id="date-table">
								<thead>
									<tr>
										<th>Data Inicial</th>
										<th>Hora Inicial</th>
										<th>Data Final</th>
										<th>Hora Final</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($event->eventDates as $eventDate)
                                        <tr>
                                            <td>{{ $eventDate->start_date }}</td>
                                            <td>{{ $eventDate->start_hour }}</td>
                                            <td>{{ $eventDate->end_date }}</td>
                                            <td>{{ $eventDate->end_hour }}</td>
                                        </tr>
									@endforeach
								</tbody>
							</table>
                        @endif
                        <h2>Local</h2>
                        <dt>CEP:</dt>
						<dd>{{ $event->cep }}</dd>
                        <dt>Endereço:</dt>
                        <dd>{{ $event->address  }}, {{ $event->number }}</dd>
                        @if(!empty($event->complement))
                            <dt>Complemento:</dt>
                            <dd>{{ $event->complement }}</dd>
                        @endif
                        <dt>Bairro:</dt>
                        <dd>{{ $event->neighborhood }}</dd>
                        <dt>País:</dt>
                        <dd>{{ $event->country->name }}</dd>
                        <dt>Cidade/UF:</dt>
                        <dd>{{ $event->city->name }}/{{ $event->state->uf }}</dd>
                        <dt>Mostrar Mapa:</dt>
                        <dd>{{ $event->show_map }}</dd>
                        <dt>Mostrar link do mapa:</dt>
                        <dd>{{ $event->show_link_map }}</dd>
                        <h2>Informações do Profissional</h2>
                        <dt>Nome:</dt>
                        <dd>{{ $event->professional_name }}</dd>
                        <dt>Mini Currículo:</dt>
                        <dd>{!! $event->professional_curriculum !!}</dd>
                        @if($event->professional_photo)
                            <dt>Foto:</dt>
                            <dd><img src="{{ Storage::url($event->professional_photo) }}" /></dd>
                        @endif
                    </dl>


                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.events.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
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
