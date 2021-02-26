<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

/**
 * 首页接口
 */
class Index extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 首页
     *
     */
    public function index()
    {
        $this->success('请求成功ok');
    }
     public function login()
    {
        $username = $this->request->post('username');
        $password = $this->request->post('password');
        $user = Db::table('paper_admin')
    				->where('username',$username)
    				->where('status','normal')
    				->find();
        if ($user) {
        		$password =md5(md5($password).$user['salt']);
        		if($password==$user['password']) {
        			print ($this->api_rule(($user),"验证完成，正在登陆，请稍候..."));
        		} else {
        			$res['code'] = "0";
            	$res['message'] = "密码错误!";
            	print json_encode($res);
        		}

            //使用规范格式json下发数据
            //上面的M方法使用是的find(),获得的结果是非数组，因此可以使用“+”运算符合并，获得是简单的嵌套json
        } else {
            $res['code'] = "0";
            $res['message'] = "用户名不存在！";
            print json_encode($res);
        }

    }
    public function input()
    {
        $product_code = $this->request->post("product_code");
        $product_sale_code = $this->request->post("sale_code");
        $data = Db::table('paper_product_product')
        			->where(['product_code'=>trim($product_code),'product_status'=>1,'product_sale_code'=>NULL])
        			->find();
        if ($data){
            $result= Db::table('paper_product_product')
            					->where(['product_code'=>trim($product_code),'product_status'=>1,'product_sale_code'=>NULL])
            					->update(['product_sale_code'=>$product_sale_code]);
            if ($result) {
            	 $res['code'] =1;
                $res['data'] = $data;
            } else {
            	 $res['code'] =0;
                $res['message'] = "产品卷号有误，或已经出库产品！";
            }
        }else {
            $res['code'] = "0";
            $res['message'] = "产品卷号有误，或已经出库产品！";
        }
        print json_encode($res);
    }

    public function remove()
    {
        $product_code = $this->request->post("product_code");
        $data = Db::table('paper_product_product')
        			->where(['product_code'=>trim($product_code),'product_status'=>1])
        			//->where('product_sale_code','<>',NULL)
        			->find();
        if ($data){
            $product['product_status'] = 0;
            $product['product_sale_code'] = '';
            $result= Db::table('paper_product_product')
            					->where(['product_code'=>trim($product_code),'product_status'=>1])
            					//->where('product_sale_code','<>',NULL)
            					->update(['product_sale_code'=>NULL]);
            if ($result) {
            	 $res['code']=1;
                $res['data'] = $data;
            } else {
            	 $res['code']="0";
                $res['message'] = "退库操作失败，请至PC端检查";
            }
        }else {
            $res['code'] = "0";
            $res['message'] = $product_code."退库操作失败，请至PC端检查！";
        }
        print json_encode($res);
    }
  
  public function download(){
        $famlePath ="FsScan.apk";
        $file_dir = './Public/' . "$famlePath";
        // 检查文件是否存在
        if (! file_exists($file_dir) ) {
            echo $file_dir;
            $this->error('文件未找到');
        }else {
            // 打开文件
            $file1 = fopen($file_dir, "r");javascript:;
            // 输入文件标签
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length:" . filesize($file_dir));
            Header("Content-Disposition: attachment;filename=" . $file_dir);
            ob_clean();     // 重点！！！
            flush();        // 重点！！！！可以清除文件中多余的路径名以及解决乱码的问题：
            //输出文件内容
            //读取文件内容并直接输出到浏览器
            echo fread($file1, filesize($file_dir));
            fclose($file1);
            exit();
        }
    }
   
    /**
     * php 编写 app 接口的函数封装
     *
     * @param  string  $data    [从数据库中所查出的数据]
     * @param  string  $message [接口的提示信息,解释状态码所使用]
     * @param  integer $code    [状态码]
     * @return [type]           [返回 json 数据类型]
     * 接口主要实现了 value 不为空
     * 并且统一将类型转化成字符串
     * 将安卓与 ios 中的关键字进行 key 的转化,如果是系统关键字，那么我将 key 添加尾缀 _api 进行数组重组
     * 一维数组与二维数组通用
     */
    public function api_rule($data='',$message='成功',$code=1)
    {
        $all_data=array(
            'code'=>$code,
            'message'=>$message,
        );
        //数组校验(目的是判断数组几维数组)

        //判断是否是数组，并且数组是否大于三维数组
        foreach ($data as $x => $y)
        {
            if(is_array($y))
            {
                foreach ($y as $x1 => $y1)
                {
                    if(is_array($y1))
                    {
                        echo "函数中不能使用三维以上数组";exit(0);
                    }
                }
            }
        }
        //如果数据不为空的情况下所执行以下代码
        if ($data!=='') {
            // app 禁止使用和为了统一字段做的判断,ios 的字典中不识别的关键字
            $reserved_words=array('id','title','price','product_title','product_id','product_category','product_number');
            foreach ($reserved_words as $k => $v)
            {
                foreach ($data as $ko => $ko_value)
                {
                    if(is_array($ko_value))
                    {
                        if (array_key_exists($v, $ko_value))
                        {
                            $keys = $v.""."_api";
                            //取出数组中所有的 key 值
                            $keyss = array_keys($ko_value);
                            $ko_value[$keys]=$ko_value[$v];
                            unset($ko_value[$v]);
                            $data[]=$ko_value;
                            array_splice($data,0,1);
                        }

                    }else{
                        //检测我数组的 key 是否存在于这些关键字当中
                        if (array_key_exists($v, $data))
                        {
                            $keys = $v.""."_api";
                            $data[$keys]=$data[$v];
                            //取出数组中所有的 key 值
                            $keyss = array_keys($data);
                            $index = array_search($v, $keyss);
                            if($index !== FALSE){
                                array_splice($data, $index, 1);
                            }
                        }
                    }
                }
            }

            foreach ($data as $key => $value)
            {
                if(is_array($value))
                {
                    foreach ($value as $key12 => $value12)
                    {
                        if(!is_string($value12))
                        {
                            $data[$key][$key12]=strval($value12);
                        }
                        //如果我的 value 是空的情况下，赋予默认值  空
                        if(empty($value12))
                        {
                          //  $data[$key][$key12]="空";
                        }
                    }
                }else{
                    if(!is_string($value))
                    {
                        $data[$key]=strval($value);
                    }
                    //如果我的 value 是空的情况下，赋予默认值  空
                    if(empty($value))
                    {
                      //  $data[$key]="空";
                    }
                }
                //如果我的 value 不是字符串类型，我强转成字符串类型
            }

            $all_data['data']=$data;
        }
        // 如果是 ajax 或者 app 访问；则返回 json 数据 pc 访问直接 p 出来
        return json_encode($all_data);
        exit(0);
    }
}
