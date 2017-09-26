<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}

class table_tool_info extends discuz_table
{
    public function __construct(){
        $this->_table = 'tool_info';
        $this->_pk = 'tool_id';
        parent::__construct();
    }

    public function get_tool_list($data){
        //插入
        // $result = DB::insert($this->_table,$data,true);
        
        //删除
        // $result = DB::delete($this->_table,'tool_id' = .$data);
        
        //更新
        // $result = DB::update($this->_table,$data,$this->_pk'='.$tool_id);
        
        //查询
        $result = DB::fetch_first('SELECT * FROM %t WHERE tool_id=%d',array($this->_table,$tool_id));
        return $result;
    }
    public function count_tool_info(){
        $result = DB::result_first('SELECT COUNT(*) FROM %t',array($this->_table));
        return $result;
    }
    //把上传的附件插入到数据库中
    public function add_tool($add_tool){
        $result = DB::insert($this->_table,$add_tool);
        return $result;
    }
}