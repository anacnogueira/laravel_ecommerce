<div class="row">
    <div class="col-md-12">
        <x-adminlte-input name="name" label="Nome:*" value="{{ $paymentGateway->name ?? ''}}" placeholder="Insira nome da integradora de pagamento" enable-old-support/>

        @php
            $config = [
                'state' => (isset($paymentGateway) && $paymentGateway->status == 1) || !isset($paymentGateway) ? true : false,
            ];
        @endphp    
        <x-adminlte-input-switch 
            name="status"
            label="Status:"
            data-on-color="success"
            data-off-color="danger"
            data-on-text="Ativo"
            data-off-text="Inativo"
            :config="$config"
            checked="$config['state']"
            enable-old-support />

        <x-adminlte-textarea name="html" label="HTML:" cols="40" rows="10" enable-old-support>
            {{ $paymentGateway ? $paymentGateway->html : ''}}
        </x-adminlte-textarea>


        <a href="{{ route('admin.payment-gateways.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
    </div>
</div>