@extends('layouts.app')

@section('title', $title)


@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="{{ route('index') }}"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><a href="{{ route('customer.index') }}">Minha Conta</a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
         <p>Os campos marcados com * são obrigatórios</p>
        <form method="POST" action="{{ route('customers.update') }}">
            @method('PUT')
            @csrf
            @if ($customer->type_person === 'pf')
                <div class="form-group">
                    <label for="name">Nome Completo:*</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') ?? $customer->name   }}"
                        class="@error('name') is-invalid @enderror">
                    @error('name')
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
                        value="{{  old('mobile') ?? $customer->mobile }}"
                    />
                    @error('mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <label>Sexo:</label>
                <div class="gender form-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="gender" value="F"
                                {{  (
                                        (old('gender') && old('gender') == "F")  ||
                                        ($customer->gender && $customer->gender ==  'F')
                                    ) ? "checked" : ""
                                }}> Feminino
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="gender" value="M"
                               {{  (
                                        (old('gender') && old('gender') == "M") ||
                                        ($customer->gender && $customer->gender ==  'M')
                                    ) ? "checked" : ""
                                }}> Masculino
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_birth">Data de nascimento:</label>
                    <input
                        type="date"
                        name="date_birth"
                        id="date_birth"
                        value="{{ old('date_birth') ?? $customer->date_birth  }}">
                </div>

            @elseif ($customer->type_person === 'pj')
                 <div class="form-group" id="div-fantasy-name">
                    <label for="fantasy_name">Nome Fantasia:</label>
                    <input
                        type="text"
                        name="fantasy_name"
                        id="fantasy_name"
                        value="{{ old('fantasy_name') ?? $customer->fantasy_name }}"
                        class="@error('fantasy_name') is-invalid @enderror">
                    @error('fantasy_name')
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
                        value="{{ old('mobile') ?? $customer->mobile }}"
                    />
                    @error('mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            <input type="submit" value="Enviar" />
        </form>
    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/customer-edit-email.css') }}">
@endpush

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js" integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/utils/mask-field.js') }}"></script>
@endpush
