# digital-wallet
Api - Carteira digital

Aplicação feita a fins de prática e aprendizagem.
Ideia é como uma carteira digital (simples), permitindo criar conta, realizar movimentações e listagem de movimentações.

## Instalação

* Clonar o projeto, e em seguida navegar até a pasta do projeto:
```
$ git clone https://github.com/rafaelo19/digital-wallet.git

$ cd digital-wallet
```

* Criando o ambiente:
```
$ docker-compose up -d --build
```

* Instalando depêndencias da aplicação:
```
$ docker exec api-digital-wallet composer install
```

* Executar migration para criar tabelas do banco de dados e popular algumas:
```
$ docker exec api-digital-wallet composer migration:migrate:seed
```

* Se necessário entrar no shell do container:
```
$ docker exec -it api-digital-wallet bash
```

## Rotas
| Url                              | Metodo  |  Uso                        |
| :--------------------------------|:--------| :---------------------------|
| /contas                          | POST    | Criar uma conta             |
| /movimentacoes                   | POST    | Fazer movimentação na conta |
| /contas/{idconta}/movimentacoes  | POST    | Busca de moviemntações      |

## Dados para consumir rotas

##### Request: `/contas` 

 - Os dados obrigatorios são: 
     * `nome`: string 
     * `saldo`: float
  ```
     {
         "nome": "Persona 3",
         "saldo": 1500.45
     }
 ```
 - Response:
 ```
    {
        "data": "Conta criado com sucesso!"
    }
 ```

<br></br>

##### Request: `/movimentacoes` 
 
 - Os dados obrigatorios são: 
    * `id_conta`: int 
    * `id_tipo_movimento`: int
    * `descricao`: string
    * `valor`: float
  - A propriedade `destinatario` e apenas obrigatório quando `id_tipo_movimento` for 2 (Saque) ou 3 (
Transferência)

 ```
     {
         "id_conta": 1,
         "id_tipo_movimento": 1,
         "descricao": "Deposito",
         "valor": 1200,
         "destinatario": {
             "id_conta": 1
         }
     }
 ```
 - Response:
 ```
    {
        "data": "Movimentação feita com sucesso!"
    }
 ```
<br></br>

##### Request: `/contas/{idconta}/movimentações` 
 
 - Os dados no endpoint são `idconta` subistituindo pela id de conta desejada, aceita apenas int.
 - Response:
    - Dados retornados e suas tipagens:
        * `data`: array
        * `id`: int 
        * `nome`: string
        * `data`: string
        * `valor`: float
 ```
   {
       "data": [
           {
               "id": 1,
               "nome": "Persona 1",
               "data": "24/01/2021",
               "descricao": "Deposito salário-DEP-Depósito",
               "valor": 1200.50
           },
           {
               "id": 1,
               "nome": "Persona 1",
               "data": "24/02/2021",
               "descricao": "Deposito salário-DEP-Depósito",
               "valor": 1200
           }
       ]
   }
 ```
  
  
 
