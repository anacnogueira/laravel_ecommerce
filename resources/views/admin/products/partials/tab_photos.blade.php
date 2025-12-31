<div class="row">
    <div class="col-md-12">
         <p><strong>Instruções para inserção de imagens</strong></p>
         <ul>
          <li>Insira até {{ env('FILE_MAX_QTDE') }} imagens</li>
          <li>Extensões permitidas: jpg, jpeg, png e gif</li>
          <li>Cada imagem não deve ultrapassar {{ env('FILE_MAX_FILE_SIZE_TXT') }}</li>
        </ul>
        <div class="row">
            @for ($i=0; $i < env('FILE_MAX_QTDE'); $i++)
                <div class="col-md-2">
                    <div class="file-upload">
                        @if (isset($product->photos[$i]))
                            <input type="hidden" name="photo_ori[{{ $i }}]" value="{{ $product->photos[$i]->photo_ori }}" />
                            <input type="hidden" name="photo_redim[{{ $i }}]" value="{{ $product->photos[$i]->photo_redim }}" />
                        @endif

                        <div id ="upload-preview-{{ $i+1 }}">
                            @if (isset($product->photos[$i]) && !empty($product->photos[$i]))
                                <img src="{{ Storage::url ($product->photos[$i]->photo_redim) }}" alt="" width="119" height="67" />
                            @else
                                <div class="product-upload-image">
                                    <i class='fa fa-camera' aria-hidden='true'></i>
                                    <i class='fa fa-plus fa-2' aria-hidden='true'></i>
                                </div>
                            @endif
                        </div>
                        <input type="file" name="files[{{ $i }}]" class="input-upload" id="file-{{ $i+1 }}" />
                        <x-adminlte-input name="order[{{ $i }}]" type="number" value="{{ $product->photos[$i]->order ?? ''}}" placeholder="Ordem" size="2" min="1" max="6" />
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
