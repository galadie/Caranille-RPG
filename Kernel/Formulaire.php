<?php
	function textarea_input($label,$name,$value=null,$class=null,$id=null,$placeholder=null)
	{
		//required
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);
		$input .= "<textarea name='$name'" ;		
		$input .= (is_null($placeholder) ? "" : " placeholder='".LanguageValidation::nMsg($placeholder)."'");
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
		$input .= ">";
		$input .= (is_null($value) ? "" : $value);
		$input .= "</textarea>";
		$input .= (is_null($placeholder) ? "" : LanguageValidation::eMsg($placeholder) );
		$input .= "</div>";
		
		return $input ;
	}
	
	function call_wysiwyg($name="content",$content="")
    {
    	global $kernel_path ;
    	
    	ob_start();
    	
    	require($kernel_path.'/wysiwyg.php');
    	
    	$out = ob_get_contents();
    	
    	ob_end_clean();
    
    	return $out ;
    }
    
    function call_bbcode_editor($name="content",$content="", $page="normal")
    {
    	global $kernel_path ;
    	
    	ob_start();
    	
    	require($kernel_path.'/bbcode.php');
    	
    	$out = ob_get_contents();
    	
    	ob_end_clean();
    
    	return $out ;
    }
	
	function select_input($label,$name,$option,$selected=null,$class=null,$id=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);
		$input .="<select name='$name'";
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
		$input .= (is_null($placeholder) ? "" : " placeholder='$placeholder'");
		$input .= ">";
		$input .= "<option value=''>Selectionner</option>";
		foreach($option as $key => $value)
			$input .= "<option value='$key'>$value</option>";
		$input .= "</select>";
		$input .= "</div>";
		
		return $input ;
	}

	function checkbox_multi_input($name,$option,$selected=null,$class=null,$id=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);

		foreach($option as $key => $value)
		{
			$input .= "<input type='checkbox' name='".$name."[]' value='$key'";
			
			$input .= (is_null($class) ? "" : " class='$class'");
			$input .= (is_null($id) ? "" : " id='$id'");
		
			$input .= "/>";
			$input .= (is_null($value) ? "" : LanguageValidation::iMsg($value) );
		}
		$input .= "</div>";
		
		return $input ;
	}
	
	function checkbox_input($name,$value,$selected=null,$class=null,$id=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= "<input type='checkbox' name='".$name."' ";
			
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
		
		$input .= "/>";
		$input .= (is_null($value) ? "" : LanguageValidation::iMsg($value) );
		
		$input .= label_input($name,$label,$class,$id);
		$input .= "</div>";
		
		return $input ;
	}
	
	function radio_input($label,$name,$option,$selected=null,$class=null,$id=null,$placeholder=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);

		foreach($option as $key => $value)
		{
			$input .= "<input type='radio' name='".$name."' value='$key'";
			
			$input .= (is_null($placeholder) ? "" : " placeholder='$placeholder'");
			$input .= (is_null($class) ? "" : " class='$class'");
			$input .= (is_null($id) ? "" : " id='$id'");
			
			$input .= "/>";
			$input .= (is_null($value) ? "" : LanguageValidation::iMsg($value) );
		}
		$input .= "</div>";
		
		return $input ;
	}
	
	function text_input($label,$name,$value=null,$class=null,$id=null,$placeholder=null,$length=null,$readonly=false)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);
		$input .= "<input type='text' name='$name'" ;
		$input .= (is_null($value) ? "" : " value='$value'");
		
		$input .= ($readonly===true ? "readonly='readonly'" : "");

		$input .= (is_null($placeholder) ? "" : " placeholder='".LanguageValidation::nMsg($placeholder)."'");
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
		$input .= (is_null($length) ? "" : " length='$length'");
		
		$input .= "/>";
		
		$input .= (is_null($placeholder) ? "" : LanguageValidation::eMsg($placeholder) );
		$input .= "</div>";
		
		return $input;
	}
	
	function password_input($label,$name,$value=null,$class=null,$id=null,$placeholder=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);
		$input .= "<input type='password' name='$name'" ;
		$input .= (is_null($value) ? "" : " value='$value'");
		
		$input .= (is_null($placeholder) ? "" : " placeholder='".LanguageValidation::nMsg($placeholder)."'");
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
				
		$input .= "/>";
		$input .= (is_null($placeholder) ? "" : LanguageValidation::eMsg($placeholder) );
		$input .= "</div>";
		
		return $input ;
	}
	
	function phone_input($label,$name,$value=null,$class=null,$id=null,$placeholder=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);
		$input .= "<input type='tel' name='$name'" ;
		$input .= (is_null($value) ? "" : " value='$value'");
		
		$input .= (is_null($placeholder) ? "" : " placeholder='".LanguageValidation::nMsg($placeholder)."'");
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
		
		$input .= "pattern='^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$'/>";
		$input .= (is_null($placeholder) ? "" : LanguageValidation::eMsg($placeholder) );
		$input .= "</div>";
		
		return $input ;
	}
	
	function num_input($label,$name,$value=null,$class=null,$id=null,$placeholder=null,$min=null,$max=null,$step=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);
		$input .= "<input type='number' name='$name'" ;
		$input .= (is_null($value) ? "" : " value='$value'");
		
		$input .= (is_null($placeholder) ? "" : " placeholder='".LanguageValidation::nMsg($placeholder)."'");
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
		
		$input .= (is_null($min) ? "" : " min='$min'");
		$input .= (is_null($max) ? "" : " max='$max'");
		$input .= (is_null($step) ? "" : " step='$step'");
		
		$input .= "/>";
		$input .= (is_null($placeholder) ? "" : LanguageValidation::eMsg($placeholder) );
		$input .= "</div>";
		
		return $input ;
	}
	
	function date_input($label,$name,$value=null,$class=null,$id=null,$placeholder=null,$min=null,$max=null,$html=false)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);
		$input .= "<input type='".($html?'date':'datetime')."' name='$name'" ;
		$input .= (is_null($value) ? "" : " value='$value'");
		
		$input .= (is_null($placeholder) ? "" : " placeholder='".LanguageValidation::nMsg($placeholder)."'");
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
		
		$input .= (is_null($min) ? "" : " min='$min'");
		$input .= (is_null($max) ? "" : " max='$max'");
		
		$input .= "/>";
		$input .= (is_null($placeholder) ? "" : LanguageValidation::eMsg($placeholder) );
		$input .= "</div>";
		
		return $input ;
	}
	
	function url_input($label,$name,$value=null,$class=null,$id=null,$placeholder=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);
		$input .= "<input type='url' name='$name'" ;
		$input .= (is_null($value) ? "" : " value='$value'");
		
		$input .= (is_null($placeholder) ? "" : " placeholder='".LanguageValidation::nMsg($placeholder)."'");
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
		
		$input .= "/>";
		$input .= (is_null($placeholder) ? "" : LanguageValidation::eMsg($placeholder) );
		$input .= "</div>";
		
		return $input ;
	}
	
	function email_input($label,$name,$value=null,$class=null,$id=null,$placeholder=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";

		$input .= label_input($name,$label,$class,$id);
		$input .= "<input type='email' name='$name'" ;
		$input .= (is_null($value) ? "" : " value='$value'");
		
		$input .= (is_null($placeholder) ? "" : " placeholder='".LanguageValidation::nMsg($placeholder)."'");
		$input .= (is_null($id) ? "" : " id='$id'");
		
		$input .= "/>";
		$input .= (is_null($placeholder) ? "" : LanguageValidation::eMsg($placeholder) );
		$input .= "</div>";
		
		return $input ;
	}
	
	function submit_input($name,$value=null,$class=null,$id=null,$placeholder=null)
	{
		$input = "<div class='line-input";
		$input .= (is_null($class) ? "" : " ".$class);
		$input .= "' >";
		
		$input .= "<input type='submit' name='$name'" ;
		$input .= (is_null($value) ? "" : " value='".LanguageValidation::nMsg($value)."'");
		
		$input .= (is_null($placeholder) ? "" : " placeholder='$placeholder'");
		$input .= (is_null($id) ? "" : " id='$id'");
		
		$input .= "/>";
		$input .= (is_null($value) ? "" : LanguageValidation::eMsg($value) );
		$input .= "</div>";
		
		return $input ;
	}
	
	function hidden_input($name,$value=null)
	{
		$input = "<input type='hidden' name='$name'" ;
		$input .= (is_null($value) ? "" : " value='$value'");		
		$input .= "/>";
		
		return $input ;
	}

	function label_input($name,$value=null,$class=null,$id=null)
	{
		$input = "<label for='$name'" ;
		$input .= (is_null($class) ? "" : " class='$class'");
		$input .= (is_null($id) ? "" : " id='$id'");
		$input .= ">";
		$input .= (is_null($value) ? "" : LanguageValidation::iMsg($value));
		$input .= "</label>";
		
		return $input ;
	}
	
	function formulaire_input($inputs=array(),$token,$action=null,$method="post",$enctype="multipart/form-data")
	{
		$form = "<form";
		$form .= (is_null($action) ? "" : " action='$action'");
		$form .= (is_null($method) ? "" : " method='$method'");
		$form .= (is_null($enctype) ? "" : " enctype='$enctype'");
		$form .= " autocomplete='on' >";
		$form .= is_null($token) ? "" : hidden_input("token",generer_token($token));
		foreach($inputs as $x => $input) 
		{
			$form .= $input ;
		}
		$form .= "</form>";
		
		return $form ;
	}