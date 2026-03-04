# Documentação da API - Shop

## Visão Geral

API RESTful para gerenciamento de e-commerce, construída com Laravel e autenticação via tokens Sanctum.

**Base URL:** `http://localhost:8000/api/`  
**Versão:** 1.0  
**Autenticação:** Bearer Token (Sanctum)

---

## Autenticação

### Registrar Novo Usuário
Cria uma nova conta de usuário e retorna um token de autenticação.

**Endpoint:** `POST /cadastro`  
**Autenticação:** Não requerida  
**Content-Type:** `application/json`

#### Parâmetros (Body)
```json
{
  "name": "João Silva",
  "email": "joao@example.com",
  "password": "senha123"
}
```

#### Resposta de Sucesso (201 Created)
```json
{
  "message": "ok",
  "data": {
    "id": 1,
    "name": "João Silva",
    "email": "joao@example.com",
    "created_at": "2026-03-02T10:30:00Z",
    "updated_at": "2026-03-02T10:30:00Z"
  },
  "token": "1|abcdefghijklmnopqrstuvwxyz"
}
```

#### Exemplo de Requisição
```bash
curl -X POST http://localhost:8000/api/cadastro \
  -H "Content-Type: application/json" \
  -d '{
    "name": "João Silva",
    "email": "joao@example.com",
    "password": "senha123"
  }'
```

---

### Autenticar Usuário
Realiza login e retorna um token de autenticação.

**Endpoint:** `POST /login`  
**Autenticação:** Não requerida  
**Content-Type:** `application/json`

#### Parâmetros (Body)
```json
{
  "email": "joao@example.com",
  "password": "senha123"
}
```

#### Resposta de Sucesso (200 OK)
```json
{
  "message": "ok",
  "data": {
    "id": 1,
    "name": "João Silva",
    "email": "joao@example.com",
    "created_at": "2026-03-02T10:30:00Z",
    "updated_at": "2026-03-02T10:30:00Z"
  },
  "token": "2|abcdefghijklmnopqrstuvwxyz"
}
```

#### Erro de Autenticação (400 Bad Request)
```json
{
  "message": "error"
}
```

#### Exemplo de Requisição
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "joao@example.com",
    "password": "senha123"
  }'
```

---

## Gerenciamento de Usuários

### Obter Dados do Usuário
Retorna as informações de um usuário específico.

**Endpoint:** `GET /user/{id}`  
**Autenticação:** Requerida   
**Método HTTP:** GET

#### Parâmetros
| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| id | integer | ID do usuário |

#### Resposta de Sucesso (200 OK)
```json
{
  "message": "ok",
  "data": {
    "id": 1,
    "name": "João Silva",
    "email": "joao@example.com",
    "created_at": "2026-03-02T10:30:00Z",
    "updated_at": "2026-03-02T10:30:00Z"
  }
}
```

#### Erro - Usuário Não Encontrado (400 Bad Request)
```json
{
  "message": "not found"
}
```

#### Erro - Não Autenticado (400 Bad Request)
```json
{
  "Message": "not authenticable"
}
```

#### Exemplo de Requisição
```bash
curl -X GET http://localhost:8000/api/user/1 \
  -H "Authorization: Bearer {TOKEN}"
```

---

### Atualizar Dados do Usuário
Atualiza as informações de um usuário.

**Endpoint:** `PUT /user/{id}`  
**Autenticação:** Requerida   
**Content-Type:** `application/json`

#### Parâmetros
| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| id | integer | ID do usuário |

#### Parâmetros (Body)
```json
{
  "name": "João Silva Atualizado",
  "email": "joao.novo@example.com",
  "password": "novasenha123"
}
```

#### Resposta de Sucesso (200 OK)
```json
{
  "message": "ok",
  "data": {
    "id": 1,
    "name": "João Silva Atualizado",
    "email": "joao.novo@example.com",
    "created_at": "2026-03-02T10:30:00Z",
    "updated_at": "2026-03-02T11:45:00Z"
  }
}
```

#### Erro - Usuário Não Encontrado (404 Not Found)
```json
{
  "message": "not found"
}
```

#### Exemplo de Requisição
```bash
curl -X PUT http://localhost:8000/api/user/1 \
  -H "Authorization: Bearer {TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "João Silva Atualizado",
    "email": "joao.novo@example.com",
    "password": "novasenha123"
  }'
```

---

### Deletar Usuário
Deleta um usuário da base de dados.

**Endpoint:** `DELETE /user/{id}`  
**Autenticação:** Requerida   
**Método HTTP:** DELETE

#### Parâmetros
| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| id | integer | ID do usuário |

#### Resposta de Sucesso (200 OK)
```json
{
  "message": "Ok"
}
```

#### Exemplo de Requisição
```bash
curl -X DELETE http://localhost:8000/api/user/1 \
  -H "Authorization: Bearer {TOKEN}"
```

---

## Relacionamento Usuário-Produto

### Listar todos os produtos com seus donos
Retorna todos os produtos junto com o usuário que é dono (relação `user`).

**Endpoint:** `GET /user/products`  
**Autenticação:** Requerida  
**Método HTTP:** GET

#### Resposta de Sucesso (200 OK)
```json
{
  "message": "ok",
  "data": [
    {
      "id": 1,
      "name": "Produto A",
      "quantity": 5,
      "unit_price": 100.0,
      "description": "Descrição",
      "user": {
        "id": 2,
        "name": "Nome do Usuário",
        "email": "user@example.com"
      }
    }
  ]
}
```

#### Exemplo de Requisição
```bash
curl -X GET http://localhost:8000/api/user/products \
  -H "Authorization: Bearer {TOKEN}"
```

---

### Listar produtos de um usuário
Retorna os produtos associados a um usuário específico.

**Endpoint:** `GET /user/{id}/products`  
**Autenticação:** Requerida  
**Parâmetros:**
| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| id | integer | ID do usuário |

#### Resposta de Sucesso (200 OK)
```json
{
  "message": "ok",
  "data": [
    {
      "id": 3,
      "name": "Produto B",
      "quantity": 2,
      "unit_price": 50.0,
      "description": "Outro produto"
    }
  ]
}
```

#### Exemplo de Requisição
```bash
curl -X GET http://localhost:8000/api/user/2/products \
  -H "Authorization: Bearer {TOKEN}"
```

---

## Gerenciamento de Produtos

### Listar Todos os Produtos
Retorna uma lista de todos os produtos cadastrados.

**Endpoint:** `GET /`  
**Autenticação:** Requerida   
**Método HTTP:** GET

#### Resposta de Sucesso (200 OK)
```json
{
  "message": "ok",
  "data": [
    {
      "id": 1,
      "name": "Laptop Dell XPS 13",
      "quantity": 10,
      "unit_price": 1299.99,
      "description": "Laptop ultraportátil com processador Intel i7",
      "created_at": "2026-03-02T10:30:00Z",
      "updated_at": "2026-03-02T10:30:00Z"
    },
    {
      "id": 2,
      "name": "Mouse Logitech MX Master",
      "quantity": 25,
      "unit_price": 99.99,
      "description": "Mouse sem fio ergonômico",
      "created_at": "2026-03-02T10:35:00Z",
      "updated_at": "2026-03-02T10:35:00Z"
    }
  ]
}
```

#### Exemplo de Requisição
```bash
curl -X GET http://localhost:8000/api/ \
  -H "Authorization: Bearer {TOKEN}"
```

---

### Criar Novo Produto
Cria um novo produto no catálogo.

**Endpoint:** `POST /product`  
**Autenticação:** Requerida   
**Content-Type:** `application/json`

#### Parâmetros (Body)
```json
{
  "name": "Teclado Mecânico RGB",
  "quantity": 15,
  "unit_price": 149.99,
  "description": "Teclado mecânico com iluminação RGB personalizada"
}
```

#### Resposta de Sucesso (201 Created)
```json
{
  "message": "ok",
  "data": {
    "name": "Teclado Mecânico RGB",
    "quantity": 15,
    "unit_price": 149.99,
    "description": "Teclado mecânico com iluminação RGB personalizada"
  }
}
```

#### Exemplo de Requisição
```bash
curl -X POST http://localhost:8000/api/product \
  -H "Authorization: Bearer {TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Teclado Mecânico RGB",
    "quantity": 15,
    "unit_price": 149.99,
    "description": "Teclado mecânico com iluminação RGB personalizada"
  }'
```

---

### Obter Detalhes de um Produto
Retorna as informações detalhadas de um produto específico.

**Endpoint:** `GET /product/{id}`  
**Autenticação:** Requerida   
**Método HTTP:** GET

#### Parâmetros
| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| id | integer | ID do produto |

#### Resposta de Sucesso (200 OK)
```json
{
  "Status": "ok",
  "data": {
    "id": 1,
    "name": "Laptop Dell XPS 13",
    "quantity": 10,
    "unit_price": 1299.99,
    "description": "Laptop ultraportátil com processador Intel i7",
    "created_at": "2026-03-02T10:30:00Z",
    "updated_at": "2026-03-02T10:30:00Z"
  }
}
```

#### Erro - Produto Não Encontrado (404 Not Found)
O Laravel retona um erro padrão de 404 quando o recurso não é encontrado.

#### Exemplo de Requisição
```bash
curl -X GET http://localhost:8000/api/product/1 \
  -H "Authorization: Bearer {TOKEN}"
```

---

### Atualizar Produto
Atualiza as informações de um produto existente.

**Endpoint:** `PUT /product/{id}`  
**Autenticação:** Requerida   
**Content-Type:** `application/json`

#### Parâmetros
| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| id | integer | ID do produto |

#### Parâmetros (Body)
```json
{
  "name": "Laptop Dell XPS 13 Plus",
  "quantity": 8,
  "unit_price": 1399.99,
  "description": "Laptop ultraportátil com processador Intel i7 Gen 13"
}
```

#### Resposta de Sucesso (201 Created)
```json
{
  "message": "ok",
  "data": {
    "name": "Laptop Dell XPS 13 Plus",
    "quantity": 8,
    "unit_price": 1399.99,
    "description": "Laptop ultraportátil com processador Intel i7 Gen 13"
  }
}
```

#### Erro - Produto Não Encontrado (400 Bad Request)
```json
{
  "message": "Not found"
}
```

#### Exemplo de Requisição
```bash
curl -X PUT http://localhost:8000/api/product/1 \
  -H "Authorization: Bearer {TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Laptop Dell XPS 13 Plus",
    "quantity": 8,
    "unit_price": 1399.99,
    "description": "Laptop ultraportátil com processador Intel i7 Gen 13"
  }'
```

---

### Deletar Produto
Remove um produto do catálogo.

**Endpoint:** `DELETE /product/{id}`  
**Autenticação:** Requerida   
**Método HTTP:** DELETE

#### Parâmetros
| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| id | integer | ID do produto |

#### Resposta de Sucesso (200 OK)
```json
{
  "message": "ok"
}
```

#### Erro - Produto Não Encontrado (400 Bad Request)
```json
{
  "message": "not found"
}
```

#### Exemplo de Requisição
```bash
curl -X DELETE http://localhost:8000/api/product/1 \
  -H "Authorization: Bearer {TOKEN}"
```

---

## Pedidos (Order)

### Criar Ordem / Checkout
Gera uma preferência de pagamento utilizando a API do MercadoPago e retorna URLs de checkout para o cliente.

**Endpoint:** `POST /order`  
**Autenticação:** Requerida   
**Content-Type:** `application/json`

#### Parâmetros (Body)
```json
{
  "product_id": 1,
  "quantity": 2
}
```

- **product_id**: ID do produto no catálogo (deve existir).
- **quantity**: Quantidade desejada (inteiro entre 1 e 100).

#### Resposta de Sucesso (201 Created)
```json
{
  "message": "ok",
  "data": {
    "order": {
      "id": 10,
      "user_id": 3,
      "product_id": 5,
      "quantity": 2,
      "unit_price": 49.99,
      "total_price": 99.98,
      "preference_id": "123456",
      "status": "pending",
      "created_at": "2026-03-04T12:00:00Z",
      "updated_at": "2026-03-04T12:00:00Z"
    },
    "checkout_url": "https://www.mercadopago.com/checkout/v1/redirect?pref_id=XYZ",
    "sandbox_url": "https://sandbox.mercadopago.com/checkout/v1/redirect?pref_id=XYZ"
  }
}
```

#### Erros Comuns
- **400 Bad Request**: Validação falhou (produto não existe ou quantidade inválida).

#### Exemplo de Requisição
```bash
curl -X POST http://localhost:8000/api/order \
  -H "Authorization: Bearer {TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{
    "product_id": 1,
    "quantity": 2
  }'
```

---

## Estrutura de Dados

### Usuário (User)
```json
{
  "id": 1,
  "name": "string",
  "email": "string (email único)",
  "password": "string (hash bcrypt)",
  "email_verified_at": "timestamp | null",
  "remember_token": "string | null",
  "created_at": "timestamp",
  "updated_at": "timestamp"
}
```

### Produto (Product)
```json
{
  "id": 1,
  "name": "string",
  "quantity": "integer",
  "unit_price": "float",
  "description": "string",
  "created_at": "timestamp",
  "updated_at": "timestamp"
}
```

### Pedido (Order) - Requisição
Os pedidos não possuem um modelo persistido neste serviço. A requisição para criar uma ordem espera um objeto simples:
```json
{
  "product_id": 1,
  "quantity": 2
}
```

---

## Como Usar

### Obtendo um Token
1. Registre-se em `/cadastro` ou faça login em `/login`
2. Você receberá um token na resposta
3. Use o token nos headers de requisições autenticadas

### Header de Autenticação
```
Authorization: Bearer {seu_token_aqui}
```

### Exemplo Completo de Fluxo
```bash
# 1. Registrar
curl -X POST http://localhost:8000/api/cadastro \
  -H "Content-Type: application/json" \
  -d '{
    "name": "João Silva",
    "email": "joao@example.com",
    "password": "senha123"
  }'

# Resposta contém token: "abc123def456"

# 2. Criar produto usando o token
curl -X POST http://localhost:8000/api/product \
  -H "Authorization: Bearer abc123def456" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Produto Teste",
    "quantity": 10,
    "unit_price": 99.99,
    "description": "Descrição do produto"
  }'

# 3. Listar todos os produtos
curl -X GET http://localhost:8000/api/ \
  -H "Authorization: Bearer abc123def456"
```

---

## Códigos de Resposta HTTP

| Código | Descrição |
|--------|-----------|
| 200 | Requisição bem-sucedida |
| 201 | Recurso criado com sucesso |
| 400 | Requisição inválida / Erro de validação |
| 404 | Recurso não encontrado |
| 500 | Erro interno do servidor |

---

## Validações

### Validação de Usuário (Cadastro e Login)
- **name**: Obrigatório, string
- **email**: Obrigatório, email válido, único
- **password**: Obrigatório, string (mínimo de caracteres conforme configuração)

### Validação de Produto
- **name**: Obrigatório, string
- **quantity**: Obrigatório, integer
- **unit_price**: Obrigatório, numérico (float)
- **description**: Obrigatório, string

---

## Notas Importantes

1. **Autenticação**: Todos os endpoints de produtos e gerenciamento de usuários requerem autenticação via token Sanctum
2. **CORS**: Certifique-se de que CORS está configurado corretamente se estiver fazendo requisições de um domínio diferente
3. **Rate Limiting**: Verifique se há limitações de taxa configuradas no servidor
4. **Estado do Token**: Tokens são únicos por sessão e permanecem válidos até serem revogados

---

## Recursos Relacionados

- [Documentação Laravel](https://laravel.com/docs)
- [Sanctum - Autenticação API](https://laravel.com/docs/sanctum)
- [API RESTful Best Practices](https://restfulapi.net)

---

**Última atualização:** 2 de Março de 2026
