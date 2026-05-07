@if ($errors->any())
    <div class="alert alert-danger">
        <h2>Corrija os erros:</h2>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
