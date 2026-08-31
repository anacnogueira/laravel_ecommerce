 @if ($address)
     <div class="address-item">
         <input type="radio" name="contact_address_id" value="{{ $address->id }}" checked />
         <div class="adress-item-info">
             <p><strong>{{ $address->title }}</strong></p>
             <p>{{ $address->address }}, {{ $address->number }}</p>
             @if (!empty($address->complement))
                 <p>{{ $address->complement }}</p>
             @endif
             <p>{{ $address->neighborhood }}</p>
             <p>CEP: <span id="cep-selected">{{ $address->cep }}</span></p>
             <p>{{ $address->city->name }} - {{ $address->state->uf }} - {{ $address->country->name }}
             </p>
         </div>
     </div>
     <p><a href="{{ route('customers.addresses.index', 'redirect=checkout') }}" class="button">Usar
             outro
             endereço</a></p>
 @else
     <p>Nenhum endereço de entrega cadastrado.</p>
     <p><a href="{{ route('customers.addresses.create', 'redirect=checkout') }}" class="button">Cadastrar endereço</a>
     </p>
 @endif
