@csrf

<x-adminlte-input name="name" label="Name:*" value="{{ $country->name ?? ''}}" placeholder="Insira nome do país"/>
<x-adminlte-input name="acronym" label="Sigla:*" placeholder="Insira a sigla do país" value="{{ $country ? $country->acronym : ''}}"/>
<x-adminlte-input name="code" label="Código:" placeholder="Insira o código do país" value="{{ $country ? $country->code : ''}}"/>

<a href="{{ route('admin.countries.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
