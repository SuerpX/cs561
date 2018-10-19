<?php
echo "Hello php";//输入出
//注释同C语言
$a = 10;//声明变量需要美元符号
$b = 5;
$c = $a + $b;
echo '<br>';//输出换行
echo $c;//输出
echo '<br>'.$a; //用'.'结合string和变量输出
echo "<br>a = $a, b = $b";

const c_v = 10;//常量



//函数
echo '<br>';
echo '<br>';

$d = func(2,3);//调用函数
echo "<br> $d";

function func($a, $b){
    echo $a * $b;
    return $a * $b;
}
echo '<br>';
//另一种函数执行方式
$func_variable = 'func';
$func_variable(3,4);



//流程控制
//if 同C语言
$score = 89;
if($score >= 90){
    echo "牛";
}
elseif ($score < 90){
    echo "不牛";
}
//swich 同C语言
//intval类型强制转换
switch (intval($score / 10)){
    case 10:
    case 9:
        echo "好好";
        break;
    default:
        echo "不好好";
}
//自加，for,while和do while 同C语言
//逻辑控制符也同C语言，&&, ||, !=
echo '<br>';
echo '<br>';
echo '<br>';
//字符串

$str = 'zi fu chuang he shu zu';
echo strpos($str, 'fu'); //子字符串的位置
$str2 = substr($str, 2, 5 );//截取字符串
echo '<br>';
echo $str;
echo '<br>';

$astr = str_split($str, 2 );//分割字符串存在数组
print_r($astr);//输出字符串
echo '<br>';
$astr2 = explode(' ', $str);//以符号分割字符串存在数组
print_r($astr2);//输出字符串
echo '<br>';

$num = 100;
echo "lianjie<br>".$str.$num;//连接字符串
echo '<br>';

$lstr = "$str <br> together, $num"; //全部连在一起
echo $lstr;

//数组
$arr = array();//可存所有类型
$arr[0] = 'str';
$arr[1] = 123;
$arr[2] = 1.1;
print_r($arr);

$arr2 = array();

for($i = 0; $i < 10; $i++){
    array_push($arr2, 'item'.$i);
}
print_r($arr2);

echo '<br>';
$arrd = array();//类似字典一样
$arrd['h'] = 'world';
$arrd['hahah'] = 'hehehe';
print_r($arrd);

echo '<br>';
$arrd2 = array('h'=>'world2', 0 => '12', 2 => '543');
print_r($arrd2);
echo '<br>';
echo '<br>';

//include and require

include 'lib.php'; // require 'lib.php'效果一样，区别在于一个是要求（出错），一个是包含（警告）
funlib();

require_once 'lib.php';// php不允许重复引入文件，用once可以避免重复
require_once 'lib.php';

echo '<br>';
echo '<br>';
echo '<br>';

include_once 'parentCLS.php';


//类
class demo extends parentCLS
{
    /**
     * @var int $_a 快速注释并表明类型
     */
    private $_a, $_b;
    private static $age = 10;
    const NAME = 20;//常量不需要加美元符号

    public function __construct()
    {
        parent::__construct();
        echo '构造方法<br>';
        $this->a = 1;
        echo demo::$age; //调用静态变量或常量
        echo demo::NAME;

    }

    public function init()
    {
        echo 'class init';
        echo $this->a;
    }

    public static function sta()
    {
        echo '静态方法或类方法';
    }
    /*
    public function sameNameAsParentsFunction{
        重构父类方法
        // parent::sameNameFunction(); 如同时需要用到父类方法
    }*/
}
include_once 'demo.php';
$d = new demo();
$d->init();
echo '<br>';
//同类名，可用命名空间区分调用，$d = new \namespace\demo();
$dn = new \name1\demo();
$dn->init();

echo '<br>';
echo '<br>';
demo::sta();//调用静态方法
echo '<br>';
$d->pecho(); //执行父类方法


echo '<br>';
echo '<br>';

echo '<br>';
//时间
date_default_timezone_set('America/Los_Angeles');

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}
echo '<br>';
echo date('Y-m-d H:i:s');
echo '<br>';
echo time();//输出时间戳
echo '<br>';
echo date('Y-m-d H:i:s',time());//转换时间戳

echo '<br>';
echo '<br>';
echo '<br>';
/*
json format
[1,2,5,7,8,"abc",[3,"shuzu2"], {"h":"hello"}]
{"h":"hello","w":"world", [1,2,3]}
*/
//编码成json格式，输出
$arrd1 = array(1,2,3,4,"abc",array(231,321),array("suzu2"=>"321"));
print_r($arrd1);
echo '<br>';
echo json_encode($arrd1);//输出json格式
$arrd2 = array(1,2,3,4,'h'=>'world2', 0 => '12', 2 => '543', array("suzu2"=>"321"));
echo '<br>';
echo json_encode($arrd2);

//解码json格式
echo '<br>';
echo '<br>';
$jsonStr = '{"0":"12","1":2,"2":"543","3":4,"h":"world2","4":{"suzu2":"321"}}';
$obj = json_decode($jsonStr);
print_r($obj);
echo '<br>';
echo $obj->h;

echo '<br>';
$jsonStr = '[1,2,3,4,"abc",[231,321],{"suzu2":"321"}]';
$obj = json_decode($jsonStr);
print_r($obj);
echo '<br>';
echo $obj[0];





//http://php.net/manual/zh/      php手册



// 如果在html中插入就需要结束符号，如果纯php文件就不用
?>

<script type="text/javascript">
    alert("请认真听讲！！");
</script>

<button type="button">Click Me!</button>