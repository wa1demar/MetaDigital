<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'metamoskow');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'root');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'HZaiX$sH0LWcP+EZEQf,uM}[]^7R! Rf6LU(&$#E9-2&v &*LcRVJG9|t)tbxA8x');
define('SECURE_AUTH_KEY',  ']ln+ir7I^`T=<<Eal|TG$]IwA}1x^!0hECu(FLA%AZ:t$`CdA?TF$127T5eI,LgP');
define('LOGGED_IN_KEY',    'dH|MgirXKXN&cCYHgvdbi|ePOcqFxooGWt^}4c+E|KKApt!3^Sj|DYQlnUjqC`3-');
define('NONCE_KEY',        'z5DZ1C8:}@zg8?c,BPk^XY`$Iu-J%`T<@!tY%6 |ylD[tYi3gCk~rlM&`6)TAW$-');
define('AUTH_SALT',        '{-||3AOD{/}Q]*W;{+%yf2e)jN$2BKOK{aogH.=,}dVrE>T*V-1Xk]Gnq8s>4UBC');
define('SECURE_AUTH_SALT', '*-3JG^I5,i}-4E I@,vH1KKx,I~bPI{qro3Y-kh>IU%]*z,ht6h92pi|SgK=kX!/');
define('LOGGED_IN_SALT',   '~w&+J3+>-oM.@|:B3A^Sp+]J{lr-D-NTGqGB|0aTK{^h1-eq)oJ!Sh)M1lG2948i');
define('NONCE_SALT',       '~m$PohUJ~3cf)(l{*((}Z)35#|~BF>~ENV{>7S[-BNpX%g` G30fAtY$)|L`CR@B');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'mm_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
