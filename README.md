# Pulcherrima

Sistema de cadastro e login em PHP + MySQL, feito originalmente como
atividade em dupla da disciplina Programação Web2 e revisado depois para
corrigir problemas de segurança e servir como peça de portfólio.

## Como rodar localmente

Pré-requisitos: PHP 8+ e MySQL/MariaDB.

1. Crie o banco de dados executando o script `schema.sql`:
   ```
   mysql -u root -p < schema.sql
   ```
2. Se as credenciais do seu banco local forem diferentes de
   `root`/senha em branco, crie um arquivo `config.local.php` (ele é
   ignorado pelo git) copiando o formato de `config.php` com os seus
   dados.
3. Suba o site com o servidor embutido do PHP:
   ```
   php -S localhost:8000
   ```
4. Acesse `http://localhost:8000` no navegador.

## Estrutura

- `index.php` — página inicial, com links para login e cadastro.
- `cadastro.php` — formulário e processamento de cadastro de novos usuários.
- `login.php` — formulário e processamento de login.
- `dashboard.php` — página protegida, só acessível após login.
- `logout.php` — encerra a sessão.
- `servicos.html` — página de serviços (em construção).
- `db.php` / `config.php` — conexão com o banco e configuração.
- `schema.sql` — estrutura das tabelas do banco.
- `style.css` — estilos compartilhados por todas as páginas.

## Correções de segurança feitas na revisão

A versão original tinha vários problemas comuns de projetos de
aprendizado, corrigidos aqui:

- **SQL injection**: a query de cadastro concatenava os campos do
  formulário direto na string SQL. Agora todo acesso ao banco usa PDO
  com *prepared statements*.
- **Senhas em texto/MD5**: senhas eram salvas com MD5 (ou em arquivos
  soltos). Agora usam `password_hash`/`password_verify`.
- **"Banco de dados" como arquivo nomeado com o usuário**: uma versão
  antiga salvava a senha em um arquivo cujo nome era o login digitado
  pelo usuário (`fopen($user, ...)`), o que permite leitura/escrita de
  arquivos arbitrários no servidor. Substituído por uma tabela real no
  MySQL.
  ("path traversal"/directory traversal)
- **Credenciais e e-mail reais no código**: senha de banco e endereço de
  e-mail pessoal estavam hardcoded nos arquivos PHP. Agora ficam em
  `config.php` (com valores de exemplo) e podem ser sobrescritos por um
  `config.local.php` não versionado.
- **Saída sem escape**: mensagens e valores de formulário reexibidos na
  página agora passam por `htmlspecialchars` antes de serem impressos.
- **Arquivos duplicados e inconsistentes**: existiam três versões
  concorrentes de login e de cadastro, cada uma com um comportamento
  diferente (e alguns com variáveis que não batiam com os campos do
  formulário). Foram consolidados em um único fluxo de cadastro/login.
- **Arquivos sem extensão** (`Serviços`, `email`, etc.), que impediam o
  servidor de interpretá-los como HTML/PHP corretamente, foram renomeados.

## Créditos

Projeto original desenvolvido em dupla para a disciplina Programação
Web2.
