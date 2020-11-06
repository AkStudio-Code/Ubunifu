<?php
$config = [
    'run' => '',
    'default_app'=>strtoupper('wbca'),
    'controller' => 'App',
    'action'=>'index',
    'app_dir' =>  realpath(dirname(__FILE__) . '/../../../') . '/apps/',
    'log_file_path' => realpath(dirname(__FILE__) . '/../../') . '/logs/runtime/',
    'error_reporting' => 'E_ALL | E_NOTICE ',
    'display_errors' => 2,
    'environment' => 'development | test | production',
    'base_url' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('Ubunifu/application', '', dirname($_SERVER['SCRIPT_NAME'])),
    'pretty_url' => true,
    'session_duration' => 60 * 60 * 2,
    'auto_start_session'=> true,
    'requires_auth' => true,
    'timezone' =>'Africa/Nairobi',
    'home_url' => strtoupper('wbca/'),
    /**
     * Configuration for: Cookies
     * 1209600 seconds = 2 weeks
     * COOKIE_PATH is the path the cookie is valid on, usually "/" to make it valid on the whole domain.
     * @see http://stackoverflow.com/q/9618217/1114320
     * @see php.net/manual/en/function.setcookie.php
     *
     * COOKIE_DOMAIN: The domain where the cookie is valid for. Usually this does not work with "localhost",
     * ".localhost", "127.0.0.1", or ".127.0.0.1". If so, leave it as empty string, false or null.
     * When using real domains make sure you have a dot (!) in front of the domain, like ".mydomain.com". This is
     * strange, but explained here:
     * @see http://stackoverflow.com/questions/2285010/php-setcookie-domain
     * @see http://stackoverflow.com/questions/1134290/cookies-on-localhost-with-explicit-domain
     * @see http://php.net/manual/en/function.setcookie.php#73107
     *
     * COOKIE_SECURE: If the cookie will be transferred through secured connection(SSL). It's highly recommended to set it to true if you have secured connection.
     * COOKIE_HTTP: If set to true, Cookies that can't be accessed by JS - Highly recommended!
     * SESSION_RUNTIME: How long should a session cookie be valid by seconds, 604800 = 1 week.
     */
    'session_prefix'=> 'wbca',
    'COOKIE_RUNTIME' => 1209600,
    'COOKIE_PATH' => '/',
    'COOKIE_DOMAIN' => "",
    'COOKIE_SECURE' => false,
    'COOKIE_HTTP' => true,
    'SESSION_RUNTIME' => 604800,
    /**
     * Configuration for: Encryption Keys
     * ENCRYPTION_KEY, HMAC_SALT: Currently used to encrypt and decrypt publicly visible values, like the user id in
     * the cookie. Change these values for increased security, but don't touch if you have no idea what this means.
     */
    'ENCRYPTION_KEY' => '6#x0gÊìf^25cL1f$08&',
    'HMAC_SALT' => '8qk9c^4L6d#15tM8z7n0%',
    /**
     * Configuration for: Email server credentials
     *
     * Here you can define how you want to send emails.
     * If you have successfully set up a mail server on your linux server and you know
     * what you do, then you can skip this section. Otherwise please set EMAIL_USE_SMTP to true
     * and fill in your SMTP provider account data.
     *
     * EMAIL_USED_MAILER: Check Mail class for alternatives
     * EMAIL_USE_SMTP: Use SMTP or not
     * EMAIL_SMTP_AUTH: leave this true unless your SMTP service does not need authentication
     */
    'EMAIL_USED_MAILER' => 'phpmailer',
    'EMAIL_USE_SMTP' => false,
    'EMAIL_SMTP_HOST' => 'yourhost',
    'EMAIL_SMTP_AUTH' => true,
    'EMAIL_SMTP_USERNAME' => 'yourusername',
    'EMAIL_SMTP_PASSWORD' => 'yourpassword',
    'EMAIL_SMTP_PORT' => 465,
    'EMAIL_SMTP_ENCRYPTION' => 'ssl',

];