<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Bonuspunkte @version 5.0.3.2 SourceGuardian (07.03.2023) @author  Markus Gärtner support@shopmodule.com @copyright (C) 2023, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
