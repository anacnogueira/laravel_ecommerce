@csrf
@php
    $oldTypePersonPf = old("type_person") == "pf" ||  (!empty($customer) && $customer->type_person == 'pf') ? "checked" :  "";
    $oldTypePersonPj = old("type_person") == "pj" ||  (!empty($customer) && $customer->type_person == 'pj') ? "checked" :  "";
@endphp

<div class="form-group" >
    <label>Tipo Pessoa:</label><br />
    <div class="btn-group btn-group-toggle @error('type_person') is-invalid-group @enderror" data-toggle="buttons" id="types-person">
        <label class="btn btn-secondary">
            <input type="radio" name="type_person" id="type_person1" value="pf" {{  $oldTypePersonPf }}> Pessoa Física
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="type_person" id="type_person2" value="pj"  {{  $oldTypePersonPj }}> Pessoa Jurídica
        </label>
    </div>
    @error('type_person')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div id="frm-fields">
    <x-adminlte-input name="name" label="Nome Completo:*" value="{{ $customer->name ?? ''}}" enable-old-support/>


    <div id="div-fantasy-name">
        <x-adminlte-input name="fantasy_name" label="Nome Fantasia:" value="{{ $customer->fantasy_name ?? ''}}" enable-old-support/>
    </div>

    <div id="div-cpf">
      <x-adminlte-input name="cpf" label="CPF:*" value="{{ $customer->cpf ?? ''}}" class="cpf-mask" placeholder="000.000.000-00" enable-old-support/>
    </div>

    <div id="div-cnpj">
        <x-adminlte-input name="cnpj" label="CNPJ:*" value="{{ $customer->cnpj ?? ''}}" class="cnpj-mask" placeholder="000.000.000-00" enable-old-support/>
    </div>

    <div id="div-ie">
        <x-adminlte-input name="ie" label="Inscrição Estadual:*" value="{{ $customer->ie ?? ''}}" placeholder="000.000.000-00" enable-old-support/>
    </div>

    <x-adminlte-input name="mobile" label="Telefone:*" value="{{ $customer->mobile ?? ''}}" class="phone-mask" enable-old-support/>

    @php
        $oldGenderF = old("gender") == "F" ||  (!empty($customer) && $customer->gender == 'F') ? "checked" :  "";
        $oldGenderM = old("gender") == "M" ||  (!empty($customer) && $customer->gender == 'M') ? "checked" :  "";
    @endphp
    <div class="form-group" id="div-gender">
        <label>Sexo:</label><br />
        <div class="btn-group btn-group-toggle @error('gender') is-invalid-group @enderror" data-toggle="buttons" id="types-person">
            <label class="btn btn-secondary">
                <input type="radio" name="gender" id="gender1" value="F" {{  $oldGenderF }}> Feminimo
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="gender" id="gender2" value="M"  {{  $oldGenderM }}> Masculino
            </label>
        </div>
        @error('gender')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div id="div-date-birth">
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
    </div>

    <x-adminlte-input name="email" label="E-mail:*" value="{{ $customer->email ?? ''}}" enable-old-support/>

    @php
        $oldNewsletterS = old("newsletter") == "S" ||  (!empty($customer) && $customer->newsletter == 'S') ? "checked" :  "";
        $oldNewsletterN = old("newsletter") == "N" ||  (!empty($customer) && $customer->newsletter == 'N') ? "checked" :  "";
    @endphp
    <div class="form-group">
        <label>Deseja receber promoções:</label><br />
        <div class="btn-group btn-group-toggle @error('newsletter') is-invalid-group @enderror" data-toggle="buttons" >
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

     @php
        $oldPrivacyS = old("newsletter") == "1" ||  (!empty($customer) && $customer->privacy == 'S') ? "checked" :  "";
        $oldPrivacyN = old("newsletter") == "N" ||  (!empty($customer) && $customer->privacy == 'N') ? "checked" :  "";
    @endphp
    <div class="form-group">
        <label>Concordo com o uso dos meus dados para compra e experiência no site conforme a política de privacidade:*</label><br />
        <div class="btn-group btn-group-toggle @error('privacy') is-invalid-group @enderror" data-toggle="buttons" >
            <label class="btn btn-secondary">
                <input type="radio" name="privacy" id="privacy1" value="1" {{ $oldPrivacyS }}> Sim
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="newsletter" id="privacy2" value="N"  {{ $oldPrivacyN }}> Não
            </label>
        </div>
        @error('privacy')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
</div>

<a href="{{ route('admin.customers.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>


