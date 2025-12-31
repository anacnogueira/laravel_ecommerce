# 🛍️ Ecommerce de Cosméticos - Laravel 12

Este projeto é uma aplicação de ecommerce desenvolvida com Laravel 12, voltada para a venda de cosméticos. O sistema permite a gestão de produtos, categorias, clientes, pedidos e pagamentos, com uma interface amigável tanto para os usuários quanto para os administradores da loja.
Veja a loja em funcionamento:
<https://mayacosmeticos.com.br/>

## 🚀 Funcionalidades

-   Cadastro e login de clientes
-   Catálogo de produtos com busca e filtro por categoria
-   Carrinho de compras e finalização de pedido
-   Pagamento via API para Cartão De Crédito, Boleto e Pix(EFí)
-   Dashboard administrativo para gerenciamento de:
    -   Produtos e categorias
    -   Pedidos e status de entrega
    -   Clientes
-   Controle de estoque
-   Imagens dos produtos
-   Cupons de desconto
-   Paǵinas Estáticas

## 🧰 Tecnologias utilizadas

-   **PHP 8.5+**
-   **Laravel 12**
-   **MySQL**
-   **CSS**
-   **Javascript**
-   **Composer**
-   **Blade Templates**

## ⚙️ Instalação

1. Clone o repositório:

    ```bash
    git clone https://github.com/anacnogueira/laravel_ecommerce.git
    cd laravel_ecommerce
    ```

2. Instale as dependências:

    ```bash
    composer install
    ```

3. Copie o arquivo .env.example para .env e configure as variáveis de ambiente (banco de dados, email, etc):

    ```bash
    cp .env.example .env
    ```

4. Gere a chave da aplicação:
    ```bash
    php artisan key:generate
    ```
5. Inicie o docker com sail:

    ```bash
    sail up -d
    ```

6. Acesse o frontend:
   `http://localhost`

7. Acesse o admin:
   `http://localhost/admin`

🗂️ Estrutura do projeto

-   app/Models: Modelos Eloquent
-   app/Repositories: Repositorios
-   app/Http/Controllers: Lógica dos controladores
-   app/Services: Lógica dos serviços
-   resources/views: Arquivos Blade (frontend)
-   routes/web.php: Rotas web da aplicação
-   routes/api.php: Rotas API da aplicação

📦 Futuras melhorias

-   Estilização de páginas da loja
-   Sistema de avaliação dos produtos
-   Notificações por email
-   Integração com redes sociais
-   Versão mobile-first responsiva

📄 Licença

<p>Este projeto está licenciado sob a MIT License.</p>

<p>Desenvolvido com ❤️ por Ana Claudia Nogueira</p>
