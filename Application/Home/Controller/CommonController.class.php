<?php

namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller
{
	// 用户
	protected $user;

	/**
	 * [__construt 构造方法]
	 */
	protected function _initialize()
	{
		// 视图初始化
		$this->ViewInit();
	}

	/**
	 * [ajaxReturn 重写ajax返回方法]
	 * @param    [string]       $info  [提示信息]
	 * @param    [int]          $code  [状态码]
	 * @param    [mixed]        $data  [数据]
	 * examples $this->ajaxReturn($result,"新增成功！",0);
	 *			$this->ajaxReturn(0,"新增错误！",-100);
	 *			$data['code'] = 1;
	 *			$data['msg'] = 'info';
	 *			$data['size'] = 9;
	 *			$data['url'] = $url;
	 *			$this->ajaxReturn($data,'JSON');
	 */
	protected function ajaxReturn($data=array(),$type='') {
	    if(func_num_args()>2) {
	      $args      =  func_get_args();
	      array_shift($args);
	      $info      =  array();
	      $info['data']  =  $data;
	      $info['msg']  =  array_shift($args);
	      $info['code'] =  array_shift($args);
	      $data      =  $info;
	      $type      =  $args?array_shift($args):'';
	    }
	    if(empty($type)) $type =  C('DEFAULT_AJAX_RETURN');
	    header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		header('Access-Control-Allow-Methods: GET, POST, PUT');
	    if(strtoupper($type)=='JSON') {
	      // 返回JSON数据格式到客户端 包含状态信息
	      header('Content-Type:text/html; charset=utf-8');
	      exit(json_encode($data));
	    }elseif(strtoupper($type)=='XML'){
	      // 返回xml格式数据
	      header('Content-Type:text/xml; charset=utf-8');
	      exit(xml_encode($data));
	    }elseif(strtoupper($type)=='EVAL'){
	      // 返回可执行的js脚本
	      header('Content-Type:text/html; charset=utf-8');
	      exit($data);
	    }else{
	      // TODO 增加其它格式
	    }
	}

	/**
	 * [Is_Login 登录校验]
	 */
	protected function Is_Login()
	{
		if(empty($_SESSION['token']))
		{
			$this->error(L('common_login_invalid'), U('Admin/Admin/LoginInfo'));
		} else {
			// 用户
			$this->token = I('session.token');
		}
	}

	/**
	 * [ViewInit 视图初始化]
	 */
	public function ViewInit()
	{
		// 控制器静态文件状态css,js
		$module_css = MODULE_NAME.DS.'Css'.DS.CONTROLLER_NAME.'.css';
		$this->assign('module_css', file_exists(ROOT_PATH.'Public'.DS.$module_css) ? $module_css : '');
		$module_js = MODULE_NAME.DS.'Js'.DS.CONTROLLER_NAME.'.js';
		$this->assign('module_js', file_exists(ROOT_PATH.'Public'.DS.$module_js) ? $module_js : '');
		// 用户
		$this->assign('token', $this->token);
	}


}
?>