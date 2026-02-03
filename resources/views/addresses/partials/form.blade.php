@csrf

<div class="form-group">
    <label for="name">Nome:* (Ex: casa, escritório, etc.)</label>
    <input
        type="text"
        name="title"
        id="name"
        value="{{  $address->title ?? ''}}"
        class="@error('title') is-invalid @enderror">
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="cep">CEP:* </label>
    <input
        type="text"
        name="cep"
        id="cep"
        value="{{  $address->cep ?? ''}}"
        class="cep-mask @error('cep') is-invalid @enderror">
    @error('cep')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <span>
        <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank">Não sei o CEP</a>
    </span>
</div>

<div class="form-group">
    <label for="name">Endereço:* </label>
    <input
        type="text"
        name="address"
        id="address"
        value="{{  $address->address ?? ''}}"
        class="@error('address') is-invalid @enderror">
    @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="number">Número:* </label>
    <input
        type="text"
        name="number"
        id="number"
        value="{{  $address->number ?? ''}}"
        class="@error('number') is-invalid @enderror">
    @error('number')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="complement">Complemento: </label>
    <input
        type="text"
        name="complement"
        id="complement"
        value="{{  $address->complement ?? ''}}">
</div>

<div class="form-group">
    <label for="neighborhood">Bairro:* </label>
    <input
        type="text"
        name="neighborhood"
        id="neighborhood"
        value="{{  $address->neighborhood ?? ''}}"
        class="@error('neighborhood') is-invalid @enderror">
    @error('neighborhood')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="country-id">País:* </label>
    <select name="country_id" id="country-id" class="@error('country_id') is-invalid @enderror">
        @foreach($countries as $country)
            <option value="{{ $country->id }}" {{ isset($address->country_id) && $country->id == $address->country_id ? "selected" : "" }}>{{ $country->name }}</option>
        @endforeach
    </select>

    @error('country_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="state-id">Estado:* </label>
    <select name="state_id" id="state-id" class="@error('state_id') is-invalid @enderror">
        @foreach($states as $state)
            <option value="{{ $state->id }}" {{ isset($address->state_id) && $state->id == $address->state_id ? "selected" : "" }}>{{ $state->name }}</option>
        @endforeach
    </select>

    @error('state_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="city-id">Cidade:* </label>
    <select name="city_id" id="city-id" class="@error('city_id') is-invalid @enderror">
        @foreach($cities as $city)
            <option value="{{ $city->id }}" {{ isset($address->city_id) && $city->id == $address->city_id ? "selected" : "" }}>{{ $city->name }}</option>
        @endforeach
    </select>

    @error('city_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="phone">Telefone: </label>
    <input
        type="text"
        name="phone"
        id="phone"
        value="{{  $address->phone ?? ''}}"
        class="phone-mask">
</div>

<div class="form-group">
    <label for="contact">Contato:* </label>
    <input
        type="text"
        name="contact"
        id="contact"
        value="{{  $address->phone ?? ''}}"
        class="@error('contact') is-invalid @enderror">
     @error('contact')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

 <input type="submit" value="Enviar" />
