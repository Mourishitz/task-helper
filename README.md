
# Task Helper

Um app simples focado em ajudar no controle de tarefas.
Este projeto foi feito em paralelo com o curso de [Desenvolvimento Web Avançado]('https://www.udemy.com/course/curso-completo-do-desenvolvedor-laravel')
e experiências profissionais.

[![wakatime](https://wakatime.com/badge/user/c3066713-8dca-47d5-9002-0096164d3393/project/786949da-0473-4d4a-abe6-d8b3211ea41f.svg)](https://wakatime.com/badge/user/c3066713-8dca-47d5-9002-0096164d3393/project/786949da-0473-4d4a-abe6-d8b3211ea41f)
[![Laravel](https://img.shields.io/badge/Laravel-Docs-orange)](https://laravel.com/docs/9.x)
[![Udemy](https://img.shields.io/badge/Udemy-Site-blueviolet)](https://www.udemy.com/course/curso-completo-do-desenvolvedor-laravel)
[![Gitmoji](https://img.shields.io/badge/Commits-Gitmoji-yellow)](https://gitmoji.dev)

## Referência

- [Curso completo de Desenvolvimento Web Avançado](https://www.udemy.com/course/curso-completo-do-desenvolvedor-laravel)
- [Editor Markdown](https://readme.so)


## Stack utilizada

**Front-end:** Laravel Ui, Blade, Bootstrap

**Back-end:** Laravel Octane(Swoole), PHP, WSL2(Ubuntu)

**Banco de Dados:** Redis, PostgreSQL


## Rodando localmente

Clone o projeto

```bash
  git clone https://github.com/Mourishitz/task-helper.git
```

Entre no diretório do projeto

```bash
  cd task-helper
```

Instale as dependências

```bash
  npm install &&
  composer install 
```

Inicie o servidor (recomendado utilizar as configurações abaixo)

```bash
   php artisan octane:start --server=swoole --host=0.0.0.0 --max-requests=3000 --workers=4 --task-workers=12 --port=8089
```

Inicie o servidor (alternativo)

```bash
   php artisan serve
```

