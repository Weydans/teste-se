# Teste SE

Sistema de venda de produtos desenvolvido para teste técnico para a empresa SE

## Fluxos da aplicação

Para que possam ser utilidas todas as funconalidades, 
é necessário realizar, primeiro, o cadastro de categorias de produtos, 
isso permitirá cadastrar os produtos, que por sua vez, permitirá cadastrar as vendas no sistema.



## Importante

 - Verifique antes de subir os containers se alguma das portas utilizadas pela aplicação encontram-se em uso em sua máquina



### Observações

- Foi bem legal desenvolver o projeto. Algumas bibliotecas foram utilizadas no processo como Doctrine, Twig e PHPUnit.
- A pasta lib é um "micro-framework" que permite a criação de Rotas, Abstração de Controladores e Traits muito úteis no desenvolvimento.
- Os scripts do front end encontram-se na pasta public. Preferi utilizar vanilla Javascript por haver necessidade em uma única página.
- O sistema está dockerizado sendo esperado o mesmo comportamento em outras máquinas.
- A aplicação conta com variáveis de ambiente (.env) para facilitar o bootstrap do projeto e esconder secrets.
- Todas as classes presentes na pasta src estão em PHP nativo como requisitado.
- SGBD Postgres como requisitado.
- Biblioteca de front end Bootstrap (via CDN) como sugerido.
- Foi utilizado o composer para gerenciar as dependências do projeto.
- O projeto conta com migrações para criação da base de dados.
- Foi utilizado um arquivo Makefile para facilitar a instalação, Execução e Exclusão do projeto.
- O sistema segue o padrão arquitetural da Clean Archtecture.
- Foram utilizados padrões de projeto como Repository e Singleton, métodos mágicos \__get, \__set e \__isset, iterfaces, traits, herança e muitas outras funcionalidades das versões mais modernas do PHP. 
- Foi realizada a cobertura de testes de unidade sobre as principais classes de domínio do negócio, incluindo as pastas, Model e Service. Com isso a aplicação no geral possui atualmente 10.72% de cobertura, contudo, a camada de domínio encontra-se com 70.25% de cobertura, sendo que, o que falta fica por conta dos repositórios que funcionam como adaptadores para cominicação com o Doctrine, ou seja, baixo risco de erros.
-
  Boa avaliação, espero ter feito um bom trabalho ;)

## Dependências

É necessário ter previamente instalado em sua máquina os seguintes softwares:

- [git](https://git-scm.com/downloads)
- [Docker](https://docs.docker.com/engine/install/)
- [docker-compose](https://docs.docker.com/compose/install/)

Clique nos links acima para acessar a página de instalação de cada um.



## Instalação

- Clone o projeto
```bash
git clone https://github.com/Weydans/teste-se.git
```

- Acesse a pasta do projeto
```bash
cd teste-se
```

- Rode o comando de instalação dos containers
```bash
make install
```


## Execução

- Suba a plicação com o comando abaixo
```bash
make
```



## Acesso

O acesso pode ser feito [aqui](http://localhost:8000/) nesse link ou pela url do navegador `http://localhost:8000/`.


## Execução dos testes

Executa os teste de unidade 
```bash
make test
```

__Para acessar os dados de cobertura de testes abra o arquivo `coverage/index.html` no seu navegador__




## Parar Execução

Interrompe a execução dos containers
```bash
make down
```



## Desinstalação

Remove a pasta com todos os arquivos do projeto
```bash
sudo make uninstall
```
