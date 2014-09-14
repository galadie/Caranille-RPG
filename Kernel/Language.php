<?php

//$i18n_lg = LanguageUtils::parseHttpAcceptLanguage();

function x_plainstring_to_htmlprotected($str)
{
	return htmlspecialchars(stripslashes_r($str), ENT_QUOTES);
}


class LanguageValidation
{

    
        /**
	 * Returns the debug mode (stored in session)
	 *
	 * @return boolean
	 */
	public static function isMessageEditionMode() 
	{		
		if(isset($_SESSION['Account_Data']['Message_Mode']))
		{
			return $_SESSION['Account_Data']['Message_Mode'];
		}
		else 
		{			
			return false;
		}
	}

	/**
	 * Sets the message edition mode (stored in session)
	 *
	 * @param boolean $message_edit
	 * @return boolean
	 */
	public static function setMessageEditionMode($message_edit=null)
	{		
		if(verif_access("Admin",true))
		{
			if(!is_null($message_edit))
			{
				$_SESSION['Account_Data']['Message_Mode'] = $message_edit;
			}
			elseif(isset($_SESSION['Account_Data']['Message_Mode']))
			{
				if($_SESSION['Account_Data']['Message_Mode']=== true)
				{
					$_SESSION['Account_Data']['Message_Mode'] = false ;
				}
				else
				if($_SESSION['Account_Data']['Message_Mode']=== false)
				{
					$_SESSION['Account_Data']['Message_Mode'] = true ;
				}
				
				$message_edit = $_SESSION['Account_Data']['Message_Mode'] ;
			}
			else
			{
				$_SESSION['Account_Data']['Message_Mode'] = true ;
			}
		}
		else
		{
			$_SESSION['Account_Data']['Message_Mode'] = false ;
		}
		debug_log( "mode ".($message_edit ? "activé" : "desactivé"));
		
		header('location:'.getenv('HTTP_REFERER'));
	}
        
    static function hasMsg()
	{
		global $msg;
		$args = func_get_args();
		$key = $args[0];
		return $msg[$key]?true:false;
	}
	
	/**
	 * 
	 * traduction & editeur
	 */
	static public function iMsg()
	{	
		$args = func_get_args();
		
		$key = $args[0];		
		
            	$value = self::eMsg( $key );	
		$value .= call_user_func_array(array('self','nMsg'), func_get_args());
	
		return $value;
	}
	
	/**
	 * 
	 * editeur de trad
	 */
	static function eMsg()
	{	
		$args = func_get_args();
		$key = $args[0];
		
		$value ='';
		
		if (self::isMessageEditionMode()) 
		{
			$params = array('key'=>$key);
						
			//$value .= '<a class="translate-link" href="'.get_Link('translate','edition',$params ).'" ></a>';
			
			//$value .= '<img class="translate-img" src="'.frameValidation::getImagePath('admin/edit.png').'"/>';
			//$value .= '<img class="translate-img" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAwBQTFRFAAAA////3d7i1dbVj4+O9c9K9MQx9tue8Z0M7cBxj1kCr4tcy3IK1pJPGhQQq52U8mIT4rOX0qiP2JJvsYRu/9G/zl9J3Dwh5nBZ6ZGA8IBxqXVuAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA37h3pQAAAB10Uk5T/////////////////////////////////////wBZhudqAAAAZElEQVR42oyPQQ6AIAwECaggorWCVtT/v9MQkoIejHubOXS34npFfIgYj4cAWmmvBEhFMxXhpIKTNhau7czQAN9IbBxwS2bLtU4XTgK17pmT8BpxtNXSsKC39fQpePz3XM4twADEFBfbmIX7EgAAAABJRU5ErkJggg=="/>';
			//$value .= '';
			
			$content = translateForm::getForm($key);
			
			$value = init_popIn('translate-'.$key.'-form',"tranlate {$key}",$content,'translate-link');
		}
		
		return $value ;
	}
	/**
	 * traduction
	 */
	static function nMsg()
	{		
		$args = func_get_args();
		$key = $args[0];
	
		$msg = translateForm::getMessageFileForCurrentUser()->getAllMessages();
		
		if (isset($msg[$key]))
		{
			$value = nl2br(stripslashes($msg[$key]));
			
			for ($i=1;$i<count($args);$i++)
				$value = str_replace('{'.($i).'}', $args[$i].x_plainstring_to_htmlprotected(''), $value);
				
			//$value = utf8_decode($value);
		} 
		else 
		{
			$value = "???".$key;
			
			for ($i=1;$i<count($args);$i++)
			{
				if (!is_array($args[$i]) && !is_object($args[$i]))
					$value .= ", ".x_plainstring_to_htmlprotected($args[$i]);
				 else
					$value .= ", ...";
			
			}
			$value .= "???";
		}
	
		return $value;
	}
}

//include_once(MODEL_PATH."form.class.php");

class translateForm //extends Form
{
	function __construct($key)
	{
	}
	
	static function edition()
	{
		global $_LANGUAGES, $MMORPG_Language ;
		
		//$lang = $_LANGUAGES[$MMORPG_Language];

		if(request_confirm($MMORPG_Language))
		{
			$messageFile = translateForm::getMessageFileForLanguage();
			$messageFile->setMessage(Request_post('key'), Request_post($MMORPG_Language));
			$messageFile->save();
			
			header('location:'.Request_post('referer'));
			//frameValidation::redirection(Request_post('referer'), 'element modifi?');			
		}		
	}
	
	static function getForm($key)
	{
		global $MMORPG_Language, $_LANGUAGES, $_url , $page,$secteur_module ;
		
		//$lang = $_LANGUAGES[command::getInstance()->langue];
		$referer = get_link($page,$secteur_module);
		$msg = self::getMessageFileForCurrentUser()->getMessage($key);
		return "
		<form method='post' action='' >
			<input type='hidden' name='referer' value ='".$referer."' />
			<input type='hidden' name='key' value ='".$key."' />
			Positionner les variables numériquement entre {}
			<textarea name='".$MMORPG_Language."' >".stripslashes($msg)."</textarea>
			<input type='submit' name='valid-translate' value ='&check;' />
		</form>
		";
		
		
	/**	
		//parent::__construct("edition".$key);
		
		$_referer = new HiddenInputForm('referer', 'referer' , $referer ,'referer');
		$_key = new HiddenInputForm($key, $key);
		$langue = new input($lang, $lang , $msg ,'trad.'.command::getInstance()->langue);		
		
		echo "-".$lang."[".$key."]" ;
		
		$this->addElement($_key,'key') ;
		$this->addElement($_referer,'referer') ;
		$this->addElement($langue,command::getInstance()->langue) ;
		
		
	**/	
	}
	
		/**
	 * @return MessageFile The message file for the current user.
	 */
	public static function getMessageFileForCurrentUser() {
	
		global $_path, $MMORPG_Language ;
		
		$messageFile = new MessageFile();
		$messageFile->load($_path.'message_'.$MMORPG_Language.'.php');
		return $messageFile;
	}

	/**
	 * @return MessageFile The message file for the current user.
	 */
	public static function getMessageFileForLanguage() {
		return self::getMessageFileForCurrentUser();
	}

	/**
	 * Load all messages
	 */
	public static function loadAllMessages() {
		global $_path, $MMORPG_Language ;
		
		$files = glob($_path.'message*.php');

		foreach ($files as $file) {
			$base = basename($file);
			if ($base == "message.php") 
			{
				$messageFile = new MessageFile();
				$messageFile->load($file);
				self::$messages['default'] = $messageFile;
			} else {
				$phpPos = strpos($base, '.php');
				$language = substr($base, 8, $phpPos-8);
				$messageFile = new MessageFile();
				$messageFile->load($file);
				self::$messages[$language] = $messageFile;
			}
		}
	}

	public static function getMessageForAllLanguages($key) {
		$messageArray = array();
		foreach (self::$messages as $language=>$messageFile) {
			$messageArray[$language] = $messageFile->getMessage($key);
		}
		return $messageArray;
	}

	/**
	 * Returns the list of all keys that have been defined in all language files.
	 * loadAllMessages must have been called first.
	 */
	public static function getAllKeys() {
		$all_messages = array();

		// First, let's merge all the arrays in order to get all the keys:
		foreach (self::$messages as $language=>$message) {
			$all_messages = array_merge($all_messages, $message->getAllMessages());
		}

		return array_keys($all_messages);
	}

	/**
	 * Returns the list of languages loaded.
	 */
	public static function getSupportedLanguages() {
		return array_keys(self::$messages);
	}
	
}

/**
 * The MessageFile class represents a PHP resource file that can be loaded / saved / modified.
 */
class MessageFile {

	/**
	 * The path to the file to be loaded
	 * @var string
	 */
	private $file;

	/**
	 * The array of messages in the file loaded.
	 */
	private $msg;

	/**
	 * Loads the php file
	 * @var $file The path to the file to be loaded
	 */
	public function load($file) {
		$this->file = $file;

		$msg = array();
		
		if(file_exists($file)) include($file);
		//frameValidation::_include($file);

		$this->msg = $msg;
	}

	/**
	 * Saves the file.
	 */
	public function save() {
		ksort($this->msg);

		if(!file_exists($this->file))
			$fp = fopen($this->file, "w+");
		else 
		{
			if (!is_writable($this->file))
				if(!chmod($this->file, 0777))
					return false;
					
			$fp = fopen($this->file, "w+");
					
		}
		
		fwrite($fp, "<?php\n");
		foreach ($this->msg as $key=>$message) {
			fwrite($fp, '$msg[\''.str_replace("'","\\'", $key).'\']="'.str_replace('"','\\"', $message).'";'."\n");
		}
		fwrite($fp, "?>\n");
		fclose($fp);
	}

	/**
	 * Sets the message
	 */
	public function setMessage($key, $message) {
		$this->msg[$key] = $message;
	}

	/**
	 * Returns a message for the key $key.
	 */
	public function getMessage($key) {
		if(isset($this->msg[$key]))
			return $this->msg[$key];
	}

	/**
	 * Returns all messages for this file.
	 */
	public function getAllMessages() {
		return $this->msg;
	}
}