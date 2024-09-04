<div class="row">
    <div class="col-md-12">
        @csrf

        <x-adminlte-input name="name" label="Name:*" value="{{ $paymentMethod->name ?? ''}}" placeholder="Insira nome da forma de pagamento" enable-old-support/>

        <x-adminlte-input name="value" label="Valor:*" value="{{ $paymentMethod->value ?? ''}}" placeholder="Insira o valor referente ao nome do pagamento" enable-old-support/>

        {{ $paymentMethod->payment_gateway_id}}
        <x-adminlte-select name="payment_gateway_id" label="Integradora:" enable-old-support>
            @foreach($paymentGateways as $paymentGateway)
                <option value="{{ $paymentGateway->id }}" {{ isset($paymentMethod->payment_gateway_id) && $paymentGateway->id == $paymentMethod->payment_gateway_id ? "selected" : "" }}>{{ $paymentGateway->name }}</option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-input name="installments" type="number" label="N° de Vezes:" value="{{ $paymentMethod->installments ?? ''}}" placeholder="Insira o nº de vezes permitido para esse pagamento" enable-old-support/>
        
        <x-adminlte-input name="installments_interest_rate" type="number" label="Juros a partir da parcela:" value="{{ $paymentMethod->installments_interest_rate ?? ''}}" placeholder="Insira a partir de qual parcela começar a cobrar juros" enable-old-support/>

        <x-adminlte-input name="installments_min_value" label="Valor minimo para parcelamento:" value="{{ $paymentMethod->installments_min_value ?? ''}}" placeholder="Insira valor minímo para parcelamento" class="value" enable-old-support/>
        
        <x-adminlte-input name="interest_rate" label="Taxa de Juros:" value="{{ $paymentMethod->interest_rate ?? ''}}" placeholder="Insira taxa de juros (pocentagem)" class="value" enable-old-support/>

        @php
            $config = [
                'state' => (isset($paymentMethod) && $paymentMethod->status == 1) || !isset($paymentMethod) ? true : false,
            ];
        @endphp    
        <x-adminlte-input-switch 
            name="status"
            label="status"
            data-on-color="success"
            data-off-color="danger"
             data-on-text="Ativo"
            data-off-text="Inativo"
            :config="$config"
            checked="$config['state']"
            enable-old-support />

        <x-adminlte-input-file name="upload" label="Imagem:" placeholder="Escolha um arquivo..." legend="Procurar">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-lightblue">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>

        <div id="imagePreview">
            @if(isset($paymentMethod->image))
                <img src="{{ Storage::url($paymentMethod->image) }}" alt="" style="width: 300px;">
            @endif
        </div>

        <p><strong>Instruções para inserção de imagem:</strong></p>
        <ul>
            <li>Extensões permitidas: gif,jpg e png</li>
            <li>Cada imagem não deve ultrapassar 5MB</li>
        </ul>
    
        <x-adminlte-textarea name="html" label="Conteúdo:" cols="40" rows="10" enable-old-support>
            {{ $paymentMethod ? $paymentMethod->html : ''}}
        </x-adminlte-textarea>

        <x-adminlte-input name="icon" label="ícone:" placeholder="Insira o ícone da forma de pagamento"  value="{{ $paymentMethod ? $paymentMethod->icon : ''}}" enable-old-support />

        <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('upload').addEventListener('change', function() {
                displayImagePreview(this);
            });

            function displayImagePreview(input) {
                var file = input.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').innerHTML = '<img src="' + e.target.result + '" width="200" alt="Profile Image Preview">';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
</script>
    </div>
</div>