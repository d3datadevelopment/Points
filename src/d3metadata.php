<?php ?><?php /** This Software is the property of D³ Data Development and is protected by copyright law - it is NOT Freeware.  Any unauthorized use of this software without a valid license key is a violation of the license agreement and will be prosecuted by civil and criminal law.  Inhaber: Thomas Dartsch Alle Rechte vorbehalten  @package Bonuspunkte @version 5.0.3.1 SourceGuardian (05.07.2022) @author  Daniel Seifert support@shopmodule.com @copyright (C) 2022, D3 Data Development @see https://www.d3data.de */ ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='https://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"https://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
