<?php
/*
    Use the static method getInstance to get the object.
*/

class Session
{
    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;
    const MLS_SESSION = "mls_session";
    const USER_ROLE	  = "user_role";
    const USER_LOGIN  = "user_login";
    const USER_LOGOUT = "user_logout";
    const TOMYT_LIVE 	= "tomyt_live";//For indicate if redirects to My Training
    // The state of the session
    private $sessionState = self::SESSION_NOT_STARTED;
   
    // THE only instance of the class
    private static $instance;    
    private $userRole   = null;
    private $userLogin	= null;
   
    private function __construct() {    	
    }
   
   
    /**
    *    Returns THE instance of 'Session'.
    *    The session is automatically initialized if it wasn't.
    *   
    *    @return    object
    **/
   
    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }
       
        self::$instance->startSession();
       
        return self::$instance;
    }
   
   
    /**
    *    (Re)starts the session.
    *   
    *    @return    bool    TRUE if the session has been initialized, else FALSE.
    **/
   
    public function startSession()
    {
        if ( $this->sessionState == self::SESSION_NOT_STARTED )
        {
            $this->sessionState = session_start();
        }
       
        return $this->sessionState;
    }
   
   
    /**
    *    Stores datas in the session.
    *    Example: $instance->foo = 'bar';
    *   
    *    @param    name    Name of the datas.
    *    @param    value    Your datas.
    *    @return    void
    **/
   
    public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }
   
   
    /**
    *    Gets datas from the session.
    *    Example: echo $instance->foo;
    *   
    *    @param    name    Name of the datas to get.
    *    @return    mixed    Datas stored in session.
    **/
   
    public function __get( $name )
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }
   
   
    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }
   
   
    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }
   
   
    /**
    *    Destroys the current session.
    *   
    *    @return    bool    TRUE is session has been deleted, else FALSE.
    **/
   
    public function destroy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );
           
            return !$this->sessionState;
        }
       
        return FALSE;
    }
    
    public function getMlsSession(){
    	if ( isset($_SESSION[self::MLS_SESSION]))
        {
            return $_SESSION[self::MLS_SESSION];
        }else{
        	header('Location: security/loginRequired');
        }		
	}
	
	public function setLogoutURL($url) {
		$_SESSION[self::USER_LOGOUT] = $url;
	}
	public function getLogoutURL() {
		if ( isset($_SESSION[self::USER_LOGOUT]))
        {
            return $_SESSION[self::USER_LOGOUT];
        }
		else{	
        	return "/";
        }		
	}
	public function getUserRole(){
		if ( isset($_SESSION[self::USER_ROLE]))
        {
            return $_SESSION[self::USER_ROLE];
        }
		else{	
        	header('Location: security/loginRequired');
        }
	}

	public function setUserRole($userRole){
		$_SESSION[self::USER_ROLE] = $userRole;
	}

	public function getUserLogin(){
		if ( isset($_SESSION[self::USER_LOGIN]))
        {
            return $_SESSION[self::USER_LOGIN];
        }else{	
        	return null;
        }
	}

	public function setUserLogin($userLogin){
		$_SESSION[self::USER_LOGIN] = $userLogin;
	}
	
	public function getRedirectToMyTraining(){
		if ( isset($_SESSION[self::TOMYT_LIVE]))
        {
            return $_SESSION[self::TOMYT_LIVE];
        }else{	
        	return true;
        }
	}

	public function setRedirectToMyTraining($isRedirect){
		$_SESSION[self::TOMYT_LIVE] = $isRedirect;
	}
}
?>