<?php
return array(
	//'配置项'=>'配置值'
	'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名配置
	'APP_SUB_DOMAIN_RULES'    =>    array(   
	    'admin.xinmei6.com'  => 'Admin',  
	    'www.domain.com'   => 'Home',  
	    'cs.domain.com'   => 'User',  
			),
	'MODULE_ALLOW_LIST'    =>    array('Home','Admin','User'),
	'DEFAULT_MODULE'       =>    'Home',  // 默认模块
		// 模板定界符
	'TMPL_L_DELIM'			=>	'{{',
	'TMPL_R_DELIM'			=>	'}}'


);