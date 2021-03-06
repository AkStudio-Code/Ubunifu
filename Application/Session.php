<?php


namespace Triposhub\Ubunifu\Application;


class Session
{

    /**
     * Prefix for sessions.
     *
     * @var string
     */
    private static $prefix = '';

    /**
     * Determine if session has started.
     *
     * @var bool
     */
    private static $sessionStarted = false;

    /**
     * Set prefix for sessions.
     *
     * @param mixed $prefix → prefix for sessions
     *
     * @return bool
     */
    public static function setPrefix($prefix)
    {
        return is_string(self::$prefix = $prefix);
    }

    /**
     * Get prefix for sessions.
     *
     * @since 1.1.6
     *
     * @return string
     */
    public static function getPrefix()
    {
        return self::$prefix;
    }

    /**
     * If session has not started, start sessions.
     *
     * @param int $lifeTime → lifetime of session in seconds
     *
     * @return bool
     */
    public static function init($lifeTime = 0)
    {
        if (self::$sessionStarted == false) {
            session_set_cookie_params($lifeTime);
            session_start();

            return self::$sessionStarted = true;
        }

        return false;
    }

    /**
     * Add value to a session.
     *
     * @param string $key   → name the data to save
     * @param mixed  $value → the data to save
     *
     * @return bool true
     */
    public static function set($key, $value = false)
    {
        self::$prefix = \AppConfig::load('session_prefix','app');
        if (is_array($key) && $value == false) {
            foreach ($key as $name => $value) {
                $_SESSION[$name] = $value;
            }
        } else {
            $_SESSION[$key] = $value;
        }

        return true;
    }

    /**
     * Extract session item, delete session item and finally return the item.
     *
     * @param string $key → item to extract
     *
     * @return mixed|null → return item or null when key does not exists
     */
    public static function pull($key)
    {
        if (isset($_SESSION[self::$prefix . $key])) {
            $value = $_SESSION[self::$prefix . $key];
            unset($_SESSION[self::$prefix . $key]);

            return $value;
        }

        return null;
    }

    /**
     * Get item from session.
     *
     * @param string      $key       → item to look for in session
     * @param string|bool $secondkey → if used then use as a second key
     *
     * @return mixed|null → key value, or null if key doesn't exists
     */
    public static function get($key = '', $secondkey = false)
    {
        $name = $key;

        if (empty($key)) {
            return isset($_SESSION) ? $_SESSION : null;
        } elseif ($secondkey == true) {
            if (isset($_SESSION[$name][$secondkey])) {
                return $_SESSION[$name][$secondkey];
            }
        }

        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    /**
     * Get session id.
     *
     * @return string → the session id or empty
     */
    public static function id()
    {
        return session_id();
    }

    /**
     * Regenerate session_id.
     *
     * @return string → session_id
     */
    public static function regenerate()
    {
        session_regenerate_id(true);

        return session_id();
    }

    /**
     * Empties and destroys the session.
     *
     * @param string $key    → session name to destroy
     * @param bool   $prefix → if true clear all sessions for current prefix
     *
     * @return bool
     */
    public static function destroy($key = '', $prefix = false)
    {
        if (self::$sessionStarted == true) {
            if ($key == '' && $prefix == false) {
                session_unset();
                session_destroy();
            } elseif ($prefix == true) {
                foreach ($_SESSION as $index => $value) {
                    if (strpos($index, self::$prefix) === 0) {
                        unset($_SESSION[$index]);
                    }
                }
            } else {
                unset($_SESSION[self::$prefix . $key]);
            }

            return true;
        }

        return false;
    }


    public static function userIsLoggedIn(){
        return (Session::get('user_is_logged_in')? true: false);
    }


    public static function updateSessionId($user_id, $session_id){
        Tri_Model::App()->Db()->QBuilder()-> table('users') ->where('user_id' ,'=', $user_id)->update(
            ['session_id' => $session_id]
        );

    }

    public static function isConcurrentSessionExist(){
        $session_id = session_id();

        $user_id = self::get('user_id');
        if(isset($user_id) && isset($session_id)){
            $database = Tri_Model::App()->Db()->QBuilder();
            $session_id_db =$database ->table('users') ->select('session_id') ->where('user_id','=',$user_id)
                ->setFetchMode(PDO::FETCH_ASSOC)->get();
            $session_id_db = !empty($session_id_db[0]['session_id'])? $session_id_db[0]['session_id']: null;
            if($session_id_db == $session_id){
                return true;
            }else{
                return true;
            }
        }

    }
}
