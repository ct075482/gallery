<?php
namespace app\index\controller;

use app\index\model\Comment;
use app\index\model\School;
use app\index\model\Team;
use app\index\model\User;
use app\index\model\Works;
use phpDocumentor\Reflection\Types\Array_;
use think\Db;
use think\Request;
use app\common\controller\Index as commonIndex;

class Index extends commonIndex
{
    /**
     * 默认返回全部作品信息
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $works=Works::all();
        return $this->returnJson(1,"请求成功",$works);
    }

    /**
     * 登录验证
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        //得到前台数据
        $userName=$request->post('username');
        $pwd=$request->post('password');
        //验证数据库
        $data=User::where('user_name',$userName)->find();

        if($data==null){
            return $this->returnJson(0,'用户名不存在');
        }
        else{
            //判断输入密码与数据库数据是否一样
            if($data->user_pwd==$this->encrype($pwd)){
                //存储用户信息
                $userData=[
                    "userId" =>$data->id,
                    "userName" => $data->user_name,
                    "userPhone" => $data->user_phone,
                    "userNickname" => $data->user_nickname
                ];
                return $this->returnJson(1,'验证成功',$userData);
            }else{
                return $this->returnJson(0,'密码错误');
            }
        }
    }

    /**
     * 根据作品id返回作品详情信息
     * @param Request $request
     * @return string
     */
    public function showWorks(Request $request)
    {
        $id=$request->get('id');
        //$data=Db::table('think_works')->where('id',$id)->find();
        $data=Works::where('id',$id)->find();
        return $this->returnJson(1,'请求成功',$data);
    }

    /**
     * 根据id返回评论信息
     * @param Request $request
     * @return string
     */
    public function returnComment(Request $request)
    {
        $worksId=$request->get('id');
        //$data=Db::table('think_comment')->where('works_id',$worksId)->find();
        $data=Comment::where('works_id',$worksId)->find();
        return $this->returnJson(1,"请求成功",$data);
    }

    /**
     * 管理作品
     */

    /**
     * 上传作品
     */

    /**
     * 分页模块
     */
}
