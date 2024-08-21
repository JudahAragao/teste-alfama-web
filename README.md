# Aplicação para avaliação ALFAMAWEB

## Utilizado na aplicação

- SO Ubuntu v22.04.3 LTS no WSL
- PHP v8.1.X
- Apache v2.4.52
- MySQL v8.0.39
- Javascript ES2023
- HTML 5
- CSS 3

## Configuração Básica

Coloque a pasta do projeto em /var/www/html/ e siga a etapa 4 da configuração opcional 

## Configurações opcional

```bash
    sudo nano /etc/apache2/sites-available/meu_projeto.conf
```

1. Adicione a configuração para o seu projeto:

```
<VirtualHost *:80>
    ServerAdmin webmaster@meu_projeto.local
    DocumentRoot /var/www/html/meu_projeto
    ServerName meu_projeto.local
    ErrorLog ${APACHE_LOG_DIR}/meu_projeto_error.log
    CustomLog ${APACHE_LOG_DIR}/meu_projeto_access.log combined

    <Directory /var/www/html/meu_projeto>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

2. Caso esteja usando WSL abra o bloco de notas no SO Windows como administrador e abra o arquivo sem extenção chamado "host" no endereço C:\Windows\System32\drivers\etc e adicione o conteudo abaixo no final do arquivo:

```
## Local - Start - Meu Projeto ##
127.0.0.1       meu_projeto.local
## Local - End - Meu Projeto ##
```

3. Caso esteja utilizando o SO Ubuntu instalado na máquina, inserir código acima em:

```bash
    sudo nano /etc/hosts
```

4. E por fim, adicionar as permições para o apache acessar a pasta do projeto:

```bash
sudo chown -R $(whoami):$(whoami) /var/www/html/meu_projeto
sudo chmod -R 755 /var/www/html/meu_projeto
sudo find /var/www/html/meu_projeto -type f -exec chmod 644 {} \; # permissão para manipulação de arquivos
sudo find /var/www/html/meu_projeto -type d -exec chmod 755 {} \; # permissão para manipulação de diretórios
```

