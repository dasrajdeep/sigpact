<?php

class Session {
    
    /**
     * Contains information regarding whether a session is authorized or not.
     * 
     * @var boolean
     */
    private static $authorized=false;
    
    /**
     * Contains information regarding whether a session is running or not.
     * 
     * @var boolean
     */
    private static $running=false;
    
    /**
     * Contains the session timeout in seconds.
     * 
     * @var int
     */
    private static $timeout=1800;
    
    /**
     * Contains the session control keys.
     * 
     * @var string[]
     */
    private static $control_keys=array('session_user','session_vars','expire_time');
	
	/**
	 * Initializes the session manager.
	 */
    public static function init() {
        if(isset($_SESSION['session_user'])) {
            if(self::timedOut()) {
                self::stop();
                return;
            }
            self::$running=TRUE;
        } else $_SESSION=array();
    }
    
    /**
     * Tells whether a session is running or not.
     * 
     * @return boolean
     */
    public static function isRunning() {
        return self::$running;
    }
    
    /**
     * Starts a session.
     * 
     * @param string $id
     */
    public static function start($id) {
        $_SESSION['session_user']=$id;
        $_SESSION['session_vars']=array();
        self::setTimeout(self::$timeout);
        self::$running=TRUE;
    }
    
    /**
     * Stops a running session.
     */
    public static function stop() {
        $_SESSION=array();
        session_destroy();
        self::$running=FALSE;
    }
    
    /**
     * Fetches the user ID associated with a session.
     * 
     * @return string
     */
    public static function getUserID() {
        if(isset($_SESSION['session_user'])) return $_SESSION['session_user'];
		else return null;
    }
    
    /**
     * Sets a variable for the current running session.
     * 
     * @param string $key
     * @param string $value
     * @return boolean
     */
    public static function setVar($key,$value) {
		if(!self::$running) return false;
		$_SESSION['session_vars'][$key]=$value;
		return true;
    }
    
    /**
     * Fetches a variable associated with the running session.
     * 
     * @param string $key
     * @return string|null
     */
    public static function getVar($key) {
		if(!self::$running) return null;
        if(isset($_SESSION['session_vars'][$key])) return $_SESSION['session_vars'][$key];
		else return null;
    }
    
    /**
     * Fetches the session ID for the current session.
     * 
     * @return string
     */
    public static function getSessionID() {
        return session_id();
    }
    
    /**
     * Sets the timeout for the session.
     * 
     * @param int $minutes
     * @return boolean
     */
    public static function setTimeout($minutes) {
        if($minutes<5) return FALSE;
        $seconds=$minutes*60;
        $_SESSION['expire_time']=time()+$seconds;
        return TRUE;
    }
    
    /**
     * Tells whether the session has timed out or not.
     * 
     * @return boolean
     */
    public static function timedOut() {
        $expiry=$_SESSION['expire_time'];
        if(time()>$expiry) return TRUE;
        return FALSE;
    }
    
    /**
     * Sets the current session as authorized or unauthorized.
     * 
     * @param boolean $auth
     */
    public static function setAuthorized($auth) {
        self::$authorized=$auth;
    }
    
    /**
     * Tells whether the current session is authorized or not.
     * 
     * @return boolean
     */
    public static function isAuthorized() {
        return self::$authorized;
    }
}

?>
