<header>
    <div id="info">
        <div class="attendance">
            <span id="open-modal-attendance">Atendimento</span>
            <div id="modal-attendance">
                <div class="modal-content">
                    <span id="modal-close">&times;</span>
                    <p class="modal-title">Central de Atendimento</p>
                    <p><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> (12)9889-1452</p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i>atendimento@mayacosmeticos.com.br</p>
                    <p><i class="fa fa-clock" aria-hidden="true"></i><strong>Horário de Atendimento</strong></p>
                    Segunda à Sexta: das 09H às 18h <br>
                    Sábado: 09h às 16h
                </div>
            </div>
        </div>
        <div class="payment-methods">
            Cartão de Crédito | Boleto | PIX
        </div>
        <div class="header-links">
            <ul>
                <li><a href="/" title="Ir para página inicial"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li> | </li>
                <li><a href="{{  route('pages.contact') }}">Contato</a></li>
                <li> | </li>
                <li><a href="{{ route('pages.sitemap') }}">Mapa do Site</a></li>
            </ul>
        </div>
    </div>
    <div class='top-mobile'>
        <div id="menu-dropdown-top">
            <button class="button">MENU</button>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{  route('pages.contact') }}">Contato</a></li>
                <li><a href="{{ route('pages.sitemap') }}">Mapa do Site</a></li>
            </ul>
        </div>
        <div>
            @if (session('contact'))
                <form action="{{ route('logout') }}" method="POST" id="frm-logout-contact">
                    @csrf
                    <button type="submit"><i class="fa fa-user fa-lg"></i>LOGOUT</button>
                </form>
            @else
                <a href="{{ route('login') }}"><i class="fa fa-user fa-lg"></i> LOGIN</a>
            @endif
        </div>
    </div>
    <div id="header-2">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('img/logo.svg') }}" alt="Logotipo Maya Cosméticos" title="Logotipo Maya Cosméticos" width="163" height="163">
            </a>
        </div>
        <div class="search">
            <form action="{{ url('busca') }}" method="POST">
                @csrf
                <label class="sr-only" for="keyword">Faça aqui a sua busca</label>
                <input
                    type="search"
                    id="keyword"
                    name="keyword"
                    placeholder="O que você procura?"
                    class="@error('keyword') is-invalid @enderror"
                    required
                />

                <button><i class="fas fa-search"></i></button>
            </form>
            @error('keyword')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="bag">
            <div id="menu-dropdown-user">
                <button><i class="item fa fa-user fa-6"></i></button>
                <ul>
                    @if (session('contact'))
                        <li><a href="#">Meus Pedidos</a></li>
                        <li><a href="#">Meus Dados</a></li>
                        <li><a href="#">Meus Favoritos</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="frm-logout-contact">
                                @csrf
                                <button type="submit"><i class="fa fa-user fa-lg"></i>LOGOUT</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Fazer Login</a></li>
                        <li><a href="{{ route('register') }}">Novo Cadastro</a></li>
                        <li><a href="{{ route('pages.contact') }}">Fale Conosco</a></li>
                    @endif
                </ul>
            </div>

            <a href="#" class="item" id="show_hide_mini_cart" title="Minha Sacola">
                <i class="fa fa-shopping-bag fa-6 left" aria-hidden="true"></i>
            </a>
            <div class="item mini-bag hide-for-small-only">
                Minha Sacola <i class="fa fa-sort-asc"></i><br>
                <span class="cart_count">0 itens </span>|
                <span class="total_cart">R$0,00</span>
            </div>
        </div>
    </div>
</header>
