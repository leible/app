<?php

class Dev {
    const TABLE_NAME = 'pre_dev';

    //设备的名称，固定资产编码，设备类型，购买价格，购买时间，合同编号，设备描述，设备配置明细信息，采购者，设备存放位置，状态

    public static function addDev($dev_name, $sn, $type_id, $price, $time, $contract_sn,
            $remark, $config_info, $buyer, $store_place, $status){
        self::_checkName($dev_name);
        self::_checkName($sn);
        self::_checkName($buyer);
        $info = self::getInfoByName($dev_name);
        if (is_array($info) && count($info) > 0) {
            throw new Exception('您输入的硬件名称已经存在' ,1);
        }

        $data = array(
            'dev_name' => $dev_name,
            'sn' => $sn,
            'type_id' => $type_id,
            'buyer' => $buyer,
            'status' => $status,
            'price' => $price,
            'time' => $time,
            'contract_sn' => $contract_sn,
            'remark' => $remark,
            'config_info' => $config_info,
            'store_place' => $store_place
        );
        //print_r($data);
        $res = Mysql::insert(self::TABLE_NAME, $data);
        if (!$res) {
            throw new Exception('数据插入失败', 1);
        }
    }

    public static function getAllDevList(){
        return Mysql::select(self::TABLE_NAME);
    }

    private static function _checkName($dev_name){
        $dev_name = isset($dev_name) ? trim($dev_name) : '';
        if (!$dev_name) throw new Exception('请填写设备名', 1);
    }

//    private static function _checkSearch($dev_name){
//        $dev_name = isset($dev_name) ? trim($dev_name) : '';
//        if (!$dev_name) throw new Exception('请填写要搜索的设备名', 1);
//    }

    public static function getInfoById($id){
        $id = $id > 0 ? (int)$id : 0;
        if (!$id){
            throw new Exception('请选择一个操作对象', 1);
        }
        return Mysql::selectOne(self::TABLE_NAME, array('id' => $id));
    }

    public static function getInfoByName($dev_name) {
        $where = array(
            'dev_name' => $dev_name
        );
        return Mysql::selectOne(self::TABLE_NAME, $where);
    }

    public static function delDev($id) {
        $id = $id>0 ? (int)$id : 0;
        if (!$id)  throw new Exception('请选择一个操作项', 1);
        $where = array('id' => $id);
        $res = Mysql::delete(self::TABLE_NAME, $where);
        if (!$res) {
            throw new Exception('删除失败', 1);
        }
    }

    public static function getCountByTypeId($type_id){
        $type_id = $type_id > 0 ? (int)$type_id : 0;
        $where = array(
            'type_id' => $type_id
        );
        return Mysql::selectCount(self::TABLE_NAME, $where);
    }

    public static function updateDev($id, $dev_name, $sn, $type_id, $price, $time, $contract_sn,
            $remark, $config_info, $buyer, $store_place, $status){
        self::_checkName($dev_name);
        $id = $id > 0 ? (int)$id : 0;
        $type_id = $type_id > 0 ? (int)$type_id : 0;
        $status = $status > 0 ? 1 : -1;
        $buyer = isset($_REQUEST['buyer']) ? $_REQUEST['buyer'] : '';

        if (!$id) {
            throw new Exception('请选择一个操作项', 1);
        }
        if (!$type_id) {
            throw new Exception('请选择一种类型', 1);
        }

        $info = self::getInfoById($id);
        if (is_array($info) && (count($info) > 0) && $info['id']!=$id) {
            throw new Exception('设备名已经存在', 1);
        }
        $where = array(
            'id' => $id,
        );
        $data = array(
            'dev_name' => $dev_name,
            'sn' => $sn,
            'type_id' => $type_id,
            'buyer' => $buyer,
            'status' => $status,
            'price' => $price,
            'time' => $time,
            'contract_sn' => $contract_sn,
            'remark' => $remark,
            'config_info' => $config_info,
            'store_place' => $store_place
        );
        $res = Mysql::update(self::TABLE_NAME, $data, $where);
        if (!$res) {
            throw new Exception('更新失败', 1);
        }
    }

    //报废设备
    public static function scrapDev($id){
        $id = $id > 0 ? (int)$id : 0;
        if (!$id) {
            throw new Exception('请选择一个操作项', 1);
        }
        $where = array(
            'id' => $id,
        );
        $data = array(
            'status' => -1
        );
        $res = Mysql::update(self::TABLE_NAME, $data, $where);
        if (!$res) {
            throw new Exception('更新失败', 1);
        }
    }

    //搜索功能
    public static function searchDev($searchName, $type_id, $keyWord, $status) {

        $where = array(
            $searchName => array(
                'opt' => 'like',
                'val' => $keyWord
            ),

            'status' => $status,
            'type_id' => $type_id,
        );

        $fields = array(
            'id',
            'dev_name',
            'sn',
            'type_id',
            'buyer',
            'status',
            'price',
            'time',
            'contract_sn',
            'remark',
            'config_info',
            'store_place'
        );

        $order = array(
            'order' => 'status desc'
        );

        return Mysql::select(self::TABLE_NAME, $where, $fields, $order);
//        if (!$res) {
//            return Dev::getAllDevList();
//        } else {
//            return $res;
//        }

    }
}
