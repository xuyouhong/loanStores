<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresBrandNearMeFoundModel extends Model
{
    protected $table = "loan_stores_brand_near_me_found";

    protected $fillable = [
        '_id', 'title', 'pic', 'services', 'rating', 'enable', 'reviews', 'type', 'brand_path', 'brand_number', 'standard_brand_name',
        'store_count', 'state_short_name', 'state', 'brand_title', 'loan_brand_city_list', 'loan_brand_main_city', 'page_info', 'page',
        'query_brand_name', 'query_state', 'build_id', 'asset_prefix', 'is_fallback', 'gssp', 'custom_server', 'script_loader',
    ];

    public function reptile($data): array
    {
        $detailData = $data->props->pageProps->data;
        $pageInfoData = isset($data->props->pageProps->pageInfo) ? json_encode($data->props->pageProps->pageInfo) : null;
        $msg = '';
        $param = [
            '_id' => $detailData->detail->_id,
            'title' => $detailData->detail->title,
            'pic' => $detailData->detail->pic,
            'services' => isset($detailData->detail->services) ? json_encode($detailData->detail->services) : null,
            'rating' => $detailData->detail->rating,
            'enable' => $detailData->detail->enable,
            'reviews' => $detailData->detail->reviews,
            'type' => $detailData->detail->type,
            'brand_path' => $data->props->pageProps->brandPath,
            'brand_number' => $data->props->pageProps->BrandNumber,
            'standard_brand_name' => $data->props->pageProps->standardBrandName,
            'store_count' => $detailData->storeCount,
            'state_short_name' => $detailData->stateShortName,
            'state' => $detailData->state,
            'brand_title' => $detailData->brand_title,
            'loan_brand_city_list' => isset($detailData->loanBrandCityList) ? json_encode($detailData->loanBrandCityList) : null,
            'loan_brand_main_city' => isset($detailData->loanBrandMainCity) ? json_encode($detailData->loanBrandMainCity) : null,
            'page_info' => $pageInfoData,
            'page' => $data->page,
            'query_brand_name' => $data->query->brandName,
            'query_state' => $data->query->state,
            'build_id' => $data->buildId,
            'asset_prefix' => $data->assetPrefix,
            'is_fallback' => $data->isFallback ? 1 : 0,
            'gssp' => $data->gssp ? 1 : 0,
            'custom_server' => $data->customServer ? 1 : 0,
            'script_loader' => isset($data->scriptLoader) ? json_encode($data->scriptLoader) : null
        ];

        try {
            self::firstOrCreate($param);
        } catch (\Exception $e) {
            $msg .= $e->getMessage() . PHP_EOL;
            echo $msg . PHP_EOL;
            die;
        }

        if (!empty($msg)) {
            return ['success' => false, 'msg' => 'Crawler ' . $param['brand_path'] . ' is failed.', 'errorMsg' => $msg];
        } else {
            return ['success' => true, 'msg' => 'Crawler ' . $param['brand_path'] . ' is completed.'];
        }
    }

    public function show($brandAlias, $shortName): array
    {
        $detail = self::where(['brand_path' => $brandAlias, 'state_short_name' => mb_strtolower(trim($shortName))])->first()->toArray();
        return [
            'page_url' => '/' . $detail['brand_path'] . '/' . mb_strtolower(trim($shortName)),
            'props' => [
                'pageProps' => [
                    'pageInfo' => json_decode($detail['page_info']),
                    'brandPath' => $detail['brand_path'],
                    'BrandNumber' => $detail['brand_number'],
                    'standardBrandName' => $detail['standard_brand_name'],
                    'data' => [
                        'detail' => [
                            '_id' => $detail['_id'],
                            'title' => $detail['title'],
                            'pic' => $detail['pic'],
                            'services' => json_decode($detail['services']),
                            'rating' => $detail['rating'],
                            'enable' => (bool)$detail['enable'],
                            'reviews' => $detail['reviews'],
                            'type' => $detail['type']
                        ],
                        'storeCount' => $detail['store_count'],
                        'stateShortName' => $detail['state_short_name'],
                        'state' => $detail['state'],
                        'brand_title' => $detail['brand_title'],
                        'loanBrandCityList' => json_decode($detail['loan_brand_city_list']),
                        'loanBrandMainCity' => json_decode($detail['loan_brand_main_city'])
                    ]
                ]
            ],
            'page' => $detail['page'],
            'query' => ['brandName' => $detail['query_brand_name'], 'state' => $detail['query_state']],
            'buildId' => $detail['build_id'],
            'assetPrefix' => $detail['asset_prefix'],
            'isFallback' => (bool)$detail['is_fallback'],
            'gssp' => (bool)$detail['gssp'],
            'customServer' => (bool)$detail['custom_server'],
            'scriptLoader' => json_decode($detail['script_loader'])
        ];
    }
}
