<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresBrandNearMeFoundPositionModel extends Model
{
    protected $table = "loan_stores_brand_near_me_found_position";

    protected $fillable = [
        '_id', 'title', 'pic', 'services', 'rating', 'enable', 'reviews', 'type', 'brand_path', 'standard_brand_name', 'loan_brand_city',
        'brand_title', 'state_short_name', 'state', 'other_cities', 'page_info', 'page', 'query_brand_name', 'query_state', 'query_city',
        'build_id', 'asset_prefix', 'is_fallback', 'gssp', 'custom_server', 'script_loader',
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
            'standard_brand_name' => $data->props->pageProps->standardBrandName,
            'loan_brand_city' => isset($detailData->loanBrandCity) ? json_encode($detailData->loanBrandCity) : null,
            'brand_title' => $detailData->brand_title,
            'state_short_name' => $detailData->stateShortName,
            'state' => $detailData->state,
            'other_cities' => isset($detailData->otherCities) ? json_encode($detailData->otherCities) : null,
            'page_info' => $pageInfoData,
            'page' => $data->page,
            'query_brand_name' => $data->query->brandName,
            'query_state' => $data->query->state,
            'query_city' => $data->query->city,
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

    public function show($brandAlias, $shortName, $city): array
    {
        $detail = self::where(['query_brand_name' => $brandAlias, 'query_state' => $shortName, 'query_city' => $city])->first()->toArray();
        return [
            'page_url' => '/' . $detail['brand_path'] . '/' . $shortName . '/' . $city,
            'props' => [
                'pageProps' => [
                    'pageInfo' => json_decode($detail['page_info']),
                    'brandPath' => $detail['brand_path'],
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
                        'loanBrandCity' => json_decode($detail['loan_brand_city']),
                        'brand_title' => $detail['brand_title'],
                        'state' => $detail['state'],
                        'stateShortName' => $detail['state_short_name'],
                        'otherCities' => json_decode($detail['other_cities'])
                    ]
                ]
            ],
            'page' => $detail['page'],
            'query' => ['brandName' => $detail['query_brand_name'], 'state' => $detail['query_state'], 'city' => $detail['query_city']],
            'buildId' => $detail['build_id'],
            'assetPrefix' => $detail['asset_prefix'],
            'isFallback' => (bool)$detail['is_fallback'],
            'gssp' => (bool)$detail['gssp'],
            'customServer' => (bool)$detail['custom_server'],
            'scriptLoader' => json_decode($detail['script_loader'])
        ];
    }
}
