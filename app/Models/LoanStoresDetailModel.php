<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresDetailModel extends Model
{
    protected $table = "loan_stores_detail";

    protected $fillable = [
        '_id', 'data_id', 'title', 'state', 'city', 'street', 'street_suffix', 'zip', 'phone', 'address', 'opening_hours', 'gps_coordinates',
        'location', 'website', 'rating', 'review_num', 'services', 'category', 'description', 'photos', 'enable', 'lower_title', 'score', 'loan_services',
        'city_url', 'short_state', 'available', 'main_type', 'exist', 'initials', 'open', 'short_name', 'short_title', 'reviews', 'brandNearby', 'nearByLoans',
        'redirect', 'page_info', 'socialBool'
    ];

    public function reptile($data): array
    {
//        $detailData = isset($data->props->pageProps->storeDetail) ? $data->props->pageProps->storeDetail : $data->props->pageProps->stateListData;
//        $loanData = isset($data->props->pageProps->storeDetail) ? 'loan' : 'loans';
        $pageInfoData = $data->props->pageProps->pageInfo;

        if(isset($data->props->pageProps->storeDetail)){
            $detailData = $data->props->pageProps->storeDetail;
            $param = [
                '_id' => $detailData->loan->_id,
                'data_id' => $detailData->loan->data_id,
                'title' => $detailData->loan->title,
                'state' => $detailData->loan->state,
                'city' => $detailData->loan->city,
                'street' => $detailData->loan->street,
                'street_suffix' => $detailData->loan->street_suffix,
                'zip' => $detailData->loan->zip,
                'phone' => $detailData->loan->phone,
                'address' => $detailData->loan->address,
                'opening_hours' => json_encode($detailData->loan->opening_hours),
                'gps_coordinates' => json_encode($detailData->loan->gps_coordinates),
                'location' => json_encode($detailData->loan->location),
                'website' => $detailData->loan->website,
                'rating' => $detailData->loan->rating,
                'review_num' => $detailData->loan->review_num,
                'services' => json_encode($detailData->loan->services),
                'category' => $detailData->loan->category,
                'description' => $detailData->loan->description,
                'photos' => json_encode($detailData->loan->photos),
                'enable' => $detailData->loan->enable ? 1 : 0,
                'lower_title' => $detailData->loan->lower_title,
                'score' => $detailData->loan->score,
                'loan_services' => isset($detailData->loan->loan_services) ? json_encode($detailData->loan->loan_services) : null,
                'city_url' => $detailData->loan->city_url,
                'short_state' => $detailData->loan->short_state,
                'available' => $detailData->loan->available ? 1 : 0,
                'main_type' => $detailData->loan->main_type,
                'exist' => $detailData->loan->exist ? 1 : 0,
                'initials' => $detailData->loan->initials,
                'open' => $detailData->loan->open ? 1 : 0,
                'short_name' => $detailData->loan->short_name,
                'short_title' => $detailData->title,
                'reviews' => json_encode($detailData->reviews),
                'brandNearby' => json_encode($detailData->brandNearby),
                'nearByLoans' => json_encode($detailData->nearByLoans),
                'redirect' => $detailData->redirect ? 1 : 0,
                'page_info' => json_encode($pageInfoData),
                'socialBool' => $data->props->pageProps->socialBool ? 1 : 0
            ];
        } else {
            $detailData = $data->props->pageProps->stateListData;
            $param = [
                    '_id' => $detailData->loans[0]->_id,
                    'data_id' => $detailData->loans[0]->data_id,
                    'title' => $detailData->loans[0]->title,
                    'state' => $detailData->loans[0]->state,
                    'city' => $detailData->loans[0]->city,
                    'street' => $detailData->loans[0]->street,
                    'street_suffix' => $detailData->loans[0]->street_suffix,
                    'zip' => $detailData->loans[0]->zip,
                    'phone' => $detailData->loans[0]->phone,
                    'address' => $detailData->loans[0]->address,
                    'opening_hours' => json_encode($detailData->loans[0]->opening_hours),
                    'gps_coordinates' => json_encode($detailData->loans[0]->gps_coordinates),
                    'location' => json_encode($detailData->loans[0]->location),
                    'website' => $detailData->loans[0]->website,
                    'rating' => $detailData->loans[0]->rating,
                    'review_num' => $detailData->loans[0]->review_num,
                    'services' => json_encode($detailData->loans[0]->services),
                    'category' => $detailData->loans[0]->category,
                    'description' => $detailData->loans[0]->description,
                    'photos' => json_encode($detailData->loans[0]->photos),
                    'enable' => $detailData->loans[0]->enable ? 1 : 0,
                    'lower_title' => $detailData->loans[0]->lower_title,
                    'score' => $detailData->loans[0]->score,
                    'loan_services' => isset($detailData->loans[0]->loan_services) ? json_encode($detailData->loans[0]->loan_services) : null,
                    'city_url' => $detailData->loans[0]->city_url,
                    'short_state' => $detailData->loans[0]->short_state,
                    'available' => $detailData->loans[0]->available ? 1 : 0,
                    'main_type' => $detailData->loans[0]->main_type,
                    'exist' => $detailData->loans[0]->exist ? 1 : 0,
                    'initials' => $detailData->loans[0]->initials,
                    'open' => isset($detailData->loans[0]->open) ? 1 : 0,
                    'short_name' => $detailData->loans[0]->short_name ?? '',
                    'short_title' => $detailData->loans[0]->title,
                    'reviews' => json_encode($detailData->loans[0]->reviews),
                    'brandNearby' => json_encode($detailData->loans[0]->brandNearby),
                    'nearByLoans' => json_encode($detailData->nearByLoans),
                    'redirect' => $detailData->redirect ? 1 : 0,
                    'page_info' => json_encode($pageInfoData),
                    'socialBool' => $data->props->pageProps->socialBool ? 1 : 0
                ];
        }



//        echo "<pre>";
//        print_r($param);
//        exit;

        try {
            self::firstOrCreate($param);
        } catch (\Exception $e) {
            $msg .= $e->getMessage() . PHP_EOL;
            echo $msg . PHP_EOL;
            die;
        }

//        echo "<pre>";
//        print_r($msg);
//        print_r($param);
//        exit;

        if (!empty($msg)) {
            return ['success' => false, 'msg' => 'Crawler ' . $param['lower_title'] . ' is failed.', 'errorMsg' => $msg];
        } else {
            return ['success' => true, 'msg' => 'Crawler ' . $param['lower_title'] . ' is completed.'];
        }
    }

    public function show(string $lowerTitle)
    {
        $detail = self::where('lower_title', $lowerTitle)->first()->toArray();
        return [
            'page' => '/store/' . $lowerTitle,
            'storeDetail' => [
                'loan' => [
                    '_id' => $detail['_id'],
                    'data_id' => $detail['data_id'],
                    'title' => $detail['title'],
                    'state' => $detail['state'],
                    'city' => $detail['city'],
                    'street' => $detail['street'],
                    'street_suffix' => $detail['street_suffix'],
                    'zip' => $detail['zip'],
                    'phone' => $detail['phone'],
                    'address' => $detail['address'],
                    'opening_hours' => json_decode($detail['opening_hours']),
                    'gps_coordinates' => json_decode($detail['gps_coordinates']),
                    'location' => json_decode($detail['location']),
                    'website' => $detail['website'],
                    'rating' => $detail['rating'],
                    'review_num' => $detail['review_num'],
                    'services' => json_decode($detail['services']),
                    'category' => $detail['category'],
                    'description' => $detail['description'],
                    'photos' => json_decode($detail['photos']),
                    'enable' => (bool)$detail['enable'],
                    'lower_title' => $detail['lower_title'],
                    'score' => $detail['score'],
                    'loan_services' => json_decode($detail['loan_services']) ?: null,
                    'city_url' => $detail['city_url'],
                    'short_state' => $detail['short_state'],
                    'available' => (bool)$detail['available'],
                    'main_type' => $detail['main_type'],
                    'exist' => (bool)$detail['exist'],
                    'initials' => $detail['initials'],
                    'open' => (bool)$detail['open'],
                    'short_name' => $detail['short_name']
                ],
                'title' => $detail['lower_title'],
                'reviews' => json_decode($detail['reviews']),
                'brandNearby' => json_decode($detail['brandNearby']),
                'nearByLoans' => json_decode($detail['nearByLoans']),
                'redirect' => (bool)json_decode($detail['redirect'])],
            'pageInfo' => json_decode($detail['page_info']),
            'socialBool' => (bool)$detail['socialBool']
        ];
    }
}
