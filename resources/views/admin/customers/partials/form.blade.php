@csrf

<x-adminlte-input name="name" label="Name:*" value="{{ $customer->name ?? ''}}" enable-old-support/>

@php
    $oldGenderF = old("gender") == "F" ||  (!empty($customer) && $customer->gender == 'F') ? "checked" :  "";
    $oldGenderM = old("gender") == "M" ||  (!empty($customer) && $customer->gender == 'M') ? "checked" :  "";
@endphp
<div class="form-group" >
    <label>Sexo:</label><br />
    <div class="btn-group btn-group-toggle @error('gender') is-invalid-group @enderror"  data-toggle="buttons" id="types-person">
        <label class="btn btn-secondary">
            <input type="radio" name="gender" id="option1" value="F" {{  $oldGenderF }}> Feminimo
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="gender" value="M" id="option2" {{  $oldGenderM }}> Masculino
        </label>
    </div>
    @error('gender')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<x-adminlte-input name="rg" label="RG:" value="{{ $customer->rg ?? ''}}" enable-old-support/>
<x-adminlte-input name="cpf" label="CPF:*" value="{{ $customer->cpf ?? ''}}" class="cpf-mask" placeholder="000.000.000-00" enable-old-support/>
@php
$config = ['format' => 'DD/MM/YYYY'];
@endphp

<x-adminlte-input-date name="date_birth" :config="$config" placeholder="dd/mm/aaaa"
    label="Data Nascimento:" value="{{ $customer->date_birth ?? ''}}" class="date-mask" enable-old-support>
    <x-slot name="appendSlot">
        <x-adminlte-button icon="fas fa-lg fa-calendar"
            title="Selecione a data de nascimento"/>
    </x-slot>
</x-adminlte-input-date>

<x-adminlte-input name="phone" label="Telefone:" value="{{ $customer->phone ?? ''}}" class="phone-mask" enable-old-support/>

<x-adminlte-input name="email" label="E-mail:*" value="{{ $customer->email ?? ''}}" enable-old-support/>

@php
    $oldNewsletterS = old("newsletter") == "S" ||  (!empty($customer) && $customer->newsletter == 'S') ? "checked" :  "";
    $oldNewsletterN = old("newsletter") == "N" ||  (!empty($customer) && $customer->newsletter == 'N') ? "checked" :  "";
@endphp
<div class="form-group">
    <label>Deseja receber promoções:</label><br />
    <div class="btn-group btn-group-toggle @error('newsletter') is-invalid-group @enderror" data-toggle="buttons" id="types-person" >
        <label class="btn btn-secondary">
            <input type="radio" name="newsletter" id="option1" value="S" {{ $oldNewsletterS }}> Sim
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="newsletter" value="N" id="option2" {{ $oldNewsletterN }}> Não
        </label>
    </div>
    @error('newsletter')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<a href="{{ route('admin.customers.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>

@push('js')
    <script src="https://unpkg.com/imask"></script>
    <script  type="text/javascript" src="{{ asset('js/utils/mask-field.js') }}"></script>
@endpush
