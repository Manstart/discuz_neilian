<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}

class table_app_funds extends discuz_table
{
    public function __construct(){
        $this->_table = 'app_funds';
        $this->_pk = 'app_id';
        parent::__construct();
    }

    public function add_funds($add_funds){       
        $result = DB::insert($this->_table,$add_funds);
        return $result;
    }

    public function funds_list($username){
        $list = DB::fetch_all("SELECT * FROM %t WHERE app_name=%s ORDER BY app_date DESC",array($this->_table,$username));
        return $list;
    }

}