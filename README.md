# API com PHP

## O que é

Uma API RESTFUL para cadastrar e buscar cursos.

## Objetivo

Esse projeto é parte processo seletivo, tem como objetivo a análise de competências e habilidades do(a) candidato(a).

## Instalação Local

- Instale o apache, php e Mysql da forma como lhe convier (xampp, wampp ou individualmente)
- Instale o composer e o git
- Em seu local de execução (VisualCode,Sublime, entre outros) baixe o projeto usando o *git clone*
- Digite *composer install* para instalar as bibliotecas

## Convenções

Convenções adotadas no ambiente de trabalho para o projeto API:

|Métodos| URI | Função| 
|-------|-----|-----|
| GET   |api/courses| Buscará e retornará todos os cursos existentes no banco de dados
|GET    |api/school| Buscará e retornará todos as escolas existentes no banco de dados
|GET    |api/conversions| Retornará uma lista específica de cursos 
|POST   |api/courses|Irá inserir novos cursos a lista do banco de dados
|POST   |api/schools| Irá inserir novas escolas a lista do banco de dados
|PUT    |api/courses/{course}|Irá atualizar, por parâmetro, novos cursos ao banco de dados
|PUT    |api/schools/{school}|Irá atualizar, por parâmetro, novas escolas ao banco de dados
|DELETE |api/courses/{course}|Irá deletar cursos do banco de dados
|DELETE |api/schools/{school}|Irá deletar escolas do banco de dados


## Bibliotecas do Projeto

- Foi utilizado o Laravel como framework para rotas
- Banco de Dados MySql

## Plataforma para teste

- O utilizado durante os testes. Por ele é possível fazer o envio das requisições e a análise do retorno

## Observações Importantes

- Para ter acesso ao GET do api/conversions é necessário informar o parâmetro /api/conversions?dataCotacao=YYYYMMDD


