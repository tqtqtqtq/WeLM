<?php
declare(encoding='UTF-8');
namespace tqtqtqtq\WeLM;

class WeLM
{
    private string $模型 = "xl";
    private array $请求头组;
    private array $内容类型组;
    private int $超时 = 0;
	private string $自定义网址 = "";
    private string $代理服务器 = "";
    private array $curl信息组 = [];

    public function __construct($WELM_API_KEY)
    {
        $this->内容类型组 = [
            "application/json" => "Content-Type: application/json",
        ];

        $this->请求头组 = [
            $this->内容类型组["application/json"],
            "Authorization: Bearer $WELM_API_KEY",
        ];
    }

    /**
     *
     * @return array
     * 仅供开发环境使用
     */
    public function 获取curl信息()
    {
        return $this->curl信息组;
    }


    /**
     * @param $设置选项组
     * @return bool|string
     */
    public function completion($设置选项组)
    {
        $设置选项组['model'] = $设置选项组['model'] ?? $this->模型;
        $网址 = 端点::completions端点();
        $this->基本网址($网址);

        return $this->发送请求($网址, 'POST', $设置选项组);
    }





    /**
     * @param int $超时
     */
    public function 设置超时(int $超时)
    {
        $this->超时 = $超时;
    }

    /**
     * @param string $代理服务器
     */
    public function 设置代理服务器(string $代理服务器)
    {
        if ($代理服务器 && strpos($代理服务器, '://') === false) 
		{
            $代理服务器 = 'http://' . $代理服务器;
        }
        $this->代理服务器 = $代理服务器;
    }

    /**
     * @param string $自定义网址
     */
    public function 设置自定义网址(string $自定义网址)
    {
        if ($自定义网址 != "") 
		{
            $this->自定义网址 = $自定义网址;
        }
    }



    /**
     * @param string $网址
     * @param string $方法
     * @param array $设置选项组
     * @return bool|string
     */
    private function 发送请求(string $网址, string $方法, array $设置选项组 = [])
    {
        $POST域组 = json_encode($设置选项组);
		
        $this->请求头组[0] = $this->内容类型组["application/json"];
		
        $curl信息组 = [
            CURLOPT_URL => $网址,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => $this->超时,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $方法,
            CURLOPT_POSTFIELDS => $POST域组,
            CURLOPT_HTTPHEADER => $this->请求头组,
        ];

        if ($设置选项组 == []) 
		{
            unset($curl信息组[CURLOPT_POSTFIELDS]);
        }

        if (! empty($this->代理服务器)) 
		{
            $curl信息组[CURLOPT_PROXY] = $this->代理服务器;
        }

        $curl = curl_init();

        curl_setopt_array($curl, $curl信息组);
		
        $响应 = curl_exec($curl);        

        $this->curl信息组 = curl_getinfo($curl);

        curl_close($curl);

        return $响应;
    }

    /**
     * @param string $网址
     */
    private function 基本网址(string &$网址)
    {
        if ($this->自定义网址 != "") 
		{
            $网址 = str_replace(端点::基本网址, $this->自定义网址, $网址);
        }
    }
}
