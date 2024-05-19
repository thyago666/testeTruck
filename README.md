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
- Composer

### Passos para Instalação e Uso da API

1. Clone o repositório: "https://github.com/thyago666/truckpag.git" na pasta (c:\xampp\htdocs\pasta)

2. Abrir o projeto com o visual Studio code ou alguma IDE de sua preferencia

3. Criar o .env e copiar o conteudo do env.example e informar as senhas do seu banco de dados Mysql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=testetruck
DB_USERNAME=
DB_PASSWORD=

4. Acessar o terminal do VSCode e digitar o comando "composer install" (se der erros de avisos, acessar o php.ini do xampp e habilitar a opcao extension=zip)

5. Pelo terminal do VScode dar o comando "php artisan key:generate"

6. Executar o xampp e startar o apache e o Mysql.  

7. executar o comando "php artisan migrate" no terminal do VS Code e responder yes para criar o banco no Mysql.

8. Executar o comando "PHP artisan serve" no terminal do VS Code.

9. Abrir o postman e criar uma collection (botão new) e importar a collection dos endpoints (pasta postman dentro do projeto 'Truck.postman_collection.json')

10. Executar o primeiro endpoint pelo postman mehotd[GET] - http://localhost:8000/cron

11. Executar o segundo pelo postman method[GET] http://localhost:8000/token
    Vai ser retornado um token, copiar esse token e colar no headers dos metodos PUT e DELETE

12. Executar o endpoint pelo postman method[GET] http://localhost:8000/products?page=1  

13. Executar o endpont pelo postman method[DELETE] http://localhost:8000/products/8718215063506 (o codigo do produto fica ao seu critério)

14. Executar o endpoint pelo postman method[PUT] http://localhost:8000/products/8718215090281 (o codigo do produto fica ao seu critério) 

15. Executar o endpoint pelo postman method[GET] http://localhost:8000/products/8718215063506 (o codigo do produto fica ao seu critério) 

16. Executar o endpoint pelo postman method[GET] http://localhost:8000/details
