<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    
	public function _initialize(){
		parent::_initialize();
	}

    public function index(){
        //轮播图
    	$adv = M('adv_cover');
    	$ad = $adv-> where(array('type' => '02','is_recommend' => '1'))-> limit(3)-> order('rand()')-> select();
    	foreach ($ad as $key => $value) {
    		# code...
    	}
        $this->assign('ad', $ad);
        //新闻类型
        $NT = M('news_type');
        $newsType = $NT-> field(array('newstypeId', 'newstypeName'))-> where(array('dr' => '0','IsDefault' => '1')) -> select();
        array_unshift($newsType,array('newstypeId' => '-1','newstypeName'=>'推荐' ));
        $this->assign('newsType', $newsType);
        //头部推荐
        $NS = M('news');
        $where = array();
        $where["dr"] = 0;
        $where["audit"] =  1;
        $where["isRecommend"] =  1;
        $where["isDeploy"] =  0;
        $where["isFreeSee"] =  0;
        $where["showStatus"] = 0;
        $topNewsList = $NS-> field(array('ID', 'cover', 'title'))-> where($where)-> limit(15)-> order('is_top desc, ndate desc')-> select();
        $this->assign('topNewsList', $topNewsList);
        //创业头条
        $where = array();
        $where["dr"] = 0;
        $where["audit"] =  1;
        $where["typeID"] =  33;
        $where["isDeploy"] =  0;
        $where["isFreeSee"] =  0;
        $where["showStatus"] = 0;
        $newsList = $NS-> field(array('ID', 'cover', 'title'))-> where($where)-> limit(12)-> order('is_top desc, ndate desc')-> select();

        var_dump($newsList);
    }

}