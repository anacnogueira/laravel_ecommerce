@csrf

<x-adminlte-input name="name" label="Name:*" value="{{ $country->name ?? '' }}" enable-old-support />
<x-adminlte-input name="acronym" label="Sigla:*" value="{{ $country->acronym ?? '' }}" enable-old-support />
<x-adminlte-input name="code" label="Código:*" value="{{ $country->code ?? '' }}" enable-old-support />

<a href="{{ route('admin.countries.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check" />
