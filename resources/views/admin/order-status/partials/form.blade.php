<div class="row">
    <div class="col-md-12">
        @csrf

        <x-adminlte-input name="name" label="Name:*" value="{{ $orderStatus->name ?? ''}}" placeholder="Insira nome do status do pedido" enable-old-support/>

        <x-adminlte-input name="value" label="Valor:" value="{{ $orderStatus->value ?? ''}}" placeholder="Insira o valor referente ao status do pedido" enable-old-support/>

        <x-adminlte-input name="order_status" type="number" label="Ordem:" value="{{ $orderStatus->order_status ?? ''}}" placeholder="Insira o ordem do status do pedido" enable-old-support/>

        <a href="{{ route('admin.order-status.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
        
    </div>
</div>