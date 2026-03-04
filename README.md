# Shop API

API RESTful para gerenciamento de e‑commerce desenvolvida em Laravel 10.
A aplicação utiliza autenticação via Laravel Sanctum, fornecendo tokens
Bearer para acesso aos recursos protegidos.

## Funcionalidades

* Cadastro e autenticação de usuários
* CRUD completo de produtos
* Consulta do relacionamento entre usuários e produtos
* Geração de pedidos com checkout integrado ao MercadoPago

Todos os endpoints seguem os princípios REST e retornam respostas em JSON.

## Estrutura do Projeto

```text
app/             # Models, Controllers, Services e lógica de negócio
config/          # Configurações do framework
database/        # Migrations, factories e seeders
public/          # Front controller e ativos públicos
resources/       # Views, scripts e estilos
routes/          # Rotas da aplicação (api.php, web.php, console.php)
tests/           # Testes de unidade e de feature
vendor/          # Dependências gerenciadas pelo Composer
API_DOCUMENTATION.md  # Documentação detalhada da API
README.md        # Este arquivo
```

## Requisitos

* PHP 8.1+
* Composer
* Banco de dados MySQL, MariaDB, PostgreSQL ou SQLite
* Extensões PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath

## Instalação

```bash
# clonar repositório
git clone <repo-url> shop
cd shop

# instalar dependências
composer install

# configurar ambiente
cp .env.example .env
# editar .env com as credenciais do banco e chaves MercadoPago

# gerar chave do aplicativo
php artisan key:generate

# migrar banco e popular dados iniciais
php artisan migrate --seed

# iniciar servidor de desenvolvimento
php artisan serve
```

## Configuração

A aplicação espera as seguintes variáveis no arquivo `.env`:

```ini
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shop
DB_USERNAME=root
DB_PASSWORD=

MERCADOPAGO_CLIENT_ID=...
MERCADOPAGO_CLIENT_SECRET=...
```

Ajuste conforme seu ambiente e banco de dados.

### CORS
Caso consuma a API de um front-end em outro domínio, configure o CORS
em `config/cors.php`.

## Autenticação

Os endpoints públicos são `/cadastro` e `/login`. Todos os demais
requerem cabeçalho:

```
Authorization: Bearer {TOKEN}
```

O token é retornado nas respostas de cadastro e login.

## Documentação da API

A documentação completa, com parâmetros, exemplos de requisição e resposta,
esta disponível em `API_DOCUMENTATION.md`.

## Relacionamentos de Modelo

* `User` possui muitos `Product`.
* Produtos recebem `user_id` na criação.
* Pedidos são construídos dinamicamente via serviço MercadoPago; após a
  criação é registrada uma cópia no banco de dados em tabela `orders`.

Modelos principais:

* `app/Models/User.php`
* `app/Models/Product.php`

## Execução de Testes

O projeto inclui testes de exemplo em `tests/`.
Para rodar os testes:

```bash
php artisan test
```

Adicione novos testes em `tests/Feature` ou `tests/Unit` conforme necessário.

## Convenções

* Respostas JSON no formato `{ "message": "...", "data": ... }`.
* Códigos HTTP utilizados: 200, 201, 400, 404, 500.
* Validações implementadas com `FormRequest` ou `Validator`.

## Boas práticas
danálise
* Revogue tokens de API via Sanctum quando necessário.
* Mantenha as variáveis de ambiente seguras e fora do controle de versão.

## Recursos Úteis

* [Documentação Laravel](https://laravel.com/docs)
* [Sanctum](https://laravel.com/docs/sanctum)
* [Boas práticas RESTful](https://restfulapi.net)

---

*Última atualização: 4 de março de 2026*

