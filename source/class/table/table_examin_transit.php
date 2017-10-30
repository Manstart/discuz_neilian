<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}

class table_examin_transit extends discuz_table
{
    public function __construct(){
        $this->_table = 'examin_transit';
        $this->_pk = 'id';
        parent::__construct();
    }

    public function save_transit($examins){       
        $result = DB::insert($this->_table,$examins);
        return $result;
    }

    public function list_transit($examins){       
        $list = DB::fetch_all("SELECT * FROM %t",array($this->_table));
        return $list;
    }


}