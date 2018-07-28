<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    
	public function _initialize(){
		parent::_initialize();
	}

    public function index(){
    	$adv = M("adv_cover");
    	$ad = $adv-> where(array('type' => '02','is_recommend' => '1'))-> limit(3)-> order('rand()')-> select();
    	foreach ($ad as $key => $value) {
    		# code...
    	}
        $this->assign('ad', $ad);
            
    }

}