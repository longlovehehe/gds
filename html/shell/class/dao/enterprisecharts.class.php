<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of enterprisecharts
 *
 * @author zed
 */
class enterprisecharts extends db{
	//put your code here
	public $data;
	public $fd;
	public function __construct($data) {
		parent::__construct();
		$this->fd=new formatdate();
		$this->data = $this->setData($data);
	}
	
	/**
	 * @return array
	 * 获得所有部门信息
	 */
	public function selectlist() {
		$e_id = $_SESSION['eown']["em_id"];
		$table_name = "T_UserGroup_" . $e_id;
		$sql = "SELECT ug_id,ug_name,ug_weight FROM \"{$table_name}\"";
		$sth = $this->pdo->prepare($sql);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getByid_ep($deviceflag = false) {
		if ($this->data["e_id"] == "") {
			throw new Exception("Incorrect enterprise Numbers", -1);
		}

		$sql = 'SELECT
                    "T_Enterprise".e_id,
                    "T_Enterprise".e_bss_number,
                    "T_Enterprise".e_status,
                    "T_Enterprise".e_name,
                    "T_Enterprise".e_create_time,
                    "T_Enterprise".e_mds_id,
                    "T_Enterprise".e_mds_users,
                    "T_Enterprise".e_mds_phone,
                    "T_Enterprise".e_mds_dispatch,
                    "T_Enterprise".e_mds_gvs,
                    "T_Enterprise".e_mds_call,
                    "T_Enterprise".e_vcr_id,
                    "T_Enterprise".e_vcr_audiorec,
                    "T_Enterprise".e_vcr_videorec,
                    "T_Enterprise".e_vcr_space,
                    "T_Enterprise".e_storage_function,
                    "T_Enterprise".e_addr,
                    "T_Enterprise".e_contact_fox,
                    "T_Enterprise".e_contact_phone,
                    "T_Enterprise".e_contact_name,
                    "T_Enterprise".e_contact_surname,
                    "T_Enterprise".e_industry,
                    "T_Enterprise".e_contact_mail,
                    "T_Enterprise".e_area,
                    "T_Enterprise".e_has_vcr,
                    "T_Enterprise".e_sync,
                    "T_Enterprise".e_pwd,
                    "T_Enterprise".e_ag_path
            FROM
                            "T_Enterprise"

            WHERE e_id = :e_id';
		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(':e_id', $this->data["e_id"], PDO::PARAM_INT);
		$sth->execute();
		$data = $sth->fetch(PDO::FETCH_ASSOC);

		return $data;
	}
	
	public function getList($limit = "") {
		$e_id = $this->data["e_id"];
		$sql = "
        SELECT
        u_number,
        u_name,
        u_ug_id ,
        p_id ,
        p_name ,
        pg_name ,
        ug_id ,
        ug_name ,
        ug_weight ,
        ug_parent_id ,
        ug_path

        FROM
        \"T_User\"
                        LEFT JOIN \"T_Product\" ON u_product_id = p_id
                        LEFT JOIN \"T_PttGroup_{$e_id}\" ON u_default_pg = pg_number
                        LEFT JOIN \"T_UserGroup_{$e_id}\" ON u_ug_id = ug_id
                        ";

		$sql = $sql . $this->getwhere(true);
		$sql = $sql . $limit;

		$stat = $this->pdo->query($sql);
		$result = $stat->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function getwhere($order = false) {
		$where = " WHERE 1=1 ";

		if ($this->data["e_id"] != "") {
			$where .= "AND u_e_id = " . $this->data["e_id"];
		}
		if ($this->data['u_sub_type'] != "") {
			$where .= " AND u_sub_type = " . $this->data["u_sub_type"];
		}
		if ($this->data['u_attr_type'] != "") {
			$where .= " AND u_attr_type = '" . $this->data["u_attr_type"]."'";
		}

		if ($this->data["u_product_id"] != "") {
			$where .= "AND u_product_id = '" . $this->data["u_product_id"] . "'";
		}
		if ($this->data["u_default_pg"] != "") {
			$where .= "AND u_default_pg = '" . $this->data["u_default_pg"] . "'";
		}
		if ($this->data["u_ug_id"] != "" && $this->data["u_ug_id"] != "0") {
			$where .= "AND u_ug_id = " . $this->data["u_ug_id"];
		}
		if ($this->data["u_pic"] != "") {
			if ($this->data["u_pic"] == "0") {
				$where .= " AND (u_pic = '' OR u_pic IS NULL) ";
			}
			if ($this->data["u_pic"] == "1") {
				$where .= " AND u_pic != '' ";
			}
		}
		if ($this->data["u_sex"] != "") {
			$where .= "AND u_sex = '" . $this->data["u_sex"] . "'";
		}

		if ($this->data["u_number"] != "") {
			$where .= "AND u_number LIKE E'%" . addslashes($this->data["u_number"]) . "%'";
		}
		//var_dump($this->data["u_name"]);die;
		if ($this->data["u_name"] != "") {
			$where .= " AND u_name LIKE E'%" . addslashes($this->data["u_name"]) . "%'";
		}
		if ($this->data["u_mobile_phone"] != "") {
			$where .= "AND u_mobile_phone  LIKE E'%" . addslashes($this->data["u_mobile_phone"]) . "%'";
		}
		/*
		if ($this->data["u_number"] != "") {
		$where .= "AND u_number = '" . $this->data["u_number"] . "'";
		}
		 *
		 */
		if ($this->data["u_terminal_type"] != "") {
			$where .= " AND u_terminal_type LIKE E'%" . addslashes($this->data["u_terminal_type"]) . "%'";
		}
		if ($this->data["u_terminal_model"] != "") {
			$where .= " AND u_terminal_model LIKE E'%" . addslashes($this->data["u_terminal_model"]) . "%'";
		}
		if ($this->data["u_imsi"] != "") {
			$where .= " AND u_imsi LIKE E'%" . addslashes($this->data["u_imsi"]) . "%'";
		}
		if ($this->data["u_imei"] != "") {
			$where .= " AND u_imei LIKE E'%" . addslashes($this->data["u_imei"]) . "%'";
		}
		if ($this->data["u_iccid"] != "") {
			$where .= " AND u_iccid LIKE E'%" . addslashes($this->data["u_iccid"]) . "%'";
		}
		if ($this->data["u_mac"] != "") {
			$where .= " AND u_mac ILIKE E'%" . addslashes($this->data["u_mac"]) . "%'";
		}
		if ($this->data["u_udid"] != "") {
			$where .= " AND u_udid ILIKE E'%" . addslashes($this->data["u_udid"]) . "%'";
		}
		if ($this->data["u_zm"] != "") {
			$where .= " AND u_zm LIKE E'%" . addslashes($this->data["u_zm"]) . "%'";
		}
                                     if ($this->data["checkbox1"] == "") {
                                            $this->data["checkbox1"] = NULL;
                                   }else{
                                          //$str= implode($this->data["checkbox1"]);
                                          //$this->data["u_p_function"]=$str;
                                          foreach ($this->data["checkbox1"] as $key => $value) {
                                           $where .= " AND u_p_function LIKE E'%". $value."%'";
                                          }
                                   }
		if ($this->data["e_id"] != "") {
			$where .= " AND u_e_id =" . $this->data["e_id"];
		}
		if ($order) {
			//$where .= ' ORDER BY ug_path,ug_weight,u_number';
			$where .= ' ORDER BY u_number';
		}
		return $where;
	}
	
	public function get_like_user() {
		$pdo = new db();
		$user_list = $pdo->table("T_User")->filed(array("u_number AS ag_number", "u_name AS title"), false)->where("u_e_id = {$this->data['e_id']}")->select();
		return $user_list;
	}
	
	/**
	 * ①部门数据获取接口
	 * 
	 * 
	 * ====================================================START========================================
	 */
	public function get_ug_data(){
		if($this->data['checkp']=="1"){
			$this->data['ug_id']=$this->data['u_ug_id'];
		}
		$tableName="T_DeptData_Statistics_".$this->data['e_id'];
		$sql=<<<SQL
			SELECT * FROM "$tableName" 
				WHERE 
					sdr_num=:sdr_num AND 
					sdr_cyc_type=:sdr_cyc_type AND
					sdr_time=:sdr_time
SQL;
		$sth=$this->pdo_server->prepare($sql);
		$sth->bindValue(':sdr_num', $this->data["ug_id"], PDO::PARAM_INT);
		$sth->bindValue(':sdr_cyc_type', $this->data["checkdate"], PDO::PARAM_INT);
		$sth->bindValue(':sdr_time', $this->fd->getRealDate($this->data["checkdate"],$this->data["day"]), PDO::PARAM_INT);
		$sth->execute();
		$data = $sth->fetch(PDO::FETCH_ASSOC);
		return $data;
	}




	/**
	 * 部门数据获取接口
	 * ====================================================END=========================================
	 */
	
	/*----------------------------------------------------------------------------华丽的分割线-----------------------------------------------------------------------*/
	
	/**
	 * ②用户数据获取接口
	 * 
	 * 
	 * ====================================================START========================================
	 */
	public function get_users_data() {
		$tableName="T_UserData_Statistics_".$this->data['e_id'];
		$sql=<<<SQL
			SELECT * FROM "$tableName" 
				WHERE 
				sdr_num=:sdr_num AND 
				sdr_cyc_type=:sdr_cyc_type AND
				sdr_time=:sdr_time
SQL;
		$sth=$this->pdo_server->prepare($sql);
		$sth->bindValue(':sdr_num', $this->data["u_number"], PDO::PARAM_INT);
		$sth->bindValue(':sdr_cyc_type', $this->data["checkdate"], PDO::PARAM_INT);
		$sth->bindValue(':sdr_time', $this->fd->getRealDate($this->data["checkdate"],$this->data["day"]), PDO::PARAM_INT);
		
		$sth->execute();
		$data = $sth->fetch(PDO::FETCH_ASSOC);

		return $data;
		
	}
	
	
	/**
	 * 用户数据获取接口
	 * ====================================================END=========================================
	 */
	
	/*----------------------------------------------------------------------------华丽的分割线-----------------------------------------------------------------------*/
	
	/**
	 * ②企业数据获取接口
	 * 
	 * 
	 * ====================================================START========================================
	 */
	public function get_ep_data() {

		$sql=<<<SQL
			SELECT 
				*
			FROM "T_EnterpriseData_Statistics" WHERE 
				"sdr_EID"=:sdr_EID AND 
				sdr_cyc_type=:sdr_cyc_type AND
				sdr_time=:sdr_time
SQL;
		$sth=$this->pdo_server->prepare($sql);
		$sth->bindValue(':sdr_EID', $this->data["e_id"], PDO::PARAM_INT);
		$sth->bindValue(':sdr_cyc_type', $this->data["checkdate"], PDO::PARAM_INT);
		$sth->bindValue(':sdr_time', $this->fd->getRealDate($this->data["checkdate"],$this->data["day"]), PDO::PARAM_INT);
		$sth->execute();
		$data = $sth->fetch(PDO::FETCH_ASSOC);
		
		return $data;
		
	}
	
	
	/**
	 * 用户数据获取接口
	 * ====================================================END=========================================
	 */
	
	/*----------------------------------------------------------------------------华丽的分割线-----------------------------------------------------------------------*/
	
	/**
	 * 企业或单个部门或单个用户饼状图数据转换及生成
	 * 
	 * 
	 * ====================================================START========================================
	 */
	public function get_Charts_Data($data){

		$list=array();
		foreach ($data as $k=> $val) {
			if($k=="sdr_audio_time"||$k=="sdr_video_time"||$k=="sdr_ptt_time"){
				$list['callTime'][$k]=$val;
			}else if($k=="sdr_send_sm_count"||$k=="sdr_send_pic_count"){
				$list['infoNum'][$k]=$val;
			}else{
				$list['otherInfo'][$k]=$val;
			}
		}
			
		return $list;
	}
	
	/**
	 * 企业单个部门或用户饼状图数据转换及生成
	 * ====================================================END=========================================
	 */
	
	/*----------------------------------------------------------------------------华丽的分割线-----------------------------------------------------------------------*/
	
	/**
	 * 企业饼状图数据转换及生成
	 * 
	 * 
	 * ====================================================START========================================
	 */
	public function get_Enterprise_Data($data){
		$list=array();
		foreach ($data as $key => $value) {
			$this->data['ug_id']=$value['ug_id'];
			$ugIfo=$this->get_ug_data();
			$ugIfo=$ugIfo==false?array():$ugIfo;
			$list[]=  array_merge($value,$ugIfo);
		}
		return $list;
	}
	
	/**
	 * 企业饼状图数据转换及生成
	 * ====================================================END=========================================
	 */
	
	/*----------------------------------------------------------------------------华丽的分割线-----------------------------------------------------------------------*/
	
	/**
	 * 单个用户饼状图数据转换及生成
	 * 
	 * 
	 * ====================================================START========================================
	 */
	public function get_UserGroup_Data($data){
		$list=array();
		foreach ($data as $key => $value) {
			$this->data['u_number']=$value['u_number'];
			$ugIfo=$this->get_users_data();
			$ugIfo=$ugIfo==false?array():$ugIfo;
			$list[]=  array_merge($value,$ugIfo);
		}
		return $list;
	}
	
	/**
	 * 单个用户饼状图数据转换及生成
	 * ====================================================END=========================================
	 */
	
	
	
	public function get(){
		return $this->data;
	}
	
	public function set($data){
		$this->data = $data;
	}
	
	public function setData($data){
		switch ($data['checkdate']) {
			case "0":
				$data['day']=$data['year']==null?$data['day']:$data['year'];
				return $data;
				break;
			case "1":
				$data['day']=$data['month']==null?$data['day']:$data['month'];
				return $data;
				break;
			case "2":
				$data['day']=$data['week']==null?$data['day']:$data['week'];
				return $data;
				break;
			case "3":
				return $data;
				break;

			default:
				return $data;
				break;
		}
	}
	
}
