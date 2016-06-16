<?php

/**
 * 数据报表控制器
 * @category 业务统计
 * @package 数据统计
 * @subpackage  控制器层
 */
class ReportContorl extends contorl {

	public $report;
	public $fd;
	public $line_chart;
	public $histogram;
	public $term;

	function __construct($data) {
		parent::__construct();
		$this->report = new report($_REQUEST);
//        $this->term = new terminal($_REQUEST);
		$this->fd = new formatdate();
		$this->data = $data;
		$this->line_chart = array('_already_open', '_commercial', '_livesum', '_intercom_recording', '_speaking_time');
		$this->histogram = array('_live', '_users', '_type', '_validity', '_livenum', '_call_record', '_call_time', '_video_record', '_video_time', '_term_type', '_gprs_type');
		$this->change_time();
	}

	//默认首页（开户数据）
	public function index() {
		$user_list = $this->get_item_list();
		$result = $this->get_ag_list();
		//当搜索的时间为空时 默认的时间显示
		$now = strtotime(date('Y-m-d',time()));
		if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
			//1天是86400秒        
			$_REQUEST['start'] = date("Y-m-d", $now - 86400*6);
			$_REQUEST['end'] = date("Y-m-d", $now - 86400);
		}elseif($_REQUEST['start'] == "" && $_REQUEST['end'] != ""){
			$_REQUEST['start'] = date("Y-m-d", strtotime($_REQUEST['end'])-86400*6);
		}elseif($_REQUEST['start'] != "" && $_REQUEST['end'] == ""){
			$_REQUEST['end'] = date("Y-m-d", $now - 86400);
		}
		$json = json_encode($user_list);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("result", json_encode($result));
		$this->smarty->assign("json", $json);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->render("modules/report/index.tpl");
	}

	//开户数据
	public function livenessdata() {
		$user_list = $this->get_item_list();
		$result = $this->get_ag_list();
		$arr = array();
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			$arr[$key]['expenses'] = (int) $value['user_num'];
		}
		$json = json_encode($arr);
		if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
			//1天是86400秒 七天604800
			//$_REQUEST['start']=date("Y-m-d",time()-604800);
			//$_REQUEST['end']=date("Y-m-d",time());                   
			$start = date("Y-m-d", time() - (604800));
			$end = date("Y-m-d", time() - 86400);
		}
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("result", json_encode($result));
		$this->smarty->assign("json", $json);
		$this->smarty->assign("start", $start);
		$this->smarty->assign("end", $end);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->render("modules/report/livenessdata.tpl");
	}

	//业务数据
	public function bissnessdata() {
		$user_list = $this->get_item_list();
		$result = $this->get_ag_list();
		$arr = array();
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			$arr[$key]['param1'] = (int) $value['user_num'];
		}
		$json = json_encode($arr);
		if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
			//1天是86400秒 七天604800
			//$_REQUEST['start']=date("Y-m-d",time()-604800);
			//$_REQUEST['end']=date("Y-m-d",time());                   
			$start = date("Y-m-d", time() - (604800));
			$end = date("Y-m-d", time() - 86400);
		}
		$this->smarty->assign("start", $start);
		$this->smarty->assign("end", $end);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("result", json_encode($result));
		$this->smarty->assign("json", $json);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->render("modules/report/bissnessdata.tpl");
	}

	//终端数据
	public function terminaldata() {
		$user_list = $this->get_item_list();
		$result = $this->get_ag_list();
		$arr = array();
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			$arr[$key]['expenses'] = (int) $value['user_num'];
		}
		$json = json_encode($arr);
		if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
			//1天是86400秒 七天604800
			//$_REQUEST['start']=date("Y-m-d",time()-604800);
			//$_REQUEST['end']=date("Y-m-d",time());                   
			$start = date("Y-m-d", time() - (604800));
			$end = date("Y-m-d", time() - 86400);
		}
		$this->smarty->assign("start", $start);
		$this->smarty->assign("end", $end);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("result", json_encode($result));
		$this->smarty->assign("json", $json);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->render("modules/report/terminaldata.tpl");
	}

	//终端数据
	public function gprsdata() {
		$user_list = $this->get_item_list();
		$result = $this->get_ag_list();
		$arr = array();
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			$arr[$key]['expenses'] = (int) $value['user_num'];
		}
		$json = json_encode($arr);
		if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
			//1天是86400秒 七天604800
			//$_REQUEST['start']=date("Y-m-d",time()-604800);
			//$_REQUEST['end']=date("Y-m-d",time());                   
			$start = date("Y-m-d", time() - (604800));
			$end = date("Y-m-d", time() - 86400);
		}
		$this->smarty->assign("start", $start);
		$this->smarty->assign("end", $end);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("result", json_encode($result));
		$this->smarty->assign("json", $json);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->render("modules/report/gprsdata.tpl");
	}

	public function review() {
		$user_list = $this->get_item_list();
		$result = $this->get_ag_list();
		$page = count($this->report->get_array());

		$arr = array();
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			$arr[$key]['expenses'] = (int) $value['user_num'];
		}
		$json = json_encode($arr);
		if ($_REQUEST['start'] == "") {
			$start = date("Y-m-d", time() - 86400);
		}
		$this->smarty->assign("start", $start);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("sum", $page);
		$this->smarty->assign("result", json_encode($result));
		$this->smarty->assign("json", $json);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->render("modules/report/review.tpl");
	}

	/**
	 * 获取代理商&企业的 ID与名称
	 */
	public function get_ag_list() {

		$list = $this->report->get_all_agep_list();
		return$list;
//        echo json_encode($list);
	}

	function getjson() {
		$report = new report();
		$result = $report->get_array();
//    	$res['citylist']=$result;
		echo json_encode($result);
	}

	function getagep() {
		$report = new report($_REQUEST);
		$result = $report->get_array();
		$arr = array();
		$arr['ag_number'] = '0';
		$arr['ag_name'] = 'OMP';
		$arr['ag_level'] = '0';
		$arr['list'] = NULL;
		array_unshift($result, $arr);

//    	$res['citylist']=$result;
		$this->smarty->assign("list", $result);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/ag_lv.tpl");
	}

	public function getserver() {
		$result = $this->report->getServer();
		$this->smarty->assign("list", $result);
		$this->htmlrender("modules/report/ag_lv.tpl");
	}

	public function con_server() {
		$this->htmlrender("modules/report/condition_server.tpl");
	}

	public function con_oae() {
		$this->htmlrender("modules/report/condition_oae.tpl");
	}

	function review_item() {
		if (!$_REQUEST['start'] || $_REQUEST['start'] == "") {
			$_REQUEST['start'] = date('Y-m-d', time() - 86400);
		}
		$report = new report();
		$this->report->set($_REQUEST);
		$user_list = $this->report->get_day_userdata();
		$call_list = $this->report->get_day_calldata();
		foreach ($call_list as $key => $value) {
			$call_list[$key]['sdr_ptt_htime'] = round($value['sdr_ptt_htime'] / 60, 2);
			$call_list[$key]['sdr_call_htime'] = round($value['sdr_call_htime'] / 60, 2);
		}
		$this->smarty->assign("user_list", $user_list);
		$this->smarty->assign("call_list", $call_list);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/review_item.tpl");
	}

	public function get_report_pic() {
		$user_list = $this->get_item_list();
		$arr = array();
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			$arr[$key]['expenses'] = $value['user_num'];
			$arr[$key]['week'] = $value['week'];
		}
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("viewer/report.tpl");
	}

	/**
	 * 选择查询
	 * 分别获取所需要的值
	 * 1.开户数据
	 * 2.活跃度
	 * 3.业务数据
	 * 4.终端数据
	 * 5.流量卡数据
	 * 根据图表里线条(柱状)类型种类获取相应的数据
	 * 返回结果为json格式
	 * 如:[{"date":"2016-03-01","expenses":2200},{"date":"2016-03-02","expenses":2202},{"date":"2016-03-03","expenses":2202},{"date":"2016-03-04","expenses":2204},{"date":"2016-03-05","expenses":2204},{"date":"2016-03-06","expenses":2204},{"date":"2016-03-07","expenses":2204},{"date":"2016-03-08","expenses":2204}]
	 * 
	 * [{"date":"2016-03-01","pargam1":2200,"pargam2":2200,"total":6600},{"date":"2016-03-02","pargam1":2202,"pargam2":2202,"total":13206},{"date":"2016-03-03","pargam1":2202,"pargam2":2202,"total":19812},{"date":"2016-03-04","pargam1":2204,"pargam2":2204,"total":26424},{"date":"2016-03-05","pargam1":2204,"pargam2":2204,"total":33036},{"date":"2016-03-06","pargam1":2204,"pargam2":2204,"total":39648},{"date":"2016-03-07","pargam1":2204,"pargam2":2204,"total":46260},{"date":"2016-03-08","pargam1":2204,"pargam2":2204,"total":52872}]
	 */
	/**
	 * 1.开户数据
	 * =================================START======================================
	 */

	/**
	 * 用户明细
	 */
	function report_item() {
		//获取代理商或企业创建时间
		if ($_REQUEST['ep_id'] > 0) {
			$this->agents = new agents();
			$aRes = $this->agents->getByid($_REQUEST['ep_id']);
			// var_dump("<pre>");var_dump($aRes[0]['createtime']);var_dump("</pre>");
			if ($aRes[0]['createtime']) {
				$this->smarty->assign("createtime", $aRes[0]['createtime']);
			}
		}

		$user_list = $this->get_item_list();
		$arr = array();
		$valid = 0;
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			
			$i = 0;
			$arr_list = array();
			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					$arr[$key]['param' . $i] = (int) $val;
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
//                $arr[$key]['week']=$value['week'];
			$valid = $i;
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{	
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		// var_dump("<pre>");var_dump($_REQUEST);
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/index_item.tpl");
		//$this->htmlrender("viewer/report.tpl");
	}

	/**
	 * 展示商用用户数
	 */
	public function get_commercial_users() {

		$user_list = $this->get_item_list();
		$arr = array();
		$valid = 0;
		$sum = 0;
		foreach ($user_list as $key => $value) {
			$sum += $value['sdr_add_user'];
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			$i = 0;
			$arr_list = array();
			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					$arr[$key]['param' . $i] = (int) $val;
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
//                $arr[$key]['week']=$value['week'];
			$valid = $i;
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("sum", $sum);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/opendata/commercial_users.tpl");
	}

	/**
	 * 存活率
	 */
	public function get_live_ratio() {
		if (in_array($_REQUEST['data_type'], $this->histogram)) {
			$user_list = $this->get_list_histogram();
			$arr = array();
			$valid = 0;

			foreach ($user_list as $key => $value) {
				$arr[$key]['date'] = $value['create_time'];
				if($_REQUEST['date_type'] == 'month')
				{
					$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
				}
				else
				{
					$arr[$key]['date1'] = $value['create_time'];
				}

				$i = 0;
				$arr_list = array();

				foreach ($value as $kk => $val) {
					if ($kk != "create_time") {
						$i++;
						$arr[$key]['param' . $i] = (int) $val;
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				}
//                $arr[$key]['week']=$value['week'];
				$valid = $i;
			}
		} else {
			$user_list = $this->get_item_list();
			$arr = array();
			$valid = 0;
			foreach ($user_list as $key => $value) {
				$arr[$key]['date'] = $value['create_time'];
				if($_REQUEST['date_type'] == 'month')
				{
					$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
				}
				else
				{
					$arr[$key]['date1'] = $value['create_time'];
				}
				$i = 0;
				$arr_list = array();
				foreach ($value as $kk => $val) {
					if ($kk != "create_time") {
						$i++;
						$arr[$key]['param' . $i] = (int) $val;
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				}
//                $arr[$key]['week']=$value['week'];
				$valid = $i;
			}
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		$json = json_encode($arr);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/opendata/live_ratio.tpl");
	}

	/*
	 * ==================================END====================================== 
	 */

	/**
	 * 2.活跃度数据
	 * =================================START======================================
	 */

	/**
	 * 在线人数
	 */
	public function get_live_num() {

		if (in_array($_REQUEST['data_type'], $this->histogram)) {
			$user_list = $this->get_list_histogram();
			$arr = array();
			$valid = 0;

			foreach ($user_list as $key => $value) {
				$arr[$key]['date'] = $value['create_time'];
				if($_REQUEST['date_type'] == 'month')
				{
					$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
				}
				else
				{
					$arr[$key]['date1'] = $value['create_time'];
				}
				$i = 0;
				$arr_list = array();

				foreach ($value as $kk => $val) {
					if ($kk != "create_time") {
						$i++;
						$arr[$key]['param' . $i] = (int) $val;
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				}
//                $arr[$key]['week']=$value['week'];
				$valid = $i;
			}
		} else {
			$user_list = $this->get_item_list();
			$arr = array();
			$valid = 0;
			foreach ($user_list as $key => $value) {
				$arr[$key]['date'] = $value['create_time'];
				if($_REQUEST['date_type'] == 'month')
				{
					$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
				}
				else
				{
					$arr[$key]['date1'] = $value['create_time'];
				}
				$i = 0;
				$arr_list = array();
				foreach ($value as $kk => $val) {
					if ($kk != "create_time") {
						$i++;
						$arr[$key]['param' . $i] = (int) $val;
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				}
//                $arr[$key]['week']=$value['week'];
				$valid = $i;
			}
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		$json = json_encode($arr);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/livenessdata/live_num.tpl");
	}

	/**
	 * 持续在线人数
	 */
	public function get_live_sum() {
// var_dump("<pre>");var_dump($_REQUEST);
		$user_list = $this->get_item_list();
		$arr = array();
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			$arr[$key]['expenses'] = (int) $value['online_num'];
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}

		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("title", $_REQUEST['title']['name1']);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/livenessdata/live_sum.tpl");
	}

	/**
	 * 活跃度
	 */
	public function get_liveness() {

		$user_list = $this->get_item_list();
		$arr = array();
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			$arr[$key]['expenses'] = (int) $value['sdr_active_rate'];
			$arr[$key]['num'] = (int) $value['sdr_online_user'];
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("title", $_REQUEST['title']['name1']);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/livenessdata/liveness_level.tpl");
	}

	/*
	 * ==================================END====================================== 
	 */

	/**
	 * 3.业务数据
	 * =================================START======================================
	 */

	/**
	 * 对讲次数
	 */
	public function get_intercom_recording() {
		$user_list = $this->get_item_list();
		//var_dump($user_list);
		$arr = array();
		$valid = 0;
		$total = 0;
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			$i = 0;
			$total+=$value['sdr_ptt_count'];
			$arr_list = array();
			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					$arr[$key]['param' . $i] = $val;
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
//                $arr[$key]['week']=$value['week'];
			$valid = $i;
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("total", $total);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/bissnessdata/intercom_recording.tpl");
	}

	/**
	 * 对讲时长
	 */
	public function get_speaking_time() {
		$_REQUEST['data_type'] = "_speaking_time";
		$user_list = $this->get_item_list();
		//var_dump($user_list);
		$arr = array();
		$valid = 0;
		$total = 0;
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			$i = 0;
			$total+=$value['sdr_ptt_time'];
			$arr_list = array();
			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					$arr[$key]['param' . $i] = $val;//round($val / 60, 2);
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
//                $arr[$key]['week']=$value['week'];
			$valid = $i;
		}
		
		$total = $total;//round($total / 60, 2);
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("total", $total);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/bissnessdata/speaking_time.tpl");
	}

	/**
	 * 单呼次数
	 */
	public function get_call_record() {
		$_REQUEST['data_type'] = "_call_record";
		$user_list = $this->get_list_histogram();
		$arr = array();
		$valid = 0;
		$total = 0;
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			$i = 0;
			$total+=$value['sdr_audio_count'];
			$arr_list = array();

			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					if($val!==NULL){
						$arr[$key]['param' . $i] = (int) $val;
					}else{
						$arr[$key]['param' . $i] = NULL;
					}
					
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
			$valid = $i;
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'total' => $_REQUEST['total']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
					//, 'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'total' => $_REQUEST['total']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}

		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("arr", $arr);
		
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("total", $total);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/bissnessdata/call_record.tpl");
	}

	/**
	 * 单呼时长
	 */
	public function get_call_time() {
		$_REQUEST['data_type'] = "_call_time";
		$user_list = $this->get_list_histogram();
		$arr = array();
		$valid = 0;
		$total = 0;
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			$i = 0;
			$total+=$value['sdr_audio_time'];
			$arr_list = array();

			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					$arr[$key]['param' . $i] = $val;//round($val / 60, 2);
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
			$valid = $i;
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		$json = json_encode($arr);
		$total = $total;//round($total / 60, 2);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("total", $total);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/bissnessdata/call_time.tpl");
	}

	/**
	 * 视频次数
	 */
	public function get_video_record() {
		$_REQUEST['data_type'] = "_video_record";
		$user_list = $this->get_list_histogram();
		$arr = array();
		$valid = 0;
		$total = 0;
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			$i = 0;
			$total+=$value['sdr_video_count'];
			$arr_list = array();

			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					if($val!==NULL){
						$arr[$key]['param' . $i] = (int) $val;
					}
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
			$valid = $i;
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("total", $total);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/bissnessdata/video_record.tpl");
	}

	/**
	 * 视频时长
	 */
	public function get_video_time() {
		$_REQUEST['data_type'] = "_video_time";
		$user_list = $this->get_list_histogram();
		$arr = array();
		$valid = 0;
		$total = 0;
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type'] == 'month')
			{
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			else
			{
				$arr[$key]['date1'] = $value['create_time'];
			}
			$i = 0;
			$total+=$value['sdr_video_time'];
			$arr_list = array();

			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					$arr[$key]['param' . $i] = $val;//round($val / 60, 2);
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
			$valid = $i;
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			$arr = $this->get_week_time($arr);
			$this->smarty->assign("url", $url);
		}
		elseif($_REQUEST['date_type'] == 'month')
		{
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
			
			$this->smarty->assign("url", $url);
		}
		$json = json_encode($arr);
		$total = $total;//round($total / 60, 2);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("total", $total);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/bissnessdata/video_time.tpl");
	}

	//**********业务数据的总方法**********//
	/**
	 * 获取对讲次数后一周数据
	 */
	public function get_last_week($num, $end_time = '', $fieldName) {
		if ($end_time == '') {
			$end_time = strtotime(date('Y-m-d', time()));
		}
		$num = $num;
		if ($num != 0) {
			$_REQUEST['select_type'] = 3;
			$_REQUEST['order_type'] = false;
			$_REQUEST['end'] = date('Y-m-d', $end_time - 86400);
			$_REQUEST['start'] = date('Y-m-d', strtotime($_REQUEST['end']) - ($num - 1) * 86400);
			$this->report->set($_REQUEST);
			//后一周的数据
			$lastWeek = $this->report->get_intercom($fieldName['sumfield']);
			$lastWeek[0]['create_time'] = $_REQUEST['end'];
		} else {
			//后一周的数据
			$_REQUEST['select_type'] = 1;
			$_REQUEST['order_type'] = false;
			$_REQUEST['end'] = date('Y-m-d', $end_time - 86400);
			$this->report->set($_REQUEST);
			$lastWeek = $this->report->get_intercom($fieldName['field']);
		}
		return $lastWeek;
	}

	/**
	 * 获取对讲次数第一周数据
	 */
	public function get_first_week($num, $end_time = '', $fieldName) {
		if (!$end_time) {
			$end_time = strtotime(date('Y-m-d', time()));
		}
		if ($num != 0) {
			//第一周的数据
			$firstWeekTime = date('Y-m-d', $end_time - ($num + 1) * 86400);
			$_REQUEST['select_type'] = 1;
			$_REQUEST['end'] = $firstWeekTime;
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_intercom($fieldName['field']);
		} else {
			//第一周的数据
			$firstWeekTime = date('Y-m-d', $end_time - ($num + 1 + 7) * 86400);
			$_REQUEST['select_type'] = 1;
			$_REQUEST['end'] = $firstWeekTime;
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_intercom($fieldName['field']);
		}
		return $user_list;
	}

	/**
	 * 获取对讲次数后一个月的数据     
	 */
	public function get_last_month($num, $end_time = '', $fieldName) {
		if (!$end_time) {
			$end_time = strtotime(date('Y-m-d', time()));
		}
		$num = $num;
		if ($num != 1) {
			$_REQUEST['select_type'] = 3;
			$_REQUEST['order_type'] = false;
			$_REQUEST['end'] = date('Y-m-d', $end_time - 86400);
			$_REQUEST['start'] = date('Y-m-d', $end_time - ($num - 1) * 86400);
			$this->report->set($_REQUEST);
			//后一周的数据
			$lastMonth = $this->report->get_intercom($fieldName['sumfield']);
			$lastMonth[0]['create_time'] = $_REQUEST['end'];
		} else {
			//后一周的数据
			$_REQUEST['select_type'] = 1;
			$_REQUEST['order_type'] = false;
			$_REQUEST['end'] = date('Y-m-d', $end_time - 86400);
			$this->report->set($_REQUEST);
			$lastMonth = $this->report->get_intercom($fieldName['field']);
		}
		return $lastMonth;
	}

	/**
	 * 获取对讲次数第一周数据
	 */
	public function get_first_month($num, $end_time = '', $fieldName) {
		if ($end_time == '') {
			$end_time = strtotime(date('Y-m-d', time()));
		}
		if ($num != 1) {
			//第一个月的数据
			$firstMonthTime = date('Y-m-d', $end_time - $num * 86400);
			$_REQUEST['select_type'] = 1;
			$_REQUEST['end'] = $firstMonthTime;
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_intercom($fieldName['field']);
		} else {
			//第一个月的数据
			$MonthTime = date('Y-m-d', $end_time - 86400);
			//第一个月的天数及数据
			$now_daynum = date('j', strtotime($MonthTime)); //当天是本月第几天
			//第一个月的统计天的 天的编号
			$unixtime = strtotime($MonthTime);
			$firstMonthTime = date('Y-m-d', $unixtime - $now_daynum * 86400);
			$_REQUEST['select_type'] = 1;
			$_REQUEST['end'] = $firstMonthTime;
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_intercom($fieldName['field']);
		}
		return $user_list;
	}

	/**
	 * 对讲次数/对讲时长获取方法      业务数据总方法
	 */
	public function get_intercom($fieldName) {
		$user_list = array();
		//判断字段
		$fields = explode(',', $fieldName);
		$fieldArr = array();
		$fieldArr['field'] = $fieldName . ',sdr_time AS create_time';
		if (count($fields) > 1) {
			$fieldArr['sumfield'] = '';
			foreach ($fields as $k => $v) {
				$fieldArr['sumfield'] .= "sum({$v}) AS {$v},";
			}
			$fieldArr['sumfield'] = trim($fieldArr['sumfield'], ',');
		} else {
			$fieldArr['sumfield'] = "sum({$fieldName}) AS {$fieldName}";
		}
		//var_dump($fieldArr);die;
		//周
		if ($_REQUEST['date_type'] == "week") {
			$_REQUEST['sdr_cyc_type'] = 1;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {

				//当start和end都为空时
				$num = date('w', time() - 86400);
				$end_time = strtotime(date('Y-m-d', time()));
				//最后一周数据
				$lastWeek = $this->get_last_week($num, $end_time, $fieldArr);
				//第一周数据
				$user_list = $this->get_first_week($num, $end_time, $fieldArr);
				array_push($user_list, $lastWeek[0]);
			} elseif ($_REQUEST['start'] == "" && $_REQUEST['end'] != "") {
				$end = strtotime($_REQUEST['end']);
				$now = strtotime(date('Y-m-d', time()));
				if ($end >= $now) {
					//最后一周数据
					$num = date('w', $now - 86400);
					$end_time = $now;
					$lastWeek = $this->get_last_week($num, $end_time, $fieldArr);
				} else {
					//最后一周数据
					$end_time = strtotime($_REQUEST['end']);
					$num = date('w', $end_time - 86400);
					$lastWeek = $this->get_last_week($num, ($end_time + 86400), $fieldArr);
				}
				//第一周数据
				$user_list = $this->get_first_week($num, $end_time, $fieldArr);
				array_push($user_list, $lastWeek[0]);
			} else {
				if ($_REQUEST['end'] == '') {
					$time = date('Y-m-d', time());
					$_REQUEST['end'] = date('Y-m-d', strtotime($time));
				}
				if ($_REQUEST['end'] == $_REQUEST['start']) {
					//计算时间内的对讲和即可
					$_REQUEST['select_type'] = 4;
					$_REQUEST['order_type'] = false;
					$this->report->set($_REQUEST);
					//所有周的数据
					$user_list = $this->report->get_intercom($fieldArr['field']);
					$user_list[0]['create_time'] = $_REQUEST['start'];
				} else {
					$_REQUEST['back_end'] = $_REQUEST['end'];
					$_REQUEST['back_start'] = $_REQUEST['start'];
					$cha = intval(abs(strtotime($_REQUEST['start']) - strtotime($_REQUEST['end'])) / (3600 * 24)); //两个时间差
					$w = date("N", strtotime($_REQUEST['start']));
					$s = date("N", strtotime($_REQUEST['end']));

					if (($s - $w) == $cha) {//如果开始和结束时间是同一个周
						//计算时间内的对讲和即可
						$_REQUEST['select_type'] = 3;
						$_REQUEST['order_type'] = false;
						$this->report->set($_REQUEST);
						//后一周的数据
						$user_list = $this->report->get_intercom($fieldArr['sumfield']);
						$user_list[0]['create_time'] = $_REQUEST['end'];
					} else {
						$start_time = strtotime($_REQUEST['start']);
						$start_num = date('w', $start_time);
						//第一周的数据
						if ($start_num != 0) {
							$_REQUEST['end'] = date('Y-m-d', $start_time + (7 - $start_num) * 86400);
							$_REQUEST['start'] = $_REQUEST['start'];
							$_REQUEST['order_type'] = false;
							$this->report->set($_REQUEST);
							//第一周的数据
							$firstWeek = $this->report->get_intercom($fieldArr['sumfield']);
							$firstWeek[0]['create_time'] = $_REQUEST['end'];
							$_REQUEST['start'] = date('Y-m-d', $start_time + (7 - $start_num + 1) * 86400);
						} else {
							//第一周的数据
							$_REQUEST['select_type'] = 1;
							$_REQUEST['order_type'] = false;
							$_REQUEST['end'] = $_REQUEST['start'];
							$this->report->set($_REQUEST);
							$firstWeek = $this->report->get_intercom($fieldArr['field']);
							$_REQUEST['start'] = date('Y-m-d', strtotime($_REQUEST['end']) + 86400);
						}

						//中间周及最后一周的的数据
						$_REQUEST['end'] = $_REQUEST['back_end'];
						$end = strtotime($_REQUEST['end']);
						$now = strtotime(date('Y-m-d', time()));
						if ($end >= $now) {
							$num = date('w', $now - 86400);
							if ($num != 0) {
								$_REQUEST['select_type'] = 2;
								$_REQUEST['end'] = date('Y-m-d', $now - ($num + 1) * 86400);
								$this->report->set($_REQUEST);
								$midtWeek = $this->report->get_intercom($fieldArr['field']);

								//最后一周数据
								$end_time = $now;
								$lastWeek = $this->get_last_week($num, $end_time, $fieldArr);
							} else {
								$_REQUEST['select_type'] = 2;
								$_REQUEST['end'] = date('Y-m-d', $now - 86400);
								$this->report->set($_REQUEST);
								$midtWeek = $this->report->get_intercom($fieldArr['field']);
								$lastWeek = array();
							}
						} else {
							$_REQUEST['end'] = $_REQUEST['back_end'];
							$end_time = strtotime($_REQUEST['end']);
							$num = date('w', $end_time);
							if ($num != 0) {
								$end_time = strtotime($_REQUEST['end']);
								$num = date('w', $end_time);
								$_REQUEST['start'] = date('Y-m-d', $end_time - ($num - 1) * 86400);
								$_REQUEST['select_type'] = 3;
								$_REQUEST['order_type'] = false;
								$this->report->set($_REQUEST);
								//后一周的数据
								$lastWeek = $this->report->get_intercom($fieldArr['sumfield']);
								$lastWeek[0]['create_time'] = $_REQUEST['end'];
								//中间周 对讲次数 数据
								$_REQUEST['select_type'] = 2;
								if ($start_num != 0) {
									$_REQUEST['start'] = date('Y-m-d', $start_time + (7 - $start_num + 1) * 86400);
								} else {
									$_REQUEST['start'] = date('Y-m-d', $start_time + 86400);
								}
								$this->report->set($_REQUEST);
								$midtWeek = $this->report->get_intercom($fieldArr['field']);
							} else {

								$_REQUEST['select_type'] = 2;
								$this->report->set($_REQUEST);
								$midtWeek = $this->report->get_intercom($fieldArr['field']);
								$lastWeek = array();
							}
						}

						//组合数据
						if ($midtWeek) {
							foreach ($midtWeek as $mk => $value) {
								array_push($firstWeek, $midtWeek[$mk]);
							}
						}
						if ($lastWeek) {
							foreach ($lastWeek as $lk => $value) {
								array_push($firstWeek, $lastWeek[$lk]);
							}
						}
						$user_list = $firstWeek;
					}
				}
			}
			//月
		} else if ($_REQUEST['date_type'] == "month") {
			$_REQUEST['sdr_cyc_type'] = 2;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {

				$now = strtotime(date('Y-m-d', time()));
				$end_time = $now;
				//最后一个月数据
				$now_monthday = date('t', $now); //本月总天数
				$now_daynum = date('j', $now); //当天是本月第几天
				$lastMonth = $this->get_last_month($now_daynum, $end_time, $fieldArr);
				//第一个月数据
				$user_list = $this->get_first_month($now_daynum, $end_time, $fieldArr);
				array_push($user_list, $lastMonth[0]);
			} elseif ($_REQUEST['start'] == "" && $_REQUEST['end'] != "") {
				//第一个月
				$allday = date('t', strtotime($_REQUEST['end'])); //当月总天数
				$daynum = date('j', strtotime($_REQUEST['end'])); //当月第几天

				$end = strtotime($_REQUEST['end']);
				$now = strtotime(date('Y-m-d', time()));
				if ($end >= $now) {
					$end_time = $now;
					//最后一个月数据
					$now_monthday = date('t', strtotime($now)); //本月总天数
					$now_daynum = date('j', strtotime($now)); //当天是本月第几天
					$lastMonth = $this->get_last_month($now_daynum, $end_time, $fieldArr);
					//第一个月数据
					$user_list = $this->get_first_month($now_daynum, $end_time, $fieldArr);
					array_push($user_list, $lastMonth[0]);
				} else {
					//最后一个月数据
					$end_time = strtotime($_REQUEST['end']);
					$now_monthday = date('t', strtotime($end_time)); //本月总天数
					$now_daynum = date('j', strtotime($end_time)); //当天是本月第几天
					$lastMonth = $this->get_last_week($now_daynum, $end_time, $fieldArr);
					//第一个月数据
					$user_list = $this->get_first_month($now_daynum, $end_time, $fieldArr);
					array_push($user_list, $lastMonth[0]);
				}
			} else {
				if ($_REQUEST['end'] == '') {
					$time = date('Y-m-d', time());
					$_REQUEST['end'] = date('Y-m-d', strtotime($time));
				}

				$_REQUEST['back_end'] = $_REQUEST['end'];
				$_REQUEST['back_start'] = $_REQUEST['start'];

				$stime = explode('-', $_REQUEST['start']);
				$etime = explode('-', $_REQUEST['end']);
				//如果开始和结束时间是同一个月
				if ($stime[0] == $etime[0] && $stime[1] == $etime[1]) {
					//计算时间内的对讲和即可
					$_REQUEST['select_type'] = 3;
					$_REQUEST['order_type'] = false;
					$this->report->set($_REQUEST);
					//后一周的数据
					$user_list = $this->report->get_intercom($fieldArr['sumfield']);
					$user_list[0]['create_time'] = $_REQUEST['end'];
				} else {
					//第一个月
					$start_time = strtotime($_REQUEST['start']);
					$allday = date('t', $start_time); //当月总天数
					$startday_num = date('j', $start_time); //当月第几天
					//第一个月的数据
					if ($startday_num != $allday) {
						$_REQUEST['end'] = date('Y-m-d', $start_time + ($allday - $startday_num) * 86400);
						$_REQUEST['start'] = $_REQUEST['start'];
						$_REQUEST['order_type'] = false;
						$this->report->set($_REQUEST);
						//第一个月的数据
						$firstMonth = $this->report->get_intercom($fieldArr['sumfield']);
						$firstMonth[0]['create_time'] = $_REQUEST['end'];
						$_REQUEST['start'] = date('Y-m-d', $start_time + ($allday - $startday_num + 1) * 86400);
					} else {
						//第一个月的数据
						$_REQUEST['select_type'] = 1;
						$_REQUEST['order_type'] = false;
						$_REQUEST['end'] = $_REQUEST['start'];
						$this->report->set($_REQUEST);
						$firstMonth = $this->report->get_intercom($fieldArr['field']);
						$_REQUEST['start'] = date('Y-m-d', strtotime($_REQUEST['end']) + 86400);
					}

					//中间月及最后一个月的的数据
					$end = strtotime($_REQUEST['back_end']);
					$now = strtotime(date('Y-m-d', time()));

					$endallday = date('t', $end); //当月总天数
					$endday_num = date('j', $end); //当月第几天

					if ($end >= $now) {
						//如果筛选结束的时间大于或者等于现在的时间 那么end时间用现在的时间
						$nowallday = date('t', $now); //当月总天数
						$nowday_num = date('j', $now); //当月第几天
						if ($nowday_num != 1) {
							$_REQUEST['select_type'] = 2;
							$_REQUEST['end'] = date('Y-m-d', $now);
							$this->report->set($_REQUEST);
							$midtMonth = $this->report->get_intercom($fieldArr['field']);

							//最后一周数据
							$end_time = $now;
							$lastMonth = $this->get_last_month($nowday_num, $end_time, $fieldArr);
						} else {
							$_REQUEST['select_type'] = 2;
							$_REQUEST['end'] = date('Y-m-d', $now - 86400);
							$this->report->set($_REQUEST);
							$midtMonth = $this->report->get_intercom($fieldArr['field']);
							$lastMonth = array();
						}
					} else {
						$_REQUEST['end'] = $_REQUEST['back_end'];
						$end_time = strtotime($_REQUEST['end']);
						$endallday = date('t', $end_time); //当月总天数
						$endday_num = date('j', $end_time); //当月第几天
						if ($endday_num != $endallday) {
							$_REQUEST['start'] = date('Y-m-d', $end_time - ($endday_num - 1) * 86400);
							$_REQUEST['select_type'] = 3;
							$_REQUEST['order_type'] = false;
							//var_dump($_REQUEST);die;
							$this->report->set($_REQUEST);
							//最一周的数据
							$lastMonth = $this->report->get_intercom($fieldArr['sumfield']);
							$lastMonth[0]['create_time'] = $_REQUEST['end'];

							//中间月 对讲次数 数据
							$_REQUEST['select_type'] = 2;
							$_REQUEST['start'] = date('Y-m-d', $start_time + ($allday - $startday_num + 1) * 86400);
							$this->report->set($_REQUEST);
							$midtMonth = $this->report->get_intercom($fieldArr['field']);
						} else {
							$_REQUEST['select_type'] = 2;
							$this->report->set($_REQUEST);
							$midtMonth = $this->report->get_intercom($fieldArr['field']);
							$lastMonth = array();
						}
					}
					//组合数据
					if ($midtMonth) {
						foreach ($midtMonth as $mk => $value) {
							array_push($firstMonth, $midtMonth[$mk]);
						}
					}
					if ($lastMonth) {
						foreach ($lastMonth as $lk => $value) {
							array_push($firstMonth, $lastMonth[$lk]);
						}
					}
					$user_list = $firstMonth;
				}
			}
			/* foreach ($user_list as $key => $value) {
			  $timeArr = explode('-', $value['create_time']);
			  $user_list[$key]['create_time'] = $timeArr[0].'年'.$timeArr[1].'月';
			  } */
		} else {
			$_REQUEST['sdr_cyc_type'] = 0;
			$_REQUEST['order_type'] = true;

			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {

				$end = strtotime(date('Y-m-d', time()));
				$_REQUEST['end'] = date('Y-m-d', $end - 86400);
				$_REQUEST['start'] = date('Y-m-d', $end - 7 * 86400);
			} elseif ($_REQUEST['start'] == "" && $_REQUEST['end'] != "") {
				$end = strtotime($_REQUEST['end']);
				$now = strtotime(date('Y-m-d', time()));
				if ($end >= $now) {
					$_REQUEST['end'] = date('Y-m-d', $now - 86400);
					$_REQUEST['start'] = date('Y-m-d', $now - 7 * 86400);
				} else {
					$_REQUEST['start'] = date('Y-m-d', $end - 7 * 86400);
				}
			} elseif ($_REQUEST['start'] != "" && $_REQUEST['end'] == "") {
				$end = strtotime(date('Y-m-d', time())) - 86400;
				$_REQUEST['end'] = date('Y-m-d', $end);
			} else {
				$end = strtotime($_REQUEST['end']);
				$now = strtotime(date('Y-m-d', time()));
				if ($end >= $now) {
					$_REQUEST['end'] = date('Y-m-d', $now - 86400);
				}
			}
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_intercom($fieldArr['field']);
		}
		$_REQUEST['start'] = $_REQUEST['change_time']['firstStart'];
		//去除日期记录为null的数据
		$result = array();
		$i=0;
		foreach ($user_list as $key => $value) {
			$check = true;
			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					if($val===NULL){
						unset($user_list[$key]);
						$check = false;
						break;
					}else{
						break;
					}
				}
			}
			if($check==false){
				continue;
			}else{
				$result[$i]=$user_list[$key];
				$i++;
			}
		}
		
		return $result;
	}

	/*
	 * ==================================END====================================== 
	 */
	/**
	 * 4.终端数据
	 * =================================START======================================
	 */

	/**
	 * 终端类型
	 */
	public function get_term_type() {
		//终端数据
		$_REQUEST['data_type'] = "_term_type";
		$user_list = $this->get_list_histogram();
		$arr = array();
		$valid = 0;
		$total = 0;
		$com_term = 0;
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type']=='month'){
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			$i = 0;
			$total = $value['sdr_terminal_user'];
			$com_term = $value['sdr_terminal_user_commercial'];
			$arr_list = array();

			foreach ($value as $kk => $val) {
				if ($kk != "create_time" && $kk != "sdr_terminal_user_sort") {
					$i++;
					$arr[$key]['param' . $i] = (int) $val;
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
			$valid = $i;
		}
		//当为周时，时间显示为 某天到某天
		if($_REQUEST['date_type'] == 'week')
		{
			$arr = $this->get_week_time($arr);
		}
		$json = json_encode($arr);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("total", $total);
		$this->smarty->assign("com_term", $com_term);
		//点击进周  点击进日
		if (!empty($_REQUEST['title'])) {
			foreach ($_REQUEST['title'] as $kr => $valr) {
				if (strstr($kr, 'name')) {
					$_REQUEST['title'][$kr] = urlencode($valr);
				}
			}
		}

		$url = http_build_query(
			array(
				'm' => 'report'
				, 'a' => 'next_info_histogram'
				, 'date_type' => $_REQUEST['change_time']['check_date']
				, 'data_type' => $_REQUEST['data_type']
				, 'table_type' => $_REQUEST['table_type']
				, 'index' => $_REQUEST['index']
				, 'stackType' => 'none'
				, 'total' => $_REQUEST['total']
				, 'start' => $_REQUEST['start']
				, 'end' => $_REQUEST['end']
				, 'ep_id' => $_REQUEST['ep_id']
			)
		);

		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("index", $_REQUEST['index']);
		$this->smarty->assign("title", $_REQUEST['title']);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("url", $url);
		//终端类型A102W Z106W...
		//$_REQUEST['data_type']="_term_type_data";
		$this->report->set($_REQUEST);
		//$data_list=$this->get_item_list();
		$data_list = $user_list;
		//处理组合终端类型的数据
		$term_list = $this->make_term_data($data_list); //json_type
		//数据
		$type_list = $term_list['data'];
		//终端类型数组
		$type_arr = $term_list['type_arr'];

		$arr_type = array();
		foreach ($type_list as $key => $value) {
			$arr_type[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type']=='month'){
				$arr_type[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			
			$i = 0;
			$list_type = array();

			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					$arr_type[$key]['param' . $kk] = (int) $val;
				}
			}
		}
		//当为周时，时间显示为 某天到某天
		if($_REQUEST['date_type'] == 'week')
		{
			$arr_type = $this->get_week_time($arr_type);
		}
		$json_type = json_encode($arr_type);
		$this->smarty->assign("json_type", $json_type);
		$this->smarty->assign("arr_type", $arr_type);
		$this->smarty->assign("type_arr", $type_arr);
		$this->smarty->assign("type_list", $type_list);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->smarty->assign("check_date", $_REQUEST['date_type']);
		$this->htmlrender("modules/report/terminaldata/term_type.tpl");
	}

	public function get_term_type_data() {
		//终端类型A102W Z106W...
		$_REQUEST['data_type'] = "_term_type_data";
		$_REQUEST['order_type'] = true;
		$this->report->set($_REQUEST);
		$data_list = $this->get_item_list();
		//处理组合终端类型的数据
		$term_list = $this->make_term_data($data_list); //json_type
		//数据
		$type_list = $term_list['data'];
		//终端类型数组
		$type_arr = $term_list['type_arr'];

		$arr_type = array();
		foreach ($type_list as $key => $value) {
			$arr_type[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type']=='month'){
				$arr_type[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			$i = 0;
			$list_type = array();

			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					$arr_type[$key]['param' . $kk] = (int) $val;
				}
			}
		}
		//当为周时，时间显示为 某天到某天
		if($_REQUEST['date_type'] == 'week')
		{
			$arr_type = $this->get_week_time($arr_type);
		}
		echo json_encode($arr_type);
	}

	/**
	 * TOP渠道
	 */
	public function get_term_agents() {
		$_REQUEST['this_start'] = $this->get_time();
		$this->report->set($_REQUEST);
		//获取数据
		$array = $this->report->get_tg_top('t');
		$json = json_encode($array['arr']);
		$this->smarty->assign("list", $array['user_list']);
		$this->smarty->assign("arr_list", $array['arr_list']);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("sCount", $array['valid']);
		$this->smarty->assign("arr", $array['arr']);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);

		$this->smarty->assign("karr", array_reverse($array['arr']));
		$this->htmlrender("modules/report/terminaldata/term_agents.tpl");
	}

	/**
	 * 处理组合终端类型的数据     
	 */
	public function make_term_data($list = array()) {
		$resArr = array();
		$data_arr = array();
		$str = '';
		foreach ($list as $key => $value) {
			$str_tmp = '';
			$arr = explode(',', $value['sdr_terminal_user_sort']);
			foreach ($arr as $k => $v) {
				$tmp = explode(':', $v);
				//拼接终端类型字符串
				$str_tmp .= $tmp[0] . ',';
				//组合终端类型及对应的用户数据
				if ($_REQUEST['u_attr_type'] == 'com') {
					$data_arr[$key][$tmp[0]] = $tmp[1];
				} elseif ($_REQUEST['u_attr_type'] == 'test') {
					$data_arr[$key][$tmp[0]] = $tmp[2];
				} elseif ($_REQUEST['u_attr_type'] == 'none') {
					
				} else {
					$data_arr[$key][$tmp[0]] = intval($tmp[1]) + intval($tmp[2]);
				}
			}
			$data_arr[$key]['create_time'] = $value['create_time'];
			$str .= $str_tmp;
		}
		$tmp_arr = trim($str, ',');
		$tmp_arr = explode(',', $tmp_arr);
		$tmp_arr = array_unique($tmp_arr);
		//最终返回
		$resArr['data'] = $data_arr;
		$resArr['type_arr'] = array();
		foreach ($tmp_arr as $ky => $val) {
			$resArr['type_arr'][$ky]['name'] = $val;
		}
		return $resArr;
	}

	/**
	 * 获取终端、流量卡月的数据     
	 */
	public function get_tg_month_data($thisDayMnum, $nowTime = '', $fieldArr, $type = 1, $start = '') {
		if (!$nowTime) {
			$nowTime = strtotime(date('Y-m-d', time()));
		}
		$thisDayMnum = $thisDayMnum;
		$thisDayYnum = date('z', $nowTime); //今天是当年中的第多少天
		//判断当天是否是一个月的第一天  
		if ($thisDayMnum != 1) {
			$_REQUEST['select_type'] = 1;
			if ($type == 2) {
				$_REQUEST['end'] = date('Y-m-d', $nowTime);
			} else {
				$_REQUEST['end'] = date('Y-m-d', $nowTime - 86400);
			}

			$this->report->set($_REQUEST);
			$lastMonth = $this->report->get_term_data($fieldArr['field']);

			//此年前面月的数据
			if ($start != '') {
				$_REQUEST['start'] = $start;
			} else {
				$_REQUEST['start'] = date('Y-m-d', $nowTime - ($thisDayYnum) * 86400);
			}

			$_REQUEST['select_type'] = 2;
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_term_data($fieldArr['field']);
			if ($user_list) {
				array_push($user_list, $lastMonth[0]);
			} else {
				$user_list = $lastMonth;
			}
		} else {
			if ($type == 2) {
				$_REQUEST['select_type'] = 1;
				$_REQUEST['end'] = date('Y-m-d', $nowTime);
				$this->report->set($_REQUEST);
				$lastMonth = $this->report->get_term_data($fieldArr['field']);

				//此年前面月的数据
				if ($start != '') {
					$_REQUEST['start'] = $start;
				} else {
					$_REQUEST['start'] = date('Y-m-d', $nowTime - ($thisDayYnum - 1) * 86400);
				}

				$_REQUEST['select_type'] = 2;
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_term_data($fieldArr['field']);
				if ($user_list) {
					array_push($user_list, $lastMonth[0]);
				} else {
					$user_list = $lastMonth;
				}
			} else {
				//当年现有全部月的数据
				$_REQUEST['select_type'] = 2;
				$_REQUEST['end'] = date('Y-m-d', $nowTime - 86400);

				if ($start != '') {
					$_REQUEST['start'] = $start;
				} else {
					$_REQUEST['start'] = date('Y-m-d', $nowTime - ($thisDayYnum - 1) * 86400);
				}

				$this->report->set($_REQUEST);
				$user_list = $this->report->get_term_data($fieldArr['field']);
			}
		}
		return $user_list;
	}

	/**
	 * 获取终端、流量卡年的数据     
	 */
	public function get_tg_year_data($nowTime = '', $fieldArr, $type = 1, $start = '') {
		if (!$nowTime) {
			$nowTime = strtotime(date('Y-m-d', time()));
		}
		$thisDayYnum = date('z', $nowTime); //今天是当年中的第多少天

		if ($thisDayYnum != 1) {
			$_REQUEST['select_type'] = 1;
			if ($type == 2) {
				$_REQUEST['end'] = date('Y-m-d', $nowTime);
			} else {
				$_REQUEST['end'] = date('Y-m-d', $nowTime - 86400);
			}

			$this->report->set($_REQUEST);
			$lastYear = $this->report->get_term_data($fieldArr['field']);
			//此年前面年的数据
			$user_list = $this->get_section_tg($_REQUEST['end'], $start, $fieldArr);
			if ($user_list) {
				array_push($user_list, $lastYear[0]);
			} else {
				$user_list = $lastYear;
			}
		} else {
			$_REQUEST['end'] = date('Y-m-d', $nowTime);
			if ($type == 2) {
				$_REQUEST['select_type'] = 1;
				$this->report->set($_REQUEST);
				$lastYear = $this->report->get_term_data($fieldArr['field']);
				//此年前面月的数据
				$user_list = $this->get_section_tg($_REQUEST['end'], $start, $fieldArr);
				if ($user_list) {
					array_push($user_list, $lastYear[0]);
				} else {
					$user_list = $lastYear;
				}
			} else {
				//当年现有全部月的数据
				$user_list = $this->get_section_tg($_REQUEST['end'], $start, $fieldArr);
			}
		}
		return $user_list;
	}

	/**
	 * 获取时间区间的年的终端、流量卡数据
	 */
	public function get_section_tg($end, $start = '', $fieldArr) {
		$timeArr = explode('-', $end);
		$yearNum = intval($timeArr[0]);
		$i = $yearNum - 1;
		if ($start != '') {
			$startArr = explode('-', $start);
			$step = intval($startArr[0]);
			//如果同一年则返回空数组
			if ($yearNum == $step) {
				return array();
			}
		} else {
			$step = $yearNum - 5;
		}
		$user_list = array();
		//拼接时间的字符串
		$timeStr = '';
		for ($i; $i >= $step; $i--) {
			$timeStr .= "'{$i}-12-31',";
		}
		$_REQUEST['end'] = trim($timeStr, ',');
		$_REQUEST['select_type'] = 3;
		$_REQUEST['order_type'] = true;
		$this->report->set($_REQUEST);
		$user_list = $this->report->get_term_data($fieldArr['field']);
		return $user_list;
	}

	/**
	 * 获取终端、流量卡周的数据     
	 */
	public function get_tg_week_data($nowTime = '', $fieldArr, $type = 1, $start = '') {
		if (!$nowTime) {
			$nowTime = strtotime(date('Y-m-d', time()));
		}
		//搜索的开始时间
		if ($start != '') {
			$_REQUEST['start'] = $start;
		} else {
			$_REQUEST['start'] = date('Y-m-d', $nowTime - 14 * 86400);
		}

		$thisDayWnum = date("N", $nowTime); //今天是周几
		if ($thisDayWnum != 1) {
			$_REQUEST['select_type'] = 1;
			if ($type == 2) {
				$_REQUEST['end'] = date('Y-m-d', $nowTime);
			} else {
				$_REQUEST['end'] = date('Y-m-d', $nowTime - 86400);
			}

			$this->report->set($_REQUEST);
			$lastYear = $this->report->get_term_data($fieldArr['field']);

			//前面周的数据
			$_REQUEST['select_type'] = 2;
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_term_data($fieldArr['field']);
			if ($user_list) {
				array_push($user_list, $lastYear[0]);
			} else {
				$user_list = $lastYear;
			}
		} else {
			$_REQUEST['end'] = date('Y-m-d', $nowTime);
			if ($type == 2) {
				$_REQUEST['select_type'] = 1;
				$this->report->set($_REQUEST);
				$lastYear = $this->report->get_term_data($fieldArr['field']);

				//前面周的数据
				$_REQUEST['select_type'] = 2;
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_term_data($fieldArr['field']);
				if ($user_list) {
					array_push($user_list, $lastYear[0]);
				} else {
					$user_list = $lastYear;
				}
			} else {
				//前面周的数据
				$_REQUEST['select_type'] = 2;
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_term_data($fieldArr['field']);
			}
		}

		return $user_list;
	}

	/**
	 * 终端 及  流量卡的数据获取
	 */
	public function get_term_data($fieldName) {
		$user_list = array();
		//判断字段
		$fieldArr = array();
		$fieldArr['field'] = $fieldName . ',sdr_time AS create_time';
		/* 获取公用的现在的时间信息 */
		$thisYearDays = 365; //今年多少天
		if (date('L') == 1) {
			$thisYearDays = 366;
		}
		$nowTime = strtotime(date('Y-m-d', time())); //现在的日期时间Y-m-d的UNIX时间戳
		$thisDayYnum = date('z', time()); //今天是当年中的第多少天
		$thisMonthNum = date('t', time()); //当月总天数
		$thisDayMnum = date('j', time()); //今天是当月第几天
		//var_dump($_REQUEST['date_type']);
		if ($_REQUEST['date_type'] == "month") {
			$_REQUEST['sdr_date_flag'] = 2;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {

				$user_list = $this->get_tg_month_data($thisDayMnum, $nowTime, $fieldArr, 1, '');
			} elseif ($_REQUEST['start'] == "" && $_REQUEST['end'] != "") {
				$endTime = strtotime($_REQUEST['end']);
				if ($endTime >= $nowTime) {
					$user_list = $this->get_tg_month_data($thisDayMnum, $nowTime, $fieldArr, 1, '');
				} else {
					$endDayMnum = date('j', $endTime); //当天是当月第几天
					$user_list = $this->get_tg_month_data($endDayMnum, $endTime, $fieldArr, 2, '');
				}
			} else {
				if ($_REQUEST['end'] == '') {
					$time = date('Y-m-d', time());
					$_REQUEST['end'] = date('Y-m-d', strtotime($time));
				}

				$_REQUEST['back_end'] = $_REQUEST['end'];
				$_REQUEST['back_start'] = $_REQUEST['start'];

				$stime = explode('-', $_REQUEST['start']);
				$etime = explode('-', $_REQUEST['end']);
				//如果开始和结束时间是同一个月
				if ($stime[0] == $etime[0] && $stime[1] == $etime[1]) {
					//取最后一天的值即可
					$end = strtotime($_REQUEST['end']);
					if ($end >= $nowTime) {
						$user_list = $this->get_tg_month_data($thisDayMnum, $nowTime, $fieldArr, 1, $_REQUEST['start']);
					} else {
						$thisDayMnum = date('j', $end); //今天是当月中的第多少天
						$user_list = $this->get_tg_month_data($thisDayMnum, $end, $fieldArr, 2, $_REQUEST['start']);
					}
				} else {
					//第一个月
					$start_time = strtotime($_REQUEST['start']);
					$allday = date('t', $start_time); //当月总天数
					$startday_num = date('j', $start_time); //当月第几天
					//第一个月的数据
					if ($startday_num != $allday) {

						$_REQUEST['end'] = date('Y-m-d', $start_time + ($allday - $startday_num) * 86400);
						$_REQUEST['select_type'] = 1;
						$this->report->set($_REQUEST);
						//第一个月的数据
						$firstMonth = $this->report->get_term_data($fieldArr['field']);

						$_REQUEST['start'] = date('Y-m-d', $start_time + ($allday - $startday_num + 1) * 86400);
					} else {
						//第一个月的数据
						$_REQUEST['select_type'] = 1;
						$_REQUEST['end'] = $_REQUEST['start'];
						$this->report->set($_REQUEST);
						$firstMonth = $this->report->get_term_data($fieldArr['field']);

						$_REQUEST['start'] = date('Y-m-d', strtotime($_REQUEST['end']) + 86400);
					}

					//中间月及最后一个月的的数据
					$end = strtotime($_REQUEST['back_end']);
					$now = strtotime(date('Y-m-d', time()));

					$endallday = date('t', $end); //当月总天数
					$endday_num = date('j', $end); //当月第几天

					if ($end >= $now) {
						//如果筛选结束的时间大于或者等于现在的时间 那么end时间用现在的时间
						$nowallday = date('t', $now); //当月总天数
						$nowday_num = date('j', $now); //当月第几天
						$user_list = $this->get_tg_month_data($nowday_num, $now, $fieldArr, 1, $_REQUEST['start']);
					} else {

						$endDayMnum = date('j', $end); //当天是当月第几天
						$user_list = $this->get_tg_month_data($endDayMnum, $end, $fieldArr, 2, '');
					}
				}
			}
		} else if ($_REQUEST['date_type'] == "week") {
			$_REQUEST['sdr_date_flag'] = 1;
			//判断时间
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				$user_list = $this->get_tg_week_data($nowTime, $fieldArr, 1, '');
			} elseif ($_REQUEST['start'] == "" && $_REQUEST['end'] != "") {
				$endTime = strtotime($_REQUEST['end']);
				if ($endTime >= $nowTime) {
					$user_list = $this->get_tg_week_data($nowTime, $fieldArr, 1, '');
				} else {
					$user_list = $this->get_tg_week_data($endTime, $fieldArr, 2, '');
				}
			} else {
				if ($_REQUEST['end'] == '') {
					$time = date('Y-m-d', time());
					$_REQUEST['end'] = date('Y-m-d', strtotime($time));
				}

				$endTime = strtotime($_REQUEST['end']);
				if ($endTime >= $nowTime) {
					$user_list = $this->get_tg_week_data($nowTime, $fieldArr, 1, $_REQUEST['start']);
				} else {
					$user_list = $this->get_tg_week_data($endTime, $fieldArr, 2, $_REQUEST['start']);
				}
			}
		} else if ($_REQUEST['date_type'] == "day") {
			$_REQUEST['sdr_date_flag'] = 0;
			//获取end的值
			if ($_REQUEST['end'] == '') {
				$time = date('Y-m-d', time());
				$_REQUEST['end'] = date('Y-m-d', strtotime($time));
			}
			$etime = strtotime($_REQUEST['end']);
			if ($etime >= $nowTime) {
				$_REQUEST['end'] = date('Y-m-d', $etime - 86400);
			}

			//获取start的值
			if ($_REQUEST['start'] == '') {
				$stime = strtotime($_REQUEST['end']);
				$_REQUEST['start'] = date('Y-m-d', $stime - 6 * 86400);
			}

			$_REQUEST['select_type'] = 4;
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_term_data($fieldArr['field']);
		} else {
			$_REQUEST['sdr_date_flag'] = 3;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {

				$user_list = $this->get_tg_year_data($nowTime, $fieldArr, 1, '');
			} elseif ($_REQUEST['start'] == "" && $_REQUEST['end'] != "") {
				$endTime = strtotime($_REQUEST['end']);
				if ($endTime >= $nowTime) {
					$user_list = $this->get_tg_year_data($nowTime, $fieldArr, 1, '');
				} else {
					$endDayMnum = date('j', $endTime); //当天是当月第几天
					$user_list = $this->get_tg_year_data($endTime, $fieldArr, 2, '');
				}
			} else {
				if ($_REQUEST['end'] == '') {
					$time = date('Y-m-d', time());
					$_REQUEST['end'] = date('Y-m-d', strtotime($time));
				}
				$end = strtotime($_REQUEST['end']);
				$start = strtotime($_REQUEST['start']);
				//搜索的开始时间是否大于结束时间
				if ($start > $end) {
					//大于则返回空
					$user_list = array();
				} else {
					//不大于则判断读取数据
					if ($end >= $nowTime) {
						$user_list = $this->get_tg_year_data($nowTime, $fieldArr, 1, $_REQUEST['start']);
					} else {
						$thisDayYnum = date('z', $end);
						$user_list = $this->get_tg_year_data($end, $fieldArr, 2, $_REQUEST['start']);
					}
				}
			}
		}

		return $user_list;
	}

	/*
	 * ==================================END====================================== 
	 */
	/**
	 * 5.流量卡数据
	 * =================================START======================================
	 */

	/**
	 * 流量卡类型
	 */
	public function get_gprs_type() {
		//流量卡数据
		$user_list = $this->get_list_histogram();
		$arr = array();
		$valid = 0;
		$total = 0;
		$com_gprs = 0;
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			if($_REQUEST['date_type']=='month'){
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
			}
			$i = 0;
			$total = $value['sdr_gprs_user'];
			$com_gprs = $value['sdr_gprs_user_commercial'];
			$arr_list = array();

			foreach ($value as $kk => $val) {
				if ($kk != "create_time") {
					$i++;
					$arr[$key]['param' . $i] = (int) $val;
					$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
					$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
				}
			}
			$valid = $i;
		}
		//当为周时，时间显示为 某天到某天
		if($_REQUEST['date_type'] == 'week')
		{
			$arr = $this->get_week_time($arr);
		}
		$json = json_encode($arr);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("total", $total);
		$this->smarty->assign("com_gprs", $com_gprs);

		//点击进周  点击进日
		if (!empty($_REQUEST['title'])) {
			foreach ($_REQUEST['title'] as $kr => $valr) {
				if (strstr($kr, 'name')) {
					$_REQUEST['title'][$kr] = urlencode($valr);
				}
			}
		}
		
		$url = http_build_query(
			array(
				'm' => 'report'
				, 'a' => 'next_info_histogram'
				, 'date_type' => $_REQUEST['change_time']['check_date']
				, 'data_type' => $_REQUEST['data_type']
				, 'table_type' => $_REQUEST['table_type']
				, 'index' => $_REQUEST['index']
				, 'stackType' => 'none'
				, 'total' => $_REQUEST['total']
				, 'start' => $_REQUEST['start']
				, 'end' => $_REQUEST['end']
				, 'ep_id' => $_REQUEST['ep_id']
			)
		);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("index", $_REQUEST['index']);
		$this->smarty->assign("title", $_REQUEST['title']);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("url", $url);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->smarty->assign("check_date", $_REQUEST['date_type']);
		$this->htmlrender("modules/report/gprsdata/gprs_type.tpl");
	}

	public function get_gprs_type_data() {

		$user_list = $this->get_list_histogram();
		$arr = array();
		foreach ($user_list as $key => $value) {
			$arr[$key]['date'] = $value['create_time'];
			$arr[$key]['pargam1'] = (int) $value['pargam1'];
			$arr[$key]['pargam2'] = (int) $value['pargam2'];
			$arr[$key]['total'] = (int) $value['total'];
		}
		echo json_encode($arr);
	}

	/**
	 * TOP渠道
	 */
	public function get_gprs_agents() {
		$_REQUEST['this_start'] = $this->get_time();
		$this->report->set($_REQUEST);
		//获取数据
		$array = $this->report->get_tg_top('g');
		$json = json_encode($array['arr']);
		$this->smarty->assign("list", $array['user_list']);
		$this->smarty->assign("arr_list", $array['arr_list']);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("sCount", $array['valid']);
		$this->smarty->assign("arr", array_reverse($array['arr']));
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/gprsdata/gprs_agents.tpl");
	}

	/**
	 * 终端 流量卡 Top10时间判断
	 */
	public function get_time() {
		$now = strtotime(date('Y-m-d', time()));
		if ($_REQUEST['start'] == '' && $_REQUEST['end'] == '') {
			$_REQUEST['this_start'] = date('Y-m-d', $now - 86400);
		} elseif ($_REQUEST['start'] == '' && $_REQUEST['end'] != '') {
			$end = strtotime($_REQUEST['end']);
			if ($end >= $now) {
				$_REQUEST['this_start'] = date('Y-m-d', $now - 86400);
			} else {
				$_REQUEST['this_start'] = $_REQUEST['end'];
			}
		} else {
			if ($_REQUEST['end'] == '') {
				$_REQUEST['end'] = date('Y-m-d', time());
			}
			$end = strtotime($_REQUEST['end']);
			$start = strtotime($_REQUEST['start']);
			if ($start <= $end) {
				if ($end >= $now) {
					$_REQUEST['this_start'] = date('Y-m-d', $now - 86400);
				} else {
					$_REQUEST['this_start'] = $_REQUEST['end'];
				}
			} else {
				$_REQUEST['this_start'] = date('Y-m-d', $now + 10 * 86400);
			}
		}
		return $_REQUEST['this_start'];
	}

	/*
	 * ==================================END====================================== 
	 */

	/**
	 * 历史查询
	 */
	/**
	 * 选择查询
	 * 分别获取所需要的值
	 * 1.开户用户
	 * [{"param1": "测试","value": 156}, {"param2": "商用","value": 131}]
	 * 2.通话
	 * [{"param1": "测试","value": 156}, {"param2": "商用","value": 131}]
	 * 3.终端
	 * [{"param1": "测试","value": 156}, {"param2": "商用","value": 131}]
	 * 4.流量卡
	 * [{"param1": "测试","value": 156}, {"param2": "商用","value": 131}]
	 * 5.TOP渠道
	 * [{"param1": "AMP1","value": 156}, {"param2": "AMP2","value": 131}]
	 * 
	 * 获取相对应的数据格式以json为主
	 * 
	 */

	/**
	 * 1.开户用户
	 * =================================START======================================
	 */
	public function pies_open_users() {
		if (!$_REQUEST['start'] || $_REQUEST['start'] == "") {
			$_REQUEST['start'] = date('Y-m-d', time() - 86400);
		}
		$this->report->set($_REQUEST);
		// $fileds = " sdr_test_user,sdr_commercial_user ";
		$user_list = $this->report->get_open_user($fileds);
		$sum = $user_list[0]['sdr_test_user'] + $user_list[0]['sdr_commercial_user'];
		$sum1 = $user_list[0]['sdr_phone_user'] + $user_list[0]['sdr_console_user'] + $user_list[0]['sdr_gvs_user'];
		/* var_dump($user_list);var_dump($sum);
		  var_dump($sum1); */
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("sum", $sum);
		$this->smarty->assign("sum1", $sum1);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/pies/already_open_users.tpl");
	}

	/**
	 * =================================END======================================
	 */

	/**
	 * 2.通话
	 * =================================START======================================
	 */
	public function pies_calls() {
		if (!$_REQUEST['start'] || $_REQUEST['start'] == "") {
			$_REQUEST['start'] = date('Y-m-d', time() - 86400);
		}
		$this->report->set($_REQUEST);
		// $fields = " sdr_audio_count,sdr_video_count ";
		$user_list = $this->report->get_calls();
		foreach ($user_list as $key => $value) {
			$user_list[0]['sdr_video_htime'] = round($value['sdr_video_htime'] / 60, 2);
			$user_list[0]['sdr_audio_htime'] = round($value['sdr_audio_htime'] / 60, 2);
			$sum = $value['sdr_call_hcount'];
			$sum1 = round($value['sdr_call_htime'] / 60, 2);
		}
		$json = json_encode($user_list);
		// $sum1 = $user_list[0]['sdr_audio_htime'] + $user_list[0]['sdr_video_htime'];
		// $sum = $user_list[0]['sdr_audio_hcount'] + $user_list[0]['sdr_video_hcount'];
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("sum", $sum);
		$this->smarty->assign("sum1", $sum1);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/pies/calls.tpl");
	}

	/**
	 * =================================END======================================
	 */

	/**
	 * 3.终端
	 * =================================START======================================
	 */
	public function pies_terminal() {
		if (!$_REQUEST['start'] || $_REQUEST['start'] == "") {
			$_REQUEST['start'] = date('Y-m-d', time() - 86400);
		}
		$this->report->set($_REQUEST);
		// $fields = " sdr_audio_count,sdr_video_count ";
		$user_list = $this->report->get_terminal();
		$json = json_encode($user_list);
		$sum = $user_list[0]['sdr_terminal_user_test'] + $user_list[0]['sdr_terminal_user_commercial'];
		// $sum1 = $user_list[0]['sdr_audio_count'] + $user_list[0]['sdr_video_count'];
		$aTermianl = explode(",", $user_list[0]['sdr_terminal_user_sort']);
		if (!empty($aTermianl)) {
			$aList = array();
			$sum1 = 0;
			foreach ($aTermianl as $key => $value) {
				$aTer = explode(":", $value);
				$aList[$key]->type = $aTer[0];
				$aList[$key]->value = $aTer[1] + $aTer[2];
				$sum1 += $aList[$key]->value;
			}
		}
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("aList", $aList);
		$this->smarty->assign("sum", $sum);
		$this->smarty->assign("sum1", $sum1);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/pies/terminal.tpl");
	}

	/**
	 * =================================END======================================
	 */

	/**
	 * 4.流量卡
	 * =================================START======================================
	 */
	public function pies_gprs() {
		if (!$_REQUEST['start'] || $_REQUEST['start'] == "") {
			$_REQUEST['start'] = date('Y-m-d', time() - 86400);
		}
		$this->report->set($_REQUEST);
		// $fields = " sdr_audio_count,sdr_video_count ";
		$user_list = $this->report->get_terminal();
		$json = json_encode($user_list);
		$sum = $user_list[0]['sdr_gprs_user_test'] + $user_list[0]['sdr_gprs_user_commercial'];
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("sum", $sum);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/pies/gprs.tpl");
	}

	/**
	 * =================================END======================================
	 */

	/**
	 * 5.TOP渠道
	 * =================================START======================================
	 */
	public function pies_topamp() {
		$ep = "";
		if (!$_REQUEST['ep_id'] || $_REQUEST['ep_id'] == '0') {//选择omp查询一级代理商
			$aList = $this->get_agents();
			$ep = "AMP";
		} else{//选择一级代理商，查询企业
			$aList = $this->get_agents($_REQUEST['ep_id']);
			$ep = "EMP";
		}

		$aColor = array("#56ba8a", "#ffe250", "#ff8888", "#e465c8", "#6f73f3", "#4ca3fc", "#7ecef4", "#00A600", "#56ba8a", "#f7b249");
		//选择二级代理商或企业不显示
		if ($_REQUEST['ep_id'] && strlen($_REQUEST['ep_id']) != 6 && $_REQUEST['ep_id'] != '0') {

			$aAgent = $this->agents->getByid($_REQUEST['ep_id']);
		}
		if (strlen($_REQUEST['ep_id']) != 6 && $aAgent[0]['ag_level'] != '1') {
			if (!$_REQUEST['start'] || $_REQUEST['start'] == "") {
				$_REQUEST['start'] = date('Y-m-d', time() - 86400);
			}
			$this->report->set($_REQUEST);
			$user_list1 = $this->report->get_top($ep, $aList, 'sdr_commercial_user');
			$this->agents = new agents();
			if (!empty($user_list1)) {
				$sum1 = 0;
				foreach ($user_list1 as $key => $value) {
					$agent = $this->agents->getByid($value['id']);
					$user_list1[$key]['color'] = $aColor[$key];
					$user_list1[$key]['name'] = $agent[0]['name'];
					$sum1 += $value['value'];
				}
			}
			//其他
			$res1 = $this->report->get_other($ep, $aList, 'sdr_commercial_user');
			if (count($user_list1) == 10) {
				$aOther1['color'] = "#b0b4b4";
				$aOther1['name'] = L('其他');
				$aOther1['value'] = $res1[0]['value'] - $sum1;
				array_push($user_list1, $aOther1);
				$total1 = $res1[0]['value'];
			}
			else
			{
				$total1 = $sum1;
			}

			$user_list2 = $this->report->get_top($ep, $aList, 'sdr_terminal_user_commercial');
			if (!empty($user_list2)) {
				$sum2 = 0;
				foreach ($user_list2 as $key => $value) {
					$agent = $this->agents->getByid($value['id']);
					$user_list2[$key]['color'] = $aColor[$key];
					$user_list2[$key]['name'] = $agent[0]['name'];
					$sum2 += $value['value'];
				}
			}
			$res2 = $this->report->get_other($ep, $aList, 'sdr_terminal_user_commercial');
			if (count($user_list2) == 10) {
				$aOther2['color'] = "#b0b4b4";
				$aOther2['name'] = L('其他');
				$aOther2['value'] = $res2[0]['value'] - $sum2;
				array_push($user_list2, $aOther2);
				$total2 = $res2[0]['value'];
			}
			else
			{
				$total2 = $sum2;
			}


			$user_list3 = $this->report->get_top($ep, $aList, 'sdr_gprs_user_commercial');
			if (!empty($user_list3)) {
				$sum3 = 0;
				foreach ($user_list3 as $key => $value) {
					$agent = $this->agents->getByid($value['id']);
					$user_list3[$key]['color'] = $aColor[$key];
					$user_list3[$key]['name'] = $agent[0]['name'];
					$sum3 += $value['value'];
				}
			}
			$res3 = $this->report->get_other($ep, $aList, 'sdr_gprs_user_commercial');
			if (count($user_list3) == 10) {
				$aOther3['color'] = "#b0b4b4";
				$aOther3['name'] = L('其他');
				$aOther3['value'] = $res3[0]['value'] - $sum3;
				array_push($user_list3, $aOther3);
				$total3 = $res3[0]['value'];
			}
			else
			{
				$total3 = $sum3;
			}

			$this->smarty->assign("list1", $user_list1);
			$this->smarty->assign("list2", $user_list2);
			$this->smarty->assign("list3", $user_list3);
			$this->smarty->assign("total1", $total1);
			$this->smarty->assign("total2", $total2);
			$this->smarty->assign("total3", $total3);
			$this->smarty->assign("change_time", $_REQUEST['change_time']);

			$this->htmlrender("modules/report/pies/topamp.tpl");
		}
	}

	public function get_agents($ep_id) {
		$this->agents = new agents();
		if (!$ep_id) {
			$aList = $this->agents->getlevel1_ag();
		} else {
			$aAgent = $this->agents->getlevel1_ag($ep_id);
			if(!empty($aAgent))
			{
				$aList = $this->agents->get_enterprise($ep_id);
			}
			
		}

		if (!empty($aList)) {
			$list = "'";
			foreach ($aList as $key => $value) {
				if ($key < (count($aList) - 1)) {
					$list .= $value['id'] . "','";
				} else {
					$list .= $value['id'] . "'";
				}
			}
		}
		return $list;
	}

	/**
	 * =================================END======================================
	 */
	/**
	 * 根据所选条件动态获取相应的数据
	 * 
	 * ======================================START========================================
	 */

	/**
	 * 折线图
	 * 获得相对应日期的数据
	 * type:日,周,月
	 */
	public function get_item_list() {
		if ($_REQUEST['data_type'] == '_already_open' || $_REQUEST['a'] == "index") {//开户数据
			$user_list = $this->get_already_open();
		} elseif ($_REQUEST['data_type'] == '_commercial') {//新增用户
			$user_list = $this->get_commercial();
		} elseif ($_REQUEST['data_type'] == '_livesum' || $_REQUEST['a'] == 'get_live_sum') {//持续在线人数
			$user_list = $this->get_livesum();
		} elseif ($_REQUEST['data_type'] == '_liveness' || $_REQUEST['a'] == 'get_liveness') {
			$user_list = $this->get_liveness_level();
		} elseif ($_REQUEST['data_type'] == '_livesum') {//业务数据
		} elseif ($_REQUEST['data_type'] == "_intercom_recording") { //对讲次数
			$user_list = $this->get_intercom('sdr_ptt_count');
		} elseif ($_REQUEST['data_type'] == "_speaking_time") { //对讲时长
			$user_list = $this->get_intercom('sdr_ptt_time');
			foreach ($user_list as $key => $value) {
				if($user_list[$key]['sdr_ptt_time']!==NULL){
					$user_list[$key]['sdr_ptt_time'] = round($value['sdr_ptt_time']/60,2);
				}
			}
		} elseif ($_REQUEST['data_type'] == "_term_type_data") { //各终端类型
			$user_list = $this->get_term_data('sdr_terminal_user_sort');
		}

		return $user_list;
	}

	/*
	 * 获取开户数据
	 */

	public function get_already_open() {
		$start_a = $_REQUEST['start'];
		if ($_REQUEST['date_type'] == "week") {
			$_REQUEST['sdr_date_flag'] = 1;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$cha = intval(abs(strtotime($_REQUEST['start']) - strtotime($_REQUEST['end'])) / (3600 * 24)); //两个时间差
			$w = date("N", strtotime($_REQUEST['start']));
			$s = date("N", strtotime($_REQUEST['end']));
			if (($s - $w) == $cha) {//如果开始和结束时间是同一个周
				//计算最后一周$endday天的值放到数组最后，取最后一天的值即可
				$user_list = $this->report->get_day_user($_REQUEST['end'], $_REQUEST['ep_id']);
			} else {
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_user();
				if ($s != 7) {
					$aEnd = $this->report->get_day_user($_REQUEST['end'], $_REQUEST['ep_id']);
					array_push($user_list, $aEnd[0]);
				}
			}
			// var_dump($user_list);
		} else if ($_REQUEST['date_type'] == "month") {
			$_REQUEST['sdr_date_flag'] = 2;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$stime = explode('-', $_REQUEST['start']);
			$etime = explode('-', $_REQUEST['end']);
			//如果开始和结束时间是同一个月
			if ($stime[0] == $etime[0] && $stime[1] == $etime[1]) {
				$user_list = $this->report->get_day_user($_REQUEST['end'], $_REQUEST['ep_id']);
			} else {

				$this->report->set($_REQUEST);
				$user_list = $this->report->get_user();
				$BeginDate = date('Y-m-01', strtotime($_REQUEST['end']));
				$endDate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
				if ($_REQUEST['end'] != $endDate) {
					$aEnd = $this->report->get_day_user($_REQUEST['end'], $_REQUEST['ep_id']);
					array_push($user_list, $aEnd[0]);
				}
			}

			// var_dump($user_list);
		} else {
			$_REQUEST['sdr_date_flag'] = 0;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				//$_REQUEST['start']=date("Y-m-d",time()-604800);
				//$_REQUEST['end']=date("Y-m-d",time());                   
				$_REQUEST['start'] = date("Y-m-d", time() - (604800));
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_user();
		}
		$_REQUEST['start'] = $start_a;
		return $user_list;
	}

	/*
	 * 获取商用用户
	 */

	public function get_commercial() {
		$start_a = $_REQUEST['start'];
		if ($_REQUEST['date_type'] == "week") {
			$_REQUEST['sdr_cyc_type'] = 1;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$cha = intval(abs(strtotime($_REQUEST['start']) - strtotime($_REQUEST['end'])) / (3600 * 24)); //两个时间差
			$w = date("N", strtotime($_REQUEST['start']));
			$s = date("N", strtotime($_REQUEST['end']));
			if (($s - $w) == $cha) {//如果开始和结束时间是同一个周
				$user_list = $this->report->get_day_commercial_user($_REQUEST['start'], $_REQUEST['end'], $_REQUEST['ep_id']);
				$user_list[0]['create_time'] = $_REQUEST['end'];
				// $user_list[0]['total'] = $user_list[0]['sdr_online_user'] + $user_list[0]['sdr_offline_user'];
			} else {
				//第一周计算，求和
				if (date("N", $_REQUEST['end']) != '7') {
					$start = $_REQUEST['start'];
					$weekday = date('N', strtotime($_REQUEST['start'])); //当周第几天
					$end = date("Y-m-d", (strtotime($start) + (7 - $weekday) * 86400));
					$aStart = $this->report->get_day_commercial_user($start, $end, $_REQUEST['ep_id']);
					$aStart[0]['create_time'] = $end;
					$_REQUEST['start'] = date("Y-m-d", (strtotime($end) + 86400));
				}
				//最后一周需要自己计算，所展示的值都是当天时间点的累加值，所以第一周不需要计算                
				if (date("N", $_REQUEST['end']) != '7') {
					//计算最后一周$endday天的值放到数组最后，取最后一天的值即可
					$end = $_REQUEST['end'];
					$weekday = date('N', strtotime($_REQUEST['end'])); //当周第几天
					$start = date("Y-m-d", (strtotime($end) - ($weekday - 1) * 86400));
					$aEnd = $this->report->get_day_commercial_user($start, $end, $_REQUEST['ep_id']);
					$aEnd[0]['create_time'] = $end;
				}

				$this->report->set($_REQUEST);
				$user_list = $this->report->get_commercial_user();
				$_REQUEST['start'] = $start_a;
				if ($aStart[0]['sdr_add_user'] != '' || $aStart[0]['sdr_del_user'] != '' || $aStart[0]['sdr_grow_user'] != '' ) {
					array_unshift($user_list, $aStart[0]);
				}
				if ($s != 7) {
					array_push($user_list, $aEnd[0]);
				}
			}
		} else if ($_REQUEST['date_type'] == "month") {
			$_REQUEST['sdr_cyc_type'] = 2;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$stime = explode('-', $_REQUEST['start']);
			$etime = explode('-', $_REQUEST['end']);
			//如果开始和结束时间是同一个月
			if ($stime[0] == $etime[0] && $stime[1] == $etime[1]) {
				$user_list = $this->report->get_day_commercial_user($_REQUEST['start'], $_REQUEST['end'], $_REQUEST['ep_id']);
				$user_list[0]['create_time'] = $_REQUEST['end'];
				// $user_list[0]['total'] = $user_list[0]['sdr_online_user'] + $user_list[0]['sdr_offline_user'];
			} else {
				//第一个月
				$starttotalday = date('t', strtotime($_REQUEST['start'])); //当月总天数
				$startday = date('j', strtotime($_REQUEST['start'])); //当月第几天
				if ($startday > 1) {
					$start = $_REQUEST['start'];
					$end = date("Y-m-d", (strtotime($start) + ($starttotalday - $startday) * 86400));
					$aStart = $this->report->get_day_commercial_user($start, $end, $_REQUEST['ep_id']);
					$aStart[0]['create_time'] = $end;
					$_REQUEST['start'] = date("Y-m-d", (strtotime($end) + 86400));
				}
				//最后一个月
				$totalday = date('t', strtotime($_REQUEST['end'])); //当月总天数
				$orderday = date('j', strtotime($_REQUEST['end'])); //当月第几天
				if ($totalday > $orderday) {//所选的$end时间不是当月的最后一天
					$end = $_REQUEST['end'];
					$start = date("Y-m-d", (strtotime($end) - ($orderday - 1) * 86400));
					$aEnd = $this->report->get_day_commercial_user($start, $end, $_REQUEST['ep_id']);
					$aEnd[0]['create_time'] = $end;
				}

				$this->report->set($_REQUEST);
				$user_list = $this->report->get_commercial_user();
				$_REQUEST['start'] = $start_a;
				if ($aStart[0]['sdr_add_user'] != '' || $aStart[0]['sdr_del_user'] != '' || $aStart[0]['sdr_grow_user'] != '' ) {
					array_unshift($user_list, $aStart[0]);
				}
				if ($totalday > $orderday) {//所选的$end时间不是当月的最后一天
					array_push($user_list, $aEnd[0]);
				}
			}

			// var_dump($user_list);
		} else {
			$_REQUEST['sdr_cyc_type'] = 0;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒 七天604800
				//$_REQUEST['start']=date("Y-m-d",time()-604800);
				//$_REQUEST['end']=date("Y-m-d",time());                   
				$_REQUEST['start'] = date("Y-m-d", time() - (604800));
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_commercial_user();
		}

		return $user_list;
	}

	/**
	 * 柱状图
	 * 获得相对应日期的数据
	 * type:日,周,月
	 */
	public function get_list_histogram() {
		if ($_REQUEST['data_type'] == '_live' || $_REQUEST['a'] == "get_live_ratio") {//存活率
			$user_list = $this->get_live();
		} elseif ($_REQUEST['data_type'] == '_livenum' || $_REQUEST['a'] == 'livenessdata') {//活跃度
			$user_list = $this->get_livenum();
		} elseif ($_REQUEST['data_type'] == "_call_record") { //单呼次数
			$user_list = $this->get_intercom('sdr_audio_caller_count,sdr_audio_callee_count,sdr_audio_count');
		} elseif ($_REQUEST['data_type'] == "_call_time") { //单呼时长
			$user_list = $this->get_intercom('sdr_audio_caller_time,sdr_audio_callee_time,sdr_audio_time');
            $user_list = $this->make_round($user_list,'_call_time');
		} elseif ($_REQUEST['data_type'] == "_video_record") { //视频次数
			$user_list = $this->get_intercom('sdr_video_caller_count,sdr_video_callee_count,sdr_video_count');
		} elseif ($_REQUEST['data_type'] == "_video_time") { //视频时长
			$user_list = $this->get_intercom('sdr_video_caller_time,sdr_video_callee_time,sdr_video_time');
            $user_list = $this->make_round($user_list,'_video_time');
		} elseif ($_REQUEST['data_type'] == "_term_type") { //终端数据
			$user_list = $this->get_term_data('sdr_terminal_user_commercial,sdr_terminal_user_test,sdr_terminal_user,sdr_terminal_user_sort');
		} elseif ($_REQUEST['data_type'] == "_gprs_type") { //流量卡数据
			$user_list = $this->get_term_data('sdr_gprs_user_commercial,sdr_gprs_user_test,sdr_gprs_user');
		}
		return $user_list;
	}

	/*
	 * 存活率
	 */

	public function get_live() {
		if ($_REQUEST['date_type'] == "week") {
			$_REQUEST['sdr_date_flag'] = 1;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$cha = intval(abs(strtotime($_REQUEST['start']) - strtotime($_REQUEST['end'])) / (3600 * 24)); //两个时间差
			$w = date("N", strtotime($_REQUEST['start']));
			$s = date("N", strtotime($_REQUEST['end']));
			if (($s - $w) == $cha) {//如果开始和结束时间是同一个周
				//计算最后一周$endday天的值放到数组最后，取最后一天的值即可
				$user_list = $this->report->get_day_live_user($_REQUEST['end'], $_REQUEST['ep_id']);
			} else {

				$this->report->set($_REQUEST);
				$user_list = $this->report->get_live_user();
				if ($s != 7) {
					$aEnd = $this->report->get_day_live_user($_REQUEST['end'], $_REQUEST['ep_id']);
					array_push($user_list, $aEnd[0]);
				}
			}
		} else if ($_REQUEST['date_type'] == "month") {
			$_REQUEST['sdr_date_flag'] = 2;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$stime = explode('-', $_REQUEST['start']);
			$etime = explode('-', $_REQUEST['end']);
			//如果开始和结束时间是同一个月
			if ($stime[0] == $etime[0] && $stime[1] == $etime[1]) {
				$user_list = $this->report->get_day_live_user($_REQUEST['end'], $_REQUEST['ep_id']);
			} else {

				$this->report->set($_REQUEST);
				$user_list = $this->report->get_live_user();
				$BeginDate = date('Y-m-01', strtotime($_REQUEST['end']));
				$endDate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
				if ($_REQUEST['end'] != $endDate) {
					$aEnd = $this->report->get_day_live_user($_REQUEST['end'], $_REQUEST['ep_id']);
					array_push($user_list, $aEnd[0]);
				}
			}
		} else {
			$_REQUEST['sdr_date_flag'] = 0;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒 七天604800
				//$_REQUEST['start']=date("Y-m-d",time()-604800);
				//$_REQUEST['end']=date("Y-m-d",time());                   
				$_REQUEST['start'] = date("Y-m-d", time() - (604800));
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_live_user();
		}

		return $user_list;
	}

	/*
	 * 在线人数
	 */

	public function get_livenum() {
		$start_a = $_REQUEST['start'];
		if ($_REQUEST['date_type'] == "week") {
			$_REQUEST['sdr_date_flag'] = 1;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}

			$cha = intval(abs(strtotime($_REQUEST['start']) - strtotime($_REQUEST['end'])) / (3600 * 24)); //两个时间差
			$w = date("N", strtotime($_REQUEST['start']));
			$s = date("N", strtotime($_REQUEST['end']));
			if (($s - $w) == $cha) {//如果开始和结束时间是同一个周
				$user_list = $this->report->get_day_live_num($_REQUEST['end'], $_REQUEST['ep_id']);
				$user_list[0]['total'] = $user_list[0]['sdr_online_user'] + $user_list[0]['sdr_offline_user'];
			} else {
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_live_num();
				if ($s != 7) {
					$aEnd = $this->report->get_day_live_num($_REQUEST['end'], $_REQUEST['ep_id']);
					$aEnd[0]['total'] = $aEnd[0]['sdr_online_user'] + $aEnd[0]['sdr_offline_user'];
					array_push($user_list, $aEnd[0]);
				}
			}
		} else if ($_REQUEST['date_type'] == "month") {
			$_REQUEST['sdr_date_flag'] = 2;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}

			$stime = explode('-', $_REQUEST['start']);
			$etime = explode('-', $_REQUEST['end']);
			//如果开始和结束时间是同一个月
			if ($stime[0] == $etime[0] && $stime[1] == $etime[1]) {
				$user_list = $this->report->get_day_live_num($_REQUEST['end'], $_REQUEST['ep_id']);
				$user_list[0]['total'] = $user_list[0]['sdr_online_user'] + $user_list[0]['sdr_offline_user'];
			} else {
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_live_num();
				$BeginDate = date('Y-m-01', strtotime($_REQUEST['end']));
				$endDate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
				if ($_REQUEST['end'] != $endDate) {
					$aEnd = $this->report->get_day_live_num($_REQUEST['end'], $_REQUEST['ep_id']);
					$aEnd[0]['total'] = $aEnd[0]['sdr_online_user'] + $aEnd[0]['sdr_offline_user'];
					array_push($user_list, $aEnd[0]);
				}
			}



			// var_dump($user_list);
		} else {
			$_REQUEST['sdr_date_flag'] = 0;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒 七天604800
				//$_REQUEST['start']=date("Y-m-d",time()-604800);
				//$_REQUEST['end']=date("Y-m-d",time());                   
				$_REQUEST['start'] = date("Y-m-d", time() - (604800));
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_live_num();
		}

		return $user_list;
	}

	/*
	 * 获取持续在线人数
	 */

	public function get_livesum() {
		$start_a = $_REQUEST['start'];
		$_REQUEST['online_field'] = "sdr_online" . $_REQUEST['online_days'] . "_user";
		if ($_REQUEST['date_type'] == "week") {
			$_REQUEST['sdr_date_flag'] = 1;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}

			$cha = intval(abs(strtotime($_REQUEST['start']) - strtotime($_REQUEST['end'])) / (3600 * 24)); //两个时间差
			$w = date("N", strtotime($_REQUEST['start']));
			$s = date("N", strtotime($_REQUEST['end']));
			if (($s - $w) == $cha) {//如果开始和结束时间是同一个周
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_day_live_sum($_REQUEST['end'], $_REQUEST['ep_id']);
				// $user_list[0]['create_time'] = $_REQUEST['end'];
				// $user_list[0]['total'] = $user_list[0]['sdr_online_user'] + $user_list[0]['sdr_offline_user'];
			} else {
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_live_sum();
				if ($s != 7) {
					$aEnd = $this->report->get_day_live_sum($_REQUEST['end'], $_REQUEST['ep_id']);
					array_push($user_list, $aEnd[0]);
				}
			}
		} else if ($_REQUEST['date_type'] == "month") {
			$_REQUEST['sdr_date_flag'] = 2;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$date1 = explode($tags, $_REQUEST['start']);

			$stime = explode('-', $_REQUEST['start']);
			$etime = explode('-', $_REQUEST['end']);
			//如果开始和结束时间是同一个月
			if ($stime[0] == $etime[0] && $stime[1] == $etime[1]) {
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_day_live_sum($_REQUEST['start'], $_REQUEST['end'], $_REQUEST['ep_id']);
				// $user_list[0]['create_time'] = $_REQUEST['end'];
				// $user_list[0]['total'] = $user_list[0]['sdr_online_user'] + $user_list[0]['sdr_offline_user'];
			} else {
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_live_sum();
				$BeginDate = date('Y-m-01', strtotime($_REQUEST['end']));
				$endDate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
				if ($_REQUEST['end'] != $endDate) {
					$aEnd = $this->report->get_day_live_sum($_REQUEST['end'], $_REQUEST['ep_id']);
					array_push($user_list, $aEnd[0]);
				}
			}



			// var_dump($user_list);
		} else {

			$_REQUEST['sdr_date_flag'] = 0;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒 七天604800
				//$_REQUEST['start']=date("Y-m-d",time()-604800);
				//$_REQUEST['end']=date("Y-m-d",time());                   
				$_REQUEST['start'] = date("Y-m-d", time() - (604800));
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_live_sum();
		}

		return $user_list;
	}

	/*
	 * 获取活跃度
	 */

	public function get_liveness_level() {
		$start_a = $_REQUEST['start'];
		if ($_REQUEST['date_type'] == "week") {
			$_REQUEST['sdr_date_flag'] = 1;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}

			$cha = intval(abs(strtotime($_REQUEST['start']) - strtotime($_REQUEST['end'])) / (3600 * 24)); //两个时间差
			$w = date("N", strtotime($_REQUEST['start']));
			$s = date("N", strtotime($_REQUEST['end']));
			if (($s - $w) == $cha) {//如果开始和结束时间是同一个周
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_day_liveness($_REQUEST['end'], $_REQUEST['ep_id']);

			} else {
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_liveness();
				if ($s != 7) {
					$aEnd = $this->report->get_day_liveness($_REQUEST['end'], $_REQUEST['ep_id']);
					array_push($user_list, $aEnd[0]);
				}
			}
		} else if ($_REQUEST['date_type'] == "month") {
			$_REQUEST['sdr_date_flag'] = 2;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				$_REQUEST['start'] = date("Y-m-d", time() - 604800);
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$date1 = explode($tags, $_REQUEST['start']);

			$stime = explode('-', $_REQUEST['start']);
			$etime = explode('-', $_REQUEST['end']);
			//如果开始和结束时间是同一个月
			if ($stime[0] == $etime[0] && $stime[1] == $etime[1]) {
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_day_liveness($_REQUEST['end'], $_REQUEST['ep_id']);
				// $user_list[0]['create_time'] = $_REQUEST['end'];
				// $user_list[0]['total'] = $user_list[0]['sdr_online_user'] + $user_list[0]['sdr_offline_user'];
			} else {
				$this->report->set($_REQUEST);
				$user_list = $this->report->get_liveness();
				$BeginDate = date('Y-m-01', strtotime($_REQUEST['end']));
				$endDate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
				if ($_REQUEST['end'] != $endDate) {
					$aEnd = $this->report->get_day_liveness($_REQUEST['end'], $_REQUEST['ep_id']);
					array_push($user_list, $aEnd[0]);
				}
			}



			// var_dump($user_list);
		} else {
			$_REQUEST['sdr_date_flag'] = 0;
			if ($_REQUEST['start'] == "" && $_REQUEST['end'] == "") {
				//1天是86400秒
				//$_REQUEST['start']=date("Y-m-d",time()-604800);
				//$_REQUEST['end']=date("Y-m-d",time());                   
				$_REQUEST['start'] = date("Y-m-d", time() - (604800));
				$_REQUEST['end'] = date("Y-m-d", time() - 86400);
			}
			$this->report->set($_REQUEST);
			$user_list = $this->report->get_liveness();
		}


		return $user_list;
	}

	/**
	 * 数据获取接口
	 */
	//折线图
	/**
	 * 获得日显示的通用接口
	 * 单位:日
	 */
	public function get_day_info() {
		if (in_array($_REQUEST['data_type'], $this->histogram)) {
			//var_dump($_REQUEST);
			$user_list = $this->get_list_histogram();
			$arr = array();
			$valid = 0;

			foreach ($user_list as $key => $value) {
				$arr[$key]['date'] = $value['create_time'];
				$i = 0;
				$arr_list = array();

				foreach ($value as $kk => $val) {
					if ($kk != "create_time" && $kk != "sdr_terminal_user_sort") {
						$i++;
						if ($_REQUEST['data_type'] == '_call_time' || $_REQUEST['data_type'] == '_video_time') {
							$arr[$key]['param' . $i] = $val;//round($val / 60, 2);
						} else {
							$arr[$key]['param' . $i] = (int) $val;
						}
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				}
//                $arr[$key]['week']=$value['week'];
				$valid = $i;
			}

            //当终端切换日周月是需要查出终端类型对应的数据
            if($_REQUEST['data_type'] == '_term_type'){
                //终端类型A102W Z106W...
                $this->report->set($_REQUEST);
                $term_type_data = $this->publicGetTermTypeData($user_list);
                $this->smarty->assign("json_type", $term_type_data['json_type']);
                $this->smarty->assign("type_arr", $term_type_data['type_arr']);
                $this->smarty->assign("type_list", $term_type_data['type_list']);
            }
		} else {
			$user_list = $this->get_item_list();
			$arr = array();
			$valid = 0;
			if ($_REQUEST['data_type'] == '_liveness') {
				foreach ($user_list as $key => $value) {
					$arr[$key]['date'] = $value['create_time'];
					$arr[$key]['expenses'] = (int) $value['sdr_active_rate'];
					$arr[$key]['num'] = (int) $value['sdr_online_user'];
				}
			} else {
				foreach ($user_list as $key => $value) {
					$arr[$key]['date'] = $value['create_time'];
					$i = 0;
					$arr_list = array();
					foreach ($value as $kk => $val) {
						if ($kk != "create_time") {
							$i++;
							if ($_REQUEST['unit'] == '1') {
								$arr[$key]['bparam' . $i] = (int) $val . "%";
							}
							if ($_REQUEST['data_type'] == '_speaking_time') {
								$arr[$key]['param' . $i] = $val;//round($val / 60, 2);
							} else {
								$arr[$key]['param' . $i] = (int) $val;
							}
							$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
							$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
						}
					}
//                $arr[$key]['week']=$value['week'];
					$valid = $i;
				}
			}
		}
		
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("index", $_REQUEST['index']);
		$this->smarty->assign("title", $_REQUEST['title']);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
        $this->smarty->assign("check_date", $_REQUEST['date_type']);
		if (in_array($_REQUEST['data_type'], $this->histogram)) {
			$this->htmlrender("modules/report/get_histogram.tpl"); //柱状图
		} else {
			$this->htmlrender("modules/report/get_charts.tpl"); //折线图
		}
	}

	/**
	 * 获得周显示的通用接口
	 * 单位:周
	 */
	public function get_week_info() {
		if (in_array($_REQUEST['data_type'], $this->histogram)) {
			$user_list = $this->get_list_histogram();
			$arr = array();
			$valid = 0;

			foreach ($user_list as $key => $value) {
				$arr[$key]['date'] = $value['create_time'];
				$i = 0;
				$arr_list = array();

				foreach ($value as $kk => $val) {
					if ($kk != "create_time" && $kk != "week" && $kk != "sdr_terminal_user_sort") {
						$i++;
						if ($_REQUEST['data_type'] == '_call_time' || $_REQUEST['data_type'] == '_video_time') {
							$arr[$key]['param' . $i] = $val;//round($val / 60, 2);
						} else {
							$arr[$key]['param' . $i] = (int) $val;
						}
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				}
//                $arr[$key]['week']=$value['week'];
				$valid = $i;
			}
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'total' => $_REQUEST['total']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
            //当终端切换日周月是需要查出终端类型对应的数据
            if($_REQUEST['data_type'] == '_term_type'){
                //终端类型A102W Z106W...
                $this->report->set($_REQUEST);
                $term_type_data = $this->publicGetTermTypeData($user_list);
                $this->smarty->assign("json_type", $term_type_data['json_type']);
                $this->smarty->assign("arr_type", $term_type_data['arr_type']);
                $this->smarty->assign("type_arr", $term_type_data['type_arr']);
                $this->smarty->assign("type_list", $term_type_data['type_list']);
            }
		} else {
			$user_list = $this->get_item_list();
			$arr = array();
			$valid = 0;
			if ($_REQUEST['data_type'] == '_liveness') {
				foreach ($user_list as $key => $value) {
					$arr[$key]['date'] = $value['create_time'];
					$arr[$key]['expenses'] = (int) $value['sdr_active_rate'];
					$arr[$key]['num'] = (int) $value['sdr_online_user'];
				}
			} else {
				foreach ($user_list as $key => $value) {
					$arr[$key]['date'] = $value['create_time'];
					$i = 0;
					$arr_list = array();
					foreach ($value as $kk => $val) {

						if ($kk != "create_time" && $kk != "week") {
							$i++;
							if ($_REQUEST['unit'] == '1') {
								$arr[$key]['bparam' . $i] = (int) $val . "%";
							}
							if ($_REQUEST['data_type'] == '_speaking_time') {
								$arr[$key]['param' . $i] = $val;//round($val / 60, 2);
							} else {
								$arr[$key]['param' . $i] = (int) $val;
							}
							$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
							$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
						}
					}
					// $arr[$key]['week']=$value['week'];
					$valid = $i;
				}
			}
			// var_dump($user_list);
			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					, 'date_type' => 'day'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
					, 'online_days' => $_REQUEST['online_days']
				// ,'title'=>$_REQUEST['title']
			));
		}
		
		$arr = $this->get_week_time($arr);

        $json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("index", $_REQUEST['index']);
		$this->smarty->assign("title", $_REQUEST['title']);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("url", $url);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
        $this->smarty->assign("check_date", $_REQUEST['date_type']);
		if (in_array($_REQUEST['data_type'], $this->histogram)) {
			$this->htmlrender("modules/report/get_histogram_week.tpl"); //柱状图
		} else {
			$this->htmlrender("modules/report/get_charts_week.tpl"); //折线图
		}
	}

	/**
	 * 获得月分显示的通用接口
	 * 单位:月
	 */
	public function get_month_info() {
		if (in_array($_REQUEST['data_type'], $this->histogram)) {
			$user_list = $this->get_list_histogram();
			$arr = array();
			$valid = 0;

			foreach ($user_list as $key => $value) {
				$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
				$arr[$key]['date'] = $value['create_time'];
				$i = 0;
				$arr_list = array();

				foreach ($value as $kk => $val) {
					if ($kk != "create_time" && $kk != "month" && $kk != "sdr_terminal_user_sort") {
						$i++;
						if ($_REQUEST['data_type'] == '_call_time' || $_REQUEST['data_type'] == '_video_time') {
							$arr[$key]['param' . $i] = $val;//round($val / 60, 2);
						} else {
							$arr[$key]['param' . $i] = (int) $val;
						}
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				}
				// $arr[$key]['month']=$value['month'];
				$valid = $i;
			}
			if (!empty($_REQUEST['title'])) {
				foreach ($_REQUEST['title'] as $kr => $valr) {
					if (strstr($kr, 'name')) {
						$_REQUEST['title'][$kr] = urlencode($valr);
					}
				}
			}

			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_histogram'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'total' => $_REQUEST['total']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
				// ,'ep_id'=>$_REQUEST['ep_id']
				// ,'title'=>$_REQUEST['title']
			));
            //当终端切换日周月是需要查出终端类型对应的数据
            if($_REQUEST['data_type'] == '_term_type'){
                //终端类型A102W Z106W...
                $this->report->set($_REQUEST);
                $term_type_data = $this->publicGetTermTypeData($user_list);
                $this->smarty->assign("json_type", $term_type_data['json_type']);
                $this->smarty->assign("arr_type", $term_type_data['arr_type']);
                $this->smarty->assign("type_arr", $term_type_data['type_arr']);
                $this->smarty->assign("type_list", $term_type_data['type_list']);
            }
		} else {
			$user_list = $this->get_item_list();
			$arr = array();
			$valid = 0;
			if ($_REQUEST['data_type'] == '_liveness') {
				foreach ($user_list as $key => $value) {
					$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
					$arr[$key]['date'] = $value['create_time'];
					$arr[$key]['expenses'] = (int) $value['sdr_active_rate'];
					$arr[$key]['num'] = (int) $value['sdr_online_user'];
				}
			} else {
				foreach ($user_list as $key => $value) {
					$arr[$key]['date1'] = substr($value['create_time'], 0, -3);
					$arr[$key]['date'] = $value['create_time'];
					$i = 0;
					$arr_list = array();
					foreach ($value as $kk => $val) {

						if ($kk != "create_time" && $kk != "month") {
							$i++;
							if ($_REQUEST['unit'] == '1') {
								$arr[$key]['bparam' . $i] = (int) $val . "%";
							}
							if ($_REQUEST['data_type'] == '_speaking_time') {
								$arr[$key]['param' . $i] = $val;//round($val / 60, 2);
							} else {
								$arr[$key]['param' . $i] = (int) $val;
							}
							$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
							$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
						}
					}
					// $arr[$key]['month']=$value['month'];
					$valid = $i;
				}
			}


			if (!empty($_REQUEST['title'])) {
				foreach ($_REQUEST['title'] as $kr => $valr) {
					if (strstr($kr, 'name')) {
						$_REQUEST['title'][$kr] = urlencode($valr);
					}
				}
			}

			$url = http_build_query(
				array(
					'm' => 'report'
					, 'a' => 'next_info_charts'
					//,'date_type'=>'day'
					, 'date_type' => 'week'
					, 'data_type' => $_REQUEST['data_type']
					, 'table_type' => $_REQUEST['table_type']
					, 'index' => $_REQUEST['index']
					, 'stackType' => $_REQUEST['stackType']
					, 'start' => $_REQUEST['start']
					, 'end' => $_REQUEST['end']
					, 'ep_id' => $_REQUEST['ep_id']
					, 'online_days' => $_REQUEST['online_days']
				// ,'title'=>$_REQUEST['title']
			));
		}
		$json = json_encode($arr);

		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("index", $_REQUEST['index']);
		$this->smarty->assign("title", $_REQUEST['title']);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("url", $url);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
        $this->smarty->assign("check_date", $_REQUEST['date_type']);
		if (in_array($_REQUEST['data_type'], $this->histogram)) {
			$this->htmlrender("modules/report/get_histogram_month.tpl"); //柱状图
		} else {
			$this->htmlrender("modules/report/get_charts_month.tpl"); //折线图
		}
	}

	/**
	 * 点击某个日期来显示详细的统计图
	 * 通用接口
	 */
	public function next_info_charts() {
		// var_dump("<pre>");var_dump($_REQUEST);
		if ($_REQUEST['u']) {
			$_REQUEST['title'] = array();
			$aArr = explode("__", $_REQUEST['u']);
			foreach ($aArr as $key => $value) {
				$aArr1 = explode("_", $value);
				if (strstr($aArr1[0], "color")) {
					$aArr1[1] = "#" . $aArr1[1];
				}
				$_REQUEST['title'][$aArr1[0]] = $aArr1[1];
			}
		}
		if ($_REQUEST['date_type'] == "week") {
			$time = strtotime(date("Y-m", strtotime($_REQUEST['time'])) . "-01");
			if (strtotime($_REQUEST['start']) < $time) {
				$cha1 = intval(abs(strtotime($_REQUEST['start'])-$time)/(3600*24));
				$w = date("N",strtotime($_REQUEST['start']));
            	$s = date("N",$time);
            	if(($s - $w) != $cha1)
            	{
            		$_REQUEST['start'] = date("Y-m-d",$time-86400*($s-1));
            	}
				// $_REQUEST['start'] = date("Y-m", strtotime($_REQUEST['time'])) . "-01";
			}
			// $_REQUEST['end'] = $_REQUEST['time'];
		} elseif ($_REQUEST['date_type'] == "day") {
			$n = date("N", strtotime($_REQUEST['time']));
			if ($n == 1) {//周一
				$_REQUEST['start'] = $_REQUEST['end'] = $_REQUEST['time'];
			} else {
				$time = strtotime(date("Y-m-d", strtotime($_REQUEST['time']) - 86400 * ($n - 1)));
				if (strtotime($_REQUEST['start']) < $time) {
					$_REQUEST['start'] = date("Y-m-d", strtotime($_REQUEST['time']) - 86400 * ($n - 1));
				}
				$_REQUEST['end'] = $_REQUEST['time'];
			}
		} else {
			$_REQUEST['end'] = $_REQUEST['time'];
		}

		$user_list = $this->get_item_list();
		$arr = array();
		if ($_REQUEST['data_type'] == '_term_type_data') {
			//处理组合终端类型的数据
			$term_list = $this->make_term_data($user_list); //json_type
			//数据
			$type_list = $term_list['data'];
			//终端类型数组
			$arr_list = $term_list['type_arr'];
			foreach ($type_list as $key => $value) {
				$arr[$key]['date'] = $value['create_time'];
				$i = 0;
				$list_type = array();

				// if ($_REQUEST['date_type'] == "week") {
				// 	$arr[$key]['date1'] = "第" . ($key + 1) . "周";
				// 	if($_COOKIE['lang']=='en_US'){
    //         		    $arr[$key]['date1']="Week".($key+1); 
    //     			}
				// } else {
					$arr[$key]['date1'] = $value['create_time'];
				// }

				foreach ($value as $kk => $val) {
					if ($kk != "create_time") {
						$i++;
						$arr[$key]['param' . $kk] = (int) $val;
					}
				}
			}
			$this->smarty->assign("checktype", '_term_type_data');
		} else {
			$valid = 0;
			foreach ($user_list as $key => $value) {
				// if ($_REQUEST['date_type'] == "week") {
				// 	$arr[$key]['date1'] = "第" . ($key + 1) . "周";
				// 	if($_COOKIE['lang']=='en_US'){
	   //                  $arr[$key]['date1']="Week".($key+1); 
	   //              }
				// 	$arr[$key]['date'] = $value['create_time'];
				// } else {
					$arr[$key]['date1'] = $value['create_time'];
					$arr[$key]['date'] = $value['create_time'];
				// }
				// if ($_REQUEST['data_type'] == '_liveness') {
				// {
				// 	$arr[$key]['num'] = (int) $value['sdr_online_user'];
				// }

				$i = 0;
				$arr_list = array();
				foreach ($value as $kk => $val) {

					if ($kk != "create_time" && $kk != "month") {
						$i++;
						if($_REQUEST['data_type']=='_speaking_time'){
							$arr[$key]['param' . $i] = (float) $val;
						}else{
							$arr[$key]['param' . $i] = (int) $val;
						}
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				}
				// $arr[$key]['month']=$value['month'];
				$valid = $i;
			}
		}

		if($_REQUEST['date_type'] == 'week')
		{
			$arr = $this->get_week_time($arr);
		}
		//var_dump($_REQUEST);
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("check_date", $_REQUEST['change_time']['check_date']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("index", $_REQUEST['index']);
		$this->smarty->assign("title", $_REQUEST['title']);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/next_info_charts.tpl"); //折线图
	}

	public function next_info_histogram() {
		// var_dump("<pre>");var_dump($_REQUEST);
		if ($_REQUEST['u']) {
			$_REQUEST['title'] = array();
			$aArr = explode("__", $_REQUEST['u']);
			foreach ($aArr as $key => $value) {
				$aArr1 = explode("_", $value);
				if (strstr($aArr1[0], "color")) {
					$aArr1[1] = "#" . $aArr1[1];
				}
				$_REQUEST['title'][$aArr1[0]] = $aArr1[1];
			}
		}
		
		if ($_REQUEST['date_type'] == "week") {
			$time = strtotime(date("Y-m", strtotime($_REQUEST['time'])) . "-01");
			if (strtotime($_REQUEST['start']) < $time) {
				$cha1 = intval(abs(strtotime($_REQUEST['start'])-$time)/(3600*24));
				$w = date("N",strtotime($_REQUEST['start']));
            	$s = date("N",$time);
            	if(($s - $w) != $cha1)
            	{
            		$_REQUEST['start'] = date("Y-m-d",$time-86400*($s-1));
            	}
				// $_REQUEST['start'] = date("Y-m", strtotime($_REQUEST['time'])) . "-01";
			}
		} elseif ($_REQUEST['date_type'] == "day") {
			$n = date("N", strtotime($_REQUEST['time']));
			if ($n == 1) {//周一
				$_REQUEST['start'] = $_REQUEST['end'] = $_REQUEST['time'];
			} else {
				$time = strtotime(date("Y-m-d", strtotime($_REQUEST['time']) - 86400 * ($n - 1)));
				if (strtotime($_REQUEST['start']) < $time) {
					$_REQUEST['start'] = date("Y-m-d", strtotime($_REQUEST['time']) - 86400 * ($n - 1));
				}

				$_REQUEST['end'] = $_REQUEST['time'];
			}
		} else {
			$_REQUEST['end'] = $_REQUEST['time'];
		}

		$user_list = $this->get_list_histogram();
		$arr = array();
		$valid = 0;
		foreach ($user_list as $key => $value) {
			// if ($_REQUEST['date_type'] == "week") {
			// 	$arr[$key]['date1'] = "第" . ($key + 1) . "周";
			// 	if($_COOKIE['lang']=='en_US'){
   //          		$arr[$key]['date1']="Week".($key+1); 
   //      		}
			// 	$arr[$key]['date'] = $value['create_time'];
			// } else {
				$arr[$key]['date1'] = $value['create_time'];
				$arr[$key]['date'] = $value['create_time'];
			// }
			$i = 0;
			$arr_list = array();

			foreach ($value as $kk => $val) {
				if ($_REQUEST['data_type'] == '_term_type') {
					//如果是终端的话，则还需要判断字段名不等于sdr_terminal_user_sort
					if ($kk != "create_time" && $kk != "month" && $kk != "sdr_terminal_user_sort") {
						$i++;
						$arr[$key]['param' . $i] = (int) $val;
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				} else {
					if ($kk != "create_time" && $kk != "month") {
						$i++;
						//当数据为单呼时长或视频时长时则不取整数
						if($_REQUEST['data_type']=='_call_time'||$_REQUEST['data_type']=='_video_time'){
							$arr[$key]['param' . $i] = (float)$val;
						}else{
							$arr[$key]['param' . $i] = (int)$val;
						}
						$arr_list[$i]['name'] = $_REQUEST['title']["name" . $i];
						$arr_list[$i]['color'] = $_REQUEST['title']["color" . $i];
					}
				}
			}
			// $arr[$key]['month']=$value['month'];
			$valid = $i;
		}
		if($_REQUEST['date_type'] == 'week')
		{
			$arr = $this->get_week_time($arr);
		}
		$json = json_encode($arr);
		$this->smarty->assign("list", $user_list);
		$this->smarty->assign("arr_list", $arr_list);
		$this->smarty->assign("arr", $arr);
		$this->smarty->assign("sCount", $valid);
		$this->smarty->assign("check_date", $_REQUEST['change_time']['check_date']);
		$this->smarty->assign("json", $json);
		$this->smarty->assign("data_type", $_REQUEST['data_type']);
		$this->smarty->assign("date_type", $_REQUEST['date_type']);
		$this->smarty->assign("table_type", $_REQUEST['table_type']);
		$this->smarty->assign("index", $_REQUEST['index']);
		$this->smarty->assign("title", $_REQUEST['title']);
		$this->smarty->assign("res", $_REQUEST);
		$this->smarty->assign("change_time", $_REQUEST['change_time']);
		$this->htmlrender("modules/report/next_info_histogram.tpl"); //柱状图
	}

	/**
	 * ======================================END========================================
	 */
	public function get_ep_ag_list() {
		$ag_list = $this->report->get_ep_ag_list();
		echo json_encode($ag_list, TRUE);
	}

	public function get_server_list() {
		$server_list = $this->report->get_server_list();
		echo json_encode($server_list, TRUE);
	}

	/**
	 * 判断时间段的长度 来规定时间的切换以及时间的缺省显示
	 */
	public function change_time() {
		if ($_REQUEST['start'] != '' && $_REQUEST['end'] != '') {

			$end = strtotime($_REQUEST['end']);
			$now = strtotime(date('Y-m-d', time()));
			if ($end >= $now) {
				$_REQUEST['end'] = date('Y-m-d', time() - 86400);
			}
			$change_time = $this->make_change_time($_REQUEST['start'], $_REQUEST['end']);
		} elseif ($_REQUEST['start'] != '' && $_REQUEST['end'] == '') {

			$_REQUEST['end'] = date('Y-m-d', time() - 86400);
			$change_time = $this->make_change_time($_REQUEST['start'], $_REQUEST['end']);
		} else {
			$change_time = $this->make_change_time('', '');
		}
		$_REQUEST['change_time'] = $change_time;
	}

	/**
	 * 时间切换控制、默认时间缺省显示、Y轴单位显示、日月周判断  全局总方法
	 */
	public function make_change_time($start, $end) {
		$data_type = $_REQUEST['data_type'];
		$change_time = array();
		$change_time['firstStart'] = $_REQUEST['start'];
		$day = 'day' . $data_type;
		$week = 'week' . $data_type;
		$month = 'month' . $data_type;

		//判断并确定前端单位
		$unit_array = array(
			'_already_open' => '人',
			'_commercial' => '人',
			'_live' => '人',
			'_livenum' => '人',
			'_livesum' => '人',
			'_liveness' => '',
			'_calls' => '',
			'_intercom_recording' => '次',
			'_speaking_time' => '分钟',
			'_call_record' => '次',
			'_call_time' => '分钟',
			'_video_record' => '次',
			'_video_time' => '分钟',
			'_term_type' => '个',
			'_term_type_data' => '个',
			'_gprs_type' => '个',
			'_gprs_agents' => '个'
		);

	    //判断是否周月日的切换是则跳过下面的时间判断
        $get_time = $_REQUEST['a'];
        //判断时候是 切换日周月的 终端类型 选择商用和测试
        if(isset($_REQUEST['checktermdata'])){
            $termdata = $_REQUEST['checktermdata'];
        }else{
            $termdata='';
        }
      	
      	//排除 不需要 尽行判断开始结束时间确定默认显示时间单位的url 的数组
        $get_out = array('get_day_info', 'get_week_info', 'get_month_info', 'next_info_charts', 'next_info_histogram');
        
        if ( !in_array($get_time,$get_out) && $termdata!='checktermdata' )
        { 
    		if ($start != '' && $end != '') {
    			$stime = strtotime($start);
    			$etime = strtotime($end);

    			$num = $etime - $stime + 86400;
    			//判断缺省时间单位 
    			if ($num / 86400 > 90 && $num / 86400 < 270) {
 
    				$_REQUEST['date_type'] = 'week';
    				
    				$change_time['checked'] = $week;
    			} elseif ($num / 86400 >= 270) {
    				
    				$_REQUEST['date_type'] = 'month';
    				
    				$change_time['checked'] = $month;
    			}

    			if ($data_type == '_term_type' || $data_type == '_term_type_data' || $data_type == '_gprs_type') {
    				//当统计数据为终端、终端类型或者流量卡时的 搜索的缺省时间单位
    				if ($num / 86400 > 90 && $num / 86400 < 270) {
    					$_REQUEST['date_type'] = 'week';
    					$change_time['checked'] = $week;
    				} elseif ($num / 86400 >= 270 && $num / 86400 < 720) {
    					$_REQUEST['date_type'] = 'month';
    					$change_time['checked'] = $month;
    				} elseif ($num / 86400 >= 720) {
    					//$_REQUEST['date_type'] = 'year';
    					$_REQUEST['date_type'] = 'month';
    					$change_time['checked'] = $month;
    				} else {
    					$_REQUEST['date_type'] = 'day';
    				}
    			}

    			//判断时间切换可选时间单位
    			if ($num / 86400 < 7) {
    				$week = '';
    				$month = '';
    			} elseif ($num / 86400 >= 7 && $num / 86400 < 30) {
    				$month = '';
    			}
    		}
	    }else{
	    	$change_time['checked'] = $_REQUEST['date_type'];
	    }
		$change_time['day'] = $day;
		$change_time['week'] = $week;
		$change_time['month'] = $month;
		if ($_REQUEST['date_type'] == 'week') {
			$change_time['dateType'] = '日';
			$change_time['check_date'] = 'day';
		} elseif ($_REQUEST['date_type'] == 'month') {
			$change_time['dateType'] = '周';
			$change_time['check_date'] = 'week';
		} elseif ($_REQUEST['date_type'] == 'year') {
			$change_time['dateType'] = '月';
			$change_time['check_date'] = 'month';
		} else {
			$change_time['dateType'] = '日';
			$change_time['check_date'] = 'day';
		}
		//单位
		$change_time['unit'] = $unit_array["{$data_type}"];

		return $change_time;
	}

	public function checkdate() {
		if ($_REQUEST['start'] > $_REQUEST['end']) {
			echo -1;
		} else {
			echo 1;
		}
	}

	/*
	* 周获取时间段
	*/
	public function get_week_time($arr)
	{
		foreach ($arr as $key => $value) {
            $time = strtotime($value['date']);
            // var_dump($starttime);echo "<br>";var_dump($time);echo "<br/>";
            $cha = intval(abs($time-strtotime($_REQUEST['start']))/(3600*24));//两个时间差
            $cha1 = intval(abs(strtotime($_REQUEST['end'])-strtotime($_REQUEST['start']))/(3600*24));//两个时间差
            $cha2 = intval(abs(strtotime($_REQUEST['end'])-$time)/(3600*24));//两个时间差
            $w = date("N",strtotime($_REQUEST['start']));
            $s = date("N",$time);
            $e = date("N",strtotime($_REQUEST['end']));
            if(($e - $w) == $cha1)//开始时间和结束时间是一周
            {
                $arr[$key]['date1'] = date("m-d",strtotime($_REQUEST['start']))."~".date("m-d",strtotime($_REQUEST['end']));
            }
            else
            {
                if($time >= strtotime($_REQUEST['start']))
                {
                    if(($s - $w) == $cha)
                    {
                        $arr[$key]['date1'] = date("m-d",strtotime($_REQUEST['start']))."~".date("m-d",strtotime($value['date']));
                        // var_dump($arr[$key]['date']);
                    }
                    else
                    {
                        $arr[$key]['date1'] = date("m-d",$time-86400*($s-1))."~".date("m-d",strtotime($value['date']));
                    }
                }
                elseif($time <= $_REQUEST['end'] && $key = count($arr) -1)
                {
                    if(($e - $s) == $cha2)
                    {
                    $arr[$key]['date1'] = date("m-d",$time)."~".date("m-d",strtotime($value['date']));
                    }
                    else
                    {
                    $arr[$key]['date1'] = date("m-d",strtotime($_REQUEST['end'])-86400*($e-1))."~".date("m-d",strtotime($value['date']));
                    }
                }
                else
                {
                    $arr[$key]['date1'] = date("m-d",$endtime-86400*($e-1))."~".date("m-d",strtotime($value['date']));
                }
            }

		}

		return $arr;
	}

    /*
    *分转换为秒保留两位小数的公共方法
    */
    public function make_round( $data , $data_type )
    {
        $arr = array(
            '_call_time'=>array('total'=>'sdr_audio_time','com'=>'sdr_audio_caller_time','test'=>'sdr_audio_callee_time'),
            '_video_time'=>array('total'=>'sdr_video_time','com'=>'sdr_video_caller_time','test'=>'sdr_video_callee_time'),
            );
        $Tot_field = $arr[$data_type]['total'];
        $Com_field = $arr[$data_type]['com'];
        $Tes_field = $arr[$data_type]['test'];
        foreach ($data as $key => $value) {
        	if($value[$Com_field]!==NULL && $value[$Tes_field]!==NULL){
				$data[$key][$Com_field] = round($value[$Com_field]/60,2);
            	$data[$key][$Tes_field] = round($value[$Tes_field]/60,2);
            	$data[$key][$Tot_field] = $data[$key][$Com_field]+$data[$key][$Tes_field];
			}
        }
        return $data;
    }

    /*
    *切换日周月时 终端类型 数据获取 公共方法
    */
    public function publicGetTermTypeData($user_list){
        //$data_list=$this->get_item_list();
        $data_list = $user_list;
        //处理组合终端类型的数据
        $term_list = $this->make_term_data($data_list); //json_type
        //数据
        $type_list = $term_list['data'];
        //终端类型数组
        $type_arr = $term_list['type_arr'];

        $arr_type = array();
        foreach ($type_list as $key => $value) {
            $arr_type[$key]['date'] = $value['create_time'];
            $arr_type[$key]['date1'] = substr($value['create_time'], 0, -3);
            $i = 0;
            $list_type = array();

            foreach ($value as $kk => $val) {
                if ($kk != "create_time") {
                    $i++;
                    $arr_type[$key]['param' . $kk] = (int) $val;
                }
            }
        }
        //当为周时，时间显示为 某天到某天
		if($_REQUEST['date_type'] == 'week')
		{
			$arr_type = $this->get_week_time($arr_type);
		}
        $json_type = json_encode($arr_type);
        $res = array();
        $res['json_type'] = $json_type;
        $res['type_arr'] = $type_arr;
        $res['type_list'] = $type_list;
        $res['arr_type'] = $arr_type;
        return $res;
    }
}
