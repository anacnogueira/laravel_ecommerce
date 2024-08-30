<div class="row">
 	<div class="col-md-12">
        <table class="table table-bordered" id="date-table">
            <thead>
                <tr>
                    <th>Data Inicial</th>
                    <th>Hora Inicial</th>
                    <th>Data Final</th>
                    <th>Hora Final</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @include('admin.events.partials.dates', ['key' => 0])
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td class="actions">
                        <x-adminlte-button theme="success" icon="fa fa-fw fa-lg fa-plus" title="Adicionar" class="add" />  
                    </td>
                </tr>
            </tfoot>
        </table>        
 	</div>
</div> 	