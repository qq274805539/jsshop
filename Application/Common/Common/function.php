<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 19:13
 */


function guolv($string)
{
    require_once '/Application/Common/Plugins/htmlpurifier/HTMLPurifier.auto.php';
    // 生成配置对象
    $cfg = HTMLPurifier_Config::createDefault();
    // 以下就是配置：
    $cfg->set('Core.Encoding', 'UTF-8');
    // 设置允许使用的HTML标签
    $cfg->set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,br,span[style],img[width|height|alt|src]');
    // 设置允许出现的CSS样式属性
    $cfg->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
    // 设置a标签上是否允许使用target="_blank"
    $cfg->set('HTML.TargetBlank', TRUE);
    // 使用配置生成过滤用的对象
    $obj = new HTMLPurifier($cfg);
    // 过滤字符串
    return $obj->purify($string);
}


/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 19:13
 */
//利用PHPMailer实现邮件发送

//发送邮件
/*
$to:邮件接收方
$title:邮件标题
$content:邮件内容
*/
function sendMail($to, $content){
    //引入发送邮件的核心类文件
    require_once('./Application/Common/Plugins/PHPMailer/class.phpmailer.php');
    $mail = new PHPMailer();
    // 设置为要发邮件
    $mail->IsSMTP();
    // 是否允许发送“HTML代码”做为邮件的内容
    $mail->IsHTML(TRUE);
    $mail->CharSet='UTF-8';
    // 是否需要身份验证
    $mail->SMTPAuth=TRUE;
    /*  邮件服务器上发送方账号设置 start*/
    $mail->From="hnnylql@163.com"; //发送方邮件地址
    $mail->FromName="京西商城的激活邮件";  //发送方名称，会显示在邮件的内容中，可以自定义
    $mail->Host="smtp.163.com";  //发送邮件的服务协议地址，中转邮件服务器地址
    $mail->Username="hnnylql";  //发送方帐号
    $mail->Password="lql1100"; //发送方帐号密码
    /*  邮件服务器上发送方账号设置 end*/
    // 发邮件端口号默认25
    $mail->Port = 25;
    // 收件人
    $mail->AddAddress($to);
    // 邮件标题
    $mail->Subject=$title;
    // 邮件内容
    $mail->Body=$content;
    return($mail->Send());//发送邮件
}
//调用函数实现邮件发送
//var_dump(sendMail('2226230644@qq.com','what the weather todayA','it is <a href="http://www.sun.com">sun</a> shine'));
//var_dump(sendMail('php621@163.com','what the weather todayB','it is <a href="http://www.sun.com">sun</a> shine'));

//注册时发送短信
function sendSms($to,$datas,$tempId='1')
{
    include_once("./Application/Common/Plugins/sms/CCPRestSmsSDK.php");




    // 初始化REST SDK
    global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;

    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
    $accountSid= '8a216da85b3c225d015b421906ee03a9';

    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    $accountToken= 'f2acc7745ff649b6b0e433679e38b5b2';

    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    $appId='8a216da85b3c225d015b421908f203b0';

    //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    $serverIP='app.cloopen.com';


    //请求端口，生产环境和沙盒环境一致
    $serverPort='8883';

    //REST版本号，在官网文档REST介绍中获得。
    $softVersion='2013-12-26';

    $rest = new REST($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
    //echo "Sending TemplateSMS to $to <br/>";
    $result = $rest->sendTemplateSMS($to,$datas,$tempId);
    if($result == NULL ) {
        //echo "result error!";
        break;
    }
    if($result->statusCode!=0) {
        //echo "error code :" . $result->statusCode . "<br>";
        //echo "error msg :" . $result->statusMsg . "<br>";
        //TODO 添加错误处理逻辑
        return false;
    }else{
        //echo "Sendind TemplateSMS success!<br/>";
        // 获取返回信息
        $smsmessage = $result->TemplateSMS;
        //echo "dateCreated:".$smsmessage->dateCreated."<br/>";
        //echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
        //TODO 添加成功处理逻辑
        return true;
    }
}