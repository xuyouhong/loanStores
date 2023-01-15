<?php

namespace App\Models;

use DOMDocument;
use DOMXPath;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurModel extends Model
{
    use HasFactory;

    /**
     * @throws GuzzleException
     */
    public static function run(string $url, string $type = 'GET', array $header = [])
    {
        $client = new \GuzzleHttp\Client(['verify' => false]);
//        $client = new \GuzzleHttp\Client();
        $response = $client->request($type, $url, $header);
        return $response->getBody()->getContents();
    }

    public function getCrawler($url = '', $rule = '')
    {
        $html = self::run($url);
        //在LoadHTML之前先对应的转码，避免汉字乱码
        //$html = mb_convert_encoding($html ,'HTML-ENTITIES',"UTF-8");
        //创建一个DomDocument对象，用于处理一个HTML
        $dom = new DOMDocument();
        //从一个字符串加载HTML
        @$dom->loadHTML($html);
        //使该HTML规范化
        $dom->normalize();
        //用DOMXpath加载DOM，用于查询
        $xpath = new DOMXPath($dom);
        //获取所有规则内容
        return $xpath->query($rule);
    }
}
