<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ---------------------------------------------------------------------------

// Alterando o caminho do diretório wp-content
define( 'WP_CONTENT_URL', 'http://localhost/gdg-lauro/gdg-lauro-wordpress/site/app' );
define( 'WP_CONTENT_DIR', 'E:\XAMPP\htdocs\gdg-lauro\gdg-lauro-wordpress\site\app' );

// Modo debug
define('WP_DEBUG', true); // Ativando o modo debug
define('WP_DEBUG_LOG', true); // Fazendo com que as mensagens de log sejam salvas em arquivo: `true` gera o arquivo debug.log, string gera arquivo com outro nome
define('WP_DEBUG_DISPLAY', false); // Fazendo com que as mensagens de log NÃO sejam exibidas no front-end

// ---------------------------------------------------------------------------


// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'gdg_lauro_apresentacao_wp_2' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '&?sfzOP$xADsk0**kXrH=``t%sH?4L)|kHR_`$7}UCN/8^m2+<gdCWA4hwZBYEKc' );
define( 'SECURE_AUTH_KEY',  'c:)XS?XWx=upbaDRhj?ZQS+]+<T20]Un@9E#i9{sqETD1E{7zOhxne(q4;](El_I' );
define( 'LOGGED_IN_KEY',    'Ut`$~=- |]L@116SK9Q@!Gq+#/&M?A9@E]4}<DgT.4.-.!NXKnGL68&7HZ+V:M}`' );
define( 'NONCE_KEY',        'pRe?co6Pkf%M?c[eN%bFctN6}#MZ[CsY?)Sv!/pT{v+I2c]=wupL}~}C6y0 o@ik' );
define( 'AUTH_SALT',        ';o,3k%?@#8!N7FU5ae>h^]U<=I4U34X1gx$98UH1LZ540!Iz]Yy_5bBVno.(PusL' );
define( 'SECURE_AUTH_SALT', 'oU[=J(m6dk|m$[1ZhuoNW#V(yfOb@8I8Iuck}V{K?<2P)OY@+`&=q.DOZncH8}:d' );
define( 'LOGGED_IN_SALT',   'F-bCXM:4j{j[gXUz_w/0W&EB1/Mp]sR0s|UI%GqgH@!ZrQy@T_*u<L$ bfu^OUNL' );
define( 'NONCE_SALT',       '?UPm|Vu<o$<vfG=h>kmHIguNwHq%]ty=sC?3ToC_YoI.G8#0}[t};u}VaFB#kTAY' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'gdg_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
