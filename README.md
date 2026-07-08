# 📚 Sistema de Gerenciamento de Eventos Acadêmicos

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-Frontend-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/status-estudo-yellow?style=for-the-badge)

Sistema web desenvolvido para **gerenciamento de eventos acadêmicos**, permitindo o cadastro e organização de eventos, participantes, inscrições e demais informações relacionadas às atividades acadêmicas.

⚠️ **Nota:** O arquivo `.env` está presente neste repositório apenas por se tratar de um projeto de estudo, facilitando a avaliação. Em projetos reais, esse arquivo não deve ser enviado ao GitHub e deve ser incluído no `.gitignore`.

---

# 🎯 Objetivo

O objetivo deste projeto é facilitar o gerenciamento de eventos acadêmicos, centralizando informações de participantes, inscrições e organização dos eventos em uma única plataforma.

---

# 🚀 Tecnologias utilizadas

- Laravel (Framework PHP)
- Bootstrap (Estilização da interface)
- MySQL (Banco de dados)
- PHP

---

# 📦 Bibliotecas Utilizadas

Além do framework Laravel, o projeto utiliza as seguintes bibliotecas para funcionalidades específicas:

### 🔐 Laravel Sanctum
Responsável pela autenticação de API e emissão de tokens de acesso leves, garantindo a segurança nas requisições autenticadas dentro do sistema.

### 🌐 Laravel Socialite
Utilizado para implementar o login social via OAuth 2.0, permitindo que os usuários se autentiquem utilizando suas contas Google, conforme descrito na seção de configuração abaixo.

### 📄 barryvdh/laravel-dompdf
Biblioteca utilizada para geração de documentos em PDF diretamente pela aplicação, permitindo exportar relatórios e informações relacionadas aos eventos, participantes e inscrições.

---

# 🗂️ Estrutura de Pastas

Principais diretórios do projeto:

```text
Sistema-Gerenciamento-Eventos-Academicos/
├── Diagramas/          # Diagramas do sistema (modelagem, fluxos, etc.)
├── app/                # Models, Controllers, Providers e lógica da aplicação
├── bootstrap/          # Arquivos de inicialização do Laravel
├── config/             # Arquivos de configuração da aplicação
├── database/           # Migrations, seeders e factories
├── public/             # Ponto de entrada da aplicação (index.php) e assets públicos
├── resources/          # Views (Blade), CSS e JS
├── routes/             # Definição das rotas (web.php, api.php, etc.)
├── storage/            # Logs, cache, arquivos gerados (ex: PDFs) e uploads
├── tests/              # Testes automatizados (PHPUnit)
├── .env.example        # Exemplo de variáveis de ambiente
├── artisan              # CLI do Laravel
├── composer.json        # Dependências PHP
├── package.json          # Dependências front-end
├── phpunit.xml            # Configuração dos testes
└── vite.config.js         # Configuração do Vite (build do front-end)
```

---

# 📌 Funcionalidades

- 📅 Cadastro de eventos acadêmicos
- 👥 Cadastro de participantes
- 📝 Gerenciamento de inscrições
- 🏫 Cadastro de organizadores
- 📍 Cadastro de locais dos eventos
- 📆 Controle de datas e horários
- 📂 Organização dos eventos cadastrados
- 🔎 Consulta e gerenciamento das inscrições

---

# 🚀 Como Executar o Projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/jvsobroza/Sistema-Gerenciamento-Eventos-Academicos.git
cd Sistema-Gerenciamento-Eventos-Academicos
```

---

### 2. Instalar as dependências

```bash
composer install
```

---

### 3. Criar o arquivo de ambiente

```bash
cp .env.example .env
```

---

### 4. Configurar o banco de dados

Edite o arquivo `.env`:

```env
DB_DATABASE=nome_do_banco
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Gerar a chave da aplicação

```bash
php artisan key:generate
```

---

### 6. Executar as migrations e seeders

```bash
php artisan migrate:fresh --seed
```

---

### 7. Criar o link simbólico do storage

```bash
php artisan storage:link
```

---

### 8. Iniciar o servidor

```bash
php artisan serve
```

Acesse:

```text
http://127.0.0.1:8000
```
---

## 🌱 Sobre os Seeders

O comando `php artisan migrate:fresh --seed` executa as *migrations* (criação das tabelas) e, em seguida, os **seeders**, responsáveis por popular o banco de dados com registros iniciais — incluindo o usuário administrador padrão listado acima.

Esse usuário é criado a partir de dados fixos definidos no seeder `database/seeders/UsuarioSeeder.php`. Isso significa que, **por padrão, todos que rodarem o projeto terão o mesmo usuário e senha** (`admin@gmail.com` / `admin123`).

### 🔧 Como escolher outro usuário padrão

Caso queira utilizar um e-mail e senha diferentes, basta:

1. Abrir o arquivo `database/seeders/UsuarioSeeder.php`.
2. Alterar os valores de `email` e `senha` (e demais campos, se necessário) para os dados desejados.
3. Rodar novamente o comando de seed:

```bash
php artisan migrate:fresh --seed
```

> ⚠️ Atenção: o comando `migrate:fresh` apaga todas as tabelas e as recria do zero. Use com cuidado caso já existam dados importantes no banco.

Se preferir manter as tabelas existentes e apenas rodar os seeders novamente, utilize:

```bash
php artisan db:seed
```

---

## 🔐 Usuário Padrão

Após executar os seeders:

Email: admin@gmail.com

Senha: admin123

---

# 🔐 Configuração do Login com Google

Este projeto utiliza autenticação com contas Google através do OAuth 2.0.

## 1. Acesse o Google Cloud Console

https://console.cloud.google.com/

---

## 2. Crie um projeto

- Clique em **Selecionar projeto**.
- Clique em **Novo Projeto**.
- Escolha um nome para o projeto.
- Clique em **Criar**.

---

## 3. Ative a API

No menu lateral:

**APIs e Serviços → Biblioteca**

Pesquise por:

- Google Identity
- Google People API (caso utilizada pelo projeto)

Clique em **Ativar**.

---

## 4. Configure a Tela de Consentimento OAuth

Em:

**APIs e Serviços → Tela de consentimento OAuth**

- Escolha **Externo**
- Informe:
  - Nome da aplicação
  - E-mail de suporte
  - E-mail do desenvolvedor

Salve as alterações.

---

## 5. Criar as credenciais

Vá em:

**APIs e Serviços → Credenciais**

Clique em:

**Criar credenciais → ID do cliente OAuth**

Tipo da aplicação:

**Aplicativo Web**

---

## 6. Adicione as URIs

### Origens JavaScript autorizadas

```
http://127.0.0.1:8000
```

ou

```
http://localhost:8000
```

### URIs de redirecionamento autorizadas

```
http://127.0.0.1:8000/auth/google/callback
```

ou

```
http://localhost:8000/auth/google/callback
```

> Caso o projeto utilize outra rota de callback, substitua pelo endereço correto definido nas rotas do Laravel.

---

## 7. Copie as credenciais

Após criar o OAuth Client, o Google fornecerá:

- Client ID
- Client Secret

---

## 8. Configure o arquivo .env

Substitua pelos dados da sua aplicação:

```env
GOOGLE_CLIENT_ID=SEU_CLIENT_ID
GOOGLE_CLIENT_SECRET=SEU_CLIENT_SECRET
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

---

## 9. Configuração do APP_URL

O parâmetro `APP_URL` define a URL base da aplicação. Ele deve corresponder ao endereço utilizado para acessar o sistema.

Durante o desenvolvimento local, utilize:

```env
APP_URL=http://127.0.0.1:8000
```

ou

```env
APP_URL=http://localhost:8000
```

> **Importante:** Caso utilize uma URL diferente, altere o valor de `APP_URL` para refletir o endereço correto da aplicação.

Exemplo:

```env
APP_URL=http://meu-endereco:8000
```

Além disso, se o projeto utilizar autenticação com Google, o valor de `APP_URL` deve ser compatível com a variável `GOOGLE_REDIRECT_URI`.

Exemplo:

```env
APP_URL=http://127.0.0.1:8000

GOOGLE_CLIENT_ID=SEU_CLIENT_ID
GOOGLE_CLIENT_SECRET=SEU_CLIENT_SECRET
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

Após alterar o arquivo `.env`, execute os seguintes comandos para atualizar as configurações da aplicação:

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

Caso a aplicação seja publicada em um servidor, lembre-se de atualizar tanto o `APP_URL` quanto o `GOOGLE_REDIRECT_URI` para o domínio utilizado e registrar a mesma URI de redirecionamento nas credenciais OAuth do Google.

---

## 11. Inicie o projeto

```bash
php artisan serve
```

Agora será possível realizar login utilizando uma conta Google.

# 👨‍💻 Autores
- [**Claitom Rodrigues**](https://github.com/claitomrodrigues) - rodriguesclaitom0@gmail.com
- [**Guilherme Grass**](https://github.com/GuiGrass007)
- [**Guilherme Durande**](https://github.com/guikts) - guilhermedurande@gmail.com
- [**Henric Baccin**](https://github.com/Henric-ops) - henricbaccin@gmail.com
- [**João Victor Sobroza Dal Ross**](https://github.com/jvsobroza) - joaovictor0908.jv@gmail.com
- [**Kelvem Pozzatto Bressan**](https://github.com/Kelvem-Bressan) - pozzattokelvem@gmail.com
- [**Leonardo Bitencourt**](https://github.com/LeoTB16)
- [**Matheus Sturza**](https://github.com/MatheusSturza33)
- [**Vinicios Weide Ebling**](https://github.com/ViniciosWE) - vinicioswe2005@gmail.com
