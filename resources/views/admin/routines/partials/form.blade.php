<div class="row">
    <div class="col-md-12">
        @csrf
        <x-adminlte-select name="module_id" label="Módulo:">
        @foreach($modules as $module)
                <option value="{{ $module->id }}" {{ isset($routine->module_id) && $module->id == $routine->module_id ? "selected" : "" }}>{{ $module->name }}</option>
        @endforeach
        </x-adminlte-select>

        <x-adminlte-input name="name" label="Nome:*" value="{{ $routine->name ?? ''}}" placeholder="Insira nome do módulo" enable-old-support/>

        <x-adminlte-textarea name="description" label="Descrição:" cols="40" rows="10" enable-old-support>
            {{ $routine ? $routine->description : ''}}
        </x-adminlte-textarea>

        <x-adminlte-input name="page" label="Página:" value="{{ $routine->page ?? ''}}" placeholder="Insira página da rotina" enable-old-support/>
        
        <x-adminlte-input name="onclick" label="Ao clicar:" value="{{ $routine->onclicke ?? ''}}" placeholder="Insira a ação ao clicar" enable-old-support/>

        <x-adminlte-input type="number" name="quantity" label="Qtde registos:*" value="{{ $routine->quantity ?? ''}}" placeholder="Qtde de registros a serem afetados" enable-old-support/>
        
        <x-adminlte-input type="number" name="order" label="Ordem:" value="{{ $routine->order ?? ''}}" placeholder="Insira a ordem do módulo" enable-old-support/>

        @php
            $config = [
                'state' => (isset($routine) && $routine->visible == 'S') || !isset($routine) ? true : false,
            ];
        @endphp    
        <x-adminlte-input-switch 
            name="visible"
            label="Vísivel:"
            data-on-color="success"
            data-off-color="danger"
            data-on-text="Sim"
            data-off-text="Não"
            :config="$config"
            checked="$config['state']"
            enable-old-support />

        <x-adminlte-input name="btn_image" label="Imagem:" value="{{ $routine->btn_Image ?? ''}}" placeholder="Insira a imagem do botão" enable-old-support/>    
        
        <div class="form-group">
            <label>Mostrar:</label>
            <div class="radio">
                <label>
                    <input type="radio" name="show" value="header"
                    {{  isset($routine->show) && $routine->show == "header" ? "checked" : "" }}> Cabeçalho
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="show" value="intern"
                    {{  isset($routine->show) && $routine->show == "intern" ? "checked" : "" }}> Interno
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="show" value="specific"
                    {{  isset($routine->show) && $routine->show == "specific" ? "checked" : "" }}> Específico
                </label>
            </div>
            
        </div>

        

        <a href="{{ route('admin.routines.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>    
    </div>
</div>   