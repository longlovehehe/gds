<?php

/**
 * Created by PhpStorm.
 * User: zed
 * Date: 2016/5/28
 * Time: 17:34
 */
class EnterpriseChartsContorl extends contorl{
    public $enterprise;
    public $fd;
    public function __construct(){
		parent::__construct();
		$_REQUEST['e_id']=$_SESSION['ep']['e_id'];
		$this->enterprise=new enterprisecharts($_REQUEST);
		$this->fd=new formatdate();
//        $this->user=new users($_REQUEST);
//        $this->page = new page($_REQUEST);
//        $this->groups = new groups($_REQUEST);
//        $this->usergroup = new usergroup($_REQUEST);
    }

    public function charts(){
	
        $usergroup=$this->enterprise->selectlist();
        $this->smarty->assign('usergroup', $usergroup);
        $this->smarty->assign('data', $_SESSION['ep']);
        $this->render("modules/report/show.tpl");
    }
	/**
	 * 默认展示企业所有部门信息
	 */
    public function charts_item(){
	$item_e = $this->enterprise->getByid_ep();
	$epInfo=$this->enterprise->get_Charts_Data($this->enterprise->get_ep_data());
	$list = $this->get_Enterprise_Data($this->enterprise->selectlist());
	$this->smarty->assign('list', $list);
	$this->smarty->assign('data', $_REQUEST);
	$this->smarty->assign('item_e', $item_e);
	$this->smarty->assign('epInfo', $epInfo);

            if($_SESSION['ident']=='VT'){
                $this->htmlrender('modules/report/show_item.tpl');
            }else if($_SESSION['ident']=='GQT'){
                $this->htmlrender('modules/report/show_item.tpl');
            }else{
                $this->htmlrender('modules/report/show_item.tpl');
            }

    }
    public function charts_item_ug(){
        //获得该部门的数据
	$onlyUg=$this->enterprise->get_ug_data();	

        //获取用户的数据
	$list = $this->get_UserGroup_Data($this->enterprise->getList());
	$ugInfo=$this->enterprise->get_Charts_Data($this->enterprise->get_ug_data());
	$this->smarty->assign('list', $list);
	$this->smarty->assign('data', $_REQUEST);
	$this->smarty->assign("onlyUg", $onlyUg);

        if($_SESSION['ident']=='VT'){
            $this->htmlrender('modules/report/show_item_ug.tpl');
        }else if($_SESSION['ident']=='GQT'){
            $this->htmlrender('modules/report/show_item_ug.tpl');
        }else{
            $this->htmlrender('modules/report/show_item_ug.tpl');
        }

    }
    public function charts_item_user(){

	//获取用户的数据
	$list = $this->get_UserGroup_Data($this->enterprise->getList());
	$ugInfo=$this->enterprise->get_Charts_Data($this->enterprise->get_ug_data());
	$this->smarty->assign('list', $list);
	$this->smarty->assign('OneUserInfo', $list[0]);
	$this->smarty->assign('data', $_REQUEST);

        if($_SESSION['ident']=='VT'){
            $this->htmlrender('modules/report/show_item_user.tpl');
        }else if($_SESSION['ident']=='GQT'){
            $this->htmlrender('modules/report/show_item_user.tpl');
        }else{
            $this->htmlrender('modules/report/show_item_user.tpl');
        }

    }

    public function get_like_user(){
        echo json_encode($this->enterprise->get_like_user(),TRUE);
    }
	
	public function get_data(){
		switch ($_REQUEST['type']) {
			case 'usergroup': //部门
				$list=$this->get_Charts_Data($this->enterprise->get_ug_data());

				$this->smarty->assign("callTime",  $list['callTime']);
				$this->smarty->assign("infoNum", $list['infoNum']);
				$this->smarty->assign("otherInfo", $list['otherInfo']);
//				$this->smarty->assign("ug_id",$_REQUEST['ug_id']);
				$this->htmlrender('modules/report/show_charts.tpl');
				break;
			case 'user': //用户
				$list=$this->get_Charts_Data($this->enterprise->get_users_data());
				$this->smarty->assign("callTime",  $list['callTime']);
				$this->smarty->assign("infoNum", $list['infoNum']);
				$this->smarty->assign("otherInfo", $list['otherInfo']);
//				$this->smarty->assign("u_number",$_REQUEST['u_number']);
				$this->htmlrender('modules/report/show_charts.tpl');
				break;
			case 'enterprise': //企业
				$list=$this->get_Charts_Data($this->enterprise->get_ep_data());
				$this->smarty->assign("callTime",  $list['callTime']);
				$this->smarty->assign("infoNum", $list['infoNum']);
				$this->smarty->assign("otherInfo", $list['otherInfo']);
//				$this->smarty->assign("u_number",$_REQUEST['u_number']);
				$this->htmlrender('modules/report/show_charts.tpl');
				break;
			default:
				break;
		}
	}
		
	/**
	 * 饼状图数据
	 * @param array $data
	 * @return array
	 */
	public function get_Charts_Data($data){
		return $this->enterprise->get_Charts_Data($data);
	}
	
	/**
	 * 企业下各个部门数据
	 * @param array $data
	 * @return array
	 */
	public function get_Enterprise_Data($data){
		return $this->enterprise->get_Enterprise_Data($data);
	}
	
	/**
	 * 部门下各个用户数据
	 * @param array $data
	 * @return array
	 */
	public function get_UserGroup_Data($data){
		return $this->enterprise->get_UserGroup_Data($data);
	}
}