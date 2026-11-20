
# Gerenciador de Fretes

Esse é o meu sistema de fretes, feito pra APO de Fundamentos de Programação para Internet. 

O objetivo do sistema é poder adicionar produtos, as transportadores e endereços gerar fretes e poder exportar os fretes gerados

## O que dá pra fazer

1 Cadastrar e editar produtos, com nome, peso, medidas e quantidade
2 Cadastrar e editar transportadores, com nome, CPF ou CNPJ, telefone e cidade
3 Cadastrar e editar endereços, que depois viram a origem ou o destino do frete
4 Gerar um frete escolhendo o transportador, a origem, o destino e os produtos
5 Colocar vários produtos no mesmo frete, com o botão "+ Adicionar produto"
6 Buscar os fretes de um dia no relatório e baixar ele em PDF

## O que eu usei

1 HTML, Bootstrap, JavaScript, PHP, MySQL como banco de dados, pelo phpMyAdmin, XAMPP, Git e GitHub, Figma

## Como rodar na sua máquina

1. Instalar o  XAMPP (https://www.apachefriends.org)
2. Baixar esse repositório e coloca a pasta `APO-Frete` dentro de `C:\xampp\htdocs`
3. Abra o painel do XAMPP e liga o Apache e o MySQL
4. Entre em `localhost/phpmyadmin` e cria um banco chamado `apo_fretes`
5. Com o banco selecionado, vai na aba **Importar** e escolhe o arquivo `banco.sql`, que está na pasta do projeto
6. Agora é só abrir `localhost/APO-Frete/produtos.php` no navegador e usar o menu lá em cima pra navegar

## Quem fez

Vinicios Kresko de Freitas, RA: 09205870
Curso: Sistemas de Informação da Unipar EAD
Polo: Cascavel