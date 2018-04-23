# AgendaTCC
Trabalho desenvolvido durante a disciplina de Laboratório de Engenharia de Software 1.

Utilizamos a metodologia Scrum usando o Trello para gerenciar o desenvolvimento do Projeto.


<a href="https://trello.com/b/F4osH5Pu" target="_blank"> Visitar o Board no Trello</a> 

# Como executar

Atualize o repositório ou clone. Copie o .env.example para .env

```{r, engine='sh', count_lines}
git pull
cp .env.example .env
```
Crie um Banco de Dados mysql com o nome AgendaTCC. Em seguida, abra o arquivo .env
e modifique as seguintes linhas: 

DB_USERNAME=root <br>
DB_PASSWORD=root

Em DB_USERNAME troque 'root' para o nome do usuário utilizado ao criar o banco e em DB_PASSWORD modifique para a senha cadastrada para esse usuário.

Agora vamos atualizar o composer e migrar as tabelas. Caso não tenha instalado o composer, troque 'update' por 'install'

```{r, engine='sh', count_lines}
composer update
php artisan key:generate
php artisan migrate
php artisan db:seed
```

Agore inicie o servidor.
```{r, engine='sh', count_lines}
php artisan serve
```
Acesse o http://127.0.0.1:8000 para visualizar a página.

# Desfazer última migração
1. Execute migrate:rollback
```{r, engine='sh', count_lines}
php artisan migrate:rollback
```
2. Manualmente delete o arquivo de migração <br>
app/database/migrations/meu_arquivo_de_migracao.php

3. Resete os arquivos carregados automaticamente do composer
```{r, engine='sh', count_lines}
composer dump-autoload
```	
4. Remova o último registro da tabela migrations no MySQL
