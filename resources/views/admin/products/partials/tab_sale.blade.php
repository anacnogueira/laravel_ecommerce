<div class="row">
 	<div class="col-md-12">
        <x-adminlte-input name="name" label="Nome:*" value="{{ $product->name ?? ''}}" enable-old-support/>
        <x-adminlte-select name="category_id" label="Categoria:*" enable-old-support>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ isset($product->category_id) && $category->id == $product->category_id ? "selected" : "" }}>{{ $category->name }}</option>
            @endforeach
        </x-adminlte-select>
        <x-adminlte-input name="selling_price" label="Preço de venda:*" class="money" value="{{ $product->selling_price ?? ''}}" enable-old-support/>
        @php
            $config = [
                "height" => "200",
                "toolbar" => [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            ]
        @endphp
        <x-adminlte-text-editor name="text" label="Descrição:"
            igroup-size="sm" placeholder="Descrição" :config="$config"  enable-old-support>
            {!! $product->text ?? '' !!}
        </x-adminlte-text-editor>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="highlight">Destaque:</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="highlight1" name="highlight" value="S" {{ old('highlight') == 'S' || (isset($product->highlight) && $product->highlight == 'S') ? 'checked' : '' }}>
                        <label for="highlight1" class="custom-control-label">Sim</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="highlight2" name="highlight" value="N" {{ old('highlight') == 'N' || (isset($product->highlight) && $product->highlight == 'N') ? 'checked' : '' }}>
                        <label for="highlight2" class="custom-control-label">Não</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                    <label for="highlight">Novidade:</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="news1" name="news" value="S" {{ old('news') == 'S' || (isset($product->news) && $product->news == 'S')? 'checked' : '' }}>
                        <label for="news1" class="custom-control-label">Sim</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="news2" name="news" value="N" {{ old('news') == 'N' || (isset($product->news) && $product->news == 'N') ? 'checked' : '' }}>
                        <label for="news2" class="custom-control-label">Não</label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
