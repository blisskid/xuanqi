<?php
/**
 * WordPress基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL设置、数据库表名前缀、密钥、
 * WordPress语言设定以及ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑wp-config.php}Codex页面。MySQL设置具体信息请咨询您的空间提供商。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后填入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/data/home/qyu1616550001/htdocs/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'qdm155063659_db');

/** MySQL数据库用户名 */
define('DB_USER', 'qdm155063659');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'Caringyou2015');

/** MySQL主机 */
define('DB_HOST', 'qdm155063659.my3w.com:3306');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 't+,K,m?V&5cDmcRb6xfrH%K@O;b29R*T$kJ6w!!u/3|>%<pORBP|a bF/k.Ex&kU');
define('SECURE_AUTH_KEY', '+9$s5GL(Y(%UI$.lQFCA$iF(&TN8SMPM{h}?:O,pJ+fu7W3)wIHWFh:A[C=+( kz');
define('LOGGED_IN_KEY', 'Y*l^1`W3zOux_HH4vUMa1eh]J(TwWxO8[HPyMFTr)|d`|Osf@ `Y,<Uzi<(hsRN$');
define('NONCE_KEY', 'w]_B+KXw#{B,6[w731{*12y|b5L@f@0QTTz2x$%nQ@KCR:-J&NZ+wAvvA3-%#Wv}');
define('AUTH_SALT', '+{!,W;cy35V9iY_!K-SAvI1n:GOQyjq3+.hV,x;*;wX{IDcx/K[|jRwQT@-A-;YY');
define('SECURE_AUTH_SALT', 'p+ZsNg}0feXL#dw5-voB1rIePyavWO=O4P#.*0vn6#C!* }OrO;nNekf7+B25~ K');
define('LOGGED_IN_SALT', 'e!j6w0iE|(SroU1:N({GC/zwdQnzFIS}RCaJ2CtKuRI:+)7yW?9*wniyB} ;.8MY');
define('NONCE_SALT', 'H*IO>rIrd+zn^fm uq6gxNQY>4saAFrb1-Ro3FGwEZ;3^zazIc.RZ_R[VQN75nBh');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** 设置WordPress变量和包含文件。 */
require_once ABSPATH . 'wp-settings.php';
