<?php
$version = "ezgenerator centraladmin 3.6";
/*
  centraladmin.php
  ezgenerator centraladmin
  http://www.ezgenerator.com
  Copyright (c) 2004-2008 Image-line
*/
error_reporting(E_ALL);
if(file_exists('../documents/htmlMimeMail.php')) { $pref='../'; $general_db_dir='../ezg_data';}
else											{ $pref=''; $general_db_dir='ezg_data';}
include($pref.'documents/htmlMimeMail.php'); 
$ca_lang_set_fname=$pref.'ezg_data/ca_lang_set.txt';
$admin_username="admin";  
$admin_pwd="21232f297a57a5a743894a0e4a801fc3";  
$db_dir='../documents/';
$db_file='centraladmin.ezg.php';
$delay_fname='centraladmin_sec.ezg.php';
$counter_db_fname='counter_db.ezg.php'; // COUNTER
$settings_db_fname=$db_dir.'centraladmin_conf.ezg.php'; // settings file --> counter, self-reg and other settings
$activity_log=$general_db_dir.'/centraladmin_reglog.ezg.php'; // self-registration log file
$ca_sitemap_fname='../sitemap.php';
$sp_pages_ids=array('20','21','133','136','137','138','143','144'); 
$max_l_chars=25000;
$access_type=array('0'=>'read','1'=>'read&write');
$access_type_ex=array('0'=>'read','1'=>'read&write','2'=>'access on page level');
$set_login_cookie=false; 
if(!isset($thispage_id)) {$thispage_id=(isset($_GET['pageid'])? $_GET['pageid']: '');}

$template_fname='documents/template_source.html';
if(!file_exists('../'.$template_fname) && !file_exists($template_fname)) {  $template_fname='documents/home.html'; }
$template_in_root=false; 
$pref_dir='../documents/';  
if(strpos($template_fname,'.html')!==false && strpos($template_fname,'http://')===false)	
{
	$template_fname_f='../'.$template_fname;
	if(strpos($template_fname,'/')===false) {$template_in_root=true; $pref_dir='documents/';}
}	
else																				
{
	$template_fname_f=define_template_page(); 
	if(strpos($template_fname_f,'/')===false) {$template_fname_f='../'.$template_fname_f; $template_in_root=true; $pref_dir='documents/';}
}
$ca_lang_l = array('site map'=>'site map','manage users'=>'manage users','add user'=>'add user','counter settings'=>'counter settings','logout'=>'logout','CENTRAL ADMIN'=>'CENTRAL ADMIN','page name'=>'page name','admin link'=>'admin link' ,'protected'=>'protected','ca controlled'=>'CA controlled','pageloads'=>'pageloads','edit'=>'edit','admin'=>'admin','na'=>'NA','tell a friend admin'=>'tell a friend admin','total pageloads'=>'total pageloads','unique visitors'=>'unique visitors','first time visitors'=>'first time visitors','returning visitors'=>'returning visitors','details'=>'details','detailed stat'=>'detailed statistics','prev'=>'prev','next'=>'next','first'=>'first','last'=>'last','date'=>'date','time'=>'time','browser'=>'browser','os'=>'os','resolution'=>'resolution','host'=>'host','ip'=>'ip','of'=>'of','referrer'=>'referrer','user'=>'user','none users'=>'none users defined','check range'=>'check range','section'=>'section','protected pages'=>'protected pages','non-protected pages'=>'non-protected pages controlled by Central Admin','back'=>'back','username'=>'username','name'=>'first name','surname'=>'last name','email'=>'email','password'=>'password','code'=>'code','edit access'=>'edit access','edit details'=>'edit details','edit password'=>'edit password','access to'=>'access to protected sections','fill in'=>'fill in','username exists'=>'such username already exists','can contain only'=>'username can contain only A-Z, a-z, _ and 0-9','repeat password'=>'repeat password','old password'=>'old password','new password'=>'new password','password and repeated password'=>'password and repeated password don\'t match','your password should be'=>'your password should be at least five symbols','select access'=>'select access section','nonvalid email'=>'use valid email address','incorrect username/password'=>'incorrect username/password','remove'=>'remove','remove MSG'=>'Are you sure you want to remove this user?','all'=>'all','selected'=>'selected','read'=>'read','read&write'=>'read&write','required fields'=>'required fields','background color'=>'background color','digit color'=>'digit color','select color'=>'select color','font size'=>'font size','small font'=>'small font','medium font'=>'medium font','bold font'=>'bold font','large font'=>'large font','stylish font'=>'stylish font','refresh'=>'refresh','display'=>'display','number of digits'=>'number of digits','maximum visit length'=>'maximum visit length','unique start offset'=>'unique start offset','pageloads start offset'=>'pageloads start offset','show unique visitors'=>'show unique visitors','show pageloads'=>'show pageloads','reset counter'=>'reset counter','submit'=>'submit','settings saved'=>'settings were saved successfully','reset done'=>'counter was reset succcessfully','confirm counter reset'=>'confirm counter reset','reset MSG1'=>'Reset Counter only in case you need to start counting from zero. <br>Note that resetting counter will permanently remove all counter statistics!<br>If you want to proceed, press the link below to confirm resetting.','reset MSG2'=>'Are you sure you want to reset counter? Note that this will remove all statistics data.','ca login'=>'Protected area login','login'=>'login','use correct username'=>'please, use correct username and password to login','adduser_msg1'=>"If you want to grant user access to certain protected pages only (not to ALL), you can add login page (section) in EZGenerator and associate this section with certain protected pages, using Login property in Page Settings panel.", 'adduser_msg2'=>'allows users to browse protected pages.','adduser_msg3'=>'allows users to browse protected pages and also access special pages admin screen (for example, Blog admin screen or Online Editable page edit screen).','field should match the text on the right'=>'field should match the text on the right','code'=>'code','agree with terms'=>'you should agree with Terms of Use in order to proceed','registration'=>'registration','log'=>'log file','settings'=>'settings','non-confirmed users'=>'non-confirmed users','clear log'=>'clear log','log file cleared'=>'log file cleared','clear log MSG'=>'Are you sure you want to clear this log file?','non-existing'=>'this is non-existing username','no email for user'=>'the email doesn\'t match this username','password changed'=>'password was changed successfully','wrong old'=>'OLD password is wrong','sr_agree_msg'=>'I agree with the %%Terms of Use%%.','sr_success_msg'=>'Your registration was successful. To complete it, check your email and follow the instructions.','sr_confirm_msg'=>'Your registration was successfully completed.' ,'sr_email_msg'=>'Dear %%username%%, ####thank you for registering at %%site%%. ##To complete your registration, please confirm it here: %CONFIRMLINK%.####The %%site%% Team','sr_email_subject'=>'Your registration at %%site%%','sr_forgotpass_note'=>'Enter your username and the email address associated with your account, and your login information will be sent to that email address.','sr_forgotpass_msg'=>'Dear %%username%%, ####this email comes as an answer to your request for new password to access %%site%%. ##Your new password is: %%newpassword%%.####The %%site%% Team','sr_forgotpass_subject'=>'New password for %%site%%','sr_forgotpass_msg2'=>'Check your email to find the new password.','sr_notif_subject'=>'New user has just registered at %%site%%','sr_already_confirmed'=>'You have already confirmed your registration!','admin email'=>'admin email','sendmail from'=>'sendmail from','return path'=>'return path','terms url'=>'Terms of Use page url','notes'=>'notes','confreg_msg1'=>'you can set here either absolute url (starting with http://), or relative url (following the example: ../documents/page.html)','confreg_msg2'=>'Type here the site administrator email address. Self-registration notifications will be delivered at this address.','confreg_msg3'=>'This option is used only in case your host provider has set trusted (registered) users to be used as "From" email address. Type here the administrator email address (or other) that will be used as "From" email address.','confreg_msg4'=>'This option is to be used only in case your host provider has not set Sendfrom_email configuration option in php.ini. Type here the administrator email address (or other).','confreg_msg5'=>'Type here some notes that you want to put at the bottom of your registration form.','forgotten password'=>'forgotten password','change password'=>'change password','forgot q'=>'Forgot your password?','member q'=>'Not a member yet? REGISTER','set language'=>'set Central Admin screen language','language'=>'language','confirmation email'=>'confirmation email','resend'=>'re-send','resend MSG'=>'Are you sure you want to resend confirmation email to','user removed'=>'user was removed successfully','email resent'=>'confirmation email was sent to user','date'=>'date','activity'=>'activity','result'=>'result','confirm'=>'confirm','creation date'=>'creation date');
$ca_available_lang_sets=array('DA'=>'Danish','NL'=>'Dutch','EN'=>'English','FR'=>'French','DE'=>'German','IS'=>'Icelandic','NO'=>'Norwegian','PT'=>'Portuguese','ES'=>'Spanish','SV'=>'Swedish'); 
$ca_page_charset=''; 
if(isset($_COOKIE['ca_lang'])) $ca_lang_set=strtoupper($_COOKIE['ca_lang']); 
elseif(isset($_GET['lang'])) $ca_lang_set=strtoupper($_GET['lang']); 
else $ca_lang_set='EN'; 
$l=($ca_lang_set=='EN'?'':'lang='.$ca_lang_set);
if(file_exists($ca_lang_set_fname)&&(filesize($ca_lang_set_fname)>0))
{
		$fp=fopen($ca_lang_set_fname,'r');
		$read_f=false;
		while ($data=fgetcsv($fp,$max_l_chars,'|')) 
		{	
			if(isset($data[0]) && !empty($data[0]))
			{			
				if($data[0]=='[END]' && $read_f) break;
				elseif($read_f)	{$label=explode('=',$data[0]); $ca_lang_l["{$label[0]}"]=$label[1];}	
				if($data[0]=='['.strtoupper($ca_lang_set).']') $read_f=true;
			}
		}
		fclose($fp);						
}
$sr_enable=false;
$sr_notif_enabled=true; 
$ca_mail_type="mail";
$ca_SMTP_HOST='%SMTP_HOST%';
$ca_SMTP_PORT='%SMTP_PORT%';
$ca_SMTP_HELLO='%SMTP_HELLO%';
$ca_SMTP_AUTH='%SMTP_AUTH%';
if($ca_SMTP_AUTH=='FALSE'||$ca_SMTP_AUTH=='false') $ca_SMTP_AUTH=FALSE;
if($ca_SMTP_AUTH=='TRUE'||$ca_SMTP_AUTH=='true') $ca_SMTP_AUTH=TRUE;
$ca_SMTP_AUTH_USR='%SMTP_AUTH_USR%';
$ca_SMTP_AUTH_PWD='%SMTP_AUTH_PWD%';
if (isset($_SERVER['SERVER_SOFTWARE'])) 
{
	if(strpos($_SERVER['SERVER_SOFTWARE'],'Microsoft')!==false) $use_linef=true;
	elseif(strpos($_SERVER['SERVER_SOFTWARE'],'Win')!==false) $use_linef=true;
	else $use_linef=false;
}
else {$use_linef=false;}
$ca_lf=($use_linef? "\r\n": "\n");
$ca_first_line="<?php echo 'hi'; exit; /*"; 
$ca_last_line="*/ ?>";
$ca_account_msg='<div align="center"><br><span class="rvts9">Username & Password are not set for your Central Admin account.</span> <br><span class="rvts8">Please, go to</span> <span class="rvts9">EZGenerator, menu Extra, Project Settings, Central Admin</span> <span class="rvts8">tab and set</span> <span class="rvts9">Username & Password</span>.</div>';
$ca_user_msg='ADMIN & ADMIN is not secure combination and thus not allowed. Please, type new one!';
function int_start_session_ca()
{
	if(''!='') session_save_path('');
	session_start();
}
function GFS($src,$start,$stop) 
{
  if($start=='') $res=$src;
  elseif(strpos($src,$start)===false) {$res=''; return $res;}
  else $res=substr($src,strpos($src,$start) + strlen($start));
  if(($stop != '')&&(strpos($res,$stop)!==false)) $res=substr($res,0,strpos($res,$stop));
  return $res;
}
function GFSAbi($src,$start,$stop)
{
  $res2=GFS($src,$start,$stop);
  return $start.$res2.$stop;
}
function ch_email($email)
{
	return preg_match("/^[A-Za-z_0-9\.\-]+@(?:[A-Za-z_0-9\-]+\.)+[A-Za-z_0-9]{1,6}$/",$email);
}
function un_esc($s) 
{
	return  htmlspecialchars(str_replace(array('\\\\','\\\'','%%%'),array('\\','\'','"'),$s),ENT_QUOTES);
}
function esc($s)
{
	$buff=(get_magic_quotes_gpc()?str_replace('\"','%%%',$s):str_replace(array('\\','\'','"'),array('\\\\','\\\'','%%%'),$s));
	return $buff;
}
function get_page_info($page_id) // gets info for protected page
{
	global $ca_sitemap_fname,$max_l_chars,$thispage_id;
	$page=array();
	if(file_exists($ca_sitemap_fname)) {$ca_sitemap_fname_fixed=$ca_sitemap_fname;}
	else {$ca_sitemap_fname_fixed=str_replace('../','',$ca_sitemap_fname);}

	if(file_exists($ca_sitemap_fname_fixed)&&(filesize($ca_sitemap_fname_fixed)>0)) 
	{
			$fp=fopen($ca_sitemap_fname_fixed,'r');
			while ($data=fgetcsv($fp,$max_l_chars,'|')) 
			{
				$data_str=implode('|',$data);
				if(strpos($data_str,'<id>'.$page_id.'|')!==false) {$page=$data;break;}
			}
			if(empty($page)) 
			{      
				if($thispage_id==$page_id) 
				{
					if(isset($_POST['loginid']))
					{             	
						rewind($fp);	
    					while($data=fgetcsv($fp,$max_l_chars,'|')) 
		      				{if(isset($data[10]) && isset($data[6]) && $data[6]=='TRUE' && $data[7]==$_POST['loginid']) {$page=$data;break;}}
						if(empty($page))
						{
							rewind($fp);	
    						while($data=fgetcsv($fp,$max_l_chars,'|')) 
		      				{if(isset($data[10]) && isset($data[6]) && $data[6]=='TRUE' && $data[4]=='136') {$page=$data;break;}}
						}
					}
					//if(empty($page) isset($_POST['loginid']))
					//{echo "ERROR: you are trying to log in a protected area, but there are no pages protected with the current Login //page.";fclose($fp);exit;} 		   
				}		   
				else {echo "ERROR: the <b>Protected page</b> you are trying to access uses <b>Login</b> page that does not exist anymore! Please, go to protected page <b>Page Settings</b> panel and set existing page as <b>Login</b> page, or contact the site administrator.";fclose($fp);exit;}			   
			}        			
			fclose($fp);						
   }
   return $page;
}
function get_pages_list($type_id='') 
{
	global $sp_pages_ids,$ca_sitemap_fname,$max_l_chars;
	$pages=array();
	if(file_exists($ca_sitemap_fname)&&(filesize($ca_sitemap_fname)>0)) 
	{
			$fp=fopen($ca_sitemap_fname,'r');
			while ($data=fgetcsv($fp,$max_l_chars,'|')) 
			{
				$data_str=implode('|',$data);
				$buffer=array();
				if(strpos($data_str,'*/ ?>')===false && strpos($data_str,'<?php')===false) 
				{
					$p_name=strpos($data[0],'#')!==false && strpos($data[0],'#')==0? str_replace('#','',$data[0]): $data[0];
					if(strpos($data_str,'<id>')!==false) 
					{
						$buffer['name']= trim($p_name);
						$buffer['id']= trim($data[4]);
						$buffer['url']= $data[1];
						$buffer['protected']= $data[6];
						$buffer['section']=$data[7];
						$buffer['subpage']=$data[3];
						$buffer['frames']=$data[15];
						$buffer['subpage_url']=$data[18];
						$buffer['pageid']= str_replace('<id>','',$data[10]);
						if(in_array($data[4],$sp_pages_ids)) 
						{
							if($data[4]=='133') 
							{
								$buffer['adminurl']='../subscribe/subscribe_'.str_replace('<id>','',$data[10]).'.php?action=subscribers';		
							}
							elseif($data[4]=='143'&&strpos($data[1],'?flag=podcast')!==false) {$buffer['adminurl']=$data[1].'&action=index';}		
							elseif($data[4]=='21') 
							{
								if(strpos($data[1],'/')===false)	$data[1]='../'.$data[1];
								if(strpos($data[1],'action=list')!==false) $buffer ['adminurl']=str_replace('action=list','action=orders',$data[1]);
								else $buffer['adminurl']=$data[1].'?action=orders';
							}
							elseif($data[4]=='20')
							{
								if(strpos($data[1],'/')===false) $data[1]='../'.$data[1];
								if($data[7]!='' && $data[7]!='-1' || $data[6]=='TRUE') $new_action='action=doedit'; 
								else													$new_action='action=login'; 
								
								if(strpos($data[1],'action=show')!==false) $buffer['adminurl']=str_replace('action=show',$new_action,$data[1]);
								else $buffer['adminurl']=$data[1].'?'.$new_action;
							}
							else {$buffer ['adminurl']=$data[1].'?action=index';}
						}
					}
					else {$buffer=array('name' => trim($p_name));  }
					if($type_id=='' || isset($buffer['id']) && $buffer['id']==$type_id) { $pages[]=$buffer; }
				}
			}
			fclose($fp);   
   }
   return $pages;
}
function get_prot_pages_list($section_id='')
{
	global $ca_sitemap_fname,$max_l_chars;
	$pages=array();
	if(file_exists($ca_sitemap_fname)&&(filesize($ca_sitemap_fname)>0)) 
	{
			$fp=fopen($ca_sitemap_fname,'r');
			while($data=fgetcsv($fp,$max_l_chars,'|')) 
			{
				$data_str=implode('|',$data);
				if(strpos($data_str,'<id>')!==false) 
				{
					$p_name=strpos($data[0],'#')!==false && strpos($data[0],'#')==0? str_replace('#','',trim($data[0])): trim($data[0]);
					$ca_control = ($data[7]!='' && $data[7]!='-1' || $data[6]=='TRUE');
					if($ca_control && ($section_id=='' || $data[7]==$section_id)) 
					{	
						$temp=array('name'=>$p_name,'url'=>$data[1],'typeid'=>$data[4],'section'=>$data[7],'protected'=>$data[6],'id'=>str_replace('<id>','',$data[10]));
						$pages[]=$temp;
					}
				}
			}
			fclose($fp);
   }
   return $pages;
}
function get_sections_list() 
{
	global $ca_sitemap_fname,$max_l_chars;
		$sections=array();
	if(file_exists($ca_sitemap_fname)&&(filesize($ca_sitemap_fname)>0))
	{	
			$fp=fopen($ca_sitemap_fname,'r');
			while($data=fgetcsv($fp,$max_l_chars,'|'))
			{
				$data_str=implode('|',$data);
				if(strpos($data_str,'<id>')!==false) {if($data[4]=='22') {$sections []= $data;}}
			}
			fclose($fp);
	}
	return $sections;
}
function get_section_name($section_id) 
{
	global $ca_sitemap_fname,$max_l_chars;
	$sections_name='';
	if(file_exists($ca_sitemap_fname)&&(filesize($ca_sitemap_fname)>0)) 
	{
			$fp=fopen($ca_sitemap_fname,'r');
			while($data=fgetcsv($fp,$max_l_chars,'|'))
			{
				$data_str=implode('|',$data);
				if(strpos($data_str,'<id>')!==false)
					{if($data[4]=='22' && strpos($data_str,'<id>'.$section_id.'|')!==false) {$sections_name=$data[8];}}
			}
			fclose($fp);
	}
	return $sections_name;
}
function duplicated_user($user) 
{
	global $admin_username;
		$existing_users_arr=array();
		$existing_users=db_get_users();
		$selfreg_users=db_get_users('selfreg_users');
	
	if($admin_username==$user) return true;
	if(strpos($existing_users,'username="'.$user.'"')!==false) return true;
	elseif(strpos($selfreg_users,'username="'.$user.'"')!==false) return true;
	else return false; 	
}
function error() 
{	
	global $ca_lang_l;

	if(isset($_GET['ref_url']) && $_GET['ref_url']!='') {$contents=build_login_form('',urldecode($_GET['ref_url']));} //event manager
	else { $contents=build_login_form(); }

	if(strpos($contents,'<!--[error_message]')!==false)
	{
	    $pattern = GFS($contents,'[error_message]','[/error_message]');
		if($pattern!='')
		{
			if(isset($_GET['extcall'])) { $pattern="<div class='rvps1'><h5><br>".$pattern."</h5></div>"; }
			else 
			{
    			$contents=str_replace('<!--[error_message]',"<div class='rvps1'><h5><br>",$contents);
				$contents=str_replace(GFSAbi($contents,'[/error_message]','-->'),"</h5></div>",$contents);
			}
		}
		else 
		{
			$pattern = '<div class="rvps1"><h5><br>'.$ca_lang_l['use correct username'].'</h5></div>';
			$contents=str_replace(GFSAbi($contents,'<!--[error_message]','-->'),$pattern,$contents);
		}
	}
	else {$contents=str_replace('<!--page-->','<!--page-->'.'Error occured. '.$ca_lang_l['use correct username'],$contents);}
	if(isset($_GET['extcall'])) {$contents=GT($pattern);}
	echo $contents;
	exit;
}
function checkauth($user,$pawd,$non_pass_flag=false) 
{
	global $thispage_id;
		$auth=false; 
		$section_flag=false;
		$write_flag=false;
		$no_access=false;
	$user_account=db_get_specific_user($user);
	$prot_page_info=get_page_info($thispage_id);
	if(isset($prot_page_info[1])) $prot_page_name=$prot_page_info[1]; //path

	if(!empty($user_account) && isset($prot_page_info[1]))
	{
		$pass=$user_account['password'];
		if($user_account['access'][0]['section']!='ALL')
		{
			foreach($user_account['access'] as $k=>$v)
			{
				if($prot_page_info[7]==$v['section'])
				{
					$section_flag=true;
					if($v['type']=='1')	{$write_flag=true;}
					elseif($v['type']=='2' && isset($v['page_access'])) //
					{
						foreach($v['page_access'] as $key=>$val)
						{
							if($thispage_id==$val['page'] && $val['type']=='1') {$write_flag=true; break;}
							elseif($thispage_id==$val['page'] && $val['type']=='2') {$no_access=true; break;}
						}
					} //
					break;
				}
			}				
		}
		else 
		{
			$section_flag=true; 
			if($user_account['access'][0]['type']=='1')	{$write_flag=true;} 
		}
		if($user_account['username']==$user && ($pass==crypt($pawd,$pass) || $non_pass_flag) && $section_flag===true)   
		{
			if(!isset($_GET['indexflag']) && $no_access==false) {$auth=true;}
			elseif($write_flag==true) {$auth=true;}
		}
    }
    return $auth;
}
function users_import() 
{
	global $db_file,$db_dir;
	$result=false;
	$flag=false;
	$sections=array();		
	$sections_info=get_sections_list();
	foreach($sections_info as $k=>$v)    {$sections []=$v[1];   }  //sections path list
	foreach($sections as $k=>$v) 
	{
		if(!empty($v)) 
		{
			$newdb_file=str_replace('.html','',$v).'users.ezg.php';
			$olddb_file=str_replace('.html','',$v).'users.php';
			if(file_exists($db_dir.$db_file) && filesize($db_dir.$db_file)==0) 
			{
				if(file_exists($newdb_file) && filesize($newdb_file)>0 || file_exists($olddb_file) && filesize($olddb_file)>0)
				{
					$flag=true;
					break;
				}
			}
		}
	}
	if($flag == true) 
	{	
		$existing_users_arr=array();
		$existing_users=db_get_users();
		if($existing_users!='') {$existing_users_arr=format_users_on_read($existing_users);}
		foreach($sections as $k=>$v) 
		{
			$new_users='';
			$newdb_file=str_replace('.html','',$v).'users.ezg.php';
			$olddb_file=str_replace('.html','',$v).'users.php';
			if(file_exists($newdb_file) && filesize($newdb_file)>0) {$import_from_file=$newdb_file;}
			elseif(file_exists($olddb_file) && filesize($olddb_file)>0) {$import_from_file=$olddb_file;}
				
			$fp=fopen($import_from_file,'r');
			$fsize=filesize($import_from_file);
			$buffer=fread($fp,$fsize);
			fclose($fp);

			$users=GFS($buffer,'<users>','</users>');				
			$users_arr=explode('|',$users);		
			foreach($users_arr as $k=>$v) 
			{
				if(!empty($v)) 
				{
					$t=explode(':',$v);
					if(!empty($existing_users_arr)) 
					{
						foreach($existing_users_arr as $k=>$v)
						{
							if(!in_array($t[0],$v)) 
							{db_write_user('add',$t[0],$t[1],'<access id="1" section="ALL" type="0"></access>','<details email="" name="" sirname="" date=""></details>');}
						}
					}
					else {db_write_user('add',$t[0],$t[1],'<access id="1" section="ALL" type="0"></access>','<details email="" name="" sirname="" date=""></details>');}
				}
			}			
		}		
		$result=true;
	}
	return $result;
}
function define_template_page()
{
	global $ca_sitemap_fname,$max_l_chars,$sp_pages_ids;
		$fname_buffer='';
	if(file_exists($ca_sitemap_fname)&&(filesize($ca_sitemap_fname)>0))
	{
			$fp=fopen($ca_sitemap_fname,'r');
			while($data=fgetcsv($fp,$max_l_chars,'|'))
			{
				if(isset($data[1]) && strpos($data[1],'.html')!==false && strpos($data[1],'http://')===false && isset($data[10]) )
				{
					$fname_buffer=$data[1];
					break;
				}
			}
			if($fname_buffer=='')  
			{
				fseek($fp,0);
				while($data=fgetcsv($fp,$max_l_chars,'|'))
				{
					if(isset($data[1]) && strpos($data[1],'.php')!==false && strpos($data[1],'http://')===false && isset($data[10]) )
					{
						if(in_array($data[4], $sp_pages_ids))
						{
							$id=str_replace('<id>','',$data[10]);
							if(strpos($data[1],'../')!==false) $fname_buffer=substr($data[1], 0, strrpos($data[1],'/')+1).$id.'.html';
							else							$fname_buffer=$id.'.html';	
							break;
						}
					}
				}
			}
			fclose($fp);					
	}
	return $fname_buffer;
}
//--------------- HTML functions
function GT($html_output,$include_counter_flag=false) 
{
	global $template_fname_f,$ca_sitemap_fname,$max_l_chars,$template_in_root,$ca_lang_l;		
		$contents='';
		$fname_buffer='';
		$title_tag='';
	$fname_buffer=$template_fname_f;
	$fp=fopen($fname_buffer,"r");
	$contents=fread($fp,filesize($fname_buffer));
	fclose($fp);

	if(strpos($template_fname_f,'template_source.html')!==false && strpos($contents,'%CONTENT%')!==false) {$pattern='%CONTENT%';}
	elseif(strpos($contents,'<!--page-->')!==false) {$pattern=GFS($contents,'<!--page-->','<!--/page-->');}
	elseif(strpos($contents,'<BODY')!==false) 
	{
		$pattern=GFSAbi($contents,'<BODY','</BODY>');
		$body_part=substr($pattern,0,strpos($pattern,'>')+1);
		$html_output=$body_part.$html_output.'</BODY>';
	}
	else
	{
		$pattern=GFSAbi($contents,'<body','</body>');
		$body_part=substr($pattern,0,strpos($pattern,'>')+1);
		$html_output=$body_part.$html_output.'</body>';
	}
	$title_tag=GFSAbi($contents,'<title>','</title>');
	$contents=str_replace($title_tag,'<title>'.$ca_lang_l['CENTRAL ADMIN'].'</title>',$contents);
	if($template_in_root) {$contents=str_replace('</title>','</title> <base href="http://'.$_SERVER['HTTP_HOST'].str_replace('documents','',dirname($_SERVER['PHP_SELF'])).'">',$contents);}
	$contents=str_replace('<!--scripts-->', '<!--scripts--><script src="'.($template_in_root?'documents/':'').'201a.js" type="text/javascript"></script>',$contents);
	$contents=str_replace($pattern,$html_output,$contents);
	if($include_counter_flag==false) {$contents=str_replace(GFS($contents,'<!--counter-->','<!--/counter-->'),'',$contents);}
	return $contents;
}
function build_select_ca($name,&$data,$selected,$style="") 
{
	$r='';
	if(is_array($data) && !empty($data)) 
	{
		$r="<select class='input1' ".$style." id='$name' name='$name'>\n";
		foreach($data as $k=>$v) 
		{
			$r.="<option  value='$k'";
			if($k==$selected) {	$r.=" selected='selected'";	}
			$r.=">$v</option>\n";
		}
		$r.= "</select>";
	}
	return $r;
}
function build_login_form($ms='',$ref_url='') 
{
	global $thispage_id,$ca_lang_l,$sp_pages_ids,$sr_enable,$l;
	$contents='';
	$pattern='';
	$prot_page_info=get_page_info($thispage_id);
	$prot_page_name=$prot_page_info[1];
	if(strpos($prot_page_info[1],'../')===false) {$dir='documents/';}
	else {$dir='../documents/';}

	if(!empty($prot_page_info[7])) // login page if defined
	{
		$login_page_info=get_page_info($prot_page_info[7]);
		if(in_array($prot_page_info[4],array('21','130','140'))) 
			{$login_page_name=$login_page_info[1];}
		elseif(!in_array($prot_page_info[4],$sp_pages_ids) && (strpos($prot_page_info[1],'../')===false)) 	
			{$login_page_name=str_replace('../','',$login_page_info[1]);}
		elseif(in_array($prot_page_info[4],array('133','136','137','138','143','144','20')) &&($prot_page_info[6]=='TRUE')&&(strpos($prot_page_info[1],'../')===false)) 
			{$login_page_name=str_replace('../','',$login_page_info[1]);}
		else {$login_page_name=$login_page_info[1];}		
		
		$fp=fopen($login_page_name,"r");
		$contents=fread($fp,filesize($login_page_name));
		if(strpos($prot_page_info[1],'../')===false) {$contents=str_replace('../','',$contents);}
		fclose($fp);

		if($ref_url!='') //event manager
		{
			$contents=str_replace(GFSAbi($contents,'[/error_message]','-->'),'[/error_message]--><br><div align="center"><span class="rvts9">'.$ms.'</span></div>',$contents);
			$contents=str_replace(GFSAbi($contents,'centraladmin.php?pageid=','"'), 
				'centraladmin.php?pageid='.$thispage_id.($ref_url!=''?'&amp;ref_url='.urlencode($ref_url):'').'"', $contents);
		}			
	}
	else // default login
	{
		$contents='<!--page--><!--[error_message]'.$ca_lang_l['use correct username'].'[/error_message]-->'
		.'<form name="login" method="post" action="'.$dir.'centraladmin.php?pageid='.$thispage_id.'&amp;'.$l; 
		$contents .= ($ref_url!=''?'&amp;ref_url='.urlencode($ref_url):'').'">'; //event manager
		$contents .= "<br><table align='center'>"
		."<tr><td></td><td><span class='rvts9'>".$ca_lang_l['ca login']."</span><br>&nbsp;</td></tr>"
		."<tr><td><span class='rvts8'>".$ca_lang_l['username']."</span></td>"
		."<td><input class='input1' type='text' name='pv_username' style='width:180px'></td></tr><tr><td>"
		."<span class='rvts8'>".$ca_lang_l['password']."</span></td><td>"
		."<input class='input1' type='password' name='pv_password' style='width:180px'></td></tr><tr><td></td><td>"
		."<input class='input1' type='submit' name='REQUEST_SEND' value='".$ca_lang_l['login']."'></td></tr>";
		if($sr_enable)
		{
			$contents .='<tr><td></td><td><p> <br><a class="rvts12" href="'.$dir.'centraladmin.php?process=forgotpass&'.$l.'">' 
			.$ca_lang_l['forgot q'].'</a></p><p class="rvps1"><span class="rvts8">&nbsp;</span></p><p><a class="rvts12" href="' .$dir.'centraladmin.php?process=register&'.$l.'">'.$ca_lang_l['member q'].'</a></p></td></tr>';
		}
		$contents .= "</table></form><!--/page-->";
	}

	if(!isset($_GET['pageid']) || isset($_GET['indexflag']) || in_array($prot_page_info[4],array('21','130','140')) || $ref_url!='') 
	{
		$pattern=GFS($contents,'method="post" action="','">');     // login form action fixation  
		if($pattern=='') {$pattern=GFS($contents,'method=post action=','>');  }  
			
		if(isset($_GET['indexflag'])) {$r_with = $dir."centraladmin.php?pageid=".$thispage_id."&indexflag=index&".$l;}
		elseif(isset($_GET['pageid']) && (in_array($prot_page_info[4],array('21','130','140')) || $ref_url!='') )  
		{
			$r_with = $dir."centraladmin.php?pageid=".$thispage_id."&".$l.($ref_url!=''?'&amp;ref_url='.urlencode($ref_url):'');
		}
		else { $r_with = $prot_page_name; }
		$contents=str_replace($pattern,$r_with,$contents);
		
		if(in_array($prot_page_info[4],array('136','137','138','143','144','20')))    // Special PHP pages
		{			
			if($prot_page_info[4]=='20')
			{
				if(strpos($prot_page_info[1],'../')!==false) $f_dir='../'.GFS($prot_page_info[1],'../','/').'/';
				elseif($prot_page_info[6]!=='TRUE') $f_dir='../';
				else $f_dir='';
				$f_dir=str_replace('//','/',$f_dir);
			}
			else
			{
				if($prot_page_info[4]=='136')	$pat = '../ezg_calendar';
				elseif($prot_page_info[4]=='137')	$pat = '../blog';
				elseif($prot_page_info[4]=='138') $pat = '../photoblog';
				elseif($prot_page_info[4]=='143')	$pat = '../podcast';
				elseif($prot_page_info[4]=='144') $pat = '../guestbook';

				if(strpos($prot_page_info[1],$pat.'/')!==false) $f_dir='../documents/';
				elseif(strpos($prot_page_info[1],'../')!==false) $f_dir='../'.GFS($prot_page_info[1],'../','/').'/';
				elseif($prot_page_info[6]!=='TRUE') $f_dir='../';
				else $f_dir='';
				$f_dir=str_replace('//','/',$f_dir);
			}					
			if($prot_page_info[15]=='0' && $prot_page_info[3]=='1') {$prot_page_name_fixed = $f_dir.'SUB_';} //FRAMES and SUBPAGE 
			else													{$prot_page_name_fixed = $f_dir; }
			$prot_page_name_fixed .= $thispage_id.($prot_page_info[6]=='TRUE'?'.php':'.html');
		}			
		elseif(in_array($prot_page_info[4],array('21','130','140')))               // shop and lister pages
		{
			$f_dir='../'.GFS($prot_page_info[1],'../','/').'/';
			if($prot_page_info[15]=='0' && $prot_page_info[3]=='1') {$prot_page_name_fixed = $f_dir.'SUB_'; }
			else													{$prot_page_name_fixed = $f_dir; }
			$prot_page_name_fixed .= $thispage_id.'.html';
		}
		elseif($prot_page_info[4]=='133') 
		{ 
			if(strpos($prot_page_info[1], '../')!==false) $prot_page_name_fixed=$prot_page_name;
			elseif($prot_page_info[6]!=='TRUE')		$prot_page_name_fixed='../'.$prot_page_name;
			else $prot_page_name_fixed=$prot_page_name;
			$prot_page_name_fixed=str_replace('//','/',$prot_page_name_fixed);
		}
		else {$prot_page_name_fixed=$prot_page_name;}
			
		if(file_exists($prot_page_name_fixed))	{$fp=fopen($prot_page_name_fixed,"r");$protpage_content=fread($fp,filesize($prot_page_name_fixed));fclose($fp);}
		else $protpage_content='<html><head><link type="text/css" href="../documents/textstyles_nf.css" rel="stylesheet"></head><BODY>missing</BODY></html>';
			
		if(strpos($contents,'<!--page-->')!==false) {$replace_with=GFS($contents,'<!--page-->','<!--/page-->');}
		elseif(strpos($contents,'<BODY')!==false) 
		{	
			$str_body='<BODY'.GFS($contents,'<BODY','>').'>';
			if(strpos($contents,'</BODY>')!==false) $end_body='</BODY>';
			else									$end_body='</body>';
			$replace_with=GFS($contents,$str_body,$end_body);
		}
		elseif(strpos($contents,'<body')!==false) 
		{	
			$str_body='<body'.GFS($contents,'<body','>').'>';
			if(strpos($contents,'</BODY>')!==false) $end_body='</BODY>';
			else									$end_body='</body>';
			$replace_with=GFS($contents,$str_body,$end_body);
		}

		$login_page_scripts=GFS($contents,'<!--scripts-->','<!--endscripts-->');				
		if(strpos($protpage_content,'<!--page-->')!==false) {$for_replace=GFS($protpage_content,'<!--page-->','<!--/page-->');}
		elseif(strpos($protpage_content,'<BODY')!==false) 
		{	
			$str_body='<BODY'.GFS($protpage_content,'<BODY','>').'>';
			if(strpos($protpage_content,'</BODY>')!==false) $end_body='</BODY>';
			else											$end_body='</body>';
			$for_replace=GFS($protpage_content,$str_body,$end_body);
		}
		elseif(strpos($protpage_content,'<body')!==false) 
		{	
			$str_body='<body'.GFS($protpage_content,'<body','>').'>';
			if(strpos($protpage_content,'</BODY>')!==false) $end_body='</BODY>';
			else											$end_body='</body>';
			$for_replace=GFS($protpage_content,$str_body,$end_body);
		} 
		$contents=str_replace($for_replace,$replace_with,$protpage_content);
		$contents=str_replace(GFS($contents,'<!--counter-->','<!--/counter-->'),'',$contents);
		$contents=str_replace('<!--endscripts-->',$login_page_scripts.'<!--endscripts-->',$contents);
		$contents = preg_replace("'<\?php.*?\?>'si",'',$contents);
		if(strpos($prot_page_info[1],'../')===false)
		{
			$url='http://'.$_SERVER['HTTP_HOST'].str_replace('//','/',str_replace('documents','',dirname($_SERVER['PHP_SELF'])).'/');
			$contents=str_replace('</title>','</title> <base href="'.$url.'">',$contents);
		}
  }
  //for Miro
  //if(isset($prot_page_info[7])) 
			//$contents = preg_replace("'<!--".$prot_page_info[7].".*?".$prot_page_info[7]."-->'si",'',$contents);
  $contents=str_replace(array('GMload();','GUnload();'),array('',''),$contents);
  return $contents;
}
function build_menu($user='admin')
{
 global $counter_db_fname,$pref_dir,$ca_lang_l,$sr_enable,$l; 

 $counter_on = file_exists($counter_db_fname)&&(filesize($counter_db_fname)!==0);

 $body_section="<br><div align='center'><span class='rvts8'>:: </span><a class='rvts12' href='".$pref_dir."centraladmin.php?process=index&amp;".$l."'>".$ca_lang_l['site map']."</a>"; 
 $body_section.=" <span class='rvts8'>:: </span><a class='rvts12' href='".$pref_dir."centraladmin.php?process=manageusers&amp;".$l."'>" .$ca_lang_l['manage users']."</a><span class='rvts8'> :: </span><a class='rvts12' href='".$pref_dir."centraladmin.php?process=processuser&amp;" .$l."'>".$ca_lang_l['add user']."</a><span class='rvts8'> :: </span>"; 
 if($counter_on) 
   $body_section.="<a class='rvts12' href='".$pref_dir."centraladmin.php?process=confcounter&amp;".$l."'>".$ca_lang_l['counter settings']."</a><span class='rvts8'> :: </span>";
 $body_section.="<a class='rvts12' href='".$pref_dir."centraladmin.php?process=conflang&amp;".$l."'>".$ca_lang_l['language']."</a><span class='rvts8'> :: </span>";
 $body_section.="<br><span class='rvts8'>:: ".$ca_lang_l['registration']." [ "; 
 $body_section.="<a class='rvts12' href='".$pref_dir."centraladmin.php?process=pendingreg&amp;".$l."'>".$ca_lang_l['non-confirmed users']."</a><span class='rvts8'> : </span><a class='rvts12' href='".$pref_dir."centraladmin.php?process=confreg&amp;".$l."'>".$ca_lang_l['settings']."</a><span class='rvts8'> ] :: </span>";
 $body_section.="<a class='rvts12' href='".$pref_dir."centraladmin.php?process=log&amp;".$l."'>".$ca_lang_l['log']."</a><span class='rvts8'> :: </span>"; 
 
 $body_section .= "<br><span class='rvts8'>:: ".$ca_lang_l['CENTRAL ADMIN']." [ </span><a class='rvts12' href='".$pref_dir."centraladmin.php?process=logoutadmin&amp;".$l."'>".$ca_lang_l['logout']."</a> <span class='rvts8'>]</span><span class='rvts8'> ::</span><br></div><br>"; 
 return $body_section;
}
function build_login_form_ca($msg,$flag='login') 
{
	global $pref_dir,$ca_lang_l,$l; 
	$body_section="<div align='center'><form method=post action='".$pref_dir."centraladmin.php?process="
	.($flag=='login'?'index':'confadmin')."&amp;".$l."'>";
	$body_section .= "<table align='center'><tr><td colspan='2'><span class='rvts9'>".$msg."</span></td></tr><tr><td><span class='rvts8'>"
	.$ca_lang_l['username']."</span></td><td><input class='input1' type='text' name='username' style='width:180px'></td></tr>"
	."<tr><td><span class='rvts8'>".$ca_lang_l['password']."</span></td><td><input class='input1' type='password' name='password' style='width:180px'></td></tr>";
	if($flag=='config') 
  		$body_section .= "<tr><td><span class='rvts8'>".$ca_lang_l['repeat password']."</span></td><td><input class='input1' type='password' name='rpassword' style='width:180px'></td></tr>";
	$body_section .= "<tr><td></td><td><input class='input1' type='submit' name='".($flag=='login'?'login':'submit')."' value='"
	.($flag=='login'?$ca_lang_l['login']:$ca_lang_l['submit'])."' >&nbsp;</td></tr></table></form></div>";
	return $body_section;
}
function build_add_user_form ($flag,$msg,$username='',$data='')  //flags - add,editpass,editaccess,editdetails 
{	
	global $access_type,$access_type_ex,$pref_dir,$ca_lang_l,$l;
		$trst="<tr><td align='left'><span class='rvts8'>";
		$section_list=get_sections_list();
		$buffer_id=array();
		$buffer_access=array();

	$body_section="<form action='".$pref_dir."centraladmin.php?process=processuser&amp;".$l."' method='post' enctype='multipart/form-data'>";
	$body_section.="<div align='center'><span class='rvts9'>".$msg."</span><input type='hidden' name='flag' value='".$flag."'><br><br>"; 
	$body_section.="<table width='300px'>".$trst.$ca_lang_l['username'];
	if($flag=='editdetails') 
	{ 
		$creation_date=($data!=''?$data['details']['creation_date']:$_POST['creation_date']);
		$body_section.= "<input type='hidden' name='creation_date' value='".$creation_date."'>";  
	}
	if($flag=='add' || $flag=='editdetails') 
  		{$body_section.="*</span></td><td><input type='hidden' name='old_username' value='".$username."'><input class='input1' type='text' name='username' value='".$username."' style='width:220px' maxlength='50'>";}
	elseif($flag=='editaccess')
  		{$body_section.="</span><input type='hidden' name='username' value='".$username."'><span class='rvts9'> $username</span></td><td>";}
	else
  		{$body_section.="</span></td><td><input type='hidden' name='username' value='".$username."'><span class='rvts9'> $username</span>";}
	$body_section.="</td></tr>";
	if($flag=='add' || $flag=='editdetails')
	{
		$body_section.=$trst.$ca_lang_l['name']."</span></td><td><input class='input1' type='text' name='name' value='" .($data!=''?un_esc($data['details']['name']):(isset($_POST['save'])?un_esc($_POST['name']):''))."' style='width:220px'></td></tr>";
		$body_section.=$trst.$ca_lang_l['surname']."</span></td><td><input class='input1' type='text' name='sirname' value='".($data!=''?un_esc($data['details']['sirname']):(isset($_POST['save'])?un_esc($_POST['sirname']):''))."' style='width:220px'></td></tr>";
		$body_section.=$trst.$ca_lang_l['email']."</span></td><td><input class='input1' type='text' name='email' value='".($data!=''?$data['details']['email']:(isset($_POST['save'])?$_POST['email']:''))."' style='width:220px'></td></tr>";
		if($flag=='editdetails')
			$body_section.="<td colspan='2'><span class='rvts10'>".$ca_lang_l['creation date'].': '.($creation_date!=''? date('r',$creation_date): 'NA')."</span></td></tr>";
	}
	if($flag=='add' || $flag=='editpass')
	{
		$body_section.=$trst.$ca_lang_l['password']."*</span></td><td><input class='input1' type='password' name='password' value='' style='width:220px' maxlength='50'></td></tr>";
		$body_section.=$trst.$ca_lang_l['repeat password']."*</span></td><td><input class='input1' type='password' name='repeatedpassword' style='width:220px' maxlength='50'></td></tr><tr><td> </td><td> </td></tr>";
	}
	if($flag=='add' || $flag=='editaccess') 
	{
		$select_all_flag=(isset($_POST['select_all'])? true: false);
		if($select_all_flag)	$select_all_val=$_POST["select_all"];
		else					$select_all_val='undefined';
		$checked_all_read=($flag=='add' && (!$select_all_flag || $select_all_val=='yes') || ($flag=='editaccess' && $data!='' && $data[0]['section']=='ALL'));
		$checked_all_write=(($flag=='add' && $select_all_flag && $select_all_val=='yesw') || ($flag=='editaccess' && $data!='' && $data[0]['section']=='ALL' && $data[0]['type']=='1'));
		$checked_all_no=($select_all_flag && $_POST["select_all"]=='no' || $data!='' && $data[0]['section']!='ALL');
		$selected_sec_flag=(isset($_POST['selected_sections'])? true: false);

		$section_id=array();
		$section_access=array();
		$body_section.="<tr><td colspan='2' align='left' width='380px'><fieldset><legend><span class='rvts8'>"
			.$ca_lang_l['access to']."* </span></legend>";
		$body_section.="<input type='radio' name='select_all' value='yes' ".($checked_all_read? "checked='checked'": "") 
			."> <span class='rvts8'>".strtoupper($ca_lang_l['all'])." (".$access_type['0'].") </span><br>";
		$body_section.="<input type='radio' name='select_all' value='yesw' ".($checked_all_write? "checked='checked'": "")
			."> <span class='rvts8'>".strtoupper($ca_lang_l['all'])." (".$access_type['1'].") </span><br>";
		if(!empty($section_list)) 
		{
			$body_section.="<input type='radio' name='select_all' value='no' ".($checked_all_no? "checked='checked'": "")
			."><span class='rvts8'> ".ucfirst($ca_lang_l['selected'])." </span><br>";
		}
		else {$body_section.="<br><span class='rvts8'>".ucfirst($ca_lang_l['adduser_msg1'])."</span>";}
			
		if($data!='')
		{
			foreach($data as $k=>$v)
			{
				$selected_sec_ids[]=$v['section'];
				$selected_sec_access[]= $v['type'];
			}
		}
		elseif($selected_sec_flag && !empty($_POST["selected_sections"]))
		{
			foreach($_POST["selected_sections"] as $k=>$v)
			{
				$selected_sec_ids[]=$v;
				$selected_sec_access[]=$_POST["access_type".$v];
			}
		}
		foreach($section_list as $k=>$v)
		{
			$cur_sec_id=str_replace('<id>','',$v[10]);
			$cur_sec_name=$v[8];
			$secaccess_type='0';
			if($flag=='add' && $selected_sec_flag || $flag=='editaccess')
			{ 
				$index=array_search($cur_sec_id,$selected_sec_ids);
				if($index!==false) $secaccess_type=$selected_sec_access[$index];
			}
			$body_section.="<div style='padding: 5px 22px;'><input type='checkbox' name='selected_sections[]' style='vertical-align:middle;'  value='".$cur_sec_id."' ";

			if($flag=='add' && $selected_sec_flag && in_array($cur_sec_id,$_POST["selected_sections"]) || $flag=='editaccess' && (in_array($cur_sec_id,$selected_sec_ids) || $selected_sec_flag && in_array($cur_sec_id,$_POST["selected_sections"])))
			  {$body_section.=" checked='checked'";}

			$body_section.="> <span class='rvts8'>".$cur_sec_name."</span>&nbsp;&nbsp"
			. build_select_ca('access_type'.$cur_sec_id,$access_type_ex,$secaccess_type,"onchange='javascript:tS(".$cur_sec_id.");'")."</div>";
			$body_section.="<div id='section".$cur_sec_id."' style='display:".(($secaccess_type=='2')?"block":"none")."'>";
			$body_section.=check_section_range(0,$cur_sec_id,$username)."</div>";
		}
		
		$body_section.="<br><span class='rvts9'>".ucfirst($ca_lang_l['read'])."</span><span class='rvts8'> - ".ucfirst($ca_lang_l['adduser_msg2'])." <br><span class='rvts9'>".ucfirst($ca_lang_l['read&write'])."</span><span class='rvts8'> - ".ucfirst($ca_lang_l['adduser_msg3'])."</span>"; 
		$body_section.='<br></fieldset></td></tr>';
	}
	if($flag=='add' || $flag=='editdetails') // event manager
	{
		$calendar_categories=get_calendar_categories(); 
		if(!empty($calendar_categories) || isset($data['news']) && !empty($data['news'])) 
		{	
			$news_for=array();
			if(isset($data['news']) && !empty($data['news']))
			{
				foreach($data['news'] as $key=>$val) { $news_for [] = $val['page'].'%'.$val['cat']; }
			}
			$body_section.="<tr><td colspan='2' align='left' width='380px'><fieldset><legend><span class='rvts8'>".'I want to receive newsletters for'." </span></legend><br>";
			foreach($calendar_categories as $k=>$v)
			{
				$ckbox_value=$v['pageid'].'%'.$v['catid'];
				$body_section.="<input type='checkbox' name='news_for[]' value='".$ckbox_value."' style='vertical-align: middle;' ".
				(in_array($ckbox_value,$news_for)? "checked='checked' ": "")."> <span class='rvts8'>".$v['pagename'].' - '.$v['catname']."</span><br>";	
			}
			$body_section.='<br></fieldset></td></tr>';
		}
	}
	if($flag=='add') $body_section.="<tr><td colspan='2' align='right'><span class='rvts8'>(*) ".$ca_lang_l['required fields']."</span></td></tr>";
	$body_section.="<tr><td colspan='2' align='right'><input class='input1' name='save' type='submit' value=' ".$ca_lang_l['submit']." '></td></tr>";
	$body_section.="</table></div></form>";
	$body_section.="<script>function tS(id){if(document.getElementById('access_type'+id).selectedIndex==2) document.getElementById('section'+id).style.display='block'; else document.getElementById('section'+id).style.display='none'; } </script>";
	return $body_section;
}
function build_register_form($msg='',$data='')  
{	
	global $pref_dir,$ca_lang_l,$settings_db_fname,$l;
	$trtd="<tr><td align='left'><span class='rvts8'>";
	$sr_termsofuse_urls = ''; 
	$settings=read_data($settings_db_fname,'registration');
	if(strpos($settings,'<terms_url>')!==false)	$sr_termsofuse_urls=GFS($settings,'<terms_url>','</terms_url>');
	if(strpos($settings,'<notes>')!==false)	$sr_notes=GFS($settings,'<notes>','</notes>');
	
	if($sr_termsofuse_urls!='')
	{
		if(strpos($sr_termsofuse_urls,'../')!==false && strpos($pref_dir,'../')===false) 		
			{$sr_termsofuse_urls=str_replace('../','',$sr_termsofuse_urls);}
	}
	$body_section="<br><form action='".$pref_dir."centraladmin.php?process=register&amp;".$l."' method='post' enctype='multipart/form-data'>";
	$body_section.="<div align='center'><table width='50%'><tr><td colspan='2' align='center'><span class='rvts9'>".ucfirst($ca_lang_l['registration']). $msg."</span><span class='rvts8'><br><br></span></td></tr>"; 
  	$body_section.=$trtd.$ca_lang_l['username']."*</span></td><td align='left'><input class='input1' type='text' name='username' value='".($data!=''?un_esc($data['username']):(isset($_POST['save'])?un_esc($_POST['username']):''))."' style='width:240px' maxlength='50'></td></tr>";
	$body_section.=$trtd.$ca_lang_l['name']."*</span></td><td align='left'><input class='input1' type='text' name='name' value='" .($data!=''?un_esc($data['name']):(isset($_POST['save'])?un_esc($_POST['name']):''))."' style='width:240px' maxlength='50'></td></tr>";
	$body_section.=$trtd.$ca_lang_l['surname']."*</span></td><td align='left'><input class='input1' type='text' name='sirname' value='".($data!=''?un_esc($data['sirname']):(isset($_POST['save'])?un_esc($_POST['sirname']):''))."' style='width:240px' maxlength='50'></td></tr>";
	$body_section.=$trtd.$ca_lang_l['email']."*</span></td><td align='left'><input class='input1' type='text' name='email' value='".($data!=''?$data['email']:(isset($_POST['save'])?$_POST['email']:''))."' style='width:240px' maxlength='50'></td></tr>";
	$body_section.=$trtd.$ca_lang_l['password']."*</span></td><td align='left'><input class='input1' type='password' name='password' value='' style='width:240px' maxlength='50'></td></tr>";
	$body_section.=$trtd.$ca_lang_l['repeat password']."*</span></td><td align='left'><input class='input1' type='password' name='repeatedpassword' style='width:240px' maxlength='50'></td></tr>";
	$body_section.=$trtd.$ca_lang_l['code']."*</span></td><td align='left'><input class='input1' type='text' name='code' value='' size='4' maxlength='4'> ";	
	if(function_exists('imagecreate') && (function_exists('imagegif') || function_exists('imagejpeg') || function_exists('imagepng')) )
	{
		$body_section .= '<img src="'.$pref_dir.'centraladmin.php?process=captcha&'.$l.'" border="0" alt="" style="vertical-align: middle;">';
	}
	else 
	{
		$captcha = generate_captcha_code_ca();
		$_SESSION['CAPTCHA_CODE'] = md5($captcha);
		$body_section .= "<span class='rvts1'>".$captcha."</span>";
	}
	$sr_agree_msg_fixed = $ca_lang_l['sr_agree_msg'];
	if($sr_termsofuse_urls!='')
	{
		$pattern = GFS($sr_agree_msg_fixed,'%%','%%');
		$sr_agree_msg_fixed = str_replace('%%'.$pattern.'%%','<a class="rvts12" href="'.$sr_termsofuse_urls.'">'.$pattern.'</a>',$sr_agree_msg_fixed);
	}
	else {$sr_agree_msg_fixed=str_replace('%%','',$sr_agree_msg_fixed);}
	$body_section .= "</td></tr><tr><td></td>"; 
	$body_section .= "<td align='left'><input type='checkbox' name='agree' value='agree' style='vertical-align: middle;'> <span class='rvts8'> *"; 
	$body_section .= $sr_agree_msg_fixed."</span></td></tr><tr><td></td><td><span class='rvts8'> </span></td></tr>";
	if(isset($sr_notes) && !empty($sr_notes))
		$body_section .= "<tr><td></td><td align='left'><span class='rvts8'>".$sr_notes."</span></td></tr>";
	
	$calendar_categories = get_calendar_categories(); 
	if(!empty($calendar_categories)) //event manager
	{	
		$body_section .= "<tr><td></td><td align='left'><span class='rvts9'>I want to receive newsletters for:<br> </span></td></tr>";
		foreach($calendar_categories as $k=>$v)
		{
			$body_section .= "<tr><td></td><td align='left'><input type='checkbox' name='news_for[]' value='".$v['pageid'].'%'.$v['catid']."' style='vertical-align: middle;'> <span class='rvts8'>".$v['pagename'].' - '.$v['catname']."</span></td></tr>"; 	
		}
		$body_section .=" <tr><td></td><td><span class='rvts8'> </span></td></tr>";
	}
	$body_section .= "<tr><td></td><td align='left'><span class='rvts8'>(*) ".$ca_lang_l['required fields']."</span></td></tr>";
	$body_section .= "<tr><td></td><td align='left'><input class='input1' name='save' type='submit' value=' ".$ca_lang_l['submit']." '></td></tr>";
	$body_section .= "</table></div></form>";
	return $body_section;
}
function get_calendar_categories()
{
	$categories = array();
	$calendar_pages = get_pages_list ('136'); 	
	foreach($calendar_pages as $k=>$v)
	{
		$cat = array();
		$fp=@fopen($v['url'],'r');
		if($fp) { $file_contents=fread($fp,4096); fclose($fp); }
		if(isset($file_contents) && !empty($file_contents)) 
		{
			if(strpos($file_contents,'$em_enabled=TRUE;')!==false || strpos($file_contents,'$em_enabled=true;')!==false)
			{
				$cat_names = GFS($file_contents,'$category_name=array(',');');
				$cat_names_arr = explode(',',$cat_names);
				$cat_ids = GFS($file_contents,'$category_id=array(',');');
				$cat_ids_arr = explode(',',$cat_ids);
				$cat_visib = GFS($file_contents,'$category_vis=array(',');');
				$cat_visib_arr = explode(',',$cat_visib);
				foreach($cat_names_arr as $kk=>$vv) 
				{ 
					if($kk>0 && isset($cat_visib_arr[$kk]) && $cat_visib_arr[$kk]=='true') //miro
					$categories[]= array('pageid'=>$v['pageid'],'pagename'=>$v['name'],'catid'=>$cat_ids_arr[$kk],'catname'=>str_replace('"','',$vv));
				}
			}
		}
	}
	return $categories;
}
function build_forgotpass_form($msg='')  
{	
	global $pref_dir,$ca_lang_l,$l;	

	$body_section="<br><form action='".$pref_dir."centraladmin.php?process=forgotpass&amp;".$l."' method='post' enctype='multipart/form-data'>";
	$body_section.="<div align='center'><table width='40%'><tr><td colspan='2' align='center'><span class='rvts9'>".ucfirst($ca_lang_l['forgotten password']).' '.$msg."</span><br><br><span class='rvts8'>" .$ca_lang_l['sr_forgotpass_note']."<br><br></span></td></tr>"; 
  	$body_section.="<tr><td><span class='rvts8'>".$ca_lang_l['username']."*</span></td><td><input class='input1' type='text' name='username' value='".(isset($_POST['submit'])?un_esc($_POST['username']):'')."' style='width:220px' maxlength='50'></td></tr>";
	$body_section.="<tr><td><span class='rvts8'>".$ca_lang_l['email']."*</span></td><td><input class='input1' type='text' name='email' value='".(isset($_POST['submit'])?$_POST['email']:'')."' style='width:220px' maxlength='50'></td></tr>";	
	$body_section.="<tr><td></td>"; 
	$body_section.="<tr><td colspan='2' align='right'><span class='rvts8'>(*) ".$ca_lang_l['required fields']."</span></td></tr>";
	$body_section.="<tr><td colspan='2' align='right'><input class='input1' name='submit' type='submit' value=' ".$ca_lang_l['submit']." '></td></tr>";
	$body_section.="</table></div></form>";
	return $body_section;
}
function build_changepass_form($username,$msg='')  
{	
	global $pref_dir,$ca_lang_l,$l;	

	$body_section="<br><form action='".$pref_dir."centraladmin.php?process=changepass&amp;".$l."&amp;pageid=".$_GET['pageid'] ."&amp;ref_url=".$_GET['ref_url']."' method='post' enctype='multipart/form-data'>";
	$body_section.="<div align='center'><table width='340px'><tr><td colspan='2' align='center'><span class='rvts9'>".ucfirst($ca_lang_l['change password']).' '.$msg."</span><input type='hidden' name='username' value='".$username."'></td></tr>"; 
	$body_section.="<tr><td><span class='rvts8'>".$ca_lang_l['old password']."*</span></td><td align='right'><input class='input1' type='password' name='oldpassword' value='' style='width:220px' maxlength='50'></td></tr>";
	$body_section.="<tr><td><span class='rvts8'>".$ca_lang_l['new password']."*</span></td><td align='right'><input class='input1' type='password' name='newpassword' value='' style='width:220px' maxlength='50'></td></tr>";
	$body_section.="<tr><td><span class='rvts8'>".$ca_lang_l['repeat password']."*</span></td><td align='right'><input class='input1' type='password' name='repeatedpassword' style='width:220px' maxlength='50'></td></tr>";	
	$body_section.="<tr><td colspan='2' align='right'><span class='rvts8'>(*) ".$ca_lang_l['required fields']."</span></td></tr>";
	$body_section.="<tr><td colspan='2' align='right'><input class='input1' name='submit' type='submit' value=' ".$ca_lang_l['submit']." '></td></tr>";
	$body_section.="</table></div></form>";
	return $body_section;
}
function build_editprofile_form($username,$data='',$msg='')  
{	
	global $pref_dir,$ca_lang_l,$l;	
	$trst="<tr><td align='left'><span class='rvts8'>";

	$body_section="<br><form action='".$pref_dir."centraladmin.php?process=editprofile&amp;pageid=".$_GET['pageid'] ."&amp;ref_url=".$_GET['ref_url'].'&amp;'.$l."' method='post' enctype='multipart/form-data'>";
	
	$creation_date=($data!=''?$data['details']['creation_date']:$_POST['creation_date']);
	$body_section.= "<input type='hidden' name='creation_date' value='".$creation_date."'>";
	
	$body_section.="<div align='center'><table width='340px'><tr><td colspan='2' align='center'><span class='rvts9'>".'edit profile'.' '.$msg."</span><input type='hidden' name='username' value='".$username."'></td></tr>"; 
	$body_section.=$trst.$ca_lang_l['name']."*</span></td><td align='right'><input class='input1' type='text' name='name' value='" .($data!=''?un_esc($data['details']['name']):(isset($_POST['save'])?un_esc($_POST['name']):''))."' style='width:220px'></td></tr>";
	$body_section.=$trst.$ca_lang_l['surname']."*</span></td><td align='right'><input class='input1' type='text' name='sirname' value='".($data!=''?un_esc($data['details']['sirname']):(isset($_POST['save'])?un_esc($_POST['sirname']):''))."' style='width:220px'></td></tr>";
	$body_section.=$trst.$ca_lang_l['email']."*</span></td><td align='right'><input class='input1' type='text' name='email' value='".($data!=''?$data['details']['email']:(isset($_POST['save'])?$_POST['email']:''))."' style='width:220px'></td></tr>";

	$calendar_categories=get_calendar_categories(); 
	if(!empty($calendar_categories)) // || isset($data['news']) && !empty($data['news'])
	{
		
		$news_for=array();
		if(isset($data['news']) && !empty($data['news']))
		{
			foreach($data['news'] as $key=>$val) { $news_for[]=$val['page'].'%'.$val['cat']; }
		}
		$body_section.="<tr><td colspan='2' align='left' width='380px'><fieldset><legend><span class='rvts8'>".'I want to receive newsletters for'." </span></legend><br>";
		foreach($calendar_categories as $k=>$v)
		{
			$ckbox_value=$v['pageid'].'%'.$v['catid'];
			$body_section.="<input type='checkbox' name='news_for[]' value='".$ckbox_value."' style='vertical-align: middle;' ".
			(in_array($ckbox_value,$news_for)? "checked='checked' ": "")."> <span class='rvts8'>".$v['pagename'].' - '.$v['catname']."</span><br>";	
		}
		$body_section.='<br></fieldset></td></tr>';
	}
	$body_section.="<tr><td colspan='2' align='right'><span class='rvts8'>(*) ".$ca_lang_l['required fields']."</span></td></tr>";
	$body_section.="<tr><td colspan='2' align='right'><input class='input1' name='submit' type='submit' value=' ".$ca_lang_l['submit']." '></td></tr>";
	$body_section.="</table></div></form>";
	return $body_section;
}
function generate_captcha_ca() 
{
  $captcha=generate_captcha_code_ca();
  $captcha=strtoupper($captcha);
  $_SESSION['CAPTCHA_CODE'] = md5($captcha);
  $im=imagecreate(105,18);
  $bg=imagecolorallocate($im,255,255,255);

  for($i=0;$i<100;$i++)
  {
	$clr2=imagecolorallocate($im,rand(110,255),rand(110,255),rand(110,255));
	$x=rand(0,105);$y=rand(0,18);
	imageline($im,$x,$y,$x+rand(0,3),$y+2,$clr2);
  }
  for($i=0;$i<10;$i++)
  {
	$x=rand(0,120);$y=rand(0,18);
	$xs=rand(180,255);
	$clr2=imagecolorallocate($im,$xs,$xs,$xs);
	imagearc($im,$x,$y,rand(15,30),rand(15,30),rand(0,360),rand(180,360),$clr2);
  }
  $clr1=imagecolorallocate($im,120,120,120);
  imagerectangle($im,0,0,104,17,$clr1);
  $result='';
  for($i=0;$i<strlen($captcha);$i++){$char=substr($captcha,$i,1);$result .= $char." ";}
  $tekst2=explode(" ",$result);
  $aantal=count($tekst2);
  $xas2=10;$xaz=25;
  for($i=0;$i<$aantal;$i++)
  {
   $xas2=rand(5,14);$yas2=rand(0,4);
   $clr=imagecolorallocate($im,rand(0,110),rand(0,110),rand(0,110));
   imagestring($im,5,$i*$xaz+$xas2,$yas2,$tekst2[$i],$clr);
  }

  if(function_exists("imagegif")){header("Content-type: image/gif");imagegif($im);}
  elseif(function_exists("imagejpeg")){header("Content-type: image/jpeg");imagejpeg($im);}
  elseif(function_exists("imagepng")) {header("Content-type: image/png");imagepng($im);}
  imagedestroy($im);
}
function generate_captcha_code_ca()
{	
	if(!isset($_SESSION) ) {int_start_session_ca();}
	$str = ""; 
	$length = 0; 
	for ($i = 0; $i<4; $i++) {$str .= chr(rand(97, 122));}
	return $str;
}
function process_register($ms='')  
{	
	global $pref_dir,$db_file,$db_dir,$ca_lang_l,$l,$settings_db_fname;
	global $ca_lf,$sr_notif_enabled,$ca_page_charset,$ca_user_msg;
	$mss="<br><br><span class='rvts8'><em style='color:red;'>";
	$mse="</em></span>";
	$msg = '';

 if(isset($_POST['save'])) // send registration email 
 {
	if(!isset($_SESSION)) {int_start_session_ca();}
	if(!isset($_SESSION['CAPTCHA_CODE'])) {echo "This is illegal operation. You are not allowed to register.";exit;}
	else 
	{			
		if(empty($_POST['username'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['username']).$mse;
		}
		elseif(!preg_match("/^[A-Za-z_0-9]+$/",$_POST['username'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['can contain only']).$mse;
		}
		elseif(duplicated_user($_POST['username'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['username exists']).$mse;
		}
		if(empty($_POST['name'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['name']).$mse;
		}
		if(empty($_POST['sirname'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['surname']).$mse;
		}
		if(empty($_POST['email'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['email']).$mse;
		}
		elseif(!empty($_POST["email"]) && !ch_email($_POST["email"])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['nonvalid email']).$mse;
		}
		if(empty($_POST['password'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['password']).$mse;
		}
		elseif(strlen(trim($_POST['password']))<5) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['your password should be']).$mse;
		}		
		elseif(empty($_POST['repeatedpassword'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['repeat password']).$mse;
		}
		elseif($_POST['password']!=$_POST['repeatedpassword']) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['password and repeated password']).$mse;		
		}
		elseif(strtolower($_POST['username'])=='admin' && strtolower($_POST['password'])=='admin') 
		{
			$msg.=$mss.$ca_user_msg.$mse;
		}
		if(empty($_POST['code']) || md5($_POST['code'])!= $_SESSION['CAPTCHA_CODE']) 
		{
			$msg.=$mss.strtoupper($ca_lang_l['code']).' '.$ca_lang_l['field should match the text on the right'].$mse;			
		}
		if(!isset($_POST['agree'])) { $msg.=$mss.ucfirst($ca_lang_l['agree with terms']).$mse; }
		
		if($msg!='') {$body_section = build_register_form($msg);}
		else 
		{
			$settings=read_data($settings_db_fname,'registration');
			$access = array();
			if(strpos($settings,'<access>')!==false) { $access_str=GFS($settings,'<access>','</access>'); }
			else { $access_str=''; }
			if($access_str!='')		{ $temp_access = explode('|',$access_str); }
			if(isset($temp_access)) { foreach($temp_access as $k=>$v) { $t = explode('%%',$v); $access[]=array('section'=>$t[0],'type'=>$t[1]); } }

			$uniqueid = md5(uniqid(mt_rand(),true));
			$link = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/centraladmin.php?id='.$uniqueid.'&process=register&'.$l;
			$content = str_replace("##",'<br>',$ca_lang_l['sr_email_msg']);
			$content = str_replace(array("%CONFIRMLINK%",'%%site%%'), array('<a href="'.$link.'">'.$link.'</a>',$_SERVER['HTTP_HOST']), $content);
			$content = str_replace(array('%%username%%','%%USERNAME%%'), array($_POST['username'],$_POST['username']), $content);
			$content_text = str_replace(array("##","%CONFIRMLINK%"), array($ca_lf,$link), $ca_lang_l['sr_email_msg']); 
			$content_text = str_replace(array('%%username%%','%%USERNAME%%'), array($_POST['username'],$_POST['username']), $content_text);
			$subject = str_replace('%%site%%',$_SERVER['HTTP_HOST'],$ca_lang_l['sr_email_subject']);

			if((strpos(strtolower($content),'mime-version')!==false) || (strpos(strtolower($content),'content-type')!==false)) 
			{
				$log_msg = " Registration email CAN NOT be sent - possible dangerous content";
				$body_section = $log_msg;							
			}	
			$send_to_email=$_POST["email"];
			$sections='';
			$news='';
			if(empty($access)) { $sections.='<access id="1" section="ALL" type="0"></access>'; }
			else 
			{
				foreach($access as $k=>$v) 
				{
					$sections.='<access id="'.($k+1).'" section="'.$v['section'].'" type="'.$v['type'].'"></access>';
				}
			}
			if(isset($_POST["news_for"])) //event manager
			{
				foreach($_POST["news_for"] as $k=>$v) 
				{ 
					if(strpos($v,'%')!==false) { list($p,$c)=explode('%',$v); }
					else { $p=$v; $c=''; }
					$news.='<news id="'.($k+1).'" page="'.$p.'" cat="'.$c.'"></news>';
				}
			}
			$details='<details email="'.$_POST["email"].'" name="'.esc($_POST["name"]).'" sirname="'.esc($_POST["sirname"]).'" sr="1"></details>';	
			$log_msg='success';
	
			$result=send_mail_ca($content,$content_text,$subject,$send_to_email);
			if($result) 
			{
				db_write_user('selfreg',$_POST['username'],crypt($_POST['password']),$sections,$details,$news,$uniqueid); //event manager
				$log_msg.=", email SENT"; $body_section = '<br><h5>'.$ca_lang_l['sr_success_msg'].'</h5>'; 
			}
			else 
			{
				$log_msg.=", email FAILED"; 
				$body_section='Email FAILED. Try again.'; 
			}
			write_log('reg','USER:'.$_POST['username'],$log_msg);
			if(isset($_SESSION['CAPTCHA_CODE'])) {$_SESSION['CAPTCHA_CODE']='';}			 		
		}
	 }
 }
 elseif(isset($_GET['id'])) // confirm registration
 {
		$filename=$db_dir.$db_file;
		$file_contents='<?php echo "hi"; exit; /*<users> </users>*/ ?>';
		if(!$fp=fopen($filename,'r+'))  {print "Cannot open file"; exit;}
		flock($fp, LOCK_EX);
		$fsize=filesize($filename);
		if($fsize>0) $file_contents=fread( $fp,$fsize);
		$users=GFS($file_contents,'<users>','</users>');
		if(strpos($file_contents,'<user id="'.$_GET['id'])!==false)
		{
			if($users!='') {$new_id=substr_count($users,'user id="')+1;}
			else			{$new_id=1; }		
			$_user=GFSAbi($file_contents,'<user id="'.$_GET['id'].'"','</user>');
			$username=GFS($_user,'username="','"');
			$new_user=str_replace($_GET['id'],$new_id,$_user);
			$new_user=str_replace('<details','<details date="'.mktime().'"',$new_user);  // creation date
			$file_contents=str_replace('</users>',$new_user.'</users>',$file_contents); 
			$file_contents=str_replace($_user,'',$file_contents); 

			ftruncate($fp, 0); fseek($fp, 0);
			if(fwrite($fp,$file_contents) === FALSE) {print "Cannot write to file";  exit;  }
			flock($fp, LOCK_UN); fclose($fp);	
			$body_section = '<br><h5>'.$ca_lang_l['sr_confirm_msg'].'</h5>';
			$log_msg = 'success';
			if($sr_notif_enabled)  
			{
				$users=GFS($file_contents,'<users>','</users>');
				$users_arr=format_users_on_read($users);
				if(!empty($users_arr)) 
				{
					foreach($users_arr as $k=>$v) if(in_array($username,$v)) {$user_data=$v; break;}
				}
				$content = 'register_id= '.$_GET['id'].'<br>'.'username= '.$user_data['username'].'<br>';
				$content .= 'name= '.$user_data['details']['name'].'<br>'.'surname= '.$user_data['details']['sirname'].'<br>';
				$content .= 'email= '.$user_data['details']['email'].'<br>'.'date= '.date('Y-m-d G:i', mktime()).'<br>';		
				$content .= 'IP= '.(isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:"").'<br>';
				$content .= 'HOST= '.(isset($_SERVER['REMOTE_HOST'])?$_SERVER['REMOTE_HOST']:"").'<br>';
				$content .= 'AGENT= '.(isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:"").'<br>';
				$subject = str_replace('%%site%%',$_SERVER['HTTP_HOST'],$ca_lang_l['sr_notif_subject']);
				
				$result = send_mail_ca($content,str_replace('<br>',$ca_lf,$content),$subject);
				if($result) {$log_msg.=", notification SENT";  }
				else {$log_msg.=", notification FAILED";}			
			}	
			if(!isset($_GET['flag'])) { write_log('conf','USER:'.$username,$log_msg); }
			else { write_log('confadmin','USER:'.$username,$log_msg); pending_reg_users($body_section); exit; }
		}
		else {$body_section="<br><h5>".$ca_lang_l['sr_already_confirmed']."</h5>";}
 }
 else {$body_section=build_register_form($ms);}
 $body_section=GT($body_section);
 print $body_section;
}
function process_forgotpass()  
{	
	global $pref_dir,$ca_lang_l,$ca_lf,$db_file,$db_dir,$ca_page_charset;
	$mss="<br><br><span class='rvts8'><em style='color:red;'>";
	$mse="</em></span>";
	$msg = '';

	if(isset($_POST['submit'])) 
	{	
		if(empty($_POST['username'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['username']).$mse;
		}
		elseif(!preg_match("/^[A-Za-z_0-9]+$/",$_POST['username'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['can contain only']).$mse;
		}
		elseif(!duplicated_user($_POST['username'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['non-existing']).$mse;
		}
		if(empty($_POST['email'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['email']).$mse;
		}
		elseif(!empty($_POST["email"]) && !ch_email($_POST["email"])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['nonvalid email']).$mse;
		}		
		if($msg!='') {$body_section=build_forgotpass_form($msg);}
		else 
		{	
			$user_data = db_get_specific_user($_POST['username']);
			if(isset($user_data['details']['email']) && $user_data['details']['email']==$_POST['email'])
			{
				$new_pass = mt_rand();
				$send_to_email = $_POST["email"];	
				$content = str_replace("##",'<br>',$ca_lang_l['sr_forgotpass_msg']);
				$content = str_replace(array("%%newpassword%%",'%%site%%'),array($new_pass,$_SERVER['HTTP_HOST']),$content);
				$content = str_replace(array('%%username%%','%%USERNAME%%'),array($_POST['username'],$_POST['username']),$content);	
				$content_text = str_replace("##",$ca_lf,$content); 
				$subject = str_replace('%%site%%',$_SERVER['HTTP_HOST'],$ca_lang_l['sr_forgotpass_subject']);
		
				$result = send_mail_ca($content,$content_text,$subject,$send_to_email);
				if($result) 
				{	
					$filename=$db_dir.$db_file;
					if(!$fp=fopen($filename,'r+'))  {print "Cannot open file"; exit;}
					flock($fp, LOCK_EX);
					$file_contents=fread($fp,filesize($filename));

					$users = GFS($file_contents,'<users>','</users>');
					$old_data = GFSAbi($users,'<user id="'.$user_data['id'].'"','</user>');
					$new_data = str_replace(GFSAbi($old_data,'password="','">'),'password="'.crypt($new_pass).'">',$old_data); 
					$file_contents=str_replace($old_data,$new_data,$file_contents); 		

					ftruncate($fp, 0); fseek($fp, 0);
					if(fwrite($fp,$file_contents) === FALSE) {print "Cannot write to file";  exit;  }
					flock($fp, LOCK_UN); fclose( $fp );	

					$log_msg = "success, email SENT"; 
					$body_section = '<br><h5>'.$ca_lang_l['sr_forgotpass_msg2'].'</h5>'; 
				}
				else 
				{
					$log_msg = 'success, email FAILED';
					$body_section = 'Email FAILED. Try again.'; 
				}
				write_log('forgotpass','USER:'.$_POST['username'],$log_msg);			
			}
			else 
			{
				$msg.=$mss.ucfirst($ca_lang_l['no email for user']).$mse;
				$body_section = build_forgotpass_form($msg); 
			}
	  }
 }
 else {$body_section=build_forgotpass_form();}
 $body_section=GT($body_section);
 print $body_section;
}
function process_changepass($user='')  
{	
	global $pref_dir,$ca_lang_l,$db_file,$db_dir,$ca_page_charset,$template_in_root;
	$msg = '';
	$mss="<br><br><span class='rvts8'><em style='color:red;'>";
	$mse="</em></span>";
	if(isset($_POST['submit'])) 
	{	
		$user_data = db_get_specific_user($_POST['username']);
		if(empty($_POST['oldpassword'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['old password']).$mse;
		}
		elseif($user_data['password']!=crypt($_POST['oldpassword'],$user_data['password'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['wrong old']).$mse;
		}
		if(empty($_POST['newpassword'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['new password']).$mse;
		}
		elseif(strlen(trim($_POST['newpassword']))<5) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['your password should be']).$mse;
		}		
		elseif(empty($_POST['repeatedpassword'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['repeat password']).$mse;
		}
		elseif($_POST['newpassword']!=$_POST['repeatedpassword']) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['password and repeated password']).$mse;		
		}
		if($msg!='') {$body_section=build_changepass_form($_POST['username'],$msg);}
		else 
		{			
			if(isset($user_data['username']) && $user_data['username']==$_POST['username'])
			{
				$filename=$db_dir.$db_file;
				if(!$fp=fopen($filename,'r+'))  {print "Cannot open file"; exit;}
				flock($fp, LOCK_EX);
				$file_contents=fread($fp,filesize($filename));

				$users = GFS($file_contents,'<users>','</users>');
				$old_data = GFSAbi($users,'<user id="'.$user_data['id'].'"','</user>');
				$new_data = str_replace(GFSAbi($old_data,'password="','">'),'password="'.crypt($_POST['newpassword']).'">',$old_data); 
				$file_contents=str_replace($old_data,$new_data,$file_contents); 		
				ftruncate($fp, 0); fseek($fp, 0);
				if(fwrite($fp,$file_contents) === FALSE) {print "Cannot write to file";  exit;  }
				flock($fp, LOCK_UN); fclose( $fp );				
				
				$body_section='<br><h5>'.ucfirst($ca_lang_l['password changed']).'.</h5><br>';
				if(isset($_GET['ref_url']))	
				{
					$u=$_GET['ref_url'];
					if(strpos($_GET['ref_url'],'/')===false && $template_in_root==false) $u='../'.$u;
					$body_section.='<a class="rvts12" href="'.urldecode($u).'">Back to current page</a>';
				}				
				write_log('changepass','USER:'.$_POST['username'],'success');			
			}			
	  }
 }
 else {$body_section=build_changepass_form($user);}
 $body_section=GT($body_section);
 print $body_section;
}
function process_editprofile($user='')  
{	
	global $pref_dir,$ca_lang_l,$db_file,$db_dir,$ca_page_charset;
	$msg = '';
	$mss="<br><br><span class='rvts8'><em style='color:red;'>";
	$mse="</em></span>";

	if(isset($_POST['submit'])) 
	{	
		$user_data = db_get_specific_user($_POST['username']);
		if(empty($_POST['name'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['name']).$mse;
		}
		if(empty($_POST['sirname'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['surname']).$mse;
		}
		if(empty($_POST['email'])) 
		{
			$msg.=$mss.ucfirst($ca_lang_l['fill in']).' '.strtoupper($ca_lang_l['email']).$mse;
		}
		if($msg!='') {$body_section=build_editprofile_form($_POST['username'],'',$msg);}
		else 
		{			
			if(isset($user_data['username']) && $user_data['username']==$_POST['username'])
			{
				$filename=$db_dir.$db_file;
				if(!$fp=fopen($filename,'r+'))  {print "Cannot open file"; exit;}
				flock($fp, LOCK_EX);
				$file_contents=fread($fp,filesize($filename));

				$users = GFS($file_contents,'<users>','</users>');
				$old_data = GFSAbi($users,'<user id="'.$user_data['id'].'"','</user>');
				$new_details = '<details email="'.$_POST["email"].'" name="'.$_POST["name"].'" sirname="'.$_POST["sirname"]  
					.'" date="'.$_POST["creation_date"].'"></details>';
				$new_data = str_replace(GFSAbi($old_data,'<details','</details>'),$new_details,$old_data); 

				$news = '';
				if(isset($_POST["news_for"])) //event manager
				{
					foreach($_POST["news_for"] as $k=>$v) 
					{ 
						if(strpos($v,'%')!==false) { list($p,$c)=explode('%',$v); }
						else { $p = $v; $c = ''; }
						$news.='<news id="'.($k+1).'" page="'.$p.'" cat="'.$c.'"></news>';
					}
				}
				if(!empty($news))
				{
					if(strpos($new_data,'</news_data>')===false)  //event manager
						$new_data=str_replace('</details>','</details><news_data>'.$news.'</news_data>',$new_data);
					else
						$new_data=str_replace('<news_data>'.GFS($old_data,'<news_data>','</news_data>').'</news_data>', '<news_data>'.$news.'</news_data>',$new_data);
				}
				$file_contents=str_replace($old_data,$new_data,$file_contents); 		
				ftruncate($fp, 0); fseek($fp, 0);
				if(fwrite($fp,$file_contents) === FALSE) {print "Cannot write to file";  exit;  }
				flock($fp, LOCK_UN); fclose( $fp );				
				
				$body_section='<br><h5>'.'Profile edited'.'.</h5><br>';
				if(isset($_GET['ref_url']))	
				{
					$u=$_GET['ref_url'];
					if(strpos($_GET['ref_url'],'/')==false) $u='../'.$u;
					$body_section.='<a class="rvts12" href="'.urldecode($u).'">Back to current page</a>';
				}									
				write_log('editprofile','USER:'.$_POST['username'],'success');
				//ca_m_header($load_page,false);
			}			
	  }
 }
 else {$user_data = db_get_specific_user($user); $body_section=build_editprofile_form($user,$user_data);}
 $body_section=GT($body_section);
 print $body_section;
}
function send_mail_ca($content,$content_text,$subject,$send_to_email='')
{
	global $settings_db_fname,$use_linef,$ca_lang_l;
	global $ca_mail_type,$ca_SMTP_HOST,$ca_SMTP_PORT,$ca_SMTP_HELLO,$ca_SMTP_AUTH,$ca_SMTP_AUTH_USR,$ca_SMTP_AUTH_PWD;
		$sr_admin_email = 'your@email.here'; 
		$sr_sendfrom_email = '';  
		$sr_return_path = ''; 
		$res = false;
	$settings=read_data($settings_db_fname,'registration');
	if(strpos($settings,'<admin_email>')!==false)	$sr_admin_email=GFS($settings,'<admin_email>','</admin_email>');
	if(strpos($settings,'<sendmail_from>')!==false)	$sr_sendfrom_email=GFS($settings,'<sendmail_from>','</sendmail_from>');
	if(strpos($settings,'<return_path>')!==false)	$sr_return_path=GFS($settings,'<return_path>','</return_path>');
	if($sr_sendfrom_email!='') {ini_set('sendmail_from', $sr_sendfrom_email);}	

	if(strpos($sr_admin_email,'your@email.here')!==false || $sr_admin_email=='')
	{
		echo "<br>Please, define valid admin e-mail address in Central Admin, Registration Settings panel!"; exit;
	}
	else 
	{				
		$mail = new htmlMimeMail();
		if ($use_linef) $mail->setCrlf("\r\n"); 
		$mail->setHtml($content, $content_text);
		$mail->setSubject($subject);
		if($sr_sendfrom_email=='') $mail->setFrom($sr_admin_email);
		else $mail->setFrom($sr_sendfrom_email);
		if ($sr_return_path!='') {$mail->setReturnPath($sr_return_path);}
		if(($ca_mail_type=='smtp')&&($ca_SMTP_HOST!=='')) $mail->setSMTPParams($ca_SMTP_HOST,$ca_SMTP_PORT,$ca_SMTP_HELLO,$ca_SMTP_AUTH,$ca_SMTP_AUTH_USR,$ca_SMTP_AUTH_PWD);
		if($send_to_email!='') $res = $mail->send(array($send_to_email),$ca_mail_type);
		else $res = $mail->send(array($sr_admin_email),$ca_mail_type);
	}
	return $res;
}
function write_log($change,$data,$message="")  
{
	global $db_dir,$activity_log,$ca_first_line,$ca_last_line,$ca_lf;
		
	$time=date("d M Y H:i:s"); 
	$typechange=array("reg"=>"Register","conf"=>"Confirmation","confadmin"=>"Confirmation (Admin)","forgotpass"=>"Forgotten pass","changepass"=>"Change pass","editprofile"=>"Edit profile","resend"=>"Confirmation email resend","login"=>"Login","logout"=>"Logout");
	$currchange=$typechange[$change];
	$record_line="$time => $currchange -> $data => Result: $message";  
		
	clearstatcache();
	if(!file_exists($activity_log)) $handle = fopen($activity_log,'w');
	else $handle = fopen($activity_log,'a');

	if(!$handle) {echo "Failed to open file.";exit;}
	flock($handle,LOCK_EX);
	if(filesize($activity_log)==0) {$buf=$ca_first_line.$ca_lf.$record_line.$ca_lf;}
	else {$buf=$record_line.$ca_lf;}

	fwrite($handle,$buf);	
	flock($handle,LOCK_UN);
	fclose($handle);
}
function view_log() 
{
	global $ca_first_line,$ca_lf,$ca_lang_l,$pref_dir,$l,$activity_log;
		
	$logcontent=array();
	clearstatcache();
	if(file_exists($activity_log))
	{
		$handle=fopen($activity_log,'r');
		while($data=fgetcsv($handle, 8192,'%')) 
		{
			if($data[0]!=$ca_first_line) 
			{   
				list($dt,$temp,$result)=explode('=>',$data[0]);
				list($activity,$user)=explode('->',$temp);
				if(strpos($user,'EMAIL:')!==false) $user=GFS($user,'USER:','EMAIL:');
				elseif(strpos($user,'ID:')!==false) $user=GFS($user,'USER:','ID:');
				else $user=str_replace('USER:','',$user);
				$logcontent[]=array('date'=>trim($dt),'activity'=>trim($activity),'user'=>$user, 'result'=>str_replace('Result:','',$result));
			}
		}
		fclose($handle);
	}
	$output=build_menu();	
	
	$output.="<div align='center'><span class='rvts9'>".ucfirst($ca_lang_l['log'])."</span><br><br>" 
	.'<form method="POST" action="'.$pref_dir.'centraladmin.php?process=clearlog&amp;'.$l.'" enctype="multipart/form-data">'; 		

	if(!empty($logcontent)) 
	{
		$logcontent=array_reverse($logcontent);
		$output.="<table><tr><td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['date'])."</span><hr></td>"
		."<td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['activity'])."</span><hr></td>"
		."<td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['user'])."</span><hr></td>"
		."<td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['result'])."</span><hr></td></tr>";
		foreach($logcontent as $key=>$value)
		{
			if(!empty($value)) 
			{
				$output.="<tr><td align='left'><span class='rvts10'>".$value['date']."</span></td>";
				$output.="<td align='left'><span class='rvts8'> :: ".$value['activity']."</span></td>";
				$output.="<td align='left'><span class='rvts8'>".$value['user']."</span></td>";
				$output.="<td align='left'><span class='rvts8'> :: ".$value['result']."</span></td></tr>";
			}
		}
		$output .= "</table><br><br><input class='input1' type='submit' value=' ".ucfirst($ca_lang_l['clear log'])." ' onclick=\"javascript:return confirm('".ucfirst($ca_lang_l['clear log MSG'])."')\"></form>";
	}
	$output.="</div>";
	$output=GT($output);
	print $output;
}
function clear_log() 
{	
	global $ca_lang_l,$activity_log;
	//$fname=$_POST['fname'];
	if (!$handle=fopen($activity_log,'r+')) {echo "Can not open log file."; exit;}
	ftruncate($handle,0);
	fseek($handle,0);
	fclose($handle);	
	$body_section=build_menu();
	$body_section.="<div align='center'><span class='rvts9'>".ucfirst($ca_lang_l['log file cleared'])."</span><br><br>";
	$body_section=GT($body_section);
	print $body_section;
}
function check_section_range($standalone,$section_id,$username='') // check section range screen
{
	global $template_in_root,$ca_lang_l,$access_type,$sp_pages_ids;

	$section_range=get_prot_pages_list($section_id);
	$section_name=get_section_name($section_id);
	
	if($username!='')
	{
		$user_data=db_get_specific_user($username);	
		if(!empty($user_data))
		{
			foreach($user_data['access'] as $k=>$v) 
			{
				if($v['section']==$section_id && $v['type']=='2') { $page_access=$v['page_access']; break; }
				elseif($v['section']==$section_id)  { $a_type=$v['type']; break; }
			}
		}
		if(isset($page_access)) foreach($page_access as $k=>$v) { $access_by_page[$v['page']]=$v['type']; }
	}
	$legend="<span class='rvts8'>set access on page level</span>";
	if($standalone)
	{
		$body_section="<div align='center'><div style='width:350px' align='left'><p class='rvps1'><span class='rvts9'>"
		.ucfirst($ca_lang_l['check range'])."</span></p><br>";
		$legend="<span class='rvts8'>".$ca_lang_l['section'].": ".$section_name."</span>";
	}
	else $body_section="<div style='width:350px;'><div style='padding-left:25px;' align='left'>";
	$pro=''; $unpro='';
	$line="<div style='position:relative;'><div style='padding-left:10px;'>:: <a class='rvts12' target='_blank' title='%s' href='%s'>%s</a></div><div style='position:absolute;right:10px;width:120px;top:0px' align='right'>%s</div>";
	foreach($section_range as $k=>$v)
	{	
		if($template_in_root)					$fixed_url=str_replace('../','',$v['url']);
		elseif(strpos($v['url'],'/')!==false)	$fixed_url=$v['url'];
		else									$fixed_url='../'.$v['url'];

		$url=str_replace('..','',$v['url']);
		if($v['protected']=='TRUE' && in_array($v['typeid'],$sp_pages_ids)) { $access_type_f=array('0'=>'read','1'=>'read&write','2'=>'no access'); }
		elseif($v['protected']=='TRUE' && !in_array($v['typeid'],$sp_pages_ids)) { $access_type_f=array('0'=>'read','2'=>'no access'); }
		else { $access_type_f=$access_type; }
	
		if(!$standalone) 
		{ 
			if(isset($access_by_page)&&isset($access_by_page[$v['id']])) { $default=$access_by_page[$v['id']]; }
			else { $default='0'; }
			$combo=build_select_ca('access_to_page'.$v['id'],$access_type_f,$default,'style="width: 90px"'); 
		}
		elseif(isset($access_by_page)) { $combo="<span class='rvts8'>[ ".(isset($access_by_page[$v['id']]) && isset($access_type_f[$access_by_page[$v['id']]])? $access_type_f[$access_by_page[$v['id']]]: $access_type["0"])." ]</span>"; }
		else { $combo="<span class='rvts8'>[ ".(isset($a_type)? $access_type[$a_type]: "")." ]</span>"; }

		if($v['protected']=='TRUE')		{ $pro.=sprintf($line,$url,$fixed_url,$v['name'],$combo);  }
		elseif($v['protected']=='FALSE') { $unpro.=sprintf($line,$url,$fixed_url,$v['name'],$combo); }	
		
	}
	$line="<fieldset><legend>%s</legend><span class='rvts8'>%s</span><br>%s<br><span class='rvts8'>%s</span><br>%s</fieldset>";
	$body_section.=sprintf($line,$legend,'<br>'.$ca_lang_l['protected pages'],$pro,$ca_lang_l['non-protected pages'],$unpro);

	if($standalone)$body_section.='<br><a class="rvts12" href="javascript:history.back();">['.$ca_lang_l['back']."]</a>";
	return $body_section.'</div></div>';
}
function preg_pos($sPattern,$sSubject,&$FoundString) //$iOffset=0
{
 $FoundString=NULL;
 if(@preg_match($sPattern,$sSubject,$aMatches,PREG_OFFSET_CAPTURE)>0)
 {
 	$FoundString=$aMatches[0][0];
 	return $aMatches[0][1];
 }
 else return false;
}
function index() // site map screen
{	
	global $sp_pages_ids,$counter_db_fname,$pref_dir,$template_in_root,$ca_lang_l,$l;
	$body_section=''; 
	$trtd="<td align='left'><span class='rvts10'>";
	$trtde="</span><hr></td>";
	$counter_on=file_exists($counter_db_fname)&&(filesize($counter_db_fname)!==0);

	$os=array('Other','Win95','Win98','WinNT','W2000','WinXP','W2003','WinVista','Linux','Mac','Windows'); // COUNTER
	$browsers=array('Other','IE','Opera','Firefox','Netscape','AOL','Safari','Konqueror','IE5','IE6','IE7','Opera7','Opera8','Firefox 1','Firefox 2','Netscape 6','Netscape 7'); // COUNTER
	
	$body_section .= build_menu();	
	if(isset($_GET['stat']) && $_GET['stat']='detailed') // COUNTER detailed stat
	{
		$records = array();	 
		$max_rec_on_page = 10; 
		$screen = (isset($_GET['screen'])? $_GET['screen']: 1);	
		$counter_stat = read_data($counter_db_fname,'detailed');

		if(!isset($_GET['pid']))
		{
			$f_rec_num = GFS($counter_stat,'<rec_','>'); settype($f_rec_num,'integer');	
			$records_count = substr_count($counter_stat,'<rec_') + $f_rec_num-1; 				
			if($screen==1) {$i=$records_count;}
			else {$i=$records_count-($screen-1)*10;}

			if($screen*10>$records_count) {$limit_rec_to=$records_count%$max_rec_on_page;}
			else {$limit_rec_to=10;}

			while(count($records)<10 && strpos($counter_stat,'<rec_'.$i.'>')!==false) //$i<=$screen) 
			{				
				$rec=GFS($counter_stat,'<rec_'.$i.'>','</rec_'.$i.'>'); 
				$records[]=explode('|', $rec); $i--;		
			}
			if(count($records)<$limit_rec_to)
			{
				$list_file=get_counter_archive_list();
				$list_file=array_reverse($list_file);
				if(!empty($list_file))
				{
					$f_index=0; 
					$counter_stat=read_data($list_file[$f_index],'detailed');
					while(strpos($counter_stat, '<rec_'.$i.'>')===false)
					{
						$f_index++; 
						$counter_stat=read_data($list_file[$f_index],'detailed');
					}
					while(count($records)<$limit_rec_to && strpos($counter_stat,'<rec_'.$i.'>')!==false)
					{
						$rec=GFS($counter_stat, '<rec_'.$i.'>','</rec_'.$i.'>'); 
						$records[]=explode('|', $rec); $i--;	
					}
				}
			}
			if($f_rec_num==0) $records_count=$records_count+1;
		}
		else 
		{	
			$counter_stat_totals=read_data($counter_db_fname, 'totals');
			$records_count=GFS($counter_stat_totals, "<l_".$_GET['pid'].">","</l_".$_GET['pid'].">");
			
			if($screen*10>$records_count) {$i=1;}
			elseif($screen==1) {$i=$records_count-9;}
			else {$i=$records_count-($screen)*10+1;}	
			
			if($screen*10>$records_count) {$limit_rec_to=$records_count%$max_rec_on_page;}
			else {$limit_rec_to=10;}

			$stat_by_file=get_stat_from_archive($_GET['pid']);
			array_push($stat_by_file, array('count'=>substr_count($counter_stat,'>'.$_GET['pid'].'|'),'name'=>$counter_db_fname));
			$counter_stat='';

			$f_index=0;
			$accumulated=$stat_by_file[$f_index]['count'];
			while($accumulated<$i)
			{
				$f_index++;
				$accumulated +=$stat_by_file[$f_index]['count'];		
			}
			$counter_stat=read_data($stat_by_file[$f_index]['name'],'detailed');

			$FoundString='';
			$counter=$accumulated-$stat_by_file[$f_index]['count']+1;
			$pid_pos=preg_pos('/('.'>'.$_GET['pid'].'\|'.')/', $counter_stat, $FoundString);	
			while($pid_pos!==false && count($records)<$limit_rec_to) 
			{
				$temp=GFS(substr($counter_stat, $pid_pos),'>'.$_GET['pid'].'|','>').'>'; //var_dump($temp);
				$rec_id=GFS($temp,'</rec_','>'); 
				$rec=GFS($counter_stat, '<rec_'.$rec_id.'>', '</rec_'.$rec_id.'>');  
				if($counter>=$i && !empty($rec)) {$records[]=explode('|', $rec);}
				$counter_stat=str_replace('<rec_'.$rec_id.'>'.$rec.'</rec_'.$rec_id.'>', '', $counter_stat); 
				$pid_pos=preg_pos('/('.'>'.$_GET['pid'].'\|'.')/', $counter_stat, $FoundString);	
				$counter++;
			}			
			if(count($records)<$limit_rec_to && isset($stat_by_file[$f_index+1]))
			{
				$counter_stat=read_data($stat_by_file[$f_index+1]['name'], 'detailed');
				$FoundString='';
				$pid_pos=preg_pos('/('.'>'.$_GET['pid'].'\|'.')/', $counter_stat, $FoundString);		
				while($pid_pos!==false && count($records)<$limit_rec_to) 
				{
					$temp=GFS(substr($counter_stat, $pid_pos),'>'.$_GET['pid'].'|','>').'>';
					$rec_id=GFS($temp,'</rec_','>'); 
					$rec=GFS($counter_stat, '<rec_'.$rec_id.'>', '</rec_'.$rec_id.'>'); 
					if($counter>=$i && !empty($rec)) {$records[]=explode('|', $rec);}
					$counter_stat=str_replace('<rec_'.$rec_id.'>'.$rec.'</rec_'.$rec_id.'>', '', $counter_stat); 
					$pid_pos=preg_pos('/('.'>'.$_GET['pid'].'\|'.')/', $counter_stat, $FoundString);	
					$counter++;
				}		
			}
			$records = array_reverse($records);	
		}

		$n_screens = ($records_count%$max_rec_on_page==0? $records_count/$max_rec_on_page: ceil($records_count/$max_rec_on_page));
		settype($n_screens, "integer");
		if(isset($_GET['pid']))
		{
			if($template_in_root) {$purl=str_replace('../','',$_GET['purl']);}
			else {if(strpos($_GET['purl'], '../')===false) {$purl = '../'. $_GET['purl'];} else {$purl = $_GET['purl'];} }
		}
		$body_section .= '<div align="center" width="100%"><span class="rvts9">'.ucfirst($ca_lang_l['site map']).' >> '.ucfirst($ca_lang_l['detailed stat']).' '.(isset($_GET['pid'])?' <a class="rvts12" href="'.$_GET['purl'].'" title="'.$purl.'">'.$_GET['pname'].'</a> page':'') .'</span><br><br>';
		if($records_count>$max_rec_on_page)  // navigation
		{
			$url_part1="<a class='rvts12' href='".$pref_dir."centraladmin.php?process=index&amp;stat=detailed&amp;".$l."&amp;screen=";
			$url_part2=(isset($_GET['pid'])? "&amp;pid=".$_GET['pid']."&purl=".$purl."&pname=".$_GET['pname']: '')."'>[";

			if($screen>1)	{ $body_section .= $url_part1."1".$url_part2.strtoupper($ca_lang_l['first'])."]</a>&nbsp;&nbsp;";}
			if(($screen-1)>0) { $body_section .= $url_part1.($screen-1).$url_part2.strtoupper($ca_lang_l['prev'])."]</a>&nbsp;&nbsp;";	}
			if($screen>2 && $records_count>$max_rec_on_page*$max_rec_on_page) {$body_section .= "<span class='rvts8'>... </span>";}
			if($records_count>$max_rec_on_page*$max_rec_on_page) 
			{
				if($screen==2)		$st=$screen-1;
				elseif($screen>2)	$st=$screen-2;
				else				$st=$screen;
			}
			else {$st=1;}
			for($i=$st; $i<=($records_count>$max_rec_on_page*$max_rec_on_page?($st+5):$n_screens); $i++) 
			{
				if($i==$screen) {$body_section.="<span class='rvts8'>[$i]</span>";}
				elseif($i<=$n_screens)
				{
					$body_section.=" <a class='rvts12' href='".$pref_dir."centraladmin.php?process=index&amp;stat=detailed&amp;".$l
					."&amp;screen=$i".(isset($_GET['pid'])? "&amp;pid=" .$_GET['pid']."&purl=".$purl."&pname=".$_GET['pname']: '')."'>".$i."</a> ";
				}
			}
			if($records_count>$max_rec_on_page*$max_rec_on_page && $screen<$n_screens) {$body_section.="<span class='rvts8'> ...</span>"; }
			if($screen<$n_screens) 
			{
				$body_section.="&nbsp;&nbsp;".$url_part1.($screen+1).$url_part2.strtoupper($ca_lang_l['next'])."]</a> ";		
			}
			if($screen!=$n_screens)
			{
				$body_section.="&nbsp;&nbsp;".$url_part1.($n_screens).$url_part2.strtoupper($ca_lang_l['last'])."]</a> ";
			}
		}
		$body_section.="&nbsp;&nbsp;&nbsp;&nbsp;";		
		if($n_screens>=1) 
		{
			$body_section.="<span class='rvts8'>".(($screen-1)*$max_rec_on_page+1).' - '.($max_rec_on_page*$screen>$records_count?$records_count :$max_rec_on_page*$screen).' '.$ca_lang_l['of'].' '.$records_count."</span>";
		}	
		$body_section.="<table><tr><td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['date'])."</span><hr></td>"
		.$trtd.ucfirst($ca_lang_l['time']).$trtde.$trtd.ucfirst($ca_lang_l['browser']).$trtde
		.$trtd.strtoupper($ca_lang_l['os']).$trtde.$trtd.ucfirst($ca_lang_l['resolution']).$trtde
		.$trtd.ucfirst($ca_lang_l['host'])."/".strtoupper($ca_lang_l['ip'])."/".ucfirst($ca_lang_l['referrer'])."</span><hr></td></tr>";
	
		foreach($records as $k=>$v) 
		{
			$body_section.="<tr><td align='left'><span class='rvts8'>".date ('j F Y',$v[1])."</span></td>"
			."<td align='left'><span class='rvts8'>".date ('H:i:s O',$v[1])."</span></td>"
			."<td align='left'><span class='rvts8'>".$browsers[$v[4]]."</span></td><td><span class='rvts8'>".$os[$v[5]]."</span></td>"
			."<td align='left'><span class='rvts8'>".$v[6]."</span></td><td><span class='rvts8'>".$v[3].' ('.$v[2].') ';
			if(isset($v[7]) && $v[7]!='NA')  
				$body_section.='<a class="rvts12" href="'.$v[7].'" alt="'.$v[7].'" title="'.$v[7].'">'.ucfirst($ca_lang_l['referrer']).'</a>';
			else $body_section.=$ca_lang_l['na'];
			$body_section.='</span></td></tr>';
		}
		$body_section.='</table></div>';
	}	
	else
	{
		$pages_list=get_pages_list();	
		$counter_stat=read_data($counter_db_fname,'totals'); // COUNTER
		$body_section.='<div align="center"><span class="rvts9">'.ucfirst($ca_lang_l['site map']).' </span><br><br><table>';
		$body_section.="<tr><td width='200px' align='left'><span class='rvts10'>".ucfirst($ca_lang_l['page name'])."</span><hr></td>".$trtd .ucfirst($ca_lang_l['admin link']).$trtde.$trtd.ucfirst($ca_lang_l['protected']).$trtde.$trtd.ucfirst($ca_lang_l['ca controlled']).$trtde
		.($counter_on ? "<td colspan='2' align='left'> <span class='rvts10'>".ucfirst($ca_lang_l['pageloads']).$trtde:"")."</tr>"; 
		foreach($pages_list as $k=>$v) 
		{	
			if(isset($v['id']))  
			{
				if($template_in_root) {$v_url=str_replace('../','',$v['url']);}
				else {if(strpos($v['url'],'../')===false) {$v_url='../'. $v['url'];} else {$v_url=$v['url'];} }

				if($template_in_root) {$supage_url=str_replace('../','',$v['subpage_url']);}
				else {if(strpos($v['subpage_url'],'../')===false) {$supage_url='../'. $v['subpage_url'];} else {$supage_url=$v['subpage_url'];} }	
				
				$body_section.="<tr><td width='200px' align='left'><span class='rvts8'>";
				if($v['subpage']=='1') 
				{
					$body_section.="&nbsp;&nbsp;&nbsp;&nbsp;- </span><a class='rvts12' href='";
					if($v['frames']=='0' && $v['subpage']=='1')	{$body_section .= $supage_url;	}
					else										{$body_section .= $v_url;	}
				}			
				else 
				{
					$body_section.=":: </span><a class='rvts12' href='";
					if($v['frames']=='0' && !empty($v['subpage_url'])) {$body_section .= $supage_url;	}
					else										{$body_section .= $v_url;	}
				}
				$body_section.="'>".$v['name']."</a </td><td align='left'>";

				if(in_array($v['id'],$sp_pages_ids)) 
				{
					if($template_in_root) {$admin_url=str_replace('../','',$v['adminurl']);}
					else {if(strpos($v['adminurl'],'../')===false) {$admin_url='../'. $v['adminurl'];} else {$admin_url=$v['adminurl'];} }

					$body_section.="<a class='rvts12' href='".$admin_url.'&'.$l."'>";
					if($v['id']=='20') {$body_section.='['.$ca_lang_l['edit'].']';}
					else {$body_section.='['.$ca_lang_l['admin'].']';}
					$body_section.="</a>";
				}
				$body_section.="</td><td align='left'><span class='rvts8'>".($v['protected']=='TRUE'? '[X]': '') ."</span></td>";
				$body_section.="<td align='left'><span class='rvts8'>"
				.(in_array($v['id'],$sp_pages_ids)&&($v['section']>'0' || $v['protected']=='TRUE') || $v['id']=='144' ||!in_array($v['id'],$sp_pages_ids)&&$v['protected']=='TRUE'?'[X]':'') 
				."</span></td>";
				$body_section.=($counter_on?get_loads($counter_stat,$v['pageid'],$v_url,$v['name']):"")."</tr>"; // COUNTER
			}
			else {$body_section.="<tr><td width='200px' align='left'><span class='rvts9'>".$v['name']."</span></td><td></td><td></td><td></td>".($counter_on?"<td> </td>":"")."</tr>";}
		}
		$body_section.="<tr><td width='200px' align='left'><hr><span class='rvts8'>:: </span><a class='rvts12' href='".$pref_dir."tell_friend.php?action=admin'>".ucfirst($ca_lang_l['tell a friend admin'])."</a></td>"
		."<td><hr>&nbsp;</td><td><hr>&nbsp;</td><td align='left'><hr>[X]</td>".($counter_on?"<td colspan='2' align='left'><hr>&nbsp; </td>":"")."</tr>"; 
		if($counter_on) 
		{
			$body_section.="<tr><td width='200px' align='left'><td></td><td></td><td colspan='3' align='left'><hr><span class='rvts8'>".ucfirst($ca_lang_l['total pageloads']).": ".GFS($counter_stat,'<loads>','</loads>') ."</span>&nbsp;&nbsp;".(GFS($counter_stat,'<loads>','</loads>')!='0'?"<a class='rvts12' href='".$pref_dir."centraladmin.php?process=index&stat=detailed&".$l."'>[".$ca_lang_l['details']."]</a>":"")
			."<br><span class='rvts8'>".ucfirst($ca_lang_l['unique visitors']).": ".GFS($counter_stat,'<unique>','</unique>')."</span>"
			."<br><span class='rvts8'>".ucfirst($ca_lang_l['first time visitors']).": ".GFS($counter_stat,'<first>','</first>')."</span>"
			."<br><span class='rvts8'>".ucfirst($ca_lang_l['returning visitors']).": ".GFS($counter_stat,'<returning>','</returning>')."</span>"
			."</td></tr>";
		}
		$body_section.='</table></div>';
	}
	$body_section=GT($body_section);
	print $body_section;
}
function get_loads($counter_stat,$page_id,$page_url,$page_title) // COUNTER get page loads
{	
	global $pref_dir,$ca_lang_l,$l;
	if(strpos($counter_stat, "<l_$page_id>")!==false)
	{
		$page_total='<td align="left"><span class="rvts8">'.GFS($counter_stat, "<l_$page_id>","</l_$page_id>")."</span></td><td align='right'><a class='rvts12' href='".$pref_dir."centraladmin.php?process=index&stat=detailed&".$l."&pid=".$page_id."&purl=".$page_url."&pname=".$page_title. "'>[".$ca_lang_l['details']."]</a></td>";
	}
	else {$page_total='<td align="left"><span class="rvts8">'.$ca_lang_l['na'].'</span></td><td></td>';}
	return $page_total;
}
function get_counter_archive_list()
{
	global $general_db_dir;
	$file_list=array();
	if(is_dir($general_db_dir)) {$counter_archive_db_dir_f=$general_db_dir;}
	else {$counter_archive_db_dir_f=str_replace('../','',$general_db_dir);}

	if(is_dir($counter_archive_db_dir_f))
	{
		$handle=opendir($counter_archive_db_dir_f);				
		while($file = readdir($handle)) 
		{
			if($file!='.' && $file!='..' && strpos($file, "counter_db_")!==false && strpos($file, ".ezg.php")!==false) 
			{	
				$index=GFS($file,'counter_db_','.ezg.php');
				$file_list[$index]=$counter_archive_db_dir_f.'/'.$file;
			}
		}
	}
	return $file_list;
}
function get_stat_from_archive($p_id)
{
	$result=array();
	$file_list=get_counter_archive_list();
	if(!empty($file_list))
	{
		foreach($file_list as $k=>$v)
		{
			$counter_stat=read_data($v, 'detailed');			
			$temp=substr_count($counter_stat, '>'.$p_id.'|');	
			$result[$v]=array('count'=>$temp, 'name'=>$v);
			$counter_stat='';
		}
	}
	sort($result);
	return $result;
}
function read_data($file,$type)  // COUNTER read stat || read settings - 'counter'
{
	$data='';					
	clearstatcache();	 
	if(file_exists($file))
	{	 
	  $fsize=filesize($file);
	  if($fsize>0)
	  {
		  $fp=fopen($file,'r');
		  $file_contents=fread($fp,$fsize);
		  $data=GFS($file_contents,'<'.$type.'>','</'.$type.'>');
		  fclose($fp);
		}
	}
	return $data;
}
function write_data($type,$newsettings)  // write settings - 'counter'
{
	global $settings_db_fname;
	
	$file_contents='<?php echo "hi"; exit; /*<'.$type.'> </'.$type.'>*/ ?>';  
	if(!file_exists($settings_db_fname)) {return false;}
	elseif(!$fp=fopen($settings_db_fname,'r+')) {return false;}
	else 
	{
		flock($fp, LOCK_EX);
		$fsize=filesize($settings_db_fname);
		if($fsize>0)		{	$file_contents=fread( $fp,$fsize);	}
		if(strpos($file_contents, "<$type>")!==false)
		{
			$oldsettings=GFS($file_contents, "<$type>", "</$type>");
			$file_contents=str_replace("<$type>".$oldsettings."</$type>", "<$type>".$newsettings."</$type>",$file_contents);
		}
		else {$file_contents=str_replace("*/ ?>", "<$type>".$newsettings."</$type>*/ ?>",$file_contents);}
		ftruncate($fp, 0);
		fseek($fp, 0);
		if(fwrite($fp,$file_contents) === FALSE) {print "Cannot write to file";  exit;  }
		flock($fp, LOCK_UN);
		fclose( $fp );
		return true;
	} 
}
function conf_counter ()  // COUNTER
{	
	global $settings_db_fname,$pref_dir,$ca_lang_l,$l;
	$C_MAX_VISIT_LENGHT=1800; 
	$C_NUMBER_OF_DIGITS=8;
	$C_DIGIT_COLOR='FFFFFF';
	$C_BG_COLOR='000000';
	$C_SIZE=4;  // 1, 2, 3, 4, 5
	$C_DISPLAY=0;   //1- page loads; 0- unique
	$C_UNIQUE_START_COUNT=0;
	$C_LOADS_START_COUNT=0;
	$visit_len_list=array ('1800'=>'30 min','3600'=>'1 h','7200'=>'2 h','10800'=>'3 h','216000'=>'6 h','432000'=>'12 h','864000'=>'24 h');
	$number_digits_list=array (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
	$show_list=array('show unique visitors','show pageloads');
	$trtdsp='<tr><td align="left"><span class="rvts8">';
	$trtd='<tr><td align="left">';

	$body_section=build_menu();
	if(!isset($_POST['save']))
	{
		$settings=read_data($settings_db_fname,'counter');
		if(strpos($settings,'<max_visit_len>')!==false)	$max_visit_len=GFS($settings,'<max_visit_len>','</max_visit_len>');
		else											$max_visit_len=$C_MAX_VISIT_LENGHT;
		if(strpos($settings,'<number_digits>')!==false)	$number_of_digits=GFS($settings,'<number_digits>','</number_digits>');
		else											$number_of_digits=$C_NUMBER_OF_DIGITS;
		if(strpos($settings,'<size>')!==false)			$size=GFS($settings,'<size>','</size>');
		else											$size=$C_SIZE;
		if(strpos($settings,'<digit_color>')!==false)	$digit_color=GFS($settings,'<digit_color>','</digit_color>');
		else											$digit_color=$C_DIGIT_COLOR;
		if(strpos($settings,'<bg_color>')!==false)		$bg_color=GFS($settings,'<bg_color>','</bg_color>');
		else											$bg_color=$C_BG_COLOR;
		if(strpos($settings,'<display>')!==false)		$display=GFS($settings,'<display>','</display>');
		else											$display=$C_DISPLAY;
		if(strpos($settings,'<loads_start_value>')!==false)	$loads_start_count=GFS($settings,'<loads_start_value>','</loads_start_value>');
		else												$loads_start_count=$C_LOADS_START_COUNT;
		if(strpos($settings,'<unique_start_value>')!==false)$unique_start_count=GFS($settings,'<unique_start_value>','</unique_start_value>');
		else												$unique_start_count=$C_UNIQUE_START_COUNT;

		$src=$pref_dir."centraladmin.php?process=countersample&amp;".$l .(isset($_GET['bg_color'])&&isset($_GET['digit_color'])?'&amp;bg_color='.$_GET['bg_color'].'&amp;digit_color='.$_GET['digit_color']:'');
		
		$body_section.="<form name='frm' action='".$pref_dir."centraladmin.php?process=confcounter&amp;".$l."' method='post' enctype='multipart/form-data'><div align='center'><span class='rvts9'>".$ca_lang_l['counter settings']."</span><br><br><br><table>"; 
		$body_section.=$trtdsp.$ca_lang_l['background color'].'</span></td>'.'<td align="left"><input class="input1" ID="color_1" type="text" name="bgcolor" value="#'.(isset($_GET['bg_color'])?$_GET['bg_color']:$bg_color).'" size="9" style="background-color:#'.(isset($_GET['bg_color'])?$_GET['bg_color']:$bg_color).';">'
		.'<input class="input1" name="picker" type="button" value="select color" onclick="showColorGrid2(\'color_1\',\'color_1\');"></td></tr>';
		
		$body_section.=$trtdsp.$ca_lang_l['digit color'].'</span></td>'.'<td align="left"><input class="input1" ID="color_2" type="text" name="digitcolor" value="#'.(isset($_GET['digit_color'])?$_GET['digit_color']: $digit_color).'" size="9" style="background-color:#'.(isset($_GET['digit_color'])?$_GET['digit_color']:$digit_color).';">'
		.'<input class="input1" name="picker" type="button" value="select color" onclick="showColorGrid2(\'color_2\',\'color_2\');"></td></tr>';
		
		$s=(isset($_GET['size'])?$_GET['size']:$size);
		$body_section.="<tr><td colspan='2' align='left'><br><br><fieldset><legend><span class='rvts8'>".$ca_lang_l['font size']."</span></legend>";
		$body_section.="<table><tr><td align='left'><input type='radio' name='size' value='1' ".($s=='1'?"checked='checked'":'')."> "
		."<span class='rvts8'>".$ca_lang_l['small font']."</span></td><td>";
		if(function_exists('imagecreate')&&(function_exists('imagegif') || function_exists('imagejpeg') || function_exists('imagepng')))
		{
			$body_section.="<img src='$src&amp;size=1' border='0' alt=''>";
		}
		$body_section.="</td></tr>";
		$body_section.=$trtd."<input type='radio' name='size' value='2' ".($s=='2'?"checked='checked'":'')."> "
		."<span class='rvts8'>".$ca_lang_l['medium font']."</span></td><td>";
		if(function_exists('imagecreate')&&(function_exists('imagegif') || function_exists('imagejpeg') || function_exists('imagepng')))
		{
			$body_section.="<img src='$src&amp;size=2' border='0' alt=''>";
		}
		$body_section.="</td></tr>";
		$body_section.=$trtd."<input type='radio' name='size' value='3' ".($s=='3'?"checked='checked'":'')."> "
		."<span class='rvts8'>".$ca_lang_l['bold font']."</span></td><td>";
		if(function_exists('imagecreate')&&(function_exists('imagegif') || function_exists('imagejpeg') || function_exists('imagepng')))
		{
			$body_section.="<img src='$src&amp;size=3' border='0' alt=''>";
		}
		$body_section.="</td></tr>";
		$body_section.=$trtd."<input type='radio' name='size' value='4' ".($s=='4'?"checked='checked'":'')."> "
		."<span class='rvts8'>".$ca_lang_l['large font']."</span></td><td>";
		if(function_exists('imagecreate')&&(function_exists('imagegif') || function_exists('imagejpeg') || function_exists('imagepng')))
		{
			$body_section.="<img src='$src&amp;size=4' border='0' alt=''>";
		}
		$body_section.=" </td></tr>";
		$body_section.=$trtd."<input type='radio' name='size' value='5' ".($s=='5'?"checked='checked'":'')."> "
		."<span class='rvts8'>".$ca_lang_l['stylish font']."</span></td><td>";
		if(function_exists('imagecreate')&&(function_exists('imagegif') || function_exists('imagejpeg') || function_exists('imagepng')))
		{
			$body_section.="<img src='$src&amp;size=5' border='0' alt=''>";
		}
		$body_section .= '<script language="javascript" type="text/javascript"><!--' ."\n"
		.' function showResult(){'
		.' var display=document.getElementsByName("display")[0].value;'	
		.' var num_digits=document.getElementsByName("number_digits")[0].value;'	
		.' var v_length=document.getElementsByName("max_visit_len")[0].value;'
		.' var u_offset=document.frm.u_st_count.value;'
		.' var l_offset=document.frm.l_st_count.value;'	
		.' var myOption= -1;'
		.' for (i=document.frm.size.length-1; i > -1; i--) {'
		.' if(document.frm.size[i].checked) {'
		.' myOption=i; i=-1;} }'
		.' document.location=" '.$pref_dir.'centraladmin.php?process=confcounter&'.$l.'&bg_color="+document.frm.bgcolor.value.replace("#","")+"&digit_color="+document.frm.digitcolor.value.replace("#","")+"&display="+display+"&num_digits="+num_digits+"&v_length="+v_length+"&u_offset="+u_offset+"&l_offset="+l_offset+"&size="+document.frm.size[myOption].value;} //--> </script> '; 
		$body_section.="</td></tr><tr><td colspan='2' align='left'><br><br><input class='input1' name='refresh' type='button' value='".$ca_lang_l['refresh']."' onclick='showResult();'></td></tr></table>";
		$body_section.='</fieldset><br></td></tr>'.$trtdsp.$ca_lang_l['display'].'</span></td>'
		.'<td align="right">'.build_select_ca('display',$show_list,(isset($_GET['display'])?$_GET['display']:$display)).'</td></tr>';
		$body_section.=$trtdsp.$ca_lang_l['number of digits']."</span></td><td align='right'>" .build_select_ca('number_digits',$number_digits_list,(isset($_GET['num_digits'])?$_GET['num_digits']:$number_of_digits-1))."</td></tr>";
		$body_section.=$trtdsp.$ca_lang_l['maximum visit length']."</span></td><td align='right'>" .build_select_ca('max_visit_len',$visit_len_list,(isset($_GET['v_length'])?$_GET['v_length']:$max_visit_len)) ."</td></tr>";	
		$body_section.=$trtdsp.$ca_lang_l['unique start offset'].'</span></td><td align="right"><input class="input1" name="u_st_count" type="text" value="'.(isset($_GET['u_offset'])?$_GET['u_offset']:$unique_start_count).'" size="10"></td></tr>';
		$body_section.=$trtdsp.$ca_lang_l['pageloads start offset'].'</span></td><td align="right"><input class="input1" name="l_st_count" type="text" value="'.(isset($_GET['l_offset'])?$_GET['l_offset']:$loads_start_count).'" size="10"></td></tr>';
		
		$body_section.="<tr><td colspan='2' align='right'>&nbsp;<br><input class='input1' name='save' type='submit'  value='".$ca_lang_l['submit']."'></td></tr>";
		$body_section.='</table></div><div id="colorpicker201" class="colorpicker201" style="top:400px; left:100px;"></div><hr style="width:30%;"></form>';
		$body_section.="<div align='center'><span class='rvts8'>:: </span><a class='rvts12' href='".$pref_dir."centraladmin.php?process=resetcounter&".$l."'>".$ca_lang_l['reset counter']."</a><span class='rvts8'> ::</span></div>";
	}
	else 
	{
		$newsettings='<max_visit_len>'.$_POST['max_visit_len'].'</max_visit_len>'
		.'<number_digits>'.($_POST['number_digits']+1).'</number_digits>'.'<size>'.$_POST['size'].'</size>'
		.'<digit_color>'.str_replace('#','',$_POST['digitcolor']).'</digit_color>'
		.'<bg_color>'.str_replace('#','',$_POST['bgcolor']).'</bg_color>'.'<display>'.$_POST['display'].'</display>'
		.'<loads_start_value>'.$_POST['l_st_count'].'</loads_start_value>'
		.'<unique_start_value>'.$_POST['u_st_count'].'</unique_start_value>'; //$ca_lang_l['settings saved']
		$re = write_data('counter',$newsettings);
		$body_section.="<div align='center'><span class='rvts9'>";
		if($re==true) {$body_section.=ucfirst($ca_lang_l['settings saved']);}
		else {$body_section.="Settings not saved. ERROR.";}
		$body_section.="</span><br><br>"; 		
	}
	$body_section=GT($body_section);
	print $body_section;
}
function hexrgb ($hexstr)
{
	$int=hexdec($hexstr);
	return array("red"=>0xFF & ($int>>0x10),"green"=>0xFF & ($int>>0x8),"blue"=>0xFF & $int);
}
function counter_sample($size)  // COUNTER
{
	global $settings_db_fname;
	$settings=read_data($settings_db_fname,'counter');
	if(strpos($settings,'<digit_color>')!==false) $digit_color=GFS($settings,'<digit_color>','</digit_color>');
	else $digit_color='FFFFFF';
	if(strpos($settings,'<bg_color>')!==false)			$bg_color=GFS($settings,'<bg_color>','</bg_color>');
	else $bg_color='000000';
	$bg_color_rgb=(isset($_GET['bg_color'])? hexrgb($_GET['bg_color']): hexrgb($bg_color));
	$digit_color_rgb=(isset($_GET['digit_color'])? hexrgb($_GET['digit_color']): hexrgb($digit_color));

	if($size==1) {$w=7;$h=11;}
	elseif($size==2) {$w=8;$h=16;}
	elseif($size==3)	{$w=9;$h=16;}
	elseif($size==4)	{$w=10;$h=18;}
	elseif($size==5)	{$w=11;$h=18;}
	$string='0123456789';
	
	$im=imagecreate(10*$w-10,$h);				
	$bg=imagecolorallocate($im,$bg_color_rgb['red'],$bg_color_rgb['green'],$bg_color_rgb['blue']);
	$textcolor=imagecolorallocate($im,$digit_color_rgb['red'],$digit_color_rgb['green'],$digit_color_rgb['blue']);
			
	imagestring($im,$size, 3, 1,$string,$textcolor);
	if(function_exists("imagegif"))		{header("Content-type: image/gif"); imagegif($im);}
	elseif(function_exists("imagejpeg"))	{header("Content-type: image/jpeg");  imagejpeg($im);}
	elseif(function_exists("imagepng"))	{header("Content-type: image/png"); imagepng($im);}
}
function reset_counter ()  // COUNTER resetting
{	
	global $counter_db_fname,$settings_db_fname,$pref_dir,$ca_lang_l,$l;
	
	$body_section=build_menu()."<div align='center'><span class='rvts9'>";
	if(isset($_GET['confirmreset']) && file_exists($counter_db_fname)&&(filesize($counter_db_fname)!==0))
	{
		$fp=fopen($counter_db_fname,'r+');
		flock($fp, LOCK_EX);
        $fsize=filesize($counter_db_fname);
        ftruncate($fp, 0); fseek($fp, 0);	
		flock($fp, LOCK_UN);
        fclose($fp);
		$archive_file_list = get_counter_archive_list();
		foreach($archive_file_list as $k=>$file)
		{
			if(file_exists($file))
			{
				$fp=fopen($file,'r+');
				flock($fp, LOCK_EX);
				ftruncate($fp, 0); fseek($fp, 0);		
				flock($fp, LOCK_UN);
				fclose($fp);
				unlink($file);
			}
		}
		write_data("counter_cookie_suffix", mktime()); 
		clearstatcache();	
		$body_section.=ucfirst($ca_lang_l['reset done'])."</span><br><br></div>"; 
		$body_section=GT($body_section, true);
	}	
	else 
	{
		$body_section.=ucfirst($ca_lang_l['reset counter'])."</span><br><br><span class='rvts8'>".ucfirst($ca_lang_l['reset MSG1'])."</span><br><br>"; 
		$body_section.="<a class='rvts12' href='".$pref_dir."centraladmin.php?process=resetcounter&amp;confirmreset=confirm&amp;".$l."' onclick=\"javascript:return confirm('".ucfirst($ca_lang_l['reset MSG2'])."')\">".$ca_lang_l['confirm counter reset']."</a><br><br></div>"; 
		$body_section=GT($body_section);
	}
	print $body_section;
}
function conf_registration()
{
	global $settings_db_fname,$pref_dir,$ca_lang_l,$l,$access_type;
		$admin_email='';
		$sendmail_from='';
		$return_path='';
		$terms_url='';
		$notes='';
		$access_str='';
		$access=array();
	$trtdsp='<tr><td align="left"><span class="rvts8">';
	$sptdtr='</span></td></tr>';
	$body_section=build_menu();
	if(!isset($_POST['save']))
	{
		$settings=read_data($settings_db_fname,'registration');
		if(strpos($settings,'<admin_email>')!==false)	$admin_email=GFS($settings,'<admin_email>','</admin_email>');
		if(strpos($settings,'<sendmail_from>')!==false)	$sendmail_from=GFS($settings,'<sendmail_from>','</sendmail_from>');
		if(strpos($settings,'<return_path>')!==false)	$return_path=GFS($settings,'<return_path>','</return_path>');
		if(strpos($settings,'<terms_url>')!==false)		$terms_url=GFS($settings,'<terms_url>','</terms_url>');
		if(strpos($settings,'<notes>')!==false)			$notes=GFS($settings,'<notes>','</notes>');
		if(strpos($settings,'<access>')!==false)		$access_str=GFS($settings,'<access>','</access>');
		if($access_str!='')		{ $temp_access = explode('|',$access_str); }
		if(isset($temp_access)) { foreach($temp_access as $k=>$v) { $t = explode('%%',$v); $access[]=array('section'=>$t[0],'type'=>$t[1]); } }

		$body_section.="<form name='frm' action='".$pref_dir."centraladmin.php?process=confreg&amp;".$l."' method='post' enctype='multipart/form-data'>";
		$body_section.="<div align='center'><span class='rvts9'>".ucfirst($ca_lang_l['registration']).' ' .$ca_lang_l['settings']."</span><br><br><table width='60%'>"; 
		
		$admin_email_value = (isset($_GET['admin_email'])?$_GET['admin_email']:$admin_email);
		$body_section.=$trtdsp.ucfirst($ca_lang_l['admin email']).'</span></td><td align="left">'
		.'<input class="input1" type="text" name="admin_email" value="'.$admin_email_value.'" style="width:450px"></td></tr><tr><td></td><td align="left"><span class="rvts10">'.(empty($admin_email_value)? "<em style='color:red;'>":'').ucfirst($ca_lang_l['confreg_msg2']).(empty($admin_email_value)? "</em>":'').$sptdtr;

		$body_section.='<tr><td align="left" width="130px"><span class="rvts8">'.ucfirst($ca_lang_l['terms url']).'</span></td>'
		.'<td align="left"><input class="input1" type="text" name="terms_url" value="'.(isset($_GET['terms_url'])?$_GET['terms_url']:$terms_url).'" style="width:450px"></td></tr><tr><td></td><td align="left"><span class="rvts10">'.ucfirst($ca_lang_l['confreg_msg1']).$sptdtr;

		$body_section.=$trtdsp.ucfirst($ca_lang_l['notes']).'</span></td><td align="left">'
		.'<textarea class="input1" name="notes" style="width:450px" rows="5">'.(isset($_GET['notes'])?$_GET['notes']:$notes). '</textarea></td></tr><tr><td></td><td align="left"><span class="rvts10">'.ucfirst($ca_lang_l['confreg_msg5']).$sptdtr;

		$body_section.=$trtdsp.ucfirst($ca_lang_l['sendmail from']).'</span></td><td align="left">'
		.'<input class="input1" type="text" name="sendmail_from" value="'.(isset($_GET['sendmail_from'])?$_GET['sendmail_from']:$sendmail_from).'" style="width:450px"></td></tr><tr><td></td><td align="left"><span class="rvts10">'.ucfirst($ca_lang_l['confreg_msg3']).$sptdtr;

		$body_section.=$trtdsp.ucfirst($ca_lang_l['return path']).'</span></td><td align="left">'
		.'<input class="input1" type="text" name="return_path" value="'.(isset($_GET['return_path'])?$_GET['return_path']:$return_path).'" style="width:450px"></td></tr><tr><td></td><td align="left"><span class="rvts10">'.ucfirst($ca_lang_l['confreg_msg4']).$sptdtr;

		$section_list=get_sections_list();
		$section_id=array();
		$section_access=array();
		$body_section.="<tr><td colspan='2' align='left'><fieldset width='200px'><legend><span class='rvts8'>".$ca_lang_l['access to']."</span></legend>";
		$body_section.="<input type='radio' name='select_all' value='yes' "
		.(empty($access) || $access[0]['section']=='ALL' && $access[0]['type']=='0'?"checked='checked'":"")
		."> <span class='rvts8'>".strtoupper($ca_lang_l['all'])." (".$access_type['0'].") </span><br>";
		$body_section.="<input type='radio' name='select_all' value='yesw' "
		.(!empty($access) && $access[0]['section']=='ALL' && $access[0]['type']=='1'?"checked='checked'":"")
		."> <span class='rvts8'>".strtoupper($ca_lang_l['all'])." (".$access_type['1'].") </span><br>";
		
		if(!empty($section_list)) 
		{
			$body_section.="<input type='radio' name='select_all' value='no' "
			.(!empty($access) && $access[0]['section']!='ALL'?"checked='checked'":"")."><span class='rvts8'> ".ucfirst($ca_lang_l['selected'])." </span><br>";
		}
		else {$body_section.="<br><span class='rvts8'>".ucfirst($ca_lang_l['adduser_msg1'])."</span>";}
			
		if($access!='')
		{
			foreach($access as $k=>$v) { $section_id []=$v['section']; $section_access []= $v['type']; }
		}
		elseif(!empty($_POST["selected_sections"]))
		{
			foreach($_POST["selected_sections"] as $k=>$v) { $section_id []=$v; $section_access []= $_POST["access_type".$v]; }
		}
		foreach($section_list as $k=>$v)
		{
			$sec_id=str_replace('<id>','',$v[10]);
			$sec_name=$v[8];	
			$key_of_access=array_search($sec_id,$section_id);
			if($key_of_access!==false) {$t=$section_access[$key_of_access]; settype($t,'integer');}
			
			$body_section.="&nbsp;&nbsp;&nbsp;<input type='checkbox' name='selected_sections[]' value='".$sec_id."' ";

			if(in_array($sec_id,$section_id) ) {$body_section.=" checked='checked'";}

			$body_section.="> <span class='rvts8'>".$sec_name."</span>&nbsp;&nbsp;<a class='rvts12' href='".$pref_dir."centraladmin.php?process=processuser&amp;checksection=".$sec_id."&amp;".$l."'>[".$ca_lang_l['check range']."]</a>&nbsp;&nbsp;"
			. build_select_ca('access_type'.$sec_id,$access_type,(isset($key_of_access) && $key_of_access!==false && $key_of_access!==NULL?$t:"0")) ."&nbsp;<br>";
		}
		$body_section.="<br><br><span class='rvts9'>".ucfirst($ca_lang_l['read'])."</span><span class='rvts8'> - ".ucfirst($ca_lang_l['adduser_msg2'])." <br><span class='rvts9'>".ucfirst($ca_lang_l['read&write'])."</span><span class='rvts8'> - ".ucfirst($ca_lang_l['adduser_msg3'])."</span><br></fieldset></td></tr>"; 
		
		$body_section.="<tr><td colspan='2' align='right'>&nbsp;<br><input class='input1' name='save' type='submit'  value='".$ca_lang_l['submit']."'></td></tr>";
		$body_section.='</table></div></form>';
		
	}
	else 
	{
		$newsettings='<admin_email>'.$_POST['admin_email'].'</admin_email>'
		.'<terms_url>'.$_POST['terms_url'].'</terms_url>'.'<notes>'.$_POST['notes'].'</notes>'
		.'<sendmail_from>'.$_POST['sendmail_from'].'</sendmail_from>'.'<return_path>'.$_POST['return_path'].'</return_path>';
		$sections=array();
		if(isset($_POST["select_all"]) && $_POST["select_all"]=='no') 
		{					
			if(isset($_POST["selected_sections"])) 
			{
				foreach($_POST["selected_sections"] as $k=>$v) 
				{
					$sections[]=$v.'%%'.(isset($_POST["access_type".$v])?$_POST["access_type".$v]:"0");
				}
			}
			else { $sections[]="ALL%%0"; }
		}
		elseif(isset($_POST["select_all"]) && $_POST["select_all"]=='yesw') {$sections []= "ALL%%1";} //ALL-write
		else {$sections[]= "ALL%%0";} //ALL-read
		$newsettings.='<access>'. implode('|',$sections).'</access>'; 
		$re=write_data('registration',$newsettings);
		$body_section.="<div align='center'><span class='rvts9'>"; 
		if($re==true) {$body_section.=ucfirst($ca_lang_l['settings saved']);}
		else {$body_section.="Settings not saved. ERROR.";}
		$body_section.="</span><br><br>"; 
	}
	$body_section=GT($body_section);
	print $body_section;
}		
function pending_reg_users($msg='')
{
	global $pref_dir,$ca_lang_l,$l, $ca_lf;
			
	if(isset($_GET['removeuser']))   // REMOVE USER
	{
		$user_id=$_GET['removeuser'];
		db_remove_user($user_id,'selfreg_users');
		$msg = '<br>'.ucfirst($ca_lang_l['user removed']);
	}
	$users=db_get_users('selfreg_users');
	if($users!='') {$users_array=format_users_on_read($users);}
	else {$users_array=array();}

	if(isset($_GET['resend']))   // RE_SEND CONFIRMATION EMAIL TO USER
	{
		$user_id=$_GET['resend'];
		foreach($users_array as $k=>$v) { if($v['id']==$user_id) { $user_info = $v; break; } } 
		
		$link = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/centraladmin.php?id='.$user_id.'&process=register&'.$l;
		$content = str_replace(array("##","%CONFIRMLINK%"),array('<br>','<a href="'.$link.'">'.$link.'</a>'),$ca_lang_l['sr_email_msg']);
		$content = str_replace(array('%%username%%','%%USERNAME%%','%%site%%'),array($v['username'],$v['username'],$_SERVER['HTTP_HOST']),$content);
		$content_text = str_replace("##",$ca_lf,$ca_lang_l['sr_email_msg']); 
		$content_text = str_replace(array('%%username%%','%%USERNAME%%',"%CONFIRMLINK%"),array($v['username'],$v['username'],$link),$content_text);
		$subject = str_replace('%%site%%',$_SERVER['HTTP_HOST'],$ca_lang_l['sr_email_subject']);
		$send_to_email = $v["details"]["email"];
		$log_data = 'USER:'.$v['username'].' EMAIL:'.$v["details"]["email"];
		$log_msg = 'success';
	
		$result = send_mail_ca($content,$content_text,$subject,$send_to_email);
		if($result) {$log_msg .= ", email SENT"; 
		$msg = '<br>'.ucfirst($ca_lang_l['email resent']).' '.strtoupper($v['username']);}
		else 
		{
			$log_msg.=", email FAILED"; 
			$msg='Email FAILED. Try again.'; 
		}
		write_log('resend',$log_data,$log_msg);			
	}

	$body_section = build_menu();		
	$body_section .= '<div align="center"><span class="rvts9">'.ucfirst($ca_lang_l['non-confirmed users']).'</span><span class="rvts10">'.$msg.'</span><br><br><table>'; 
	if(!empty($users_array)) 
	{
		$body_section .= "<tr><td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['user'])."</span><hr></td>"
		."<td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['name'])."/".ucfirst($ca_lang_l['surname'])."/".ucfirst($ca_lang_l['email']) ."</span><hr></td><td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['remove'])."</span><hr></td><td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['confirmation email'])."</span><hr></td></tr>";
		foreach($users_array as $key=>$value)
		{
			if(!empty($value)) 
			{						
				$body_section.="<tr><td align='left'><span class='rvts9'>".$value['username']."</span></td><td align='left'><span class='rvts8'>".strtoupper($value['details']['name'])." ".strtoupper($value['details']['sirname'])." ".$value['details']['email']."</td>";
				$body_section.="<td align='left'><a class='rvts12' href='".$pref_dir."centraladmin.php?process=pendingreg&amp;removeuser=" .$value['id']."&amp;".$l."' onclick=\"javascript:return confirm('".ucfirst($ca_lang_l['remove MSG'])."')\"> ".$ca_lang_l['remove']."</a></td>";		
				$body_section.="<td align='left'><a class='rvts12' href='".$pref_dir."centraladmin.php?process=pendingreg&amp;resend=".$value['id']."&amp;".$l."' onclick=\"javascript:return confirm('".ucfirst($ca_lang_l['resend MSG']).' '.strtoupper($value['username'])." - ".$value['details']['name']." ".$value['details']['sirname']."?')\"> ".$ca_lang_l['resend']."</a> <a class='rvts12' href='".$pref_dir."centraladmin.php?process=register&amp;id=".$value['id']."&amp;flag=admin&amp;".$l."'> ".$ca_lang_l['confirm']."</a></td></tr>";	
			}
		}
	}
	else { $body_section .= "<tr><td colspan='2' align='center'><span class='rvts8'>".ucfirst($ca_lang_l['none users'])."</span></td></tr>"; }	
	$body_section .= "</table></div>";
	$body_section=GT($body_section);	
	print $body_section;	
}
function manage_users() // manage users screen
{
	global $access_type,$pref_dir,$ca_lang_l,$l,$access_type_ex;
		
	$users=db_get_users();
	if($users!='') {$users_array=format_users_on_read($users);}
	else {$users_array=array();}
	if(count($users_array)>1)
	{
		foreach ($users_array as $key => $row) { $name[$key]=$row['username'];  }
		$name_lower=array_map('strtolower',$name);
		array_multisort($name_lower,SORT_ASC,$users_array); 
	}
	$body_section=build_menu();		
	$body_section.='<div align="center"><span class="rvts9">'.ucfirst($ca_lang_l['manage users']).'</span><br><br><table>'; 	
	
	if(!empty($users_array)) 
	{
		$body_section.="<tr><td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['user'])."</span><hr></td>"
		."<td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['edit'])."/".ucfirst($ca_lang_l['remove'])."</span><hr></td>"
		."<td align='left'><span class='rvts10'>".ucfirst($ca_lang_l['access to'])."</span><hr></td><td></td></tr>";
		foreach($users_array as $key=>$value)
		{
			if(!empty($value)) 
			{
				$body_section.="<tr><td align='left'><span class='rvts10'>".($key+1).". ".$value['username']."</span></td>";						
				$body_section.="<td><a class='rvts12' href='".$pref_dir."centraladmin.php?process=processuser&amp;editaccess=".$value['username']
				."&amp;".$l."'>[".$ca_lang_l['edit access']."]</a> <a class='rvts12' href='".$pref_dir ."centraladmin.php?process=processuser&amp;editdetails=".$value['username']."&amp;".$l."'>[".$ca_lang_l['details']."]</a>"
				." <a class='rvts12' href='".$pref_dir."centraladmin.php?process=processuser&amp;editpass=".$value['username'] ."&amp;".$l."'>[".$ca_lang_l['password']."]</a> <a class='rvts12' href='".$pref_dir ."centraladmin.php?process=processuser&amp;removeuser=".$value['username']."&amp;".$l."' onclick=\"javascript:return confirm('".ucfirst($ca_lang_l['remove MSG'])."')\"> ".$ca_lang_l['remove']."</a>&nbsp;&nbsp; </td>";
				$body_section.='<td colspan="2"><table style="width:100%">';
				if(!isset($value['access'])) 
				{
					$body_section.="<tr><td><span class='rvts8'>".strtoupper($ca_lang_l['all']).' ('.$access_type[$v['type']].')'
					."</span></td><td></td></tr>";					
				}
				else 
				{
					foreach($value['access'] as $k=>$v) //ALL-write
					{
						if($v['section']=='ALL') 
						{$body_section.="<tr><td align='left'><span class='rvts8'>".strtoupper($ca_lang_l['all']).' ('.$access_type_ex[$v['type']].')'
							."</span></td><td></td></tr>"; }
						else 
						{
							$section_name=get_section_name ($v['section']);
							if(empty($section_name)) $section_name=$v['section'];
							$body_section.="<tr><td align='left'><span class='rvts8'>".$section_name.' ('.$access_type_ex[$v['type']].')'."</span></td>" ."<td align='right'><a class='rvts12' href='".$pref_dir."centraladmin.php?process=processuser&amp;checksection=" .$v['section']."&amp;username=".$value['username']."&amp;".$l."'>[".$ca_lang_l['check range']."]</a></td></tr>";
						}
					}				
				}
				$body_section.='</table></td></tr>';
			}
		}
	}
	else { $body_section.="<tr><td colspan='2' align='center'><span class='rvts8'>".ucfirst($ca_lang_l['none users'])."</span></td></tr>"; }
	$body_section.="</table></div>";
	$body_section=GT($body_section);	
	print $body_section;
}
function process_users()  //process add/edit/remove user
{
	global $ca_lang_l,$ca_user_msg;
	
	$body_section=build_menu();
	$mss="<span class='rvts8'><em style='color:red;'>";
	$mse="</em></span>";
	$sections='';
	$details='';
	$news='';
	if(isset($_POST["select_all"]) && $_POST["select_all"]=='no') 
	{					
		if(isset($_POST["selected_sections"])) 
		{
			foreach($_POST["selected_sections"] as $k=>$v) // to each section from section_list --> access_type assigned
			{
				$a_type=(isset($_POST["access_type".$v])? $_POST["access_type".$v]: "");
				$sections.='<access id="'.($k+1).'" section="'.$v.'" type="'.$a_type.'">';
				if($a_type=='2') 
				{
					$section_range=get_prot_pages_list($v);
					foreach($section_range as $key=>$val) 
					{
						$pid=$val['id'];
						if(isset($_POST["access_to_page".$pid])) 
							{ $sections.='<p id="'.($key+1).'" page="'.$pid.'" type="'.$_POST["access_to_page".$pid].'">'; }
					}
				}
				$sections.='</access>';
			}
		}
		else {$sections.='<access id="1" section="ALL" type="0"></access>';}
	}
	elseif(isset($_POST["select_all"]) && $_POST["select_all"]=='yesw') {$sections.='<access id="1" section="ALL" type="1"></access>';} //ALL-write
	else {$sections.='<access id="1" section="ALL" type="0"></access>';} //ALL-read
	
	if(isset($_POST["email"]) || isset($_POST["name"]) || isset($_POST["sirname"])) //details
	{
		$details.='<details email="'.$_POST["email"].'" name="'.$_POST["name"].'" sirname="'.$_POST["sirname"].'"';
	}
	else {$details.='<details email="" name="" sirname=""';}
	if(isset($_POST["creation_date"]))  { $details.=' date="'.$_POST["creation_date"].'"';}
	else								{ $details.=' date="'.mktime().'"';}
	$details.='></details>';

	if(isset($_POST["news_for"])) //news - event manager
	{
		foreach($_POST["news_for"] as $k=>$v) 
		{ 
			if(strpos($v,'%')!==false) { list($p,$c)=explode('%',$v); }
			else { $p=$v; $c=''; }
			$news.='<news id="'.($k+1).'" page="'.$p.'" cat="'.$c.'"></news>';
		}
	}
	
	if(isset($_POST['save'])) 
	{
		$username=(isset($_POST['username'])? $_POST['username']: "");
		$flag=(isset($_POST['flag'])? $_POST['flag']: "");			
		if($flag=='add' && !preg_match("/^[A-Za-z_0-9]+$/",$_POST['username'])) 
		{
			$msg=$mss.ucfirst($ca_lang_l['can contain only']).$mse;
			$body_section.=build_add_user_form($flag,$msg);
		}
		elseif(($flag=='add'|| $flag=='editdetails') && empty($_POST['username'])) 
		{
			$body_section.=build_add_user_form($flag, $mss.ucfirst($ca_lang_l['fill in']).' '.ucfirst($ca_lang_l['username']).$mse,$username);
		}
		elseif(($flag=='add'|| $flag=='editdetails' && $_POST['username']!=$_POST['old_username']) && duplicated_user($_POST['username'])) 
		{
			$msg=$mss.ucfirst($ca_lang_l['username exists']).$mse;
			$body_section.=build_add_user_form($flag,$msg);
		}
		elseif(($flag=='editpass'||$flag=='add') && empty($_POST['password'])) 
		{
			$body_section.=build_add_user_form($flag, $mss.ucfirst($ca_lang_l['fill in']).' '.ucfirst($ca_lang_l['password']).$mse,$username);
		}
		elseif(($flag=='add'|| $flag=='editpass') && empty($_POST['repeatedpassword'])) 
		{
			$msg=$mss.ucfirst($ca_lang_l['repeat password']).$mse;
			$body_section.=build_add_user_form($flag,$msg,$username);
		}
		elseif(($flag=='add'|| $flag=='editpass') && $_POST['password']!=$_POST['repeatedpassword']) 
		{
			$msg=$mss.ucfirst($ca_lang_l['password and repeated password']).$mse;
			$body_section.=build_add_user_form($flag,$msg,$username);
		}
		elseif( ($flag=='add'|| $flag=='editpass') && strlen(trim($_POST['password']))<5) 
		{
			$msg=$mss.ucfirst($ca_lang_l['your password should be']).$mse;
			$body_section.=build_add_user_form($flag,$msg,$username);
		}
		elseif(($flag=='add'|| $flag=='editpass') && strtolower($_POST['username'])=='admin' && strtolower($_POST['password'])=='admin') 
		{
			$body_section.=build_add_user_form($flag, $mss.$ca_user_msg.$mse,$username);
		}
		elseif(($flag=='add'|| $flag=='editaccess') && $_POST["select_all"]=='no' && !isset($_POST["selected_sections"])) 
		{
			$msg=$mss.ucfirst($ca_lang_l['select access']).$mse;
			$body_section.=build_add_user_form($flag,$msg,$username);
		}
		elseif(($flag=='add'|| $flag=='editdetails') && !empty($_POST["email"]) && !ch_email($_POST["email"])) 
		{
			$msg=$mss.ucfirst($ca_lang_l['nonvalid email']).$mse;
			$body_section.=build_add_user_form($flag,$msg,$username);
		}
		else 
		{	
			if($flag=='add')			{ db_write_user('add',$username,crypt($_POST['password']),$sections,$details,$news); }	// ADD USER	
			elseif($flag=='editpass')	{ db_write_user('editpass',$username,crypt($_POST['password']));	 } // CHANGE PASS
			elseif($flag=='editaccess') { db_write_user('editaccess',$username,'',$sections);} // CHANGE ACCESS 
			elseif($flag=='editdetails')  { db_write_user('editdetails',$_POST['old_username'],'','',$details,$news); }	// CHANGE DETAILS 
			manage_users(); exit;
		}
	}
	elseif(isset($_GET['editaccess']))			// SHOW CHANGE ACCESS FORM
	{
		$username=$_GET['editaccess'];		
		$user_data=db_get_specific_user($username);				
		$body_section .= build_add_user_form('editaccess',ucfirst($ca_lang_l['edit access']),$username,$user_data['access']);
	}
	elseif(isset($_GET['editdetails']))		// SHOW CHANGE DETAILS FORM
	{
		$username=$_GET['editdetails'];		
		$user_data=db_get_specific_user($username);
		$body_section .= build_add_user_form('editdetails',ucfirst($ca_lang_l['edit details']),$username,$user_data);
	}
	elseif(isset($_GET['editpass']))		//SHOW CHANGE PASS FORM
	{
		$username=$_GET['editpass'];		
		$body_section .= build_add_user_form('editpass',ucfirst($ca_lang_l['edit password']),$username);
	}
	elseif(isset($_GET['removeuser'])) 
	{
		$username=$_GET['removeuser'];
		db_remove_user($username);		// REMOVE USER
		manage_users();
		exit;
	}
	elseif(isset($_GET['checksection']))   //CHECK SECTION RANGE
	{
		$section_id=$_GET['checksection'];
		$username=(isset($_GET['username'])?$_GET['username']:'');
		$body_section.=check_section_range(1,$section_id,$username);
	}
	else { $body_section.=build_add_user_form('add',ucfirst($ca_lang_l['add user'])); }
	
	$body_section=GT($body_section);
	print $body_section;
}
function format_users_on_read($users_p) 
{
	$users_array=array();
	$details_arr=array();
	$users=$users_p;
	
	while(strpos($users,'<user id="')!==false) 
	{	
		$i = GFS($users,'<user id="','" ');
		$all='<user id="'.$i.'" '. GFS($users,'<user id="'.$i.'" ','</user>').'</user>';
		$basic=GFS($all,'<user id="'.$i.'" ','>').' ';
		$details=GFS($all,'<details ','></details>').' ';
		$access=GFS($all,'<access_data>','</access_data>').' ';
		$news=GFS($all,'<news_data>','</news_data>').' '; //event manager

		list($username,$password)=explode (' ',$basic);
		$details_arr['email']=GFS($details,'email="','"');
		$details_arr['name']=GFS($details,'name="','"');
		$details_arr['sirname']=GFS($details,'sirname="','"');
		$details_arr['creation_date']=GFS($details,'date="','"');
		$access_arr=array(); $j=1;
		while(strpos($access,'<access id="'.$j.'" ')!==false) 
		{
			$access_full=GFSAbi($access,'<access id="'.$j.'" ','</access>');
			$page_access_arr=array(); $m=1;
			while(strpos($access_full,'<p id="'.$m.'" ')!==false) 
			{
				$page_access_str=GFSAbi($access_full,'<p id="'.$m.'" ','>');
				$page_access_arr []=array('page'=>GFS($page_access_str,'page="','"'), 'type'=>GFS($page_access_str,'type="','"'));
				$m++;
			} 
			$access_str=GFS($access_full,'<access id="'.$j.'" ','>');
			list($section,$type)=explode (' ',$access_str);
			$access_arr []=array(substr($section,0,strpos($section,'='))=>GFS($section,'="','"'), substr($type,0,strpos($type,'='))=> GFS($type,'="','"'),'page_access'=>$page_access_arr);
			$j++;
		}
//var_dump($page_access_arr);
		$news_arr=array();$j=1; //event manager
		while(strpos($news,'<news id="'.$j.'" ')!==false) 
		{
			$news_str=GFS($news,'<news id="'.$j.'" ','>');
			list($page,$cat)=explode(' ',$news_str);
			$news_arr []=array(substr($page,0,strpos($page,'='))=>GFS($page,'="','"'), substr($cat,0,strpos($cat,'='))=>GFS($cat,'="','"'));
			$j++;
		}	
		$users_array[]=array('id'=>$i, 'username'=>GFS($username,'="','"'), 'password'=>GFS($password,'="','"'), 'access'=>$access_arr,  'details'=>$details_arr, 'news'=>$news_arr);		
		$users=str_replace($all,'',$users);
	}
	//var_dump($users_array);
	return $users_array; 
}
function db_get_users($tag='users') 
{
	global $db_file,$db_dir;
		$users='';
		$filename=$db_dir.$db_file;
	clearstatcache();
	if(!file_exists($filename)) $filename=str_replace('../','',$filename);
	if(file_exists($filename)) 
	{   
    $fsize=filesize($filename);
    if($fsize>0)
		{
			$fp=fopen($filename,'r');
			$file_contents=fread( $fp,$fsize);
			$users=GFS($file_contents,'<'.$tag.'>','</'.$tag.'>');
			fclose($fp);
      }    
    }		
    return $users;
}
function db_get_specific_user($username) //get specific user from db
{
	$users_arr=array();
	$specific_user=array(); 
    $users=db_get_users();
	if($users!='') {$users_arr=format_users_on_read($users);}
	if(!empty($users_arr)) 
	{
		foreach($users_arr as $k=>$v) 
		 {if(in_array($username,$v)) {$specific_user=$v; break;}}
	}
	return $specific_user;	
}
function db_remove_user($username,$flag='users')  // remove user 
{
	global $db_file,$db_dir;
		$result=false;
		$updated_users='';
	$filename=$db_dir.$db_file;
	$users=db_get_users($flag);
	if($flag=='users') {if($users!='') $users_arr=format_users_on_read($users);}
	else {if($users!='') $users_arr=$users;}

	if(isset($users_arr) && !empty($users_arr)) 
	{
		$counter=0;
		if(!$fp=fopen($filename,'r+')) {print "Cannot open file"; exit;}
		flock($fp, LOCK_EX);
		$fsize=filesize($filename);
		if($fsize>0) $file_contents=fread($fp,$fsize);
		if($flag=='users')
		{
			foreach($users_arr as $k=>$v) 
			{
				if(!in_array($username,$v)) 
				{
					$counter++;
					$updated_users.=' <user id="'.$counter.'" username="'.$v['username'].'" password="'.$v['password'].'"> <access_data>';
					foreach($v['access'] as $key=>$val)
					{
						$updated_users.='<access id="'.($key+1).'" section="'.$val['section'].'" type="'.$val['type'].'"></access>';
					}
					$updated_users.='</access_data> <details email="'.$v['details']['email'].'" name="'.$v['details']['name'].'" sirname="'.$v['details']['sirname'].'" date="'.$v['details']['creation_date'].'"></details> </user>';			
				}
			}
		}
		else {$updated_users=str_replace(GFSAbi($users_arr,'<user id="'.$username.'"','</user>'),'',$users_arr);}
			
		$file_contents=str_replace($users, $updated_users,$file_contents);
		ftruncate($fp, 0);
		fseek($fp, 0);
		if(fwrite($fp,$file_contents) === FALSE) {print "Cannot write to file";  exit;  }
		flock($fp, LOCK_UN);
		fclose( $fp );
		$result=true;
	}
    return  $result;
}
function db_write_user($flag,$username,$pwd='',$sections='',$details='',$news='',$uniqueid='')  //write user
{
	$users_arr=array(); 
	$specific_user=array(); 
	if($flag=='selfreg') {db_add_user($uniqueid,$username,$pwd,$sections,$details,$news,true);}   
    else 
	{ 
		$users=db_get_users();
		if($users!='') {$users_arr=format_users_on_read($users);}
		if(!empty($users_arr)) 
		{
			foreach($users_arr as $k=>$v) 
			{
				if(in_array($username,$v))  {$id=$k+1; break;}
			}
		}
		if(isset($id))	db_edit_user($flag,$id,$username,$pwd,$sections,$details,$news);
		else	db_add_user(count($users_arr)+1,$username,$pwd,$sections,$details,$news);
	}
}
function db_add_user($id,$username,$pwd,$sections,$details,$news,$self_reg=false)  //add user
{
	global $db_file,$db_dir;
	$result=false;
	$filename=$db_dir.$db_file;
	$file_contents='<?php echo "hi"; exit; /*<users> </users>*/ ?>';
    
	$new_user = '<user id="'.$id.'" username="'.$username.'" password="'.$pwd.'"><access_data>'.$sections.'</access_data>'. ($news!=''?'<news_data>'.$news.'</news_data>':'').$details.'</user>'; //event manager

	if(!$fp=fopen($filename,'r+'))  {print "Cannot open file"; exit;}
	flock($fp, LOCK_EX);
	$fsize=filesize($filename);
	if($fsize>0) $file_contents=fread($fp,$fsize);

	if($self_reg==false) {$file_contents=str_replace('</users>',$new_user.'</users>',$file_contents);}
	else
	{
		if(strpos($file_contents,'<selfreg_users>')===false) 
		{$file_contents=str_replace('</users>','</users><selfreg_users>'.$new_user.'</selfreg_users>',$file_contents);}
		else {$file_contents=str_replace('</selfreg_users>',$new_user.'</selfreg_users>',$file_contents);}
	}
	if(strpos($file_contents,'/*<users>')===FALSE) 
	{
		$file_contents=str_replace('<users>','/*<users>',$file_contents);
		$file_contents=str_replace('</users>','</users>*/',$file_contents);
	}

	ftruncate($fp, 0);
	fseek($fp, 0);
	if(fwrite($fp,$file_contents) === FALSE) {print "Cannot write to file";  exit;  }
	flock($fp, LOCK_UN);
	fclose( $fp );
	$result=true;
}
function db_edit_user($flag,$id,$username,$pwd='',$sections='',$details='',$news='')  //edit user's password or access
{
	global $db_file,$db_dir;
	$result=false;
	$users='';
	$file_contents='';
	$fixed='';
	$filename=$db_dir.$db_file;

	$users=db_get_users();
	if(!$fp=fopen($filename,'r+'))  {print "Cannot open file"; exit;}
	flock($fp, LOCK_EX);
	$fsize=filesize($filename);
	if($fsize>0) $file_contents=fread($fp,$fsize);
			
	$user_to_update='<user id="'.$id.'" '.GFS($users,'<user id="'.$id.'" ','</user>').'</user>';
		
	if(strpos($user_to_update,'</access_data>')===false || strpos($user_to_update,'<user id="'.($id+1).'"')!==false) 
	{
		$fixed=$user_to_update;
		if(strpos($user_to_update,'</access><access_data>')!==false) 
		{
			$fixed=str_replace('</access><access_data>','</access></access_data>',$user_to_update);
		}
		else 
		{
			if(strpos($user_to_update,'<user id="'.($id+1).'"')!==false) 
			{
				$fixed=str_replace('<user id="'.($id+1).'"','</access_data> <details email="" name="" sirname="" date=""></details> </user> <user id="'.($id+1).'"',$user_to_update);
			}					
		}
		$file_contents=str_replace($user_to_update,$fixed,$file_contents);
		ftruncate($fp, 0);
		fseek($fp, 0);
		if(fwrite($fp,$file_contents) === FALSE) {print "Cannot write to file";  exit;  }
		flock($fp, LOCK_UN);
		fclose( $fp );

		$users=db_get_users();

		if(!$fp=fopen($filename,'r+'))  {print "Cannot open file"; exit;}
		flock($fp, LOCK_EX);
		$fsize=filesize($filename);
		if($fsize>0) $file_contents=fread($fp,$fsize);
	}		
	if($flag=='editpass') 
	{
		$updated_user=str_replace(GFS($user_to_update,'password="','"'),$pwd,$user_to_update);
	}
	elseif($flag=='editaccess') 
	{				
		$updated_user=str_replace(GFS($user_to_update,'<access_data>','</access_data>'),$sections,$user_to_update);
	}
	elseif($flag=='editdetails') 
	{
		$updated_user=str_replace('<details '.GFS($user_to_update,'<details ','></details>').'></details>',$details,$user_to_update);
		
		if(strpos($user_to_update,'</news_data>')===false)  //event manager
			$updated_user=str_replace('</details>','</details><news_data>'.$news.'</news_data>',$user_to_update);
		else
			$updated_user=str_replace('<news_data>'.GFS($user_to_update,'<news_data>','</news_data>').'</news_data>', '<news_data>'.$news.'</news_data>',$user_to_update);
		if(isset($_POST['old_username']))  
		{
			$old_user_name=GFSAbi($updated_user,'username="','"');
			$updated_user=str_replace($old_user_name,'username="'.$_POST['username'].'"',$updated_user);
		}
	}
	else 
	{
		$updated_user=$user_to_update;
	}
	$file_contents=str_replace($user_to_update,$updated_user,$file_contents);  
	ftruncate($fp, 0);
	fseek($fp, 0);
	if(fwrite($fp,$file_contents) === FALSE) {print "Cannot write to file";  exit;  }
	flock($fp, LOCK_UN);
	fclose( $fp );
	$result=true;
	return $result;
}
function login_admin()  // process login  admin
{
	global $settings_db_fname,$admin_username,$admin_pwd,$ca_lang_l,$ca_account_msg;
		
	$body_section="";
	$user=$admin_username;
	$pass=$admin_pwd;	
	if(isset($_POST['login'])) 
	{		
		if(isset($_POST['password'])) {$pass_filled=md5($_POST['password']);}
				
		if(empty($_POST['username']) || empty($_POST['password'])) 
		{
			$body_section.=build_login_form_ca("<em style='color:red;'>".ucfirst($ca_lang_l['fill in']).' '.ucfirst($ca_lang_l['username']).' & '.ucfirst($ca_lang_l['password'])."</em>");
		}
		elseif($_POST['username']!=$user || $pass_filled!=$pass) 
		{
			set_delay();	
			$body_section.=build_login_form_ca("<em style='color:red;'>".ucfirst($ca_lang_l['incorrect username/password'])."</em>");
		}
		else 
		{
			setsession('SID_ADMIN',$user);	//ADMIN
			if(isset($_SERVER['HTTP_USER_AGENT'])) setsession( 'HTTP_USER_AGENT',md5($_SERVER['HTTP_USER_AGENT']));
			set_admin_cookie(); // for counter - to ignore hits from site admin
			index(); exit;
		}
	}
	else 
	{
		if(strtolower($user)=='admin' && ($pass==md5('admin') || $pass==md5('Admin') || $pass==md5('ADMIN')) )
		{ 
			print GT($ca_account_msg); exit;		
		}
		$body_section.=build_login_form_ca($ca_lang_l['CENTRAL ADMIN']);
	}
	$body_section=GT($body_section);
	print $body_section;
}
function set_admin_cookie()
{
	if(!isset($_COOKIE['visit_from_admin']))  // counter needed to ignore hits from site admin
	{
		$ts=mktime();
		$expire_ts=mktime(23, 59, 59, date ('n',$ts), date ('j',$ts), 2037);				
		setcookie('visit_from_admin',  md5(uniqid(mt_rand(),true)),$expire_ts);		
	}
}
function set_delay()
{
	global $delay_fname;
	$max_exec=ini_get('max_execution_time'); settype($max_exec,'integer');
	if($max_exec>=12) {$delay=10;}
	else {$delay=$max_exec-2;}
	$ts=mktime(); 
	$last_wrong_ts=$ts;

	if(file_exists($delay_fname) && is_writable($delay_fname) )
	{	
		$fsize=filesize($delay_fname);
		if($fsize>0) 
    {
      $fp=fopen($delay_fname,'r');
      $last_wrong_ts=fread($fp,$fsize); 
      settype($last_wrong_ts,'integer');
  		fclose($fp);
		}

		if($ts-$last_wrong_ts<=30) {while($ts-$last_wrong_ts<=$delay) {$ts=mktime(); continue;} }

		$fp=fopen($delay_fname,'w');
		flock($fp, LOCK_EX);		
		fwrite($fp,$ts);
		flock($fp, LOCK_UN);
		fclose($fp);
	}
	else 
	{
		if($ts-$last_wrong_ts<=30) {while($ts-$last_wrong_ts<=$delay) {$ts=mktime(); continue;} }
	}
}
function ca_m_header($url,$td)
{
  if(false) { echo '<meta http-equiv="refresh" content="0;url='.$url. ' " />'; }
  else
  {
	if($td) header("HTTP/1.0 307 Temporary redirect");
	header("Location: $url");
  }
}
function logout_admin() 
{
	global $template_fname;
	unsetsession();
	write_log('logout', 'USER:Administrator', 'success');
	if(isset($_GET['pageid'])) 
	{
		$prot_page_info=get_page_info($_GET['pageid']);
		if(strpos($prot_page_info[1],'../')===false) { $fixed_page_name='../'.$prot_page_info[1]; }
		else $fixed_page_name=$prot_page_info[1];
	}
	else 
	{
		$pos=strpos($template_fname,'http://');
		if($pos!==false) {$fixed_page_name=substr($template_fname,$pos);}	
		else {$fixed_page_name='../'.$template_fname;}
	}
	ca_m_header($fixed_page_name,false); 
}
/*function config_admin() 
{
	global $settings_db_fname;
	
	$body_section=build_menu();      
	if(isset($_POST['submit']))   
	{
		if((empty($_POST['username'])) || (empty($_POST['password']))) 
		{
			$msg="<span class='rvts8'><em style=\"color: red; \">".'please, fill in both fields'." - ".'username'." & ".'password'."</em></span></br></br>";
			$body_section .= build_login_form($msg,'config');
		}
		elseif(!preg_match("/^[A-Za-z_0-9]+$/",$_POST['username']) )
		{
			$msg="<span class='rvts8'><em style=\"color: red; \">".'username'.' '.'can contain only' ."A-Z, a-z, _ & 0-9</em></span></br></br>";
			$body_section .= build_login_form($msg,'config');
		}
		elseif(empty($_POST['rpassword'])) 
		{
			$msg="<span class='rvts8'><em style=\"color: red; \">".'please, repeat password'."</em></span>";
			$body_section .= build_login_form($msg,'config');
		}
		elseif($_POST['password']!=$_POST['rpassword'])
		{
			$msg="<span class='rvts8'><em style=\"color: red; \">".'password and repeated password do not match'."</em></span></br></br>";
			$body_section .= build_login_form($msg,'config');
		}
		elseif(strlen(trim($_POST['password']))<5)
		{
			$msg="<span class='rvts8'><em style=\"color: red; \">".'your password should be at least five symbols'."</em></span></br></br>";
			$body_section .= build_login_form($msg,'config');
		}
		else 
		{
			$user=array($_POST['username'], crypt($_POST['password'])); 		 
			$newsettings=implode('|',$user);
			write_data('adminaccount',$newsettings);			
			manage_users(); exit; 
		}
	}
	else  // user/pass form
	{
		$msg="<span class='rvts9'>".'Change Central Admin username & password'."</span></br></br>";
		$body_section .= build_login_form($msg,'config');
	}
	$body_section=GT($body_section);
	print $body_section;
}*/

function getsession($Var)	{return (isset($_SESSION[$Var])? $_SESSION[$Var]: "");}

function setsession($Var,$varValue)	{$_SESSION[$Var]=$varValue;}

function islogged($Var)	{return ("" != getsession($Var));}

function unsetsession() 
{
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])) 
	{
		setcookie(session_name(),'', time()-42000,'/');
	}	
	session_destroy();
}
function logout_user() 
{
	global $template_fname,$thispage_id;
	
	$prot_page_info=get_page_info($thispage_id);
	$prot_page_name=$prot_page_info[1]; 
	$user=$_SESSION['cur_user'];
	unsetsession();
	write_log('logout', 'USER:'.$user, 'success');
	if(isset($_GET['pageid'])) 
	{
		$fixed_name=$prot_page_name;
		if(isset($_GET['indexflag'])) 
		{
			if($prot_page_info[4]=='143'&&strpos($prot_page_info[1],'?flag=podcast')!==false) {$fixed_name=$prot_page_name.'&action=index';}
			if($prot_page_info[4]=='20') 
			{
				if(strpos($prot_page_name,'action=show')!==false) $fixed_name=str_replace('action=show','action=noedit',$prot_page_name);
				else $fixed_name=$prot_page_name.'?action=noedit';
				if(strpos($prot_page_info[1],'../')===false) $fixed_name.='../../';
			}
			elseif($prot_page_info[4]=='136') if(strpos($prot_page_info[1],'../')===false) $fixed_name='../../'.$fixed_name;
			elseif(!in_array($prot_page_info[4], array('21','130','140'))) {$fixed_name=$prot_page_name.'?action=index';}
		}
		if(strpos($prot_page_info[1],'../')===false) $fixed_name='../'.$fixed_name;	
	}
	else 
	{
		$pos=strpos($template_fname,'http://');
		if($pos!==false) {$fixed_name=substr($template_fname,$pos);}
		else {$fixed_name='../'.$template_fname;}
	}
	ca_m_header($fixed_name,false);
}
//function user_navigation($logged_as_label='logged as',$ca_label='central admin',$logout_label='logout',$change_label='change pass')
function user_navigation($logged_as_label='',$ca_label='',$logout_label='',$change_label='',$profile_label='')
{
	global $thispage_id,$l;
	$thispage_dir='';
	if(empty($_SESSION)) { int_start_session_ca(); header("Cache-control: private"); }
    $logged_as_caadmin=isset($_SESSION['SID_ADMIN']);
    $logged_as_causer=isset($_SESSION['cur_user']);

	$prot_page_info=get_page_info($thispage_id);
	if(strpos($prot_page_info[1],'../')===false) {$thispage_dir='documents/';}
	else {$thispage_dir='../documents/';}

    $heading='';
	if(strtolower($logged_as_label)=='username' && $ca_label=='' && $logout_label=='' && $change_label=='')
	{
		if($logged_as_caadmin)	$heading=$_SESSION['SID_ADMIN'];
		elseif($logged_as_causer) $heading=$_SESSION['cur_user'];
	}
	else
	{
		$ca_url=$thispage_dir.'centraladmin.php?process=';
		if($logged_as_caadmin)
		{
			$heading.='<span class="rvts8">'.$logged_as_label.' ['.$_SESSION['SID_ADMIN'].'] </span> ';
			$heading.=':: <a class="rvts12" href="'.$ca_url.'index&amp;'.$l.'">'.$ca_label.'</a> ';
			$heading.=':: <a class="rvts12" href="'.$ca_url.'logoutadmin&&amp;'.$l.'">'.$logout_label.'</a>';
		}
		elseif($logged_as_causer || $logged_in_oep)
		{
			$heading.='<span class="rvts8">'.$logged_as_label.' ['.$_SESSION['cur_user'].'] </span> ';
			$heading.=':: <a class="rvts12" href="'.$ca_url.'logout&amp;pageid='.$thispage_id.'&amp;'.$l.'">'.$logout_label.'</a>';
		}					
		if($logged_as_causer) 
		{
			$ref_url=$prot_page_info[1];
			$ca_detailed_url=$thispage_dir.'centraladmin.php?pageid='.$thispage_id.'&amp;ref_url='.urlencode($ref_url)
				.'&amp;username='.$_SESSION['cur_user'].'&amp;'.$l.'process=';	
			$heading.=' :: <a class="rvts12" href="'.$ca_detailed_url.'changepass">'.$change_label.'</a>';
			$heading.=' :: <a class="rvts12" href="'.$ca_detailed_url.'editprofile">'.$profile_label.'</a>';
		}
	}
    print $heading;
}
function scramble_string($string)
{
	$result='';
	$str_len=strlen($string);
	for($i=0; $i<$str_len; $i++) 
		{ $result.=Chr(Ord($string[$i])+ (($i && 1) + 1));}
	return $result;
}
function descramble_string($string)
{
	$result='';
	$str_len=strlen($string);
	for($i=0; $i<$str_len; $i++)
		{ $result.=Chr(Ord($string[$i]) - (($i && 1) + 1)); }
	return $result;
}
function process_admin() 
{
	global $admin_username,$admin_pwd,$thispage_id,$version,$sp_pages_ids,$ca_account_msg;
	global $ca_sitemap_fname,$set_login_cookie,$settings_db_fname,$sr_enable;
	global $db_dir,$l,$ca_available_lang_sets,$ca_lang_set,$pref_dir,$ca_lang_l;
		$action_id='';
		$old_action_id='';
		$access_flag=false;
		if(empty($_GET)) $action_id='index';
	users_import();
	if(empty($_SESSION)) {int_start_session_ca(); header("Cache-control: private");}

	if(isset($_GET['process']))			$action_id=$_GET['process'];
	elseif(isset($_POST['process']))	$action_id=$_POST['process'];
	if(isset($_GET['action']))			$old_action_id=$_GET['action']; // for old 'user logoff' compatibility

	if($action_id=='logout' || $old_action_id == 'logoff')	{logout_user(); }
	elseif($action_id=="logoutadmin")						{logout_admin(); }
	elseif($action_id=="version")							{echo $version;}
	elseif($action_id=="countersample")	{if(isset($_GET['size'])) counter_sample($_GET['size']);}
	elseif($action_id=="register" && $sr_enable)   {process_register();  }
	elseif($action_id=="register" && !$sr_enable)   
	{
		$output=GT("<br><span class='rvts9'>Sorry, self-registration is not enabled for this site.</span>"); 
		print $output; exit;  
	}
	elseif ($action_id=="captcha")		{generate_captcha_ca();}
	elseif($action_id=="forgotpass")	{process_forgotpass(); }
	elseif($action_id=='sitemap')
	{
		$file_contents='';
		if(isset($_GET['pwd']) && crypt('admin',$_GET['pwd'])=='llRanR22sJYds')  
		{	
			$fsize=filesize($ca_sitemap_fname);
			if($fsize>0) {$fp=fopen($ca_sitemap_fname,'r'); $file_contents=fread( $fp,$fsize); fclose($fp);	}			
		}
		$file_contents=str_replace('<?php echo "hi"; exit; /*','',$file_contents);
		$file_contents=str_replace('*/ ?>','',$file_contents);
		print $file_contents;
		exit;
	}	
	elseif(in_array($action_id,
		array("index","manageusers","processuser","loginadmin","confcounter","resetcounter","log","clearlog","confreg","pendingreg","conflang") ))
	{	
		if(!islogged('SID_ADMIN') || islogged('HTTP_USER_AGENT') && $_SESSION['HTTP_USER_AGENT']!=md5($_SERVER['HTTP_USER_AGENT']) ) 
		{	 
			if(function_exists('session_regenerate_id') && version_compare(phpversion(),"4.3.3",">=") )  {session_regenerate_id();} 
			login_admin(); exit;
		}
		if($action_id=="index")				{index();}
		elseif($action_id=="adminscreens")	{admin_screens();}	
		elseif($action_id=="manageusers")	{manage_users();}	
		elseif($action_id=="processuser")	{process_users();}	
		elseif($action_id=="loginadmin")    {login_admin();}
		elseif($action_id=="confcounter")   {conf_counter();} 	
		elseif($action_id=="resetcounter")  {reset_counter();}
		elseif($action_id=="log")			{view_log();}
		elseif($action_id=="clearlog")		{clear_log();}
		elseif($action_id=="confreg")		{conf_registration();} 
		elseif($action_id=="pendingreg")    {pending_reg_users();} 
		elseif($action_id=="conflang")    
		{
			$ouput=build_menu();	
			$ouput.="<div align='center'>";
			if(isset($_POST['submit'])) 
			{  
				$ts=mktime();
				setcookie('ca_lang',$_POST['lang'], mktime(23,59,59,date('n',$ts),date('j',$ts),2037));	
				$ouput.="<span class='rvts9'>".ucfirst($ca_lang_l['settings saved'])."</span>";
			}
			else 
			{
				$ouput.="<form action='".$pref_dir."centraladmin.php?process=conflang' method='post' enctype='multipart/form-data'>";
				$ouput.="<span class='rvts9'>".ucfirst($ca_lang_l['set language'])."</span><br><br>";
				$ouput.="<table><tr><td>".build_select_ca('lang',$ca_available_lang_sets,$ca_lang_set) 
				."</td><td>&nbsp;<input class='input1' name='submit' type='submit' value=' ".$ca_lang_l['submit']." '></td></tr></table>";	
			}
			$ouput.="</div>";
			print GT($ouput); exit;		
		}  
	}
	else 
	{	
		$user=$admin_username;
		$pass=$admin_pwd;
		if(isset($_POST['pv_username'])) $pv_username=trim($_POST['pv_username']);
		if(isset($_POST['pv_password'])) $pv_password=trim($_POST['pv_password']);
		if(isset($_POST['pv_username']) && isset($_POST['pv_password']))
		{		
			$pass_filled=md5($pv_password);
		}
		if(isset($_GET['pageid']) && isset($_POST['loginid'])) // when login page is directly accessed
		{
			if(!isset($pv_username) || !isset($pv_password) ) { set_delay(); error();}
			elseif(strtolower($user)=='admin' && strtolower($user)==strtolower($pv_username) && ($pass==md5('admin') || $pass==md5('Admin') || $pass==md5('ADMIN'))  &&  ($pass==md5(strtolower($pv_password)) || $pass==md5(ucfirst($pv_password)) || $pass==md5(strtoupper($pv_password)))) { print GT($ca_account_msg); exit; }
			elseif(checkauth($pv_username,$pv_password)==false) 
			{ 
				if($user!=$pv_username || $pass!=$pass_filled) {set_delay(); error();}
			}
		}
		$prot_page_info=get_page_info($thispage_id);
		$prot_page_name=$prot_page_info[1]; 					//start of actual pwd protection check
		if(!islogged('SID_ADMIN') || islogged('HTTP_USER_AGENT') && $_SESSION['HTTP_USER_AGENT']!= md5($_SERVER['HTTP_USER_AGENT']) || isset($_GET['ref_url']))   
		{
			if(!isset($_SESSION['cur_user']) || checkauth($_SESSION['cur_user'],'none', true)==false) 
			{
				if(!isset($pv_username) && !isset($pv_password)) 
				{
					if(isset($_GET['ref_url']) && strpos($_GET['ref_url'],'action=register')!==false)
						{ $ms='Identify yourself with username and password before registering for event.'; }
					elseif(isset($_GET['ref_url']) 
						&& (strpos($_GET['ref_url'],'action=chregister')!==false||strpos($_GET['ref_url'],'action=clregister')!==false))
						{ $ms='Identify yourself with username and password before changing or canceling your registration.'; }
					elseif(isset($_GET['ref_url']) && strpos($_GET['ref_url'],'event_id=')!==false)
						{ $ms='Identify yourself with username and password before checking attendees list.'; }
					else { $ms=''; }
						
					$ref_url=(isset($_GET['ref_url'])? urldecode($_GET['ref_url']): ''); //event manager
					
					if(strtolower($user)=='admin' && ($pass==md5('admin') || $pass==md5('Admin') || $pass==md5('ADMIN')) )
					{ 
						print GT($ca_account_msg); exit;		
					}
					$contents=build_login_form($ms, $ref_url);
					$error_pattern=GFSAbi($contents,'<!--[error_message]','-->');		
					if($error_pattern!='') { $contents=str_replace($error_pattern,'',$contents); }		
					print $contents; exit;
				}
				else 
				{				
					if(!isset($pv_username) || !isset($pv_password) ) {error();}				
					if(checkauth($pv_username,$pv_password)==true) 
					{
						if(function_exists('session_regenerate_id') && version_compare(phpversion(),"4.3.3",">=") )  {session_regenerate_id();}
						setsession('cur_user',$pv_username);
						write_log('login', 'USER:'.$pv_username, 'success');
						if($set_login_cookie==true)	{setcookie("logged",$pv_username, time()+60*60*24);}
						$access_flag=true;
						//if(isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'],'stockwatcher.be')!==false) //JPC
						//{
						//	$user_ac=db_get_specific_user($pv_username);
						//	header("Location: http://www.stockwatcher.be/documents/logged.html?admin=stockwatcher&referrer_url=" .str_replace('../','',$prot_page_name) ."&u=".scramble_string($pv_username)."&n=".scramble_string($user_ac['details']['name']) ."&s=".scramble_string($user_ac['details']['sirname'])."&e=".scramble_string($user_ac['details']['email']) ."&t=".scramble_string(mktime()) 
						//	."&ip=".(isset($_SERVER['REMOTE_ADDR'])?scramble_string($_SERVER['REMOTE_ADDR']):"") );
						//	exit;
						//}
					}
					else 
					{					
						if($user!=$pv_username || $pass!=$pass_filled) {set_delay(); error();  }  //wrong username or password
						if($user==$pv_username && $pass==$pass_filled) 
						{	
							if(function_exists('session_regenerate_id') && version_compare(phpversion(),"4.3.3",">=") )  {session_regenerate_id();}
							setsession('SID_ADMIN',$pv_username);
							write_log('login', 'USER:Administrator', 'success');
							if($set_login_cookie==true)	{ setcookie("logged","admin",time()+60*60*24); } 							
							if(isset($_SERVER['HTTP_USER_AGENT'])) { setsession( 'HTTP_USER_AGENT',md5($_SERVER['HTTP_USER_AGENT'])); }
							set_admin_cookie(); // for counter - to ignore hits from site admin
							$access_flag=true;
						}
					}
				}
			}
			else {$access_flag=true;}
		}
		else {$access_flag=true;}  //end of actual pwd protection check

		if($access_flag==true)
		{
			if($action_id=="changepass" && isset($_POST['submit']))		{process_changepass();}
			elseif($action_id=="changepass" && isset($_GET['username'])) {process_changepass($_GET['username']);}
			elseif($action_id=="editprofile" && isset($_POST['submit'])) {process_editprofile();}
			elseif($action_id=="editprofile" && isset($_GET['username'])) {process_editprofile($_GET['username']);}
		}			
		if(isset($_GET['pageid']))  
		{
			if($access_flag==true) 
			{
				$load_page=$prot_page_name;
				if(isset($_GET['indexflag']))
				{
					if($prot_page_info[4]=='143' && strpos($prot_page_info[1],'?flag=podcast')!==false) 
					{$load_page=$prot_page_name.'&action=index&'.$l;}
					elseif($prot_page_info[4]=='133')
					{$load_page=(strpos($prot_page_info[1],'../')!==false? '../':''). 'subscribe/subscribe_'.str_replace('<id>','',$prot_page_info[10]).'.php?action=subscribers&'.$l;}
					elseif($prot_page_info[4]=='20') 
					{
						if(isset($_SESSION['cur_pwd'.$_GET['pageid']])) $r_with='action=remcookie';
						else											$r_with='action=doedit';
						if(strpos($prot_page_name,'action=show')!==false)
							$load_page=str_replace('action=show',$r_with,$prot_page_name);
						else $load_page=$prot_page_name.'?'.$r_with;
					}
					elseif($prot_page_info[4]=='21') 
					{
						if(strpos($prot_page_name,'action=list')!==false) 
							$load_page=str_replace('action=list','action=orders',$prot_page_name);					
						else $load_page=$prot_page_name.'?action=orders';
					}
					else  {$load_page=$prot_page_name.'?action=index&'.$l;}
				}		
				elseif($prot_page_info[15]=='0' && ($prot_page_info[3]=='1' || $prot_page_info[3]=='0' && strpos($prot_page_info[1],'/SUB_')!==false) ) // FRAMES and SUBPAGE
				{
					if($prot_page_info[7]>0)
					{   
						$login_page_info=get_page_info($prot_page_info[7]);
						if(strpos($prot_page_info[1],'/SUB_')!==false)
						{
						  if(isset($login_page_info[3]) && $login_page_info[3]=='0') $load_page=str_replace('SUB_','',$load_page);
						}                   
						elseif(in_array($prot_page_info[4],$sp_pages_ids))
						{  
						  if(isset($login_page_info[3]) && $login_page_info[3]=='0') $load_page=str_replace('<id>','',$prot_page_info[10]).'.php';
						}					 
					}
				}
				if(isset($_GET['ref_url']))			{ $load_page=urldecode($_GET['ref_url']);  } //event manager
				if(strpos($prot_page_name,'../')===false) {$load_page='../'.$load_page;}
				ca_m_header($load_page,false); exit;
			}
		}
	}
}
process_admin();
?>
