# Título do Projeto

Projeto ApiTruck - API para consulta de dados da plataforma Open Food Facts
O projeto tem como objetivo dar suporte a equipe de nutricionistas da empresa Fitness Foods LC .

## Tecnologias Utilizadas

- Linguagem: PHP
- Framework: Laravel
- Banco de Dados: MySQL
- Frontend: Postman
- Outras Tecnologias: Git

### Pré-requisitos

- XAMPP

### Passos para Instalação e Uso da API

1. Clone o repositório: https://github.com/thyago666/truckpag.git

2. Abrir o projeto com o visual Studio code ou alguma IDE de sua preferencia

3. Configurar o .env do projeto com as senhas do seu banco de dados Mysql
    DB_DATABASE=testetruck
    DB_USERNAME=
    DB_PASSWORD=

4. Executar o xampp e startar o apache e o Mysql.  

5. executar o comando "php artisan migrate" no terminal do VS Code e responder yes para criar o banco no Mysql.

6. Executar o comando PHP artisan serve no terminal do VS Code.

7. Abrir o postman e importar a collection dos endpoints (pasta postman dentro do projeto 'Truck.postman_collection.json')

8. Executar o primeiro endpoint pelo postman mehotd[GET] - http://localhost:8000/cron

9. Execuntar o segundo pelo postman method[GET] http://localhost:8000/token
    Vai ser retornado um token, copiar esse token e colar no headers dos metodos PUT e DELETE

10. Executar o endpoint pelo postman method[GET] http://localhost:8000/products?page=1  

11. Executar o endpont pelo postman method[DELETE] http://localhost:8000/products/8718215063506 (o codigo do produto fica ao seu critério)

12. Executar o endpoint pelo postman method[PUT] http://localhost:8000/products/8718215090281 (o codigo do produto fica ao seu critério) 

13. Executar o endpoint pelo postman method[GET] http://localhost:8000/products/8718215063506 (o codigo do produto fica ao seu critério) 

14. Executar o endpoint pelo postman method[GET] http://localhost:8000/details

