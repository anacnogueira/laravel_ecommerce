<div class="row">
 	<div class="col-md-12">
        <div class="row">
            <x-adminlte-input name="contact_info_name" label="Nome:" fgroup-class="col-md-4"/>
            <x-adminlte-input name="contact_info_sector" label="Setor:" fgroup-class="col-md-2"/>
            <x-adminlte-input name="contact_info_email" label="E-mail:" fgroup-class="col-md-2"/>
            <x-adminlte-input name="contact_info_phone" label="Telefone:" fgroup-class="col-md-2"/>
            <x-adminlte-input name="contact_info_branch_line" label="Ramal:" fgroup-class="col-md-2"/>
        </div>
        <div class="form-actions">
            <x-adminlte-button theme="primary" icon="fa fa-fw fa-lg fa-plus" title="Adicionar" class="add" />
            <x-adminlte-button theme="danger" icon="fa fa-fw fa-lg fa-trash" title="Remover" class="remove" />
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id='tbl_contact_infos'>
                </table>    
            </div>
        </div>
    </div>
</div>    