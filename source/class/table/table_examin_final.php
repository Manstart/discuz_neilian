<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}

class table_examin_final extends discuz_table
{
    public function __construct(){
        $this->_table = 'examin_fianl';
        $this->_pk = 'id';
        parent::__construct();
    }

    public function add_examin($result){       
        $result_final = DB::insert($this->_table,$result);
        return $result_final;
    }

}