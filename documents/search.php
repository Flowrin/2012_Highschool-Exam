<?php
$version = 'ezgenerator search 1.54';  
/*
  searcher.php ezgenerator search-site 
  http://www.ezgenerator.com
  Copyright (c) 2004-2008 Image-line
*/
error_reporting(E_ALL);
$proj_languages='English|';
$proj_languages_array=explode('|',$proj_languages);
array_pop($proj_languages_array);
$sitemap_fname='../sitemap.php';
$php_pages_ids=array('20','21','130','140','133','136','137','138','143','144');    
$max_line_chars=25000;
$internal_use=false; // for FL and EZG use 
$internal_fl_use=false; // for FL studio use only
$alternative_db_folder='flstudio7';		//  'fl7order'  // for FL studio use only --> DOES NOT work
$ext_indexing_dir='../Help/';				// for FL and EZG use only
$ext_indexing_fname='Index_Frame_Left.htm'; // for FL and EZG use only
$more_dirs_to_index=array('Help','Help/html'); 
$template_source_page='../documents/template_source.html';
// -------------------------------------------------------
function un_esc($s) 
{
	return  str_replace(array('\\\\','\\\'','\"'),array( '\\','\'','"' ),$s);
}
function esc($s)
{
	return (get_magic_quotes_gpc()?$s:str_replace(array('\\','\'','"'),array('\\\\','\\\'','\"'),$s));
}
function GFS($src,$start,$stop)
{
   if ($start=='') { $res=$src; }
   else if (strpos($src,$start)===false) { $res=''; return $res; }
   else { $res=substr($src,strpos($src,$start) + strlen($start)); }
   if (($stop!='') && (strpos($res,$stop)!==false))	{ $res=substr($res,0,strpos($res,$stop)); }
   return $res;
}
function GFSAbi($src,$start,$stop) 
{
   $res2=GFS($src,$start,$stop);
   return $start.$res2.$stop;
}
function get_sitemap_list($pageid='')		 // getting site pages list from sitemap.php
{ 
	global $sitemap_fname,$max_line_chars;
	
	$page=array();
	if(file_exists($sitemap_fname) && filesize($sitemap_fname)>0) 
	{
		$fp=fopen($sitemap_fname, 'rb' );
		while($data=fgetcsv($fp, $max_line_chars, '|'))
		{					
			if(strpos($data[0],'*/ ?>')===false && strpos($data[0],'<?php')===false) 
			{
				$data_str=implode('|', $data);
				if($pageid=='')  { if(strpos($data_str,'<id>')!==false)  {$page[]=$data;} }
				else { if(strpos($data_str,'<id>'.$pageid)!==false)  {$page[]=$data; break; } }
			}
		}
		fclose($fp);						
	}
	if(empty($page)) {echo "ERROR";}
	return $page;
}
function open_file($fname)
{
	$content='';
	if(file_exists($fname))
	{
		$fsize=filesize($fname);
		if($fsize>0)
		{
			$fp=fopen($fname,"r");
			$content=fread($fp,$fsize);
			fclose($fp);
		}
	}
	return $content;
}
function get_page_content($content, $abi=false)
{
	global $template_source_page;

	if(file_exists($template_source_page) && strpos($content,'%CONTENT%')!==false) { $content='%CONTENT%'; }
	elseif(strpos($content,'<!--page-->')!==false && $abi) { $content=GFSAbi($content,'<!--page-->','<!--/page-->'); }
	elseif(strpos($content,'<!--page-->')!==false ) { $content=GFS($content,'<!--page-->','<!--/page-->'); }
	else
	{
		if(strpos($content,'<BODY')!==false)  $tag='BODY';
		else	$tag='body';
		
		if(strpos($content,'</'.$tag.'>')!==false)	$pattern=GFS($content,'<'.$tag.'>','</'.$tag.'>');	
		else										$pattern=GFS($content,'<'.$tag.'>','</'.$tag.'>');		
		$body_start_tag=substr($pattern,0,strpos($pattern,'>')+1);
		if($abi) { $content=GFSAbi($content, $body_start_tag, '</'.$tag.'>'); }
		else	{ $content=GFS($content, $body_start_tag, '</'.$tag.'>'); }
	}
	return $content;
}
function get_file_content($fname)
{	
	$content=open_file($fname);	
	$content=get_page_content($content);			
	return $content;
}
function define_template_page() 
{
	global $sitemap_fname, $max_line_chars;
	$content='';
	$fname_buffer='';	
	$search_part='';
	
	if(isset($_POST['id']) || isset($_GET['id']))	{ $id=(isset($_POST['id'])?$_POST['id']:$_GET['id']); }
	if(file_exists($sitemap_fname) && filesize($sitemap_fname)>0) 
	{
		$fp=fopen($sitemap_fname,'r');
		while($data=fgetcsv($fp,$max_line_chars,'|')) 
		{
			if(isset($data[1]) && strpos($data[1],'http:')===false && strpos($data[1],'https:')===false && isset($data[10]))
			{
				if(isset($id)) 
				{
					if($data[10]=='<id>'.$id) 
					{
						if(in_array($data[4],array('136','137','138','143','144','20')))    // Special PHP pages
						{
							if($data[4]=='136')		$pat='../ezg_calendar';
							elseif($data[4]=='137')	$pat='../blog';
							elseif($data[4]=='138') $pat='../photoblog';
							elseif($data[4]=='143')	$pat='../podcast';
							elseif($data[4]=='144') $pat='../guestbook';

							if(strpos($data[1],'../')===false) { $f_dir=''; } 
							elseif($data[4]=='20') { $f_dir='../'.GFS($data[1],'../','/').'/'; }
							elseif(strpos($data[1],$pat)!==false) $f_dir='../documents/';
							elseif(strpos($data[1],'../')!==false) $f_dir='../'.GFS($data[1],'../','/').'/';

							if(($data[15]=='0') && ($data[3]=='1'))					// FRAMES and SUBPAGE
							{
								$fname_buffer=($data[6]=='TRUE'?$f_dir.'SUB_'.$id.'.php':$f_dir.'SUB_'.$id.'.html');
							}
							else { $fname_buffer=($data[6]=='TRUE'?$f_dir.$id.'.php':$f_dir.$id.'.html'); }
							$page_info = $data; break; 
						}			
						elseif(in_array($data[4],array('21','130','140')))          // shop and lister pages
						{ 
							if(strpos($data[1],'../')===false) { $f_dir=''; } 
							else { $f_dir = '../'.GFS($data[1],'../','/').'/'; }

							if (($data[15]=='0') && ($data[3]=='1'))		// FRAMES and SUBPAGE
							{
								$fname_buffer=$f_dir.'SUB_'.$id.'.html'; 
							}
							else  { $fname_buffer=$f_dir.$id.'.html';  }
							$page_info = $data; break; 
						}
						elseif(strpos($data[1],'.html')!==false) {$fname_buffer=$data[1]; $page_info=$data; break;} //normal page					
					}
				}
				else 
				{
					if(strpos($data[1],'.html')!==false) { $fname_buffer=$data[1]; $page_info=$data;  break; }
				}
			}
		}
		if(isset($id) && ($fname_buffer=='')) 
		{			
			$id = $id-1;
			while(($fname_buffer=='') && $id>0)
			{
				fseek($fp, 0);
				while ($data=fgetcsv($fp,$max_line_chars,'|')) 
				{
					if(isset($data[1]) && strpos($data[1],'http:')===false && strpos($data[1],'https:')===false && isset($data[10]) && $data[10]=='<id>'.$id) 
					{
						if(in_array($data[4],array('136','137','138','143','144','20')))    // Special PHP pages
						{	
							if($data[4]=='136')	$pat = '../ezg_calendar';
							elseif($data[4]=='137')	$pat = '../blog';
							elseif($data[4]=='138') $pat = '../photoblog';
							elseif($data[4]=='143')	$pat = '../podcast';
							elseif($data[4]=='144') $pat = '../guestbook';

							if(strpos($data[1],'../')===false) { $f_dir=''; } 
							elseif($data[4]=='20') { $f_dir='../'.GFS($data[1],'../','/').'/'; }
							elseif(strpos($data[1],$pat)!==false) $f_dir='../documents/';
							elseif(strpos($data[1],'../')!==false) $f_dir='../'.GFS($data[1],'../','/').'/';

							if (($data[15]=='0') &&($data[3]=='1'))					// FRAMES and SUBPAGE
							{
								$fname_buffer=($data[6]=='TRUE'?$f_dir.'SUB_'.$id.'.php':$f_dir.'SUB_'.$id.'.html');
							}
							else { $fname_buffer=($data[6]=='TRUE'?$f_dir.$id.'.php':$f_dir.$id.'.html'); }
							$page_info = $data; break;
						}			
						elseif(in_array($data[4],array('21','130','140')))    // shop and lister pages
						{
							if(strpos($data[1],'../')===false) { $f_dir=''; } 
							else { $f_dir='../'.GFS($data[1],'../','/').'/'; }

							if (($data[15]=='0') &&($data[3]=='1'))			// FRAMES and SUBPAGE
							{
								$fname_buffer=$f_dir.'SUB_'.$id.'.html'; 
							}
							else { $fname_buffer=$f_dir.$id.'.html';  }
							$page_info = $data; break;
						}
						elseif(strpos($data[1],'.html')!==false)		// normal page
						{ 
							$fname_buffer = $data[1]; $page_info = $data; break;
						}	
					}
				}
				$id = $id-1;
			}
		}
		if($fname_buffer=='') 
		{
			fseek($fp, 0);
			while ($data=fgetcsv($fp,$max_line_chars,'|')) 
			{	
				if(isset($data[1]) && strpos($data[1],'.html')!==false && strpos($data[1],'http:')===false && strpos($data[1],'https:')===false && isset($data[10]))
				{
					$fname_buffer = $data[1];
					$page_info = $data; break;					
				}
			}
		}
		fclose($fp);						
	}		 
	return $fname_buffer;
} 
function GT($fname_buffer,$html_output,$search_string ='',$id='',$page_charset='') 
{
	global $internal_fl_use;
	
	$content='';
	$search_part='';
	if(strpos($fname_buffer, '../')===false) { $fname_buffer_f='../'.$fname_buffer; }
	else { $fname_buffer_f=$fname_buffer; }
	
	$fp=fopen($fname_buffer_f, "r");
	$content=fread($fp, filesize($fname_buffer_f));
	fclose($fp);

	if(!empty($id))		
	{
		$content=str_replace(GFS($content,'charset=','"'),$page_charset,$content);
		if(strpos($content,'<!--search-->')!==false)
		{
			$search_part='<br>'.GFS($content,'<!--search-->','<!--/search-->');
			$search_part=str_replace('name="string"','name="string" value="' 
				.str_replace(array('\\"','"'),array('&#34;','&#34;'),un_esc($search_string)).'"',$search_part);
		}
	}
    $pattern=get_page_content($content);
	if($search_part!='') { $html_output=$search_part.$html_output; }

	if($internal_fl_use==true)
	{
		$html_output='<table class="main-p" width="952px" cellpadding="0" cellspacing="0"><tr valign="top"><td><h1>Search Result</h1></td></tr></table><table class="main-l" width="952px" cellpadding="0" cellspacing="16"><tr valign="top"><td width="100%"><p>'.$html_output.'</p></td></tr></table><p><img align="bottom" width="952" height="8" src="cap_main.gif" alt=""></p>';
		$content=str_replace($pattern, $html_output, $content);
	}
	else { $content=str_replace($pattern,$html_output,$content); }	
	//$content = str_replace(GFS($content, '<!--counter-->','<!--/counter-->'),'', $content);
	if(strpos($fname_buffer, '../')===false) { $content=str_replace('</title>','</title> <base href="http://'.$_SERVER['HTTP_HOST'].str_replace('documents', '', dirname($_SERVER['PHP_SELF'])).'">', $content); }
    return $content;
}
function checkfor_php_code($template_content)  // inserted php code handler
{
	$template_content = '?'.'>'.trim($template_content); //.'<'.'?'
	$template_content = preg_replace("'<\?xml(.*?)/>'si",'',$template_content);
	$rnd=GFSAbi($template_content,'<!--rnd-->','<!--endrnd-->');    //miro
	$template_content=str_replace($rnd,'',$template_content);
	eval($template_content);
}
function build_nav_bar($page,$search_string,$num_of_results,$n_pages,$l_page,$l_results,$l_from,$l_search,$id,$search_in_all,$gt_page) 
{
	if(strpos($gt_page,'../')===false) { $dir='documents/'; }
	else { $dir='../documents/'; }

	$body_section='<span class="rvts8">'.$l_page.'</span>&nbsp;';
	for($i=1; $i<=$n_pages; $i++) 
	{
		if($i==$page)	{$body_section.="<span class='rvts8'>$i</span>";}
		else 
		{
			$body_section.=' <a class="rvts12" href="'.$dir.'search.php?action=search' .(isset($id)?'&amp;id='.$id:'')
			.'&amp;string='.$search_string.'&amp;mr='.$num_of_results .'&amp;lr='.$l_results.'&amp;lp='.$l_page.'&amp;lf='.$l_from.'&amp;ls='
			.$l_search.'&amp;page='.$i.'&amp;sa='.$search_in_all.'">'.($i)."</a> ";
		}
	} 					
	return $body_section;
}
function remove_html_tags($html)
{	
	$search_main=array("'<\?php.*?\?>'si","'<script[^>]*?>.*?</script>'si","'<!--footer-->.*?<!--/footer-->'si", "'<!--search-->.*?<!--/search-->'si", "'<!--counter-->.*?<!--/counter-->'si","'<!--mmenu-->.*?<!--/mmenu-->'si","'<!--smenu-->.*?<!--/smenu-->'si","'<!--ssmenu-->.*?<!--/ssmenu-->'si");
	$result=preg_replace($search_main,array("","","","","","","",""),$html);

	$embed=GFSAbi($result,'<embed','</embed>');
	$object=GFSAbi($result,'<object','</object>');	
	$img=GFSAbi($result,'<img', '>');	
	$result=str_replace(array($embed,$object,$img),array('','',''),$result);
	$a=GFSAbi($result,'<a href="','">');
	$a1=GFSAbi($result,'<a href=','>');	
	$result=str_replace(array($a,$a1,'</a>'),array('','',''),$result);

	$search_more=array ("'<select[^>]*?>.*?</select>'si","'<[/!]*?[^<>]*?>'si","'\n'","'\r\n'","'&(quot|#34);'i","'&(amp|#38);'i","'&(lt|#60);'i", "'&(gt|#62);'i","'&(nbsp|#160);'i","'&(iexcl|#161);'i","'&(cent|#162);'i","'&(pound|#163);'i","'&(copy|#169);'i","'&#(d+);'e","'%%USER.*?%%'si", "'%%HIDDEN.*?HIDDEN%%'si","'%%DLINE.*?DLINE%%'si","'%%KEYW.*?%%'si");
	$replace_more=array (""," ","","","\"","&","<",">"," ",chr(161),chr(162),chr(163),chr(169),"chr(\1)","","","","");
	$result=preg_replace($search_more,$replace_more,$result);
	$result=str_replace('%%TEMPLATE1%%','',$result);
	return esc($result); 
}
function remove_macros($content, $id, $fields=array()) 
{
	if($id=='136')	//calendar
	{	
		$result=preg_replace(array("'%CALENDAR_OBJECT\(.*?\)%'si","'%CALENDAR_EVENTS\(.*?\)%'si","'%CALENDAR_.*?%'si"),array('','',''),$content);	
	}
	elseif($id=='137')	//blog
	{	
		$result=preg_replace(array ("'%BLOG_OBJECT\(.*?\)%'si","'%BLOG_ARCHIVE\(.*?\)%'si","'%BLOG_RECENT_COMMENTS\(.*?\)%'si","'%BLOG_RECENT_ENTRIES\(.*?\)%'si","'%BLOG_CATEGORY_FILTER\(.*?\)%'si", "'%BLOG_.*?%'si"),array ('','','','','',''),$content);					
	}
	elseif($id=='138')  //photoblog
	{	
		$result=preg_replace(array("'%BLOG_OBJECT\(.*?\)%'si","'%BLOG_EXIF_INFO\(.*?\)%'si","'%ARCHIVE_.*?%'si","'%BLOG_.*?%'si", "'%PERIOD_.*?%'si", "'%CATEGORY_.*?%'si"),array ('','','','','',''),$content);
	}
	elseif($id=='143') //podcast  
	{
		$result=preg_replace(array ("'%PODCAST_OBJECT\(.*?\)%'si","'%PODCAST_ARCHIVE\(.*?\)%'si","'%PODCAST_RECENT_COMMENTS\(.*?\)%'si","'%PODCAST_RECENT_EPISODES\(.*?\)%'si","'%PODCAST_CATEGORY_FILTER\(.*?\)%'si","'%PODCAST_OBJECT\(.*?\)%'si","'%PODCAST_.*?%'si"),array('','','','','','',''),$content);			
	}
	elseif($id=='144')  //guestbook
	{
		$content=preg_replace(array("'%GUESTBOOK_OBJECT\(.*?\)%'si","'%GUESTBOOK_ARCHIVE\(.*?\)%'si","'%GUESTBOOK_ARCHIVE_VER\(.*?\)%'si", "'%GUESTBOOK_.*?%'si"),array('','','',''),$content);
		$result=str_replace(array('%HOME_LINK%','%HOME_URL%'),array('',''),$content);				
	}
	elseif(in_array($id,array('21','130','140')))  //lister 
	{
		$a=array_fill(0,17,'');
		$content=preg_replace(array ("'%HASH\(.*?\)%'si","'%ITEMS\(.*?\)%'si","'%SCALE\(.*?\)%'si","'%SHOP_ITEM_DOWNLOAD_LINK\(.*?\)%'si","'%SHOP_CATEGORYCOMBO\(.*?\)%'si","'%SHOP_PREVIOUS\(.*?\)%'si","'%SHOP_NEXT\(.*?\)%'si","'%LISTER_CATEGORYCOMBO\(.*?\)%'si","'%LISTER_PREVIOUS\(.*?\)%'si","'%LISTER_NEXT\(.*?\)%'si","'<!--menu_java-->.*?<!--/menu_java-->'si","'<!--scripts2-->.*?<!--endscripts-->'si","'<!--<pagelink>/.*?</pagelink>-->'si","'<LISTER_BODY>.*?</LISTER_BODY>'si", "'<LISTERSEARCH>.*?</LISTERSEARCH>'si","'<SHOP_BODY>.*?</SHOP_BODY>'si", "'<SHOPSEARCH>.*?</SHOPSEARCH>'si","'%SHOP_.*?%'si","'%LISTER_.*?%'si","'%SLIDESHOWCAPTION_.*?%'si"),$a,$content); 
		$content=str_replace(array ('%ERRORS%','%IDEAL_VALID%','%QUANTITY%','%LINETOTAL%','%LINETOTAL%','%URL=Detailpage%','%CATEGORY_COUNT%','%SEARCHSTRING%'),array ('','','','','','','',''),$content);
		
		$a=array_fill(0,40,'');
		$result=str_replace(array ('<ITEM_VARS>','</ITEM_VARS>','<ITEM_VARS_LINE>','</ITEM_VARS_LINE>','<ITEM_HASHVARS>','</ITEM_HASHVARS>','<SHOP_DELETE_BUTTON>','</SHOP_DELETE_BUTTON>','<MINI_CART>','</MINI_CART>','<SHOP_BUY_BUTTON>','</SHOP_BUY_BUTTON>','<QUANTITY>','<RANDOM>','</RANDOM>','<SHOP>','</SHOP>','<LISTER>','</LISTER>','<ITEM_INDEX>','<ITEM_ID>','<ITEM_QUANTITY>','<ITEM_AMOUNT>','<ITEM_AMOUNT_IDEAL>','<ITEM_VAT>','<ITEM_SHIPPING>','<ITEM_CODE>','<ITEM_SUBNAME>','<ITEM_SUBNAME1>','<ITEM_SUBNAME2>','<ITEM_NAME>','<ITEM_CATEGORY>','<ITEM_VARS>','</ITEM_VARS>','<SHOP_URL>','<BANKWIRE>','</BANKWIRE>','<CATEGORY_HEADER>','</CATEGORY_HEADER>','<FROMCART>'),$a,$content);	

		if(!empty($fields))
		{
			foreach($fields as $k=>$v)	$result=str_replace('%'.$v.'%','',$result);
		}				
	} 
	$result=str_replace('%LINK_TO_ADMIN%','',$result);	
	return $result;
}	
function cut_content($haystack,$needle_pos,$key_words_s)
{		
	if(strlen($haystack)>400) 
	{
		$x = 0; 
		$y = 400;     
		while( ($needle_pos-$x>0) && (substr($haystack,$needle_pos-$x-1, 1)!='.') && (substr($haystack,$needle_pos-$x-1, 1)!='!') && (substr($haystack,$needle_pos-$x-1, 1)!='?') )		{ $x += 1; }  // $needle_pos+$y>strlen($haystack) ||
		while( (substr($haystack,$needle_pos+$y, 1)!=' ') && ($needle_pos+$y>$needle_pos) )   $y -= 1;  										
		$res_block = substr($haystack,$needle_pos-$x, $x + $y);	
	}
	else { $res_block = $haystack; } 

	if(strpos($key_words_s,'*')!==false)	{ $wildcardPos = strpos($key_words_s,'*'); $wc='*'; $key_words_s=str_replace($wc,'.\w*?',$key_words_s); }
	elseif(strpos($key_words_s,'?')!==false) { $wildcardPos = strpos($key_words_s,'?'); $wc='?'; $key_words_s=str_replace($wc,'.\w*?',$key_words_s); }
	else $wildcardPos = false;

	$res_block = preg_replace('/\b('.$key_words_s.')\b/i',' \0 ',$res_block);
	$res_block = preg_replace('/\b('.$key_words_s.')\W/i',' \0 ',$res_block);
	$res_block = preg_replace('/\W('.$key_words_s.')\b/i',' \0 ',$res_block);
	$res_block = preg_replace('/\W('.$key_words_s.')\W/i',' <span style="background: #FFFF40;"><b>\0</b></span> ',$res_block);	
	if($wildcardPos!==false)	
	{ 
		$res_block = preg_replace('/\W('.str_replace($wc,'',$key_words_s).')\W/i',' <span style="background: #FFFF40;"><b>\0</b></span> ',$res_block);	
	}
	$res_block = $res_block.(strlen($haystack)>100?" <b>...</b> ":" "); 							
	return $res_block;	
}	
function preg_pos($sPattern,$sSubject,&$occurances) 
{
	if(strpos($sPattern,'*')!==false)	{ $wildcardPos = strpos($sPattern,'*'); $wc='*'; }
	elseif(strpos($sPattern,'?')!==false) { $wildcardPos = strpos($sPattern,'?'); $wc='?'; }
	else $wildcardPos = false;
	
	if($wildcardPos!==false && $wildcardPos==strlen($sPattern)-1)	$sPattern_ = '/\W('.str_replace($wc,'',$sPattern).')/i';
	elseif($wildcardPos!==false && $wildcardPos==0)					$sPattern_ = '/('.str_replace($wc,'',$sPattern).')\W/i';
	elseif($wildcardPos!==false)									$sPattern_ = '/('.str_replace($wc,'.\w*?',$sPattern).')\W/i';
	else															$sPattern_ = '/\W('.$sPattern.')\W/i';
	
	$occurances = @preg_match_all($sPattern_,$sSubject,$aMat);
	if(@preg_match($sPattern_,$sSubject,$aMatches,PREG_OFFSET_CAPTURE)>0)  { return $aMatches[0][1]; }
	else {	return false; }	
}
function db_search($search_string,$pages_list,$language) 
{ 
	global $proj_languages_array, $max_line_chars;
	global $internal_fl_use, $alternative_db_folder;
		$result_pages = array();		
		$search_db_fname = array();
		$search_in_all = 'true';
		$fl = true;	

	foreach($proj_languages_array as $k=>$v)	// check for auto reindex
	{	
		$ff = '../documents/search_db_'.($k+1).'.ezg.php';
		if(file_exists($ff))
		{
			$fsize = filesize($ff); 
			if($fsize>0) 	{$fl = false;  break;}
		}
	}
	if($fl == true)		{reindex(true);}  
	
	if(isset($_POST['sa']))			{	$search_in_all = $_POST['sa'];	}
	elseif(isset($_GET['sa']))		{	$search_in_all = $_GET['sa'];	}	
	
	if(strpos($search_string,'"')!==false && strpos($search_string,'"')==0 && strrpos($search_string,'"')==strlen($search_string)-1 || strpos($search_string,'\"')!==false && strpos($search_string,'\"')==0 && strrpos($search_string,'\"')==strlen($search_string)-2) 
	{
		$key_words = array(substr($search_string,1,strlen($search_string)-2));
	}
	else { $key_words = (strpos($search_string,' ')!==false? explode(' ',$search_string): array($search_string));	 }
	
	$key_words_trimmed = array();
	foreach($key_words as $k=>$v)  { if($v!='') $key_words_trimmed [] = trim($v); }
	$key_words_s = implode('|', $key_words_trimmed);

	//---------------
	if($search_in_all=='true' || $search_in_all=='TRUE')
	{
		foreach($proj_languages_array as $k=>$v)	{$search_db_fname [] = '../documents/search_db_'.($k+1).'.ezg.php';	}
	}
	else											{$search_db_fname [] = '../documents/search_db_'.$language.'.ezg.php';	}
    
	if($internal_fl_use==true)  {$search_db_fname [] = '../../'.$alternative_db_folder.'/documents/search_db_1.ezg.php';} //fl only

	foreach($search_db_fname as $k=>$file)
	{	
		if(file_exists($file))
		{
			$fsize = filesize($file);
			if($fsize>0)
			{	
				$fp=fopen($file,'r');
				$content = fread($fp, $fsize);
				fclose($fp);	
				foreach($pages_list as $k=>$v) 
				{		
					$db_content = '';
					$flag = false;
					$page_id = str_replace('<id>', '', $v[10]);

					if(strpos($content, '<page_id_'.$page_id.'>')!==false) 
					{ 
						$page_info = GFS($content, '<page_id_'.$page_id.'>', '</page_id_'.$page_id.'>');
						$page_title = GFS($page_info, '<page_title>', '</page_title>');
						$page_url = GFS($page_info, '<page_url>', '</page_url>');
						$lm_date = GFS($page_info, '<page_date>', '</page_date>');

						if($internal_fl_use==true && (strpos('/flstudio7/', $file)!==false || strpos('/fl7order/', $file)!==false)) // fl only
						{
							if(strpos('/flstudio7/', $file)!==false)	$page_url = str_replace('../', '../../flstudio7/', $page_url);
							elseif(strpos('/fl7order/', $file)!==false) $page_url = str_replace('../', '../../fl7order/', $page_url);
						}

						$page_content = GFS($page_info, '<page_content>', '</page_content>');
						$page_content = un_esc($page_content);	
						$occurances_main = 0;
						preg_pos($key_words_s, $page_content, $occurances_main);
						
						$db_content = GFS($page_info, '<db_content>', '</db_content>');
						if($db_content!='') 
						{	
							$occurances = 0;
							$haystack = un_esc(urldecode($db_content));												
							$needle_pos = preg_pos($key_words_s, $haystack, $occurances);
							while($needle_pos!==false) 
							{	
								$page_url_fixed = $page_url;
								$entry_id = GFS(substr($haystack, $needle_pos),'</id_','_id>');
								$entry_data = GFS($haystack, '<id_'.$entry_id.'_id>','</id_'.$entry_id.'_id>');										$res_content = $entry_data;							

								if($v[4]=='136')	{ $page_url_fixed .= '?event_id='.$entry_id; }
								elseif($v[4]=='137')	{ $page_url_fixed .= '?entry_id='.$entry_id; }
								elseif($v[4]=='138')	{ $page_url_fixed .= '?photo_id='.$entry_id; }
								elseif($v[4]=='143')	{ $page_url_fixed .= '?entry_id='.$entry_id; }
								elseif($v[4]=='144')	{ $page_url_fixed .= '?entry_id='.$entry_id; }
								elseif(in_array($v[4], array('21', '130', '140')))
								{
									if(strpos($page_url_fixed,'action=list')!==false) 
										$page_url_fixed = str_replace('?action=list', '?cat='.$entry_id, $page_url_fixed);
									else $page_url_fixed=$page_url_fixed.'?cat='.$entry_id;
								}										
								if(!array_key_exists("$page_url_fixed", $result_pages))
								{	
									$occurances = 0;
									$fixed_pos = preg_pos($key_words_s, ' '.$res_content, $occurances); 
									$occurances += $occurances_main;
									$lm_date = GFS($res_content, '%%lm_', '_date%%');
									$res_content = str_replace('%%lm_'.$lm_date.'_date%%', '', $res_content);
									$res_content = cut_content($res_content, $fixed_pos, $key_words_s);
									$result_pages ["$page_url_fixed"]=array($page_title,$page_url_fixed,$res_content,$page_id,$lm_date,$occurances);
									if($flag != true) $flag = true;
								}	
								$haystack = str_replace('<id_'.$entry_id.'_id>'.$entry_data.'</id_'.$entry_id.'_id>', '', $haystack); 
								$needle_pos = preg_pos($key_words_s, $haystack, $occurances);
							}			 
						}				
						if($flag==false) 
						{
							$occurances = 0;
							$needle_pos = preg_pos($key_words_s, $page_content, $occurances);
							if($needle_pos!==false)
							{ 								
								if(!array_key_exists("$page_url" , $result_pages)) 
								{ //'../documents/search.php?page='.str_replace('../','',$page_url).'&amp;highlight='.urlencode($key_words_s)
									$result_pages ["$page_url"] = array($page_title, $page_url, cut_content($page_content, $needle_pos, $key_words_s), $page_id,$lm_date,$occurances);										
								}
							}
						}					
					}
				}
				if(strpos($content, '<ext_pages>')!==false)   
				{
					$ext_content = GFS($content, '<ext_pages>', '</ext_pages>');			
					while(strpos($ext_content,'<page_id_')!==false)
					{
						$occurances = 0;
						$page_info = GFS($ext_content,'<page_id', '</page_id');
						$page_title = GFS($page_info, '<page_title>', '</page_title>');
						$page_url = GFS($page_info, '<page_url>', '</page_url>');
						$lm_date = GFS($page_info, '<page_date>', '</page_date>');
						$page_content = GFS($page_info, '<page_content>', '</page_content>');
						$page_content = un_esc($page_content);
						
						$needle_pos = preg_pos($key_words_s, $page_content, $occurances);
						if($needle_pos!==false)
						{ 								
							if(!array_key_exists("$page_url" , $result_pages)) 
							{
								$result_pages ["$page_url"] = array($page_title, $page_url, cut_content($page_content, $needle_pos, $key_words_s), $page_url, $lm_date, $occurances);										
							}
						}
						$ext_content = substr($ext_content, strpos($ext_content, '</page_id')+9);
					}					
				}								
			}
		}
	}
	return $result_pages;
}
function process_search() 
{	
	global $proj_languages_array,$template_source_page;
		$body_section = '';
		$search_string = '';
		$id = '';
		$language = 1;
		$page_info = '';
	//$st_ts = mktime();
	$pages_list = get_sitemap_list();
	if(isset($_POST['id']) || isset($_GET['id']))			
	{		
		$id = (isset($_POST['id'])?$_POST['id']:$_GET['id']);
		foreach($pages_list as $k=>$v)
		{
			if(strpos($v[10],'<id>'.$id)!==false)  { $page_info = $v; break; }
		}
		if($page_info!='')	$language = array_search ($page_info[16],$proj_languages_array)+1;	
	}		

	if(isset($_POST['mr']) && !empty($_POST['mr']))		$num_of_results = $_POST['mr'];
	elseif(isset($_GET['mr']))							$num_of_results = $_GET['mr'];
	else												$num_of_results = 10; 

	if(isset($_POST['lr']) && !empty($_POST['lr']))		$l_results = $_POST['lr'];
	elseif(isset($_GET['lr']))							$l_results = $_GET['lr'];
	else												$l_results = 'Results:';

	if(isset($_POST['lp']) && !empty($_POST['lp']))		$l_page = $_POST['lp'];
	elseif(isset($_GET['lp']))							$l_page = $_GET['lp'];
	else												$l_page = 'Page';

	if(isset($_POST['lf']) && !empty($_POST['lf']))		$l_from = $_POST['lf'];
	elseif(isset($_GET['lf']))							$l_from = $_GET['lf'];
	else												$l_from = 'from';

	if(isset($_POST['ls']) && !empty($_POST['ls']))		$l_search = $_POST['ls'];
	elseif(isset($_GET['ls']))							$l_search = $_GET['ls'];
	else												$l_search = 'Search';

	if(isset($_GET['page']))		$page = $_GET['page'];
	else							$page = 1;

	if(isset($_POST['sa']))			$search_in_all = $_POST['sa'];	
	elseif(isset($_GET['sa']))		$search_in_all = $_GET['sa'];	
	else							$search_in_all = 'true';
	settype($page, "integer");
	settype($num_of_results, "integer");

	if(isset($_GET['string']) || isset($_POST['string']))
	{
		if(file_exists($template_source_page)) { $gt_page = $template_source_page; }
		else								{ $gt_page = define_template_page(); }
		$search_string = (isset($_POST['string'])?$_POST['string']:urldecode($_GET['string']));
		$search_string = un_esc(trim($search_string));	
		if($search_string!='') 
		{
			$results = db_search($search_string, $pages_list, $language);
			$body_section .= '<br><table style="width:100%;"><tr><td></td><td><h2>'.$l_results. ': '.$search_string.'</h2>'; 
			if(empty($results)) { $body_section .= '<br><span class="rvts10">- '.count($results)." -</span></td></tr>"; }
			else
			{
				$body_section .= '<br><span class="rvts9">'
				.(($page-1)*$num_of_results+1).' - ' .($num_of_results*$page>count($results)?count($results) :$num_of_results*$page) 
				.'</span> <span class="rvts10">'. $l_from.'</span> <span class="rvts9">'.count($results)."</span><br></td></tr>"; // (%%sr%% sec)

				if($num_of_results!=0)
				{
					$n_pages = (count($results)%$num_of_results==0? count($results)/$num_of_results: ceil(count($results)/$num_of_results));			if(count($results)>$num_of_results) 
					{
						$body_section .= '<tr><td></td><td align="right">'. build_nav_bar($page,urlencode($search_string),$num_of_results,$n_pages,$l_page,$l_results,$l_from,$l_search,$id,$search_in_all,$gt_page).'<br></td></tr>';	
					}
				}
				if(count($results)>$num_of_results && $num_of_results!=0) 
				{
					$results_cut = array_slice($results,($page-1)*$num_of_results,$num_of_results);
				}
				else { $results_cut = $results; }
				
				$counter = ($page-1)*$num_of_results;
				foreach($results_cut as $k=>$v) 
				{
					$counter++;
					$lm_date = '';
					if(isset($v[4]) && !empty($v[4])) 
					{
						if(strpos($v[4],'-')!==false) 
						{
							list($year,$month,$day) = explode('-',$v[4]);
							$lm_date = date('j M Y', mktime(0,0,0,(integer)$month,(integer)$day,(integer)$year)).' - ';
						}
						else $lm_date = date('j M Y', $v[4]).' - ';
					}
					if(strpos($gt_page, '../')===false) { $url = str_replace('../','',$v[1]);  }
					else { if(strpos($v[1], '../')===false) {$url = '../'. $v[1];} else {$url = $v[1];} }
					$body_section .= "<tr><td valign='top'><span class='rvts1'>".$counter.". </span></td>"
					."<td><a class='rvts4' href='".$url."'>".$v[0]."</a><br>"	
					."<span class='rvts8'>".$v[2]."</span><br>" 
					."<span class='rvts10'># ".$v[5].' - '.$lm_date."URL: http://" .str_replace('documents','',$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])) .str_replace('../','',$v[1])."</span><br><br></td></tr>"; 
				}
			}
			$body_section .= '</table>';
			//$end_ts = mktime();
			//var_dump($st_ts);  var_dump($end_ts);
			//$body_section = str_replace('%%sr%%',($end_ts-$st_ts)/1000,$body_section); 	
		}
	}
    if(isset($page_info[17])){$pi=$page_info[17];} else $pi=''; //miro 
	$body_section = GT($gt_page, $body_section, $search_string,$id,$pi);
	if(strpos($body_section, '<'.'?php')===false && strpos($body_section, '<'.'?')===false) { print $body_section; }
	else { checkfor_php_code($body_section); }
}
function extract_all_records($fname, $id) 
{
	global $max_line_chars;
		$records=array();
	
	clearstatcache();
	if(file_exists($fname))
	{	
		$fsize=filesize($fname);
		if($id=='144') 
		{
			$records='';
			if($fsize>0)
			{
				$fp=fopen($fname,'r');
				$data=fread( $fp,$fsize);
				$records=GFS($data,"<entries>","</entries>");
				fclose($fp);
			}
			if($records!='') {	$records = format_records_in_array2($records);	}
		}
		else 
		{	
			$last_line =  "*/ ?>";		
			$records = array();
			if($fsize>0)
			{
				$fp=fopen($fname, 'r' );
				$php_start=fgetcsv($fp, 2048);  
				$db_field_names=fgetcsv($fp, 2048);
				while ($data=fgetcsv($fp,$max_line_chars)) 
				{    
					if ($data[0]!=$last_line) {  $records[] = format_records_in_array1($data, $db_field_names);   }
				}
				fclose($fp);
			}
		}
	}		
	return $records;
} 
function extract_specific_record($fname, $id, $entry_id) 
{
	global  $max_line_chars;
		$records = array();
		$records_arr = array();
	
	clearstatcache();
	if (file_exists($fname))
	{
		$fp = fopen($fname, 'r' );
		if($id=='144') 
		{
			$records_str = '';
			$fsize = filesize($fname);
			if($fsize > 0)
			{
				$fp = fopen($fname, 'r' );
				$data = fread( $fp,$fsize);
				$records_str = GFS($data,"<entries>","</entries>");
				fclose($fp);
			}
			if($records_str!='') {	$records_arr = format_records_in_array2($records_str);	}
			if(!empty($records_arr))
			{
				foreach($records_arr as $k=>$v) 
				{
					if(in_array($entry_id,$v)) { $records [] = $v; break; }
				}
			}
		}
		else 
		{
			$last_line =  "*/ ?>";		
			$records = array();
			$fp = fopen($fname, 'r' );
			$php_start = fgetcsv($fp, 2048);  
			$db_field_names = fgetcsv($fp, 2048);
			while ($data = fgetcsv($fp, $max_line_chars)) 
			{    
				if ($data[0]!=$last_line)
				{         
					if ($data[0]==$entry_id) { $records[] = format_records_in_array1($data, $db_field_names);break; }
					else { continue; }
				}
			}
			fclose($fp);
		}
	}		
	return $records;
} 
function format_records_in_array1($value,$key) 
{
	$output = array();
	foreach($key as $k=>$v) 
	{
		$output[$v] = current($value);
		next($value);
	}
	return $output;
}
function format_records_in_array2($records) 
{
	$entries_array = array();
	$i = 1;
	
	while (strpos($records, '<entry id="'.$i.'">')!==false) 
	{
		$comments_buff = array();
		$main_buffer ['id'] = $i;

		$record = '<entry id="'.$i.'">'. GFS($records, '<entry id="'.$i.'">', '</entry>').'</entry>';
		$entry_part = GFS($record, '<entry id="'.$i.'">', '<comments_data>');
		$comments_part = GFS($record, '<comments_data>', '</comments_data>');
		$entry_timetsamp = GFS ($entry_part, "<timestamp>", "</timestamp>");

		while (strpos($entry_part, '<')!==false) 
		{
			$element_name = GFS ($entry_part, '<', '>');
			$element_value = GFS ($entry_part, "<$element_name>", "</$element_name>");			
			$main_buffer [$element_name] = $element_value;
			$entry_part = str_replace("<$element_name>$element_value</$element_name>", '',$entry_part);
		}
		$j = 1;
		while (strpos($comments_part, '<comment id="'.$j.'">')!==false) 
		{
			$buff = array();
			$comment_str = GFS($comments_part, '<comment id="'.$j.'">', '</comment>');
			while (strpos($comment_str, '<')!==false) 
			{
				$element_name = GFS ($comment_str, '<', '>');
				$element_value = GFS ($comment_str, "<$element_name>", "</$element_name>");			
				$buff [$element_name] = $element_value;
				$comment_str = str_replace("<$element_name>$element_value</$element_name>", '',$comment_str);
			}
			$buff['entry_id'] = $entry_timetsamp;
			$comments_buff [] = $buff;
			$j++;
		}
		$main_buffer ['comments'] = $comments_buff;
		$entries_array [] = $main_buffer;
		$i++;
	}
	return $entries_array;
}
function reindex($auto=false)
{
	global $proj_languages_array, $php_pages_ids, $max_line_chars,$template_source_page;
	global $more_dirs_to_index, $ext_indexing_dir, $ext_indexing_fname, $internal_use;
		$output = '';		

	foreach($proj_languages_array as $kkk=>$vvv)
	{
		$buffer = '';
		clearstatcache();
		$search_db_fname = '../documents/search_db_'.($kkk+1).'.ezg.php';

		if(file_exists($search_db_fname))
		{
			$page_reindex = (isset($_GET['pid']) && filesize($search_db_fname)>0? true: false);
			if($page_reindex) { $pages_list = get_sitemap_list($_GET['pid']); } 
			else	{ $pages_list = get_sitemap_list(); }

			if(!$page_reindex) $buffer .= "<?php echo 'hi'; exit; /* ";
			foreach($pages_list as $k=>$v)
			{
				$p_lang = array_search ($v[16], $proj_languages_array);
				$page_title = (strpos($v[0],'#')!==false && strpos($v[0],'#')==0? str_replace('#','',$v[0]): $v[0]);
				$id = str_replace('<id>', '', $v[10]);
																							
   				if(strpos($v[1],'http:')===false && strpos($v[1],'https:')===false && $p_lang==$kkk && $v[20]=='FALSE')//ignore 'HIDDEN in search'
				{					
					if(!in_array($v[4],$php_pages_ids))		// for NORMAL pages and PHP REQUEST pages
					{
						$main_fname = (strpos($v[1],'../')===false?'../'.$v[1]:$v[1]);
						$content = open_file($main_fname);	
						$lm_date = GFS($content,'<meta name="date" content="','">');
						$content = get_page_content($content);	
						$content = remove_html_tags($content);
						$buffer .= '<page_id_'.$id.'><page_title>'.$page_title.'</page_title><page_date>'.$lm_date.'</page_date><page_url>'
							.$v[1].'</page_url><page_content>'.$content.'</page_content></page_id_'.$id.'>';
					}
					else									// for special PHP pages 
					{	
						$db_part = '';
						if(in_array($v[4], array('20','21','130','140'))) 
						{
							if(strpos($v[1],'../')===false) { $dir='../'; } 
							else							{ $dir='../'.GFS($v[1],'../','/').'/'; }	
							if($v[4]=='20')	{ $main_fname=($v[6]=='TRUE'? $dir.$id.'.php': $dir.$id.'.html'); }
							else			{ $main_fname=$dir.$id.'.html'; }
							$content=get_file_content($main_fname);
							$content=remove_html_tags($content);
							
							if($v[4]=='20')		// online editable page
							{	
								$new_db_flag=false;
								$main_db_content='';
								$new_db_file='../ezg_data/'.$id.'.ezg.php';
								if(file_exists($new_db_file)) $new_db_flag=true;
								if($new_db_flag)	{ $db_fname=$new_db_file; }
								else				{ $db_fname=$dir.$id.'_main.ezg'; }
								$lm_date=array(filemtime($db_fname));
								if(file_exists($db_fname))
								{ 
									$fsize=filesize($db_fname);
									if($fsize>0)
									{
										$fp=fopen($db_fname,"r");
										$main_db_content=fread($fp,$fsize);
										fclose($fp);
									}
								}	
								if($new_db_flag)
								{
									while(strpos($main_db_content,'<ea_')!==false)
									{
										$area_id=GFS($main_db_content,'<ea_','>');
										$area=GFS($main_db_content,'<ea_'.$area_id.'>','</ea_'.$area_id.'>');
										$db_part.=$area;
										$main_db_content=str_replace('<ea_'.$area_id.'>'.$area.'</ea_'.$area_id.'>','',$main_db_content);
									}
								}
								else 
								{
									$db_part=$main_db_content;						
									$i=1;
									while(file_exists($dir.$id.'_'.$i.'.ezg')) 
									{
										$db_fname=$dir.$id.'_'.$i.'.ezg';
										$fsize=filesize($db_fname);
										if($fsize>0)
										{
											$fp=fopen($db_fname,"r");
											$add_part=fread($fp, $fsize);
											fclose($fp); 
											$db_part.=' '.$add_part;
										}
										$i++;	
										$lm_date[]=filemtime($db_fname);
									}
								}
								$content.=' '.remove_html_tags($db_part);
								$buffer.='<page_id_'.$id.'><page_title>'.$page_title.'</page_title><page_date>'.max($lm_date).'</page_date> <page_url>'.$v[1].'</page_url><page_content>'.$content.'</page_content></page_id_'.$id.'>';
							}
							else				// lister and shop pages
							{																				
								$fields=array();
								$db_fname = $dir.$id.'_0.dat';
								if(filesize($db_fname)>0)
								{
									$fp = fopen($db_fname,"r");
									while ($data = fgetcsv($fp, $max_line_chars)) 
										{  $categories [] = substr($data[0],0,strpos($data[0],'##')); }  
									fclose($fp);
								}					
								$i = 1;
								while(file_exists($dir.$id.'_'.$i.'.dat')) 
								{
									$db_fname = $dir.$id.'_'.$i.'.dat';
									$db_part .= '<id_'.$i.'_id>';
									if(filesize($db_fname)>0)
									{
										$fp = fopen($db_fname, "r");
										$fields = fgetcsv($fp, $max_line_chars,'|');
										$t = fgetcsv($fp, $max_line_chars,'|');
										while ($item_record = fgetcsv($fp, $max_line_chars,'|')) 
										{   											
											foreach($item_record as $kk=>$vv)
											{
												if($vv!='')		{	$db_part .= remove_html_tags($vv).' ';	}
											}										
										}	
										fclose($fp); 						
									}
									$db_part .= '%%lm_'.filemtime($db_fname).'_date%%';
									$db_part .= '</id_'.$i.'_id>';
									$i++;					
								}	
								$db_part = preg_replace("'%SLIDESHOWCAPTION_.*?%'si", "", $db_part);
								$content = remove_macros($content, $v[4], $fields);
								if(in_array($v[4], array('21','130','140'))) 
								{
									if($v[4]=='21')									{ $limit = 4;	}
									elseif(in_array($v[4], array('130','140')))	{ $limit = 2;	}
									
									for($i=1; $i<=$limit; $i++)
									{
										$add_content = get_file_content($dir.($id+$i).'.html');
										$add_content = remove_html_tags($add_content);
										$content .= ' '.remove_macros($add_content,$v[4],$fields);
									}
								}
								$buffer .= '<page_id_'.$id.'><page_title>'.$page_title.'</page_title><page_url>'.$v[1].'</page_url><page_content>'
								.$content.'</page_content><db_content>'.$db_part.'</db_content></page_id_'.$id.'>';
							}
						}	
						elseif(in_array($v[4],array('133')))			// subscribe page
						{
							if(strpos($v[1],'../')===false) { $dir = '../'; } 
							else { $dir = '../'.GFS($v[1],'../','/').'/'; }

							if(empty($v[9]))						{ $fname =($v[6]=='TRUE'? $dir.$id.'.php': $dir.$id.'.html');  }
							elseif(strpos($v[9],'.')===false)		{ $fname =($v[6]=='TRUE'? $dir.$v[9].'.php': $dir.$v[9].'.html'); }	
							else									{ $fname = $dir.$v[9];  }							
							$content = open_file($fname);	
							$lm_date = GFS($content,'<meta name="date" content="','">');
							$content = get_page_content($content);		
							$content = remove_html_tags($content); 
							$buffer .= '<page_id_'.$id.'><page_title>'.$page_title.'</page_title><page_date>'.$lm_date.'</page_date><page_url>'.$v[1]. '</page_url><page_content>'.$content.'</page_content></page_id_'.$id.'>';
						}
						elseif(in_array($v[4],array('136','137','138','143','144')))  //blog, pblog, cal, podcast, guestbook
						{
							if($v[4]=='136')	 $pat = '../ezg_calendar';
							elseif($v[4]=='137') $pat = '../blog';
							elseif($v[4]=='138') $pat = '../photoblog';
							elseif($v[4]=='143') $pat = '../podcast';
							elseif($v[4]=='144') $pat = '../guestbook';

							if(strpos($v[1],'../')===false) { $dir='../'; } 
							elseif(strpos($v[1],$pat)!==false) $dir='../documents/';
							elseif(strpos($v[1],'../')!==false) $dir='../'.GFS($v[1],'../','/').'/';
							$main_fname =($v[6]=='TRUE'? $dir.$id.'.php': $dir.$id.'.html');  	
							$content = get_file_content($main_fname);	
							
							if($v[4]=='138')
							{
								$fname_arch = $dir.($id+1).'.html';
								$content .= get_file_content($fname_arch);				
							}
							$content = remove_html_tags($content); 	
							$content = remove_macros($content, $v[4]); 
							$dir = '../'.GFS($v[1],'../','/').'/';

							if(in_array($v[4], array('137', '138', '143')))		// blog, photoblog, podcast
							{	
								$db_fname = $pat.'/'.$id.'_db_blog_entries.ezg.php';
								if(!$page_reindex)				{ $entries_records = extract_all_records($db_fname, $v[4]);}
								elseif(isset($_GET['entryid'])) { $entries_records = extract_specific_record($db_fname, $v[4],$_GET['entryid']);}	
								
								if(!empty($entries_records)) 
								{
									foreach ($entries_records as $key=>$val) 
									{
										$db_part .= '<id_'.$val['Id'].'_id>'.remove_html_tags(urldecode($val['Title']));
										if($v[4]=='143') 
										{
											if(!empty($val['Subtitle'])){ $db_part .= ' '.remove_html_tags(urldecode($val['Subtitle'])); }
											if(!empty($val['Author']))	{ $db_part .= ' '.remove_html_tags(urldecode($val['Author'])); }	
										}
										if(!empty($val['Content'])) { $db_part .= ' '.remove_html_tags(urldecode($val['Content']));}
										$db_part .= '%%lm_'.$val['Last_Modified'].'_date%%';
										$db_part .= '</id_'.$val['Id'].'_id>';
									}
								}
								if(!empty($db_part))
								{
									$comments_records = extract_all_records($pat.'/'.$id.'_db_blog_comments.ezg.php', $v[4]);
									if (!empty($comments_records)) 
									{
										foreach ($comments_records as $key=>$val) 
										{
											$m = '</id_'.($v[4]=='138'?$val['Photo_Id']:$val['Entry_Id']).'_id>';
											$db_part = str_replace($m,' '.remove_html_tags(urldecode($val['Visitor'])).$m, $db_part); 
											if(!empty($val['Comments']))	
											{	
												$db_part = str_replace($m,' '.remove_html_tags(urldecode($val['Comments'])).$m, $db_part); 
											}
										}
									}
								}
							}
							elseif(in_array($v[4], array('136')))   // calendar
							{
								$db_fname = $pat.'/'.$id.'_cal_events.ezg.php';
								if(!$page_reindex)				{ $entries_records = extract_all_records($db_fname,$v[4]);}
								elseif(isset($_GET['entryid'])) { $entries_records = extract_specific_record($db_fname,$v[4],$_GET['entryid']);}
																
								if(!empty($entries_records)) 
								{
									foreach($entries_records as $key=>$val) 
									{			
										$db_part .= '<id_'.$val['Id'].'_id>'.remove_html_tags(urldecode($val['Short_description']));
										if(!empty($val['Details'])) { $db_part .= ' '.remove_html_tags(urldecode($val['Details'])); }
										if(!empty($val['Location'])) { $db_part .= ' '.remove_html_tags(urldecode($val['Location'])); }
										$db_part .= '%%lm_'.filemtime($db_fname).'_date%%';
										$db_part .= '</id_'.$val['Id'].'_id>';														
									}
								}					
							}
							elseif(in_array($v[4], array('144')))   // guestbook
							{	
								$db_fname = $pat.'/'.$id.'_db_guestbook.ezg.php';
								if(!$page_reindex)				{ $entries_records = extract_all_records($db_fname,$v[4]);}
								elseif(isset($_GET['entryid'])) {$entries_records = extract_specific_record($db_fname,$v[4],$_GET['entryid']);}
								
								if(!empty($entries_records)) 
								{
									foreach ($entries_records as $key=>$val) 
									{			
										$db_part .= '<id_'.$val['timestamp'].'_id>'.remove_html_tags(urldecode($val['name']));		if(!empty($val['surname']))		{	$db_part .=  ' '.remove_html_tags(urldecode($val['surname']));	}
										$db_part .=  ' '.remove_html_tags(urldecode($val['content'])); 
										if(!empty($val['country']))		{	$db_part .=  ' '.remove_html_tags(urldecode($val['country']));	}										
										foreach($val['comments'] as $ka=>$va) 
										{
											if(!empty($va)) 
											{
												$db_part .= ' '.remove_html_tags(urldecode($va['visitor']));		
												$db_part .= ' '.remove_html_tags(urldecode($va['comments'])); 
											}
										}
										$db_part .= '%%lm_'.$val['timestamp'].'_date%%';
										$db_part .= '</id_'.$val['timestamp'] .'_id>';
									}
								}					
							}
							if(!$page_reindex)
							{	
								$buffer .= '<page_id_'.$id.'><page_title>'.$page_title.'</page_title><page_url>'.$v[1].'</page_url><page_content>' .$content.'</page_content>' .'<db_content>'.$db_part.'</db_content>'.'</page_id_'.$id.'>';
							}
							else { $buffer .= $db_part; }
						}
					}
				}
			}
			if(!$page_reindex)
			{
				$buffer .= '<ext_pages>';
				if(!empty($more_dirs_to_index))
				{
					$file_list = array();
					foreach($more_dirs_to_index as $d_k=>$d_v)
					{
						$dir_to_index = '../'.$d_v;
						if(is_dir($dir_to_index))
						{
							$handle = opendir($dir_to_index);				
							while($file = readdir($handle)) //problem with php pages
							{ 
							  if( ($file!='.') && ($file!='..') && (strpos($file,".htm")!==false || strpos($file,".php")!==false || strpos($file,".HTM")!==false || strpos($file,".PHP")!==false) )  { $file_list[] = $dir_to_index.'/'.$file; }
							}
						}
					}
					foreach($file_list as $f_k=>$f_v)
					{
						if(file_exists($f_v) && filesize($f_v)>0)
						{
							$p_content = open_file($f_v);
							$p_title = GFS($p_content,'<title>','</title>');
							if(empty($p_title)) { $p_title = GFS($p_content,'<TITLE>','</TITLE>'); }
							if(empty($p_title)) { $p_title = GFS($p_content,'<p class="pagetitle">','<p>'); }
							if(empty($p_title)) { $p_title = $f_v; }	
							$p_title = remove_html_tags($p_title);
							$lm_date = GFS($p_content,'<meta name="date" content="','">');
							if(empty($lm_date)) { $lm_date = GFS($p_content,'<META name="date" content="','">'); }
							if(empty($lm_date)) { $lm_date = filemtime($f_v); }
							$p_content = get_page_content($p_content);
							$p_content = remove_html_tags($p_content);						
							$buffer .= '<page_id_'.$f_v.'><page_title>'.$p_title.'</page_title><page_date>'.$lm_date.'</page_date><page_url>'.$f_v. '</page_url><page_content>'.$p_content.'</page_content></page_id_'.$f_v.'>';
						}
					}
				}
				if($internal_use == true && $kkk==0) //FL and EZG only
				{	
					$links = array();
					$f = $ext_indexing_dir.$ext_indexing_fname;
					if(file_exists($f)&& filesize($f)>0)
					{					
						$fp = fopen($f, 'r');
						$fsize = filesize($f);			
						$file_contents = fread($fp,$fsize);	
						fclose($fp);
						while(strpos($file_contents,'<A HREF="')!==false)
						{
							$link = GFS($file_contents,'<A HREF="','">');
							$title = GFS($file_contents,'<A HREF="'.$link.'">','</A>');
							$links [$title] = $ext_indexing_dir.str_replace('%20',' ',$link);
							$file_contents = substr($file_contents, strpos($file_contents,'<A HREF="')+9);
						}
						foreach($links as $m=>$url)
						{
							$p_content = open_file($url);
							$lm_date = GFS($p_content,'<meta name="date" content="','">');
							if(empty($lm_date)) { $lm_date = GFS($p_content,'<META name="date" content="','">'); }
							if(empty($lm_date)) { $lm_date = filemtime($f_v); }
							$p_content = get_page_content($p_content);
							$p_content = remove_html_tags($p_content);
							$buffer .= '<page_id_'.$url.'><page_title>'.$m.'</page_title><page_date>'.$lm_date.'</page_date><page_url>'.$url. '</page_url><page_content>'.$p_content.'</page_content></page_id_'.$url.'>';	
						}				
					}
				}
				$buffer .= '</ext_pages>';
				$buffer .= " */ ?>";
			}
			if(!empty($buffer))
			{
				if(!$page_reindex) { $fp = fopen($search_db_fname,"w"); }
				else				{ $fp = fopen($search_db_fname,"r+");  }
				flock($fp, LOCK_EX); 
				if($page_reindex) 
				{ 
					$db_existing_content = fread($fp,filesize($search_db_fname)); 	
					if(isset($_GET['entryid']) && strpos($db_existing_content,'<page_id_'.$_GET['pid'].'>')!==false) 
					{
						$page_for_repl = GFSAbi($db_existing_content,'<page_id_'.$_GET['pid'].'>','</page_id_'.$_GET['pid'].'>');
						if(strpos($page_for_repl,'<id_'.$_GET['entryid'].'_id>')!==false)
						{ 
							$for_repl = GFSAbi($page_for_repl,'<id_'.$_GET['entryid'].'_id>','</id_'.$_GET['entryid'].'_id>');
							$db_existing_content=str_replace($for_repl,$buffer,$db_existing_content);
						}
						else
						{ 
							$buffer = str_replace('</db_content>',$buffer.'</db_content>',$page_for_repl);
							$db_existing_content=str_replace($page_for_repl,$buffer,$db_existing_content);
						}
						
					}
					else  { break; }
					$buffer = $db_existing_content;
					ftruncate($fp,0);
					fseek($fp,0);
				} 	
				if(fwrite($fp, $buffer) === FALSE) { print "Cannot write to file ($search_db_fname)"; exit;} 
				flock($fp, LOCK_UN);
				fclose($fp);
				$output = "<span class='rvts8'>Site Search index successfully reindexed!</span><br>";
			}
		}
		elseif($auto==false && !isset($_GET['redirect'])) {$output="<span class='rvts8'>File $search_db_fname reindex FAILED!</span><br>";}	
	}	
	if($auto==false && !isset($_GET['redirect'])) 
	{ 
		if(file_exists($template_source_page)) { $gt_page = $template_source_page; }
		else								{ $gt_page = define_template_page(); }
		$output = GT($gt_page,$output);
		if(strpos($output, '<'.'?php')===false && strpos($output, '<'.'?')===false) { print $output; }
		else { checkfor_php_code($output); }
	}
	if(isset($_GET['redirect']))  // auto reindex after online update
	{
		$redirect_url = urldecode($_GET['redirect']);
		m_header('../'.$redirect_url,false); 
	}
}
function m_header($url,$td)
{
  if(false) echo '<meta http-equiv="refresh" content="0;url='.$url.' " />';
  else
  {
  if($td) header("HTTP/1.0 307 Temporary redirect");
  header("Location: $url");
  }
}
function process() 
{
	global $version;
		$action_id = 'searchform';

	if (isset($_GET['action'])) $action_id = $_GET['action'];
	else if (isset($_POST['action'])) $action_id = $_POST['action'];

	if ($action_id == "search")  {  process_search(); }
	elseif ($action_id == "reindex")  {  reindex(); }  
	elseif($action_id == "version") {   echo $version; }
	/*elseif(isset($_GET['page']) && isset($_GET['highlight']))
	{
		$result_page = '../'.$_GET['page'];
		$f_content = open_file($result_page);
		if(strpos($_GET['page'], '/')===false) { $f_content = str_replace('</title>', 
			'</title> <base href="http://'.$_SERVER['HTTP_HOST'].str_replace('documents','',dirname($_SERVER['PHP_SELF'])).'">',$f_content); }
		$p_content = get_page_content($f_content, true);
		
		$key_words_s = urldecode($_GET['highlight']);
		//$key_words_s = preg_quote($key_words_s);
		if(strpos($key_words_s,'*')!==false)	
			{ $wildcardPos = strpos($key_words_s,'*'); $wc='*'; $key_words_s = str_replace('*', '.w*?', $key_words_s); }
		elseif(strpos($key_words_s,'?')!==false) 
			{ $wildcardPos = strpos($key_words_s,'?'); $wc='?'; $key_words_s = str_replace('?', '.\w*?', $key_words_s); }
		else { $wildcardPos = false; }

		$pattern = '$1$2<span style="background: #FFFF40;">$3</span>$4$5';
		//$h_content=preg_replace('#(<[^/][^>]*>.*?\b|\W)('.$key_words_s.')(b|\W</[^>]*>)?#msi', $pattern, $p_content);
		$h_content=preg_replace('#(<[^/][^>]*>)(.*?)('.$key_words_s.')(.*?)(</[^>]*>)?#msi', $pattern, $p_content);
		if($wildcardPos!==false)	
		{ 
			$h_content = preg_replace('#(<[^/][^>]*>)(.*?)('.str_replace($wc,'',$key_words_s).')(.*?)(</[^>]*>)?#msi', $pattern, $h_content);	
		}
		$f_content = str_replace($p_content,$h_content,$f_content);
		print $f_content;
	}*/
}

process();

?>
