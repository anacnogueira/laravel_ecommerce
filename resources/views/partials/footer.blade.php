<footer class="footer hide-for-print">
    <section class="footer-1">
        <div class="newsletter">
            <p class="title">Cadastre seu e-mail e receba promoções</p>
            <form action="{{ route("newsletters") }}" method="post" id="contact-newsletter-form">
               <input type="email" name="email" placeholder="e-mail" id="email-newsletter" required/>
               <input type="submit" value="OK">
            </form>
            <div class="newsletter-response"></div>
        </div>
        <div class="links">
            <p class="title">Siga-nos nas redes sociais</p>
            <ul class="inline-list">
                <li>
                    <a href="https://www.facebook.com/mayacosmeticos" title="Facebbok" target="_blank"><i class="fa-brands fa-facebook social-media"  aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/mayacosmeticos/" title="Instagram" target="_blank"><i class="fa-brands fa-instagram social-media"  aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="https://br.pinterest.com/mayacosmeticos/" title="Pinterest" target="_blank"><i class="fa-brands fa-pinterest social-media"  aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="http://bit.ly/youtubemaya" title="Youtube" target="_blank"><i class="fa-brands fa-youtube-square social-media" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="https://twitter.com/maya_cosmeticos" title="Twitter" target="_blank"><i class="fa-brands fa-twitter-square social-media" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
        <div class="informations">
            <p class="title">Informações</p>
            <ul>
                @foreach ($pages as $page)
                    <li><a href="/pagina/{{ $page->permalink }}">{{ $page->title }}</a></li>
                @endforeach

                <li><a href="/faq">Perguntas Frequentes</a></li>
                <li><a href="/contato">Contato</a></li>
                <li><a href="https://blog.mayacosmeticos.com.br/?utm_source=mayacosmeticos.com.br&utm_medium=referral" target="_blank">Blog Da Maya</a></li>
                <li><a href="/mapa-site">Mapa do site</a></li>
            </ul>
        </div>
    </section>
    <section class="footer-2">
        <div class="my-account">
            <p class="title">Minha Conta</p>
            <ul>
                @auth
                    <li><a href="/meus-pedidos/filtro:ultimos">Úlltimos Pedidos</a></li>
                    <li><a href="/meus-pedidos/filtro:abertos">Pedidos Abertos</a></li>
                    <li><a href="/meus-pedidos/filtro:entregues">Pedidos Entregues</a></li>
                    <li><a href="/meus-pedidos/filtro:numero">Pedidos por número</a></li>
                    <li><a href="/meus-pedidos/filtro:data">Pedidos por data</a></li>
                    <li><hr></li>
                    <li><a href="/minha-conta/alterar-email">Alterar e-mail</a></li>
                    <li><a href="/minha-conta/alterar-senha">Alterar Senha</a></li>
                    <li><a href="/minha-conta/alterar-dados-cadastrais">Alterar dados</a></li>
                    <li><a href="/minha-conta/email-ofertas">E-mail de ofertas</a</li>
                    <li><a href="/minha-conta/meus-enderecos">Meus Endereços</a></li>
                    <li><hr></li>
                    <li><a href="/meus-favoritos">Meus Produtos Favoritos</a></li>
                @endauth

                @guest
                    <li><a href="/cadastro">Cadastro</a></li>
                    <li><a href="/login">Login</a></li>
                @endguest
            </ul>
        </div>
        <div class="contact">
            <p class="title">Contato</p>
            <span class="whatsapp">
                <a href="https://api.whatsapp.com/send?1=pt_BR&phone=5512988681452" title="Whatsapp" target="_blank"> <i class="fa-brands fa-whatsapp"></i> (12)98868-1452 </a>
            </span>
        </div>
    </section>
    <section class="address">
        <div>
            <span itemprop="name">Ana Claudia Nogueira 330872648-30 </span>
		    <span itemprop="address">CNPJ: 21.228.933/0001-00</span>
		    <address itemprop="addressLocality">Avenida Vale do Paraíba, 485 - Parque Santo Antonio - Jacareí-SP</span>
        </div>
        <div class="rights">
            <div>&copy; Maya Cosméticos <?php echo date('Y'); ?> - Todos os direitos reservados</div>
 	        <div>Desenvolvido por Ana Claudia Nogueira</div>
        </div>
    </section>
</footer>
