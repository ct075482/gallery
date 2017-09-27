<?php

namespace app\common\controller;

class Index
{
    const TOKEN='APeng'; //加密用
    //加密数据
    public function encrype($data)
    {
        /*
            加密规则：
            PHPCMS V9 加密规则
        */
        return md5(md5($data).Index::TOKEN);
    }
    //返回数据，以json格式输出
    public function returnJson($status ,$msg='', $data=null)
    {
        $res=[
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        ];
        return json_encode($res);
    }
}