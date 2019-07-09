# GDG Workshops Tech - Desenvolvimento de Sites com WordPress

Este site foi desenvolvido durante o workshop "Desenvolvimento de sites com Wordpress - do 0 ao avançado", ministrado por [Flávio Escobar](http://flavioescobar.com.br/).
[Clique aqui](https://www.meetup.com/GDG-Lauro-de-Freitas/events/262705266/) para acessar o site do evento.

Você encontrará os slides da apresentação na pasta `slides` deste repositório.

## Requisitos

1. Apache, PHP e MySQL instalados na máquina. Por motivos de praticidade, recomendo a utilização do [XAMPP](https://www.apachefriends.org/index.html).

## Instalação

1. Clonar, fazer *fork* ou realizar o download dos arquivos do repositório.
2. Mover os arquivos da pasta `site` para alguma pasta dentro do seu diretório `htdocs` para que seja possível acessar o site pelo navegador web. Exemplo: `htdocs/gdg-lauro`.
3. Criar um banco de dados restaurando o arquivo `db/dump.sql`.
4. Alterar os dois primeiros registros da tabela `gdg_options` no banco de dados, mudando o valor da columna `option_value` para a URL completa do site no seu servidor local. Exemplo: se no passo nº 2 acima você moveu os arquivos da pasta `site` para a pasta `htdocs/gdg-lauro`, altere o valor de `option_value` para `http://localhost/gdg-lauro`.
5. Alterar o arquivo `wp-config.php` da seguinte forma:
	- Mudar o valor da constante `WP_CONTENT_URL` para a URL completa da pasta `wp-content`, que foi renomeada para `gdg` no workshop.
	- Mudar o valor da constante `WP_CONTENT_DIR` para o caminho completo para o diretório `wp-content`, que foi renomeado para `gdg` no workshop.
	- Alterar os valores das constantes `DB_NAME`, `DB_USER` e `DB_PASSWORD` com as configurações do seu banco de dados, caso necessário.
6. Fazer login como administrador (ver dados abaixo), navegar para **Configurações > Links Permanentes** e clicar no botão **Salvar alterações**. Isso fará com que o arquivo `.htaccess` do seu site seja atualizado e as URLs funcionem corretamente.

## Acesso ao painel de administração do WordPress

Por padrão, o banco de dados já possui o seguinte usuário com privilégio de super admin:
- Nome de usuário: `gdg`
- Senha: `gdg2019`

## Contato

Caso tenha dúvidas ou queira fazer sugestões, favor entrar em contato através do meu [site](http://flavioescobar.com.br/) ou [enviar-me um email](mailto:flavioescobar1@gmail.com).
