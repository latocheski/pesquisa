- **Instalar dependências:**

>`composer install --optimize-autoloader --no-dev`



Criar o banco de dados local com o nome que desejar, sugestão `spot` com a codificação **`utf8mb4_unicode_ci`**



- **Renomear o arquivo `.env.example` para `.env`**

*O windows não permite que você faça isso, então você tem que abrir o seu console e rodar o comando:

 >`mv .env.example .env`*


- **Gere a key do projeto**

>`php artisan key:generate`



- **Abra o arquivo `.env` dentro da pasta raiz do projeto e preencha as informaçõs do seu banco de dados**

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```


- **Faça a migração para o banco de dados**

>`php artisan migrate`


- **Adicione as tipicidades por meio das seeds**

>`php artisan db:seed`


- **Coloque a aplicação em modo de produção**

```
APP_ENV=production
APP_DEBUG=false
```

- **Inicie o servidor**

>`php artisan serve`


**Done** :trophy:
