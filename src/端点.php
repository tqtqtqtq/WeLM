<?php
declare(encoding='UTF-8');
namespace tqtqtqtq\WeLM;

class 端点
{
    public const 基本网址 = 'https://welm.weixin.qq.com';
    public const API版本 = 'v1';
    public const WELM网址 = self::基本网址 . "/" . self::API版本;



    /**
     * @return string
     */
    public static function completions端点(): string
    {
        return self::WELM网址 . "/completions";
    }

 
}
