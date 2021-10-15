
## Docker projetos ##
---
** Organização de pastas **

```
/admin
/core
/site
/docker
    -- /docker-files
    -- /storage-db
    -- .gitignore
    -- docker-compose-homolog.yml <-- rodar somente em homologação
    -- docker-compose.yml <-- rodar somente em desenvolvimento

```
### Iniciando o docker ###
 - Acessar a pasta docker
 - Ajustar as variaveis de ambiente através do arquivo .env 
 - Iniciar os containers docker

```
docker-compose up -d
```

### Acesso API ###
Para acessar a URL do webservice, utilize ws.<nome do projeto>.localhost

### Atenção ###
Será gerada uma pasta storage-db não versionada na pasta docker.

Caso a pasta seja excluída, os dados do banco de dados serão perdidos.

Crie uma cópia caso necessite resetar seu projeto local.

Não modificar as informações do arquivo docker-compose.yml, utilize sempre o arquivo .env

### Ajustando configurações dos containers ###
Mantenha as configurações de containers ajustadas na pasta docker-files conforme necessário.

### Obervação ###
Para os containers Angular, será necessário aguardar alguns minutos até que o servidor seja iniciado após start do container.