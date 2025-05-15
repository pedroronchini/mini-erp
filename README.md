# Mini-ERP

Este projeto é um mini ERP desenvolvido em Laravel 10 (PHP 8.3) que permite o controle de Pedidos, Produtos, Cupons e Estoque, com frontend em Bootstrap.

## Requisitos

* PHP 8.3
* Composer
* MySQL
* Node.js e npm (para compilação de assets com Vite)

## Instalação

1. **Clone o repositório**

   ```bash
   git clone https://github.com/pedroronchini/mini-erp.git
   cd mini-erp
   ```

2. **Instale dependências PHP**

   ```bash
   composer install
   ```

3. **Configure variáveis de ambiente**

   * Copie o arquivo de exemplo:

     ```bash
     cp .env.example .env
     ```

   * Ajuste no `.env` as configurações de conexão com o banco:

     ```dotenv
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=mini_erp
     DB_USERNAME=seu_usuario
     DB_PASSWORD=sua_senha
     ```

## Banco de Dados

### Executando as migrations

Para criar as tabelas no banco de dados, execute:

```bash
php artisan migrate
```

Caso queira reiniciar o banco (remover todas as tabelas e recriar), use:

```bash
php artisan migrate:fresh
```

Caso queira o arquivo `dump-erp-202505142134.sql` tem o código do banco.

## Iniciando a aplicação

Para iniciar o servidor interno do Laravel, rode:

```bash
php artisan serve
```

O projeto ficará disponível em `http://127.0.0.1:8000`.

## Rotas Principais

* **Produtos**:

  * `GET /products` → Listagem e criação rápida de produtos
  * `POST /products` → Cadastro de produto
  * `PUT /products/{id}` → Atualização de produto

* **Carrinho**:

  * `GET /cart` → Visualizar carrinho
  * `POST /cart/add/{product}` → Adicionar item
  * `POST /cart/apply-coupon` → Aplicar cupom
  * `POST /cart/checkout` → Finalizar pedido

* **Cupons** (CRUD):

  * `GET /coupons`, 
  * `GET /coupons/create`, 
  * `POST /coupons`, 
  * `GET /coupons/{id}/edit`, 
  * `PUT /coupons/{id}`, 
  * `DELETE /coupons/{id}`


