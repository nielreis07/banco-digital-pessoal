# BDP - Banco Digital Pessoal

## Sobre o projeto

O **BDP (Banco Digital Pessoal)** é um projeto pessoal que estou desenvolvendo com o objetivo de praticar e aprimorar meus conhecimentos em **PHP** e **Laravel**.
Aqui, estou aplicando conceitos fundamentais de desenvolvimento de software como:

- **Clean Architecture** (Arquitetura Limpa)
- **Princípios SOLID**, especialmente:
  - Inversão de Dependência
  - Injeção de Dependência

Este projeto também serve como um material de **portfólio** para demonstrar minha evolução como desenvolvedor, mas, principalmente, é uma forma de fixar conhecimentos importantes — pois acredito que programação é prática intensa aliada a uma boa base teórica.

## Tecnologias utilizadas

- **PHP** (versão 8+)
- **Laravel** (versão 10)
- **MySQL** (banco de dados relacional)
- **Docker** (opcional para ambiente de desenvolvimento)

## Funcionalidades do BDP

- Criação de contas:
  - Conta Corrente
  - Conta Poupança
- Gerenciamento de saldo
- Depósitos e saques
- Histórico de transações (em desenvolvimento)
- (Futuras implementações: transferências entre contas, entre outros)

## Objetivos técnicos

- Praticar a construção de APIs RESTful com Laravel.
- Estudar e aplicar Clean Architecture na organização do projeto.
- Aplicar princípios SOLID de forma prática.
- Melhorar a estruturação de código visando manutenibilidade e escalabilidade.

## Estrutura do projeto

O projeto está sendo desenvolvido baseado nos conceitos de **separação de responsabilidades** e **baixo acoplamento**.
Para isso, organizei o código em camadas (controllers, services, repositories, models) e estou trabalhando na evolução contínua da estrutura.

## Observações

Este projeto está em constante evolução à medida que estudo novos conceitos e aprimoro as boas práticas de desenvolvimento.

## Como rodar o projeto

1. Clone este repositório:
   ```bash
   git clone https://github.com/seu-usuario/bdp.git
   ```

2. Instale as dependências:
   ```bash
   composer install
   ```

3. Configure o arquivo `.env`:
   Copie o arquivo `.env.example` para `.env` e configure as informações de banco de dados.

4. Rode as migrations:
   ```bash
   php artisan migrate
   ```

5. Inicie o servidor local:
   ```bash
   php artisan serve
   
