@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        <p>Os campos marcados com * são obrigatórios</p>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="type-person form-group @error('type_person') is-invalid @enderror">
                <div class="radio">
                    <label>
                        <input type="radio" name="type_person" value="pf"
                        {{  (old('type_person') && old('type_person')) == "pf" ? "checked" : "" }}> Pessoa Física
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="type_person" value="pj"
                        {{  (old('type_person') && old('type_person') == "pj") ? "checked" : "" }}> Pessoa Jurídica
                    </label>
                </div>

                @error('type_person')
                    <span class="alert alert-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div id="frm-fields">
                 <h2>Dados Cadastrais</h2>

                <div class="form-group">
                    <label for="name">Nome Completo:*</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        class="@error('name') is-invalid @enderror">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" id="div-fantasy-name">
                    <label for="fantasy_name">Nome Fantasia:</label>
                    <input
                        type="text"
                        name="fantasy_name"
                        id="fantasy_name"
                        value="{{ old('fantasy_name') }}"
                        class="@error('fantasy_name') is-invalid @enderror">
                    @error('fantasy_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" id="div-cpf">
                    <label for="cpf">CPF:*</label>
                    <input
                        type="text"
                        name="cpf"
                        id="cpf"
                        value="{{ old('cpf') }}"
                        class="cpf-mask @error('cpf') is-invalid @enderror">
                    @error('cpf')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group"  id="div-cnpj">
                    <label for="cnpj">CNPJ:*</label>
                    <input
                        type="text"
                        name="cnpj"
                        id="cnpj"
                        value="{{ old('cnpj') }}"
                        class="cnpj-mask @error('cnpj') is-invalid @enderror">
                    @error('cnpj')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" id="div-ie">
                    <label for="ie">Inscrição Estadual:</label>
                    <input
                        type="text"
                        name="ie"
                        id="ie"
                        value="{{ old('ie') }}"
                        class="@error('ie') is-invalid @enderror">
                    @error('ie')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mobile">Telefone:*</label>
                    <input
                        type="text"
                        name="mobile"
                        id="mobile"
                        class="phone-mask @error('mobile') is-invalid @enderror"
                        placeholder="(99)99999-9999"
                        value="{{ old('mobile') }}"
                    />
                    @error('mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div id="div-gender">
                    <label>Sexo:</label>
                    <div class="gender form-group">
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="F"
                                    {{  (old('gender') && old('gender')) == "F" ? "checked" : "" }}> Feminino
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="M"
                                    {{  (old('gender') && old('gender') == "M") ? "checked" : "" }}> Masculino
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="div-date-birth">
                    <label for="date_birth">Data de nascimento:</label>
                    <input
                        type="date"
                        name="date_birth"
                        id="date_birth"
                        value="{{ old('date_birth') }}">
                </div>

                <h2>Identificação</h2>
                <div class="form-group">
                    <label for="email">E-mail:*</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        class="@error('email') is-invalid @enderror"
                        >
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Senha:*</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        maxlength="15"
				        placeholder="Informe sua senha com 6 a 15 caracteres",
                        class="@error('password') is-invalid @enderror">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Senha:*</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        maxlength="15"
				        placeholder="Informe sua senha com 6 a 15 caracteres"
                        class="@error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

	    	    <h2>Receber Promoções</h2>
                <div class="newsletter form-group"><input
                        type="checkbox"
                        name="newsletter"
                        id="newsletter"
                        value="S"
                    {{ (!old('newsletter') || old('newsletter')) == "S" ? "checked" : ""}} />
                    <label for="newsletter">Desejo receber e-mails de promoções da Maya Cosméticos</label>
                </div>
                <hr>
                <div class="privacy form-group">
                    <input
                        type="checkbox"
                        name="privacy"
                        id="privacy"
                        value="1"
                        {{ (old('privacy') || old('privacy')) == "S" ? "checked" : ""}}
                    />
                    <label for="privacy">Concordo com o uso dos meus dados para compra e experiência no site conforme a
                        <a href="{{ url('pagina/politica-de-privacidade') }}" target="_blank">Política de Privacidade</a>
                    </label>
                    @error('privacy')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div><br />

                <input type="submit" value="Enviar" />
            </div>

        </form>
    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/register.css') }}">
@endpush

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js" integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/utils/mask-field.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/utils/set-type-person-fields.js') }}"></script>
@endpush
