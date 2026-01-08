<input type="hidden" name="all_contact_infos" id="all-contacts-infos" value="{{ isset($supplier->info)  ? json_encode($supplier->info) : '' }}" />
<div class="row">
 	<div class="col-md-12">
        <div class="row">
            <x-adminlte-input name="contact_info_name" label="Nome:" fgroup-class="col-md-2"/>
            <x-adminlte-input name="contact_info_sector" label="Setor:" fgroup-class="col-md-2"/>
            <x-adminlte-input name="contact_info_email" type="email" label="E-mail:" fgroup-class="col-md-2"/>
            <x-adminlte-input name="contact_info_phone" class="phone" label="Telefone:" fgroup-class="col-md-2"/>
            <x-adminlte-input name="contact_info_branch_line" label="Ramal:" fgroup-class="col-md-2"/>
            <div class="form-group" fgroup-class="col-md-2">
                <x-adminlte-button
                    style="margin-top: 35px;"
                    class="btn-sm"
                    id="add-contact"
                    type="button"
                    theme="primary"
                    icon="fa fa-fw fa-lg fa-plus"
                />
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id='tbl_contact_infos'>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Setor</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Ramal</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
