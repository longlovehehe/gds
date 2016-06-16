<?php

/**
 * 数据统计Model
 * @category 业务统计
 * @package 数据统计
 * @subpackage  Model层
 */
class report extends db {

	function __construct($data) {
		parent::__construct();
		$this->data = $data;
	}

	public function get() {
		return $this->data;
	}

	public function set($data) {
		$this->data = $data;
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
	 * 
	 */
	/**
	 * 1.开户数据
	 * =================================START======================================
	 */

	/**
	 * 用户明细
	 */
	public function get_user() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_time as create_time,sdr_user,sdr_commercial_user,sdr_test_user,sdr_enable_user,sdr_disable_user,sdr_phone_user,sdr_console_user,sdr_gvs_user FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_time as create_time,sdr_user,sdr_commercial_user,sdr_test_user,sdr_enable_user,sdr_disable_user,sdr_phone_user,sdr_console_user,sdr_gvs_user FROM \"T_UserData_Statistics_EMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_time as create_time,sdr_user,sdr_commercial_user,sdr_test_user,sdr_enable_user,sdr_disable_user,sdr_phone_user,sdr_console_user,sdr_gvs_user FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		}
		if ($this->data['start'] != '' && $this->data['end'] != '') {
			$select .= " AND sdr_time >= '" . $this->data['start'] . "' AND sdr_time <= '" . $this->data['end'] . "'";
		}
		$select .= " AND sdr_date_flag = '" . $this->data['sdr_date_flag'] . "'";
		$select .= " ORDER BY create_time";
		// echo $select;
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/*
	 * 获取某天的用户数据
	 */

	public function get_day_user($day, $ep_id) {
		if ($ep_id == '' || $ep_id == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_time as create_time,sdr_user,sdr_commercial_user,sdr_test_user,sdr_enable_user,sdr_disable_user,sdr_phone_user,sdr_console_user,sdr_gvs_user FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($ep_id) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_time as create_time,sdr_user,sdr_commercial_user,sdr_test_user,sdr_enable_user,sdr_disable_user,sdr_phone_user,sdr_console_user,sdr_gvs_user FROM \"T_UserData_Statistics_EMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_time as create_time,sdr_user,sdr_commercial_user,sdr_test_user,sdr_enable_user,sdr_disable_user,sdr_phone_user,sdr_console_user,sdr_gvs_user FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		}
		$select .= " AND sdr_date_flag = '0' AND sdr_time = '" . $day . "'";
		// echo $select;
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * 展示商用用户数
	 */
	public function get_commercial_user() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_time as create_time,sdr_add_user,sdr_del_user,sdr_grow_user FROM \"T_UserCycle_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_time as create_time,sdr_add_user,sdr_del_user,sdr_grow_user  FROM \"T_UserCycle_Statistics_EMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_time as create_time,sdr_add_user,sdr_del_user,sdr_grow_user  FROM \"T_UserCycle_Statistics_AMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		}
		if ($this->data['start'] != '' && $this->data['end'] != '') {
			$select .= " AND sdr_time >= '" . $this->data['start'] . "' AND sdr_time <= '" . $this->data['end'] . "'";
		}
		$select .= " AND sdr_cyc_type = '" . $this->data['sdr_cyc_type'] . "'";
		$select .= " ORDER BY sdr_time";
		// echo $select."<br><br>";
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/*
	 * 获取某段时间的和
	 */

	public function get_day_commercial_user($start, $end, $ep_id) {
		if ($ep_id == '' || $ep_id == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sum(sdr_add_user) as sdr_add_user,sum(sdr_del_user) as sdr_del_user,sum(sdr_grow_user) as sdr_grow_user FROM \"T_UserCycle_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($ep_id) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sum(sdr_add_user) as sdr_add_user,sum(sdr_del_user) as sdr_del_user,sum(sdr_grow_user) as sdr_grow_user  FROM \"T_UserCycle_Statistics_EMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sum(sdr_add_user) as sdr_add_user,sum(sdr_del_user) as sdr_del_user,sum(sdr_grow_user) as sdr_grow_user  FROM \"T_UserCycle_Statistics_AMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		}
		if ($start != '' && $end != '') {
			$select .= " AND sdr_time >= '" . $start . "' AND sdr_time <= '" . $end . "'";
		}
		$select .= " AND sdr_cyc_type = '0'";
		// $select .= " ORDER BY sdr_time";
		// echo $select."<br>";
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * 存活率
	 */
	public function get_live_user() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_time as create_time,sdr_survival_user,sdr_loss_user,sdr_cumulative_users FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_time as create_time,sdr_survival_user,sdr_loss_user,sdr_cumulative_users  FROM \"T_UserState_Statistics_EMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_time as create_time,sdr_survival_user,sdr_loss_user,sdr_cumulative_users  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		}
		if ($this->data['start'] != '' && $this->data['end'] != '') {
			$select .= " AND sdr_time >= '" . $this->data['start'] . "' AND sdr_time <= '" . $this->data['end'] . "'";
		}
		$select .= " AND sdr_date_flag = '" . $this->data['sdr_date_flag'] . "'";
		$select .= " ORDER BY sdr_time";
		// echo $select."<br><br>";
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/*
	 * 获取某天存活率信息
	 */

	public function get_day_live_user($day, $ep_id) {
		if ($ep_id == '' || $ep_id == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_time as create_time,sdr_survival_user,sdr_loss_user,sdr_cumulative_users FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($ep_id) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_time as create_time,sdr_survival_user,sdr_loss_user,sdr_cumulative_users FROM \"T_UserState_Statistics_EMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_time as create_time,sdr_survival_user,sdr_loss_user,sdr_cumulative_users FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		}
		$select .= " AND sdr_date_flag = '0' AND sdr_time = '" . $day . "'";
		// echo $select;
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
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
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_time as create_time,sdr_online_user,sdr_offline_user,(sdr_online_user+sdr_offline_user) as total FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_time as create_time,sdr_online_user,sdr_offline_user,(sdr_online_user+sdr_offline_user) as total FROM \"T_UserState_Statistics_EMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_time as create_time,sdr_online_user,sdr_offline_user,(sdr_online_user+sdr_offline_user) as total  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		}
		if ($this->data['start'] != '' && $this->data['end'] != '') {
			$select .= " AND sdr_time >= '" . $this->data['start'] . "' AND sdr_time <= '" . $this->data['end'] . "'";
		}
		$select .= " AND sdr_date_flag = '" . $this->data['sdr_date_flag'] . "'";
		$select .= " ORDER BY sdr_time";
		// echo $select."<br><br>";
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/*
	 * 获取某段时间的和
	 */

	public function get_day_live_num($day, $ep_id) {
		if ($ep_id == '' || $ep_id == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_online_user,sdr_offline_user,sdr_time as create_time FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($ep_id) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_online_user,sdr_offline_user,sdr_time as create_time  FROM \"T_UserState_Statistics_EMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_online_user,sdr_offline_user,sdr_time as create_time  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		}
		// if ($start != '' && $end != '') {
		// 	$select .= " AND sdr_time >= '" . $start . "' AND sdr_time <= '" . $end . "'";
		// }
		$select .= " AND sdr_date_flag = '0' AND sdr_time = '" . $day . "'";
		// $select .= " ORDER BY sdr_time";
		// echo $select."<br>";
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * 持续在线人数
	 */
	public function get_live_sum() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_time as create_time," . $this->data['online_field'] . " as online_num FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_time as create_time," . $this->data['online_field'] . " as online_num FROM \"T_UserState_Statistics_EMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_time as create_time," . $this->data['online_field'] . " as online_num  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		}
		if ($this->data['start'] != '' && $this->data['end'] != '') {
			$select .= " AND sdr_time >= '" . $this->data['start'] . "' AND sdr_time <= '" . $this->data['end'] . "'";
		}
		$select .= " AND sdr_date_flag = '" . $this->data['sdr_date_flag'] . "'";
		$select .= " ORDER BY sdr_time";
		// echo $select."<br><br>";
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/*
	 * 获取某段时间的和
	 */

	public function get_day_live_sum($day, $ep_id) {
		if ($ep_id == '' || $ep_id == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT " . $this->data['online_field'] . " as online_num,sdr_time as create_time  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($ep_id) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT " . $this->data['online_field'] . " as online_num,sdr_time as create_time   FROM \"T_UserState_Statistics_EMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT " . $this->data['online_field'] . " as online_num,sdr_time as create_time   FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
		}
		// if ($start != '' && $end != '') {
		// 	$select .= " AND sdr_time >= '" . $start . "' AND sdr_time <= '" . $end . "'";
		// }
		$select .= " AND sdr_date_flag = '0' AND sdr_time = '" . $day . "'";
		// $select .= " ORDER BY sdr_time";
		// echo $select."<br>";
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * 活跃度
	 */
	public function get_liveness() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_time as create_time,CAST(sdr_active_rate*100 as NUMERIC(6,2)) as sdr_active_rate,sdr_online_user FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_time as create_time,CAST(sdr_active_rate*100 as NUMERIC(6,2)) as sdr_active_rate,sdr_online_user FROM \"T_UserState_Statistics_EMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_time as create_time,CAST(sdr_active_rate*100 as NUMERIC(6,2)) as sdr_active_rate,sdr_online_user  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='" . trim($this->data['ep_id']) . "'";
		}
		if ($this->data['start'] != '' && $this->data['end'] != '') {
			$select .= " AND sdr_time >= '" . $this->data['start'] . "' AND sdr_time <= '" . $this->data['end'] . "'";
		}
		$select .= " AND sdr_date_flag = '" . $this->data['sdr_date_flag'] . "'";
		$select .= " ORDER BY sdr_time";
		// echo $select."<br><br>";
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/*
	 * 获取某天存活率
	 */

	public function get_day_liveness($day, $ep_id) {
		if ($ep_id == '' || $ep_id == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT CAST(sdr_active_rate*100 as NUMERIC(6,2)) as sdr_active_rate,sdr_online_user,sdr_time as create_time  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
			// $select1 = "SELECT sdr_cumulative_users  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($ep_id) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT CAST(sdr_active_rate*100 as NUMERIC(6,2)) as sdr_active_rate,sdr_online_user,sdr_time as create_time   FROM \"T_UserState_Statistics_EMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
			// $select1 = "SELECT sdr_cumulative_users  FROM \"T_UserState_Statistics_EMP\" WHERE sdr_id ='0'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT CAST(sdr_active_rate*100 as NUMERIC(6,2)) as sdr_active_rate,sdr_online_user,sdr_time  as create_time  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='" . trim($ep_id) . "'";
			$select1 = "SELECT sdr_cumulative_users  FROM \"T_UserState_Statistics_AMP\" WHERE sdr_id ='0'";
		}
		
		$select .= " AND sdr_date_flag = '0' AND sdr_time = '" . $day . "'";
		// echo $select."<br>";
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/*
	 * ==================================END====================================== 
	 */

	/**
	 * 3.业务数据
	 * =================================START======================================
	 */

	/**
	 * 对讲次数      业务数据处理全
	 */
	public function get_intercom($field = '*') {
		//var_dump($this->data);
		if (isset($this->data['checkp']) && $this->data['checkp'] == '1') {
			$sql = "SELECT {$field} FROM \"T_CallCycle_Statistics_S\"";
			if ($this->data['ep_id'] != "") {
				$s = " AND sdr_id = '{$this->data['ep_id']}'";
			}else{
                return array();
            }
		} else {
			if ($this->data['ep_id'] == "") {
				$sql = "SELECT {$field} FROM \"T_CallCycle_Statistics_AMP\"";
				$s = " AND sdr_id = '0'";
			} else {
				if (strlen($this->data['ep_id']) == 12 || $this->data['ep_id'] == '008000150819A') {
					$sql = "SELECT {$field} FROM \"T_CallCycle_Statistics_AMP\"";
					$s = " AND sdr_id = '{$this->data['ep_id']}'";
				} elseif (strlen($this->data['ep_id']) == 6) {
					$sql = "SELECT {$field} FROM \"T_CallCycle_Statistics_EMP\"";
					$s = " AND sdr_id = '{$this->data['ep_id']}'";
				} else {
					$sql = "SELECT {$field} FROM \"T_CallCycle_Statistics_AMP\"";
					$s = " AND sdr_id = '0'";
				}
			}
		}

		//$this->data['data_type_arr'] = array('_intercom_recording','_speaking_time','_call_record','_call_time','_video_record','_video_time');

		$sql.=$this->getwhere_biss(false);
		$sql.=$s;
		if ($this->data['order_type'] == true) {
			$sql .=" ORDER BY create_time ASC";
		}
		//echo $sql.'<br /><br />';die;
		$sth = $this->pdo_server->query($sql);
		$sth->execute();
		$res = $sth->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

	/*
	 * 业务数据where条件
	 */

	function getwhere_biss($order = false) {
		$where = " WHERE 1=1 ";
		if ($this->data['sdr_cyc_type'] == 2 || $this->data['sdr_cyc_type'] == 1) {
			//月
			if ($this->data['select_type'] == 1) {
				$where .= " AND sdr_cyc_type = {$this->data['sdr_cyc_type']} AND sdr_time = '" . $this->data['end'] . "'";
			} elseif ($this->data['select_type'] == 2) {
				if ($this->data['start'] != '' && $this->data['end'] != '') {
					$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
				}
				$where .= " AND sdr_cyc_type = {$this->data['sdr_cyc_type']}";
			} elseif ($this->data['select_type'] == 4) {
				if ($this->data['start'] != '' && $this->data['end'] != '') {
					$where .=" AND sdr_cyc_type =0 AND sdr_time='" . $this->data['start'] . "'";
				}
			} else {
				if ($this->data['start'] != '' && $this->data['end'] != '') {
					$where .=" AND sdr_cyc_type =0 AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
				}
			}
		} else {
			//天
			if ($this->data['start'] != '' && $this->data['end'] != '') {
				$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
			}
			$where .= " AND sdr_cyc_type = {$this->data['sdr_cyc_type']}";
		}

		return $where;
	}

	/**
	 * 对讲时长
	 */
	/**
	 * 单呼次数
	 */
	/**
	 * 单呼时长
	 */
	/**
	 * 视频次数
	 */
	/**
	 * 视频时长
	 */
	/*
	 * ==================================END====================================== 
	 */
	/**
	 * 4.终端数据
	 * =================================START======================================
	 */

	/**
	 * 终端流量卡的数据
	 */
	public function get_term_data($field = '*') {
		if ($this->data['ep_id'] == "" || $this->data['ep_id'] == '0' || $this->data['ep_id'] == 0) {
			$sql = "SELECT {$field} FROM \"T_UserData_Statistics_AMP\"";
			$s = " AND sdr_id = '0'";
		} else {
			if (strlen($this->data['ep_id']) == 12 || $this->data['ep_id'] == '008000150819A') {
				$sql = "SELECT {$field} FROM \"T_UserData_Statistics_AMP\"";
				$s = " AND sdr_id = '{$this->data['ep_id']}'";
			} else {
				$sql = "SELECT {$field} FROM \"T_UserData_Statistics_EMP\"";
				$s = " AND sdr_id = '{$this->data['ep_id']}'";
			}
		}
        //var_dump($this->data);
		$sql.=$this->getwhere_tg(false);
		$sql.=$s;
		//if($this->data['order_type']==true){
		$sql .=" ORDER BY create_time ASC";
		//}
		//echo $sql;die;
		$sth = $this->pdo_server->query($sql);
		$sth->execute();
		$res = $sth->fetchall(PDO::FETCH_ASSOC);
		return $res;
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

	/**
	 * 流量卡终端 TOP渠道
	 */
	public function get_tg_top($type = 't') {
		$dbname = 'AMP';
		//$filedname = 'sdr_id';
		if ($this->data['ep_id'] == "" || $this->data['ep_id'] == '0') {
			//获取所有一级代理的ag_number
			$ag_list = $this->getAllag();
			$omp = true;
		} else {
			if (strlen($this->data['ep_id']) == 6) {
				die;
			} else {
				$omp = false;
				$dbname = 'EMP';
				//$filedname = 'sdr_id';
				//获取所有当前代理的所有企业
				$ag_list = $this->get_enterprise();
				if (count($ag_list) < 1) {
					return array('user_list' => array(), 'arr' => array(), 'arr_list' => array(), 'valid' => 0);
					die;
				}
			}
		}


		$now = strtotime(date('Y-m-d', time()));
		$time = trim($this->data['this_start']);

		//array_push($ag_list,array('ag_number'=>'0','ag_name'=>'OMP'));
		$ag_str = "";
		$ag_info = array();
		foreach ($ag_list as $key => $value) {
			$ag_str .= "'{$value['ag_number']}',";
			$ag_info["{$value['ag_number']}"] = $value['ag_name'];
		}
		//var_dump($ag_str);
		//var_dump($ag_info);
		//一级代理或者下属企业的id字符串
		$ag_str = trim($ag_str, ',');

		if ($type == 'g') {
			$sql = "SELECT sdr_gprs_user_commercial,sdr_gprs_user_test,sdr_gprs_user,sdr_id AS sdr_id,sdr_time AS create_time FROM \"T_UserData_Statistics_" . $dbname . "\"";
			$order = 'ORDER BY sdr_gprs_user_commercial DESC,sdr_gprs_user DESC,sdr_gprs_user_test DESC';
		} else {
			$sql = "SELECT sdr_terminal_user_commercial,sdr_terminal_user_test,sdr_terminal_user,sdr_id AS sdr_id,sdr_time AS create_time FROM \"T_UserData_Statistics_" . $dbname . "\"";
			$order = 'ORDER BY sdr_terminal_user_commercial DESC,sdr_terminal_user DESC,sdr_terminal_user_test DESC';
		}
		$ompsql = $sql;
		$ompsql = $ompsql . " WHERE sdr_id = '0' AND sdr_time='{$time}'";

		$sql .= " WHERE sdr_id in ({$ag_str}) AND sdr_time='{$time}' AND sdr_date_flag=0 {$order} limit 10";

		$sth = $this->pdo_server->query($sql);
		$sth->execute();
		$res = $sth->fetchall(PDO::FETCH_ASSOC);
		$res = array_reverse($res);

		//组合数据
		$arr = array();
		$valid = 0;
		$num = 0;
		foreach ($res as $key => $value) {
			$arr[$key]['date'] = $ag_info["{$value['sdr_id']}"];
			$res[$key]['ag_name'] = $ag_info["{$value['sdr_id']}"];
			$i = 0;
			$arr_list = array();
			foreach ($value as $kk => $val) {
				if ($kk != "create_time" && $kk != "sdr_id") {
					$i++;
					$arr[$key]['param' . $i] = (int) $val;
					$arr_list[$i]['name'] = $this->data['title']["name" . $i];
					$arr_list[$i]['color'] = $this->data['title']["color" . $i];
				}
			}
			$valid = $i;
			$num++;
		}

		//当搜索对象为omp是则top10需显示omp的数据
		if ($omp == true) {
			$ompsth = $this->pdo_server->query($ompsql);
			$ompsth->execute();
			$ompres = $ompsth->fetch(PDO::FETCH_ASSOC);
			$i = 0;
			$arr[$num]['date'] = 'OMP';
			foreach ($ompres as $ompk => $ompval) {
				if ($ompk != "create_time" && $ompk != "sdr_id") {
					$i++;
					$arr[$num]['param' . $i] = (int) $ompval;
				}
			}
		}
		//var_dump($res);
		return array('user_list' => $res, 'arr' => $arr, 'arr_list' => $arr_list, 'valid' => $valid);
	}

	/**
	 * 获取所有一级代理
	 */
	public function getAllag() {
		$sql = 'SELECT ag_number,ag_name FROM "T_Agents"';
		$sql .= " WHERE ag_level = '0'";
		$sql .= " ORDER BY ag_name ASC";
		$stat = $this->pdo->query($sql);
		$result = $stat->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	/**
	 * 获取某代理商下的企业
	 */
	public function get_enterprise() {
		$sql = 'SELECT e_id AS ag_number,e_name AS ag_name FROM "T_Enterprise" where e_ag_path like \'%|' . $this->data['ep_id'] . '|%\' AND e_status!=6';
		$sql .= " ORDER BY e_name ASC";
		$stat = $this->pdo->query($sql);
		$result = $stat->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	/*
	 * 终端及流量卡的数据where条件
	 */

	function getwhere_tg($order = false) {
		$where = " WHERE 1=1 ";
		if ($this->data['select_type'] == 1) {
			$where .= " AND sdr_time = '" . $this->data['end'] . "' AND sdr_date_flag = 0";
		} elseif ($this->data['select_type'] == 3) {
			$where .= " AND sdr_time in(" . $this->data['end'] . ") AND sdr_date_flag = 0";
		} elseif ($this->data['select_type'] == 4) {
			if ($this->data['start'] != '' && $this->data['end'] != '') {
				$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "' AND sdr_date_flag = 0";
			}
		} else {
			if ($this->data['start'] != '' && $this->data['end'] != '') {
				$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<'" . $this->data['end'] . "'";
			}
			$where .= " AND sdr_date_flag = {$this->data['sdr_date_flag']}";
		}
		return $where;
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
	/*
	 * 获取某天用户信息
	 */
	public function get_day_userdata() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_creat_user,sdr_online_user,sdr_terminal_user,sdr_gprs_user,sdr_user,sdr_commercial_user,sdr_terminal_user_commercial,sdr_gprs_user_commercial FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_creat_user,sdr_online_user,sdr_terminal_user,sdr_gprs_user,sdr_user,sdr_commercial_user,sdr_terminal_user_commercial,sdr_gprs_user_commercial FROM \"T_UserData_Statistics_EMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_creat_user,sdr_online_user,sdr_terminal_user,sdr_gprs_user,sdr_user,sdr_commercial_user,sdr_terminal_user_commercial,sdr_gprs_user_commercial FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		}
		if ($this->data['start'] != '') {
			$select .= " AND sdr_time = '" . $this->data['start'] . "'";
		}
		$select .= " AND sdr_date_flag = '0'";
		// echo $select;
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/*
	 * 获取某天通话信息
	 */

	public function get_day_calldata() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_call_hcount,sdr_ptt_hcount,sdr_call_htime,sdr_ptt_htime FROM \"T_CallData_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_call_hcount,sdr_ptt_hcount,sdr_call_htime,sdr_ptt_htime FROM \"T_CallData_Statistics_EMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_call_hcount,sdr_ptt_hcount,sdr_call_htime,sdr_ptt_htime FROM \"T_CallData_Statistics_AMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		}
		if ($this->data['start'] != '') {
			$select .= " AND sdr_time = '" . $this->data['start'] . "'";
		}
		$select .= " AND sdr_date_flag = '0'";
		// echo $select;
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * 1.开户用户
	 * =================================START======================================
	 */
	public function get_open_user() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_test_user,sdr_commercial_user,sdr_phone_user,sdr_console_user,sdr_gvs_user FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_test_user,sdr_commercial_user,sdr_phone_user,sdr_console_user,sdr_gvs_user FROM \"T_UserData_Statistics_EMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_test_user,sdr_commercial_user,sdr_phone_user,sdr_console_user,sdr_gvs_user FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		}
		if ($this->data['start'] != '') {
			$select .= " AND sdr_time = '" . $this->data['start'] . "'";
		}
		$select .= " AND sdr_date_flag = '0'";
		// echo $select;
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * =================================END======================================
	 */

	/**
	 * 2.通话
	 * =================================START======================================
	 */
	public function get_calls() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_video_htime,sdr_video_hcount,sdr_audio_htime,sdr_audio_hcount,sdr_call_htime,sdr_call_hcount FROM \"T_CallData_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_video_htime,sdr_video_hcount,sdr_audio_htime,sdr_audio_hcount,sdr_call_htime,sdr_call_hcount FROM \"T_CallData_Statistics_EMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_video_htime,sdr_video_hcount,sdr_audio_htime,sdr_audio_hcount,sdr_call_htime,sdr_call_hcount FROM \"T_CallData_Statistics_AMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		}
		if ($this->data['start'] != '') {
			$select .= " AND sdr_time = '" . $this->data['start'] . "'";
		}
		$select .= " AND sdr_date_flag = '0'";
		// echo $select;
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * =================================END======================================
	 */

	/**
	 * 3.终端 4.流量卡
	 * =================================START======================================
	 */
	public function get_terminal() {
		if ($this->data['ep_id'] == '' || $this->data['ep_id'] == '0') {//查询T_UserData_Statistics_AMP中sdr_id=0
			$select = "SELECT sdr_terminal_user_test,sdr_terminal_user_commercial,sdr_terminal_user_sort,sdr_gprs_user_test,sdr_gprs_user_commercial FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='0'";
		} else if (strlen($this->data['ep_id']) == 6) {//查询T_UserData_Statistics_EMP表，ep_id为企业ID
			$select = "SELECT sdr_terminal_user_test,sdr_terminal_user_commercial,sdr_terminal_user_sort,sdr_gprs_user_test,sdr_gprs_user_commercial FROM \"T_UserData_Statistics_EMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		} else {//查询T_UserData_Statistics_AMP中sdr_id为代理商ID
			$select = "SELECT sdr_terminal_user_test,sdr_terminal_user_commercial,sdr_terminal_user_sort,sdr_gprs_user_test,sdr_gprs_user_commercial FROM \"T_UserData_Statistics_AMP\" WHERE sdr_id ='" . $this->data['ep_id'] . "'";
		}
		if ($this->data['start'] != '') {
			$select .= " AND sdr_time = '" . $this->data['start'] . "'";
		}
		$select .= " AND sdr_date_flag = '0'";
		// echo $select;
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * =================================END======================================
	 */

	/**
	 * 5.TOP渠道
	 * =================================START======================================
	 */
	public function get_top($table, $ep_id, $field) {
		$select = "SELECT sdr_id as id," . $field . " as value FROM \"T_UserData_Statistics_" . $table . "\"";
		$select .= " where sdr_date_flag = '0'";
		if ($ep_id != "") {
			$select .= " AND sdr_id in (" . $ep_id . ")";
		}

		if ($this->data['start'] != '') {
			$select .= " AND sdr_time = '" . $this->data['start'] . "'";
		}
		$select .= " ORDER by " . $field . " desc limit 10";
		// echo $select;
		$sth = $this->pdo_server->query($select);
		$sth->execute();
		if ($ep_id != "") {
			$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$res = array();
		}
		return $res;
	}

	/*
	 * 获取其他的综合
	 */

	public function get_other($table, $ep_id, $field) {
		$select = "SELECT sum(" . $field . ") as value FROM \"T_UserData_Statistics_" . $table . "\"";
		$select .= " where sdr_date_flag = '0'";
		if ($ep_id != "") {
			$select .= " AND sdr_id in (" . $ep_id . ")";
		}
		if ($this->data['start'] != '') {
			$select .= " AND sdr_time = '" . $this->data['start'] . "'";
		}

		$sth = $this->pdo_server->query($select);
		$sth->execute();
		if ($ep_id != "") {
			$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$res = array();
		}
		return $res;
	}

	/**
	 * =================================END======================================
	 */
//=================================数据获取分割线===============================================

	/**
	 * 获得当选择代理商下的所有企业
	 */
	public function getall_ep($e_agents_id = "0") {
		$sql = <<<ECHO
                SELECT e_id FROM "T_Enterprise" WHERE e_id!=999999
ECHO;
		if ($this->data['ep_id'] != "") {
			$sql .=" AND e_ag_path LIKE  '%|{$e_agents_id}|%'";
		}
		$sth = $this->pdo->query($sql);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * 获得选择企业的所有用户
	 */
	public function getall_user($list_id) {
		$sql = <<<ECHO
                SELECT COUNT(u_number) AS user_num FROM "T_User"
ECHO;
		$sql.=$this->getwhere(false);
		$sql.=" AND u_e_id IN ({$list_id}) ";
		$sth = $this->pdo->query($sql);
		$sth->execute();
		$res = $sth->fetch(PDO::FETCH_ASSOC);
		return $res;
	}

	public function get_all_agep_list() {
		$ag_list = $this->get_likesql_ag();
		$ep_list = $this->get_likesql_ep();
		foreach ($ep_list as $key => $value) {
			array_push($ag_list, $value);
		}
		return $ag_list;
	}

	public function get_likesql_ep() {
		$sql = "SELECT e_id AS ag_number,e_name AS ag_name FROM \"T_Enterprise\" WHERE e_id !=999999 AND e_status!=6 ORDER BY e_name collate \"zh_CN.utf8\"";
		$sth = $this->pdo->query($sql);
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	/**
	 * 获得所有代理商的名称和ag_number
	 * @param type $limit
	 * @return type
	 */
	public function get_likesql_ag() {
		$sql = "SELECT ag_number,ag_name FROM \"T_Agents\" ORDER BY ag_name collate \"zh_CN.utf8\"";
		$stat = $this->pdo->query($sql);
		$result = $stat->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	/**
	 * 递归代理商层级数组组合
	 */
	function get_array($id = 0, $level = 0) {
		switch ($id) {
			case 0:
				$sql = "SELECT ag_number,ag_name,ag_level FROM \"T_Agents\" WHERE ag_parent_id = '{$id}' OR ag_level = '{$level}' ORDER BY ag_name collate \"zh_CN.utf8\"";
				break;

			default:
				$sql = "SELECT ag_number,ag_name,ag_level FROM \"T_Agents\" WHERE ag_parent_id = '{$id}' ORDER BY ag_name collate \"zh_CN.utf8\"";
				break;
		}

		$sth = $this->pdo->query($sql);
		$arr = array();
		if ($sth->execute() && $sth->rowCount()) {//如果有子类 
			while ($rows = $sth->fetch(PDO::FETCH_ASSOC)) { //循环记录集 
				if (!$this->get_array($rows['ag_number'], $rows['ag_level'] + 1)) {
					$res = $this->get_ep($rows['ag_number']);
					$arr_ep = array();
					foreach ($res as $v) {
						$row['ag_number'] = $v['e_id'];
						$row['ag_name'] = $v['e_name'];
						$arr_ep[] = $row;
					}
					if (empty($arr_ep)) {
						$arr_ep = NULL;
					}
					$rows['list'] = $arr_ep;
				} else {
					$rows['list'] = $this->get_array($rows['ag_number'], $rows['ag_level'] + 1);
				} //调用函数，传入参数，继续查询下级
				$arr[] = $rows; //组合数组 
			}
			//$rows['e_id'] = $this->get_ep($rows['ag_number']); //调用函数，传入参数，继续查询下级 
			$res = $this->get_ep($id);
			foreach ($res as $v) {
				$row['ag_number'] = $v['e_id'];
				$row['ag_name'] = $v['e_name'];
				$arr[] = $row;
			}
			return $arr;
		}
	}

	/*
	 * 获得某个代理商下的所有企业
	 */

	public function get_ep($ag_number = "0") {
		$sql = "SELECT e_id,e_name FROM \"T_Enterprise\" WHERE e_status!=6 AND e_name IS NOT NULL AND e_agents_id='{$ag_number}' ORDER BY e_name collate \"zh_CN.utf8\"";
		$sth = $this->pdo->prepare($sql);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	public function getServer() {
		$sql = "SELECT d_id AS ag_number,d_name AS ag_name FROM \"T_Device\" WHERE d_type='mds' ORDER BY d_name collate \"zh_CN.utf8\"";
		$sth = $this->pdo->prepare($sql);
		$sth->execute();
		$res = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function childwhere() {
		$where = '';
		if ($this->data["u_create_time"] != "") {
			$where .="AND u_create_time=" . $this->data['u_create_time'];
		}

		if ($this->data["u_active_state"]) {
			$where .=" AND u_active_state=" . $this->data['u_active_state'];
		}
		return $where;
	}

	function getwhere($order = false, $parm) {
		$where = " WHERE 1=1 ";
		if ($this->data['date_type'] == "day") {
			if ($this->data['data_type'] == "_commercial") {
				$where .=" AND u_commercial_time<='" . $this->data['u_create_time'] . "' AND u_attr_type='0' ";
			} else if ($this->data['data_type'] == "_type") {
				$where .=" AND u_sub_type =" . $parm;
				if ($this->data["u_create_time"] != "") {
					$where .=" AND u_create_time='" . $this->data['u_create_time'] . "'";
				}
			} else if ($this->data['data_type'] == "_validity") {
				if ($parm == "2") {
					$parm = "0";
				}
				$where .=" AND u_active_state ='" . $parm . "'";
				if ($this->data["u_create_time"] != "") {
					$where .=" AND u_create_time='" . $this->data['u_create_time'] . "'";
				}
			} elseif ($this->data['data_type'] == "_intercom_recording") {
				if ($this->data['start'] != '' && $this->data['end'] != '') {
					$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
				}
			} else {
				if ($this->data["u_create_time"] != "") {
					$where .=" AND u_create_time<='" . $this->data['u_create_time'] . "'";
				}
			}

			//周
		} else if ($this->data['date_type'] == "week") {
			if ($this->data['data_type'] == "_commercial") {
				$where .=" AND u_commercial_time<='" . $this->data['u_create_time'] . "' AND u_attr_type='0' ";
			} else if ($this->data['data_type'] == "_type") {
				$where .=" AND u_sub_type =" . $parm;
				if ($this->data["u_create_time"] != "") {
					$where .=" AND u_create_time='" . $this->data['u_create_time'] . "'";
				}
			} else if ($this->data['data_type'] == "_validity") {
				if ($parm == "2") {
					$parm = "0";
				}
				$where .=" AND u_active_state ='" . $parm . "'";
				if ($this->data["u_create_time"] != "") {
					$where .=" AND u_create_time='" . $this->data['u_create_time'] . "'";
				}
			} elseif ($this->data['data_type'] == "_intercom_recording") {
				if ($this->data['sdr_cyc_type'] == 2) {
					if ($this->data['select_type'] == 1) {
						$where .= " AND sdr_cyc_type = 1 AND sdr_time = '" . $this->data['end'] . "'";
					} elseif ($this->data['select_type'] == 2) {
						if ($this->data['start'] != '' && $this->data['end'] != '') {
							$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
						}
						$where .= " AND sdr_cyc_type = 1";
					} else {
						if ($this->data['start'] != '' && $this->data['end'] != '') {
							$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
						}
						//$where .= " AND sdr_cyc_type = '".$this->data['sdr_cyc_type']."'";
					}
				} elseif ($this->data['sdr_cyc_type'] == 1) {
					if ($this->data['select_type'] == 1) {
						$where .= " AND sdr_cyc_type = 1 AND sdr_time = '" . $this->data['end'] . "'";
					} elseif ($this->data['select_type'] == 2) {
						if ($this->data['start'] != '' && $this->data['end'] != '') {
							$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
						}
						$where .= " AND sdr_cyc_type = 1";
					} else {
						if ($this->data['start'] != '' && $this->data['end'] != '') {
							$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
						}
						//$where .= " AND sdr_cyc_type = '".$this->data['sdr_cyc_type']."'";
					}
				} else {
					$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
				}
			} else {
				if ($this->data["u_create_time"] != "") {
					$where .=" AND u_create_time<='" . $this->data['u_create_time'] . "'";
				}
			}

			//月
		} else if ($this->data['date_type'] == "month") {
			if ($this->data['data_type'] == "_commercial") {
				$where .=" AND u_commercial_time<='" . $this->data['u_create_time'] . "' AND u_attr_type='0' ";
			} else if ($this->data['data_type'] == "_type") {
				$where .=" AND u_sub_type =" . $parm;
				if ($this->data["u_create_time"] != "") {
					$where .=" AND u_create_time='" . $this->data['u_create_time'] . "'";
				}
			} else if ($this->data['data_type'] == "_validity") {
				if ($parm == "2") {
					$parm = "0";
				}
				$where .=" AND u_active_state ='" . $parm . "'";
				if ($this->data["u_create_time"] != "") {
					$where .=" AND u_create_time='" . $this->data['u_create_time'] . "'";
				}
			} elseif ($this->data['data_type'] == "_intercom_recording") {
				$where .=" AND sdr_time>='" . $this->data['start'] . "' AND sdr_time<='" . $this->data['end'] . "'";
			} else {
				if ($this->data["u_create_time"] != "") {
					$where .=" AND u_create_time<='" . $this->data['u_create_time'] . "'";
				}
			}
		} else {
			
		}
		return $where;
	}

	/**
	 * 获得选择企业的所有用户
	 */
	public function getall_for_histogram($list_id, $parm) {
		$sql = <<<ECHO
                SELECT COUNT(u_number) AS user_num FROM "T_User"
ECHO;
		$sql.=$this->getwhere(false, $parm);
		$sql.=" AND u_e_id IN ({$list_id}) ";
		$sth = $this->pdo->query($sql);
		$sth->execute();
		$res = $sth->fetch(PDO::FETCH_ASSOC);
		return $res;
	}

	public function get_ep_ag_list() {
		$pdo = new db();
		$ep_list = $pdo->table("T_Enterprise")->filed(array("e_id AS ag_number", "e_name AS title"), false)->where("e_id !=999999 AND e_status!=6")->select();
		$ag_list = $pdo->table("T_Agents")->filed(array("ag_number", "ag_name AS title"), false)->where()->select();
		foreach ($ep_list as $key => $value) {
			array_push($ag_list, $value);
		}
		return $ag_list;
	}

	public function get_server_list() {
		$pdo = new db();
		$server_list = $pdo->table("T_Device")->filed(array("d_id AS ag_number", "d_name AS title"), false)->where("d_type='mds'")->select();
//        $ag_list=$pdo->table("T_Agents")->filed(array("ag_number","ag_name AS title"),false)->where()->select();
//        foreach ($ep_list as $key => $value) {
//           array_push($ag_list, $value);
//        }
		return $server_list;
	}

}
