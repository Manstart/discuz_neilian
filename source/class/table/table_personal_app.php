<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}

class table_personal_app extends discuz_table
{
    public function __construct(){
        $this->_table = 'personal_app';
        $this->_pk = 'personalApp_id';
        parent::__construct();
    }

    public function add_personalApp($add_personalApp){
        $result = DB::insert($this->_table,$add_personalApp);
        return $result;
    }

    public function all_personal_list($username){
        $all_personalApp = DB::fetch_all("SELECT * FROM %t WHERE personalApp_name=%s ORDER BY personalApp_date DESC",array($this->_table,$username));
        return $all_personalApp;
    }

    public function personal_list($username,$pagesize,$pageshow){
        $add_personalApp = DB::fetch_all("SELECT * FROM %t WHERE personalApp_name=%s ORDER BY personalApp_date DESC limit %d,%d",array($this->_table,$username,$pagesize,$pageshow));
        return $add_personalApp;

    }    
    
}