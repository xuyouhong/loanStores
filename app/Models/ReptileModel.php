<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReptileModel extends Model
{
    /**
     * @page https://weloans.com/store-directory
     * @return array
     */
    public function storeDirectory(): array
    {
        $url = 'https://weloans.com/store-directory';
        $successMsg = $errorMsg = [];

        // Find Loan Stores by Alphabet
        $nodes = (new CurModel)->getCrawler($url, '//ul[contains(@class, "md:gap-3")]//li//a');
        $list = [];
        foreach ($nodes as $key => $value) {
            $list[$key]['type_name'] = trim($value->nodeValue);
            $list[$key]['mb_type_name'] = mb_strtolower(trim($value->nodeValue));
        }
        $alphabet = (new LoanStoresTypeByAlphabetModel)->reptile($list);
        if ($alphabet['success']) {
            $successMsg[] = $alphabet['msg'];
        } else {
            $errorMsg[] = $alphabet['errorMsg'];
        }

        // Find Loan Stores by Brand and Directory
        $nodes = (new CurModel)->getCrawler($url, '//script[contains(@id, "__NEXT_DATA__")]');
        foreach ($nodes as $value) {
            $data = json_decode($value->nodeValue);

            $pageInfoData = $data->props->pageProps->pageInfo;
            $pageInfo = (new LoanStoresPageInfoModel)->reptile('/store-directory', $pageInfoData);
            if ($pageInfo['success']) {
                $successMsg[] = $pageInfo['msg'];
            } else {
                $errorMsg[] = $pageInfo['errorMsg'];
            }

            $storeDirectoryData = $data->props->pageProps->StoreDircetoryData;
            $directory = (new LoanStoresTypeByDirectoryModel)->reptile($storeDirectoryData);
            if ($directory['success']) {
                $successMsg[] = $directory['msg'];
            } else {
                $errorMsg[] = $directory['errorMsg'];
            }

            $brandList = $data->props->pageProps->brandList;
            $brand = (new LoanStoresTypeByBrandModel)->reptile($brandList);
            if ($brand['success']) {
                $successMsg[] = $brand['msg'];
            } else {
                $errorMsg[] = $brand['errorMsg'];
            }
        }

        // Find Loan Stores by State
        $nodes = (new CurModel)->getCrawler($url, '//ul[contains(@class, "grid grid-cols-4 gap-x-6 gap-y-3 lg:grid-cols-3 md:grid-cols-2 lg:hidden")]//li//a[contains(@class, "hover:underline")]');
        $list = [];
        foreach ($nodes as $key => $value) {
            $list[$key]['name'] = $value->nodeValue;
            $list[$key]['alias'] = substr($value->getAttribute('href'), strrpos($value->getAttribute('href'), "/") + 1);
        }
        $state = (new LoanStoresTypeByStateModel)->reptile($list);
        if ($state['success']) {
            $successMsg[] = $state['msg'];
        } else {
            $errorMsg[] = $state['errorMsg'];
        }

        return [
            'success' => $errorMsg ? 'false' : 'true',
            'successMsg' => $successMsg,
            'errorMsg' => $errorMsg,
        ];
    }

    /**
     * @page https://weloans.com/loan-stores-start-with-a
     * @return array
     */
    public function loanStoresStartWith(): array
    {
        $alphabetList = (new \App\Models\LoanStoresTypeByAlphabetModel)->selectRaw('type_name,mb_type_name')->get()->toArray();
        $curModel = new CurModel;
        $LoanStoresStartWithModel = new LoanStoresStartWithModel;
        $LoanStoresPageInfoModel = new LoanStoresPageInfoModel;
        $successMsg = $errorMsg = [];
        foreach ($alphabetList as $item) {
            $url = 'https://weloans.com/loan-stores-start-with-' . $item['mb_type_name'];

            $nodes = $curModel->getCrawler($url, '//script[contains(@id, "__NEXT_DATA__")]');
            foreach ($nodes as $value) {
                $data = json_decode($value->nodeValue);

                $pageUrl = '/' . $data->props->pageProps->router[0];
                $pageInfoData = $data->props->pageProps->pageInfo;
                $pageInfo = $LoanStoresPageInfoModel->reptile($pageUrl, $pageInfoData);
                if ($pageInfo['success']) {
                    $successMsg[] = $pageInfo['msg'];
                } else {
                    $errorMsg[] = $pageInfo['errorMsg'];
                }

                $startWithData = $data->props->pageProps->StartWithData;
                $startWith = $LoanStoresStartWithModel->reptile($startWithData);
                if ($startWith['success']) {
                    $successMsg[] = $startWith['msg'];
                } else {
                    $errorMsg[] = $startWith['errorMsg'];
                }
            }
        }
        return [
            'success' => $errorMsg ? 'false' : 'true',
            'successMsg' => $successMsg,
            'errorMsg' => $errorMsg,
        ];
    }

    /**
     * @page https://weloans.com/loan-stores-start-with-a/1
     * @return array
     */
    public function loanStoresStartWithSecondary(): array
    {
        $alphabetSecondaryList = (new \App\Models\LoanStoresStartWithModel)->selectRaw('id,initials_first_name,group_id')->get()->toArray();
//        $alphabetSecondaryList = (new \App\Models\LoanStoresStartWithModel)->where('id', '>', 1423)->selectRaw('id,initials_first_name,group_id')->get()->toArray();
        $curModel = new CurModel;
        $LoanStoresPageInfoModel = new LoanStoresPageInfoModel;
        $LoanStoresStartWithSecondaryModel = new LoanStoresStartWithSecondaryModel;
        $successMsg = $errorMsg = [];
        foreach ($alphabetSecondaryList as $item) {
            $url = 'https://weloans.com/loan-stores-start-with-' . $item['initials_first_name'] . '/' . $item['group_id'];

            $nodes = $curModel->getCrawler($url, '//script[contains(@id, "__NEXT_DATA__")]');
            foreach ($nodes as $value) {
                $data = json_decode($value->nodeValue);
                $pageUrl = '/' . $data->props->pageProps->pathUrl;
                $pageInfoData = $data->props->pageProps->pageInfo;
                $pageInfo = $LoanStoresPageInfoModel->reptile($pageUrl, $pageInfoData);
                if ($pageInfo['success']) {
                    $successMsg[] = $pageInfo['msg'];
                } else {
                    $errorMsg[] = $pageInfo['errorMsg'];
                }

                $codeDirectorySecondData = $data->props->pageProps->CodeDirectorySecondData;
                $startWith = $LoanStoresStartWithSecondaryModel->reptile($codeDirectorySecondData);
                if ($startWith['success']) {
                    $successMsg[] = $startWith['msg'];
                } else {
                    $errorMsg[] = $startWith['errorMsg'];
                }
            }
        }
        return [
            'success' => $errorMsg ? 'false' : 'true',
            'successMsg' => $successMsg,
            'errorMsg' => $errorMsg,
        ];
    }

    /**
     * @page https://weloans.com/store/a-1-acceptance-loan-b603129c
     * @return array
     */
    public function loanStoresDetail()
    {
        $secondaryList = (new \App\Models\LoanStoresStartWithSecondaryModel)->whereBetween('id', [24965, 60000])->selectRaw('lower_title')->get()->toArray();
//        $secondaryList = (new \App\Models\LoanStoresStartWithSecondaryModel)->where('id', 60)->selectRaw('lower_title')->get()->toArray();
        $curModel = new CurModel;
        $LoanStoresDetailModel = new LoanStoresDetailModel;
        $successMsg = $errorMsg = [];
        foreach ($secondaryList as $item) {
            $url = 'https://weloans.com/store/' . $item['lower_title'];
            $nodes = $curModel->getCrawler($url, '//script[contains(@id, "__NEXT_DATA__")]');
            foreach ($nodes as $value) {
                $data = json_decode($value->nodeValue);
                $result = $LoanStoresDetailModel->reptile($data);
                if ($result['success']) {
                    $successMsg[] = $result['msg'];
                } else {
                    $errorMsg[] = $result['errorMsg'];
                }
            }
        }
        return [
            'success' => $errorMsg ? 'false' : 'true',
            'successMsg' => $successMsg,
            'errorMsg' => $errorMsg,
        ];
    }

    /**
     * @page https://weloans.com/1st-heritage-credit-near-me
     * @return array
     */
    public function loanStoresBrandNearMe(): array
    {
//        $brandList = (new \App\Models\LoanStoresTypeByBrandModel)->where('id', '>', 156)->selectRaw('alias')->get()->toArray();
        $brandList = (new \App\Models\LoanStoresTypeByBrandModel)->selectRaw('alias')->get()->toArray();
        $curModel = new CurModel;
        $LoanStoresBrandNearMeModel = new LoanStoresBrandNearMeModel;
        $successMsg = $errorMsg = [];
        foreach ($brandList as $item) {
            $url = 'https://weloans.com/' . $item['alias'] . '-near-me';
            $nodes = $curModel->getCrawler($url, '//script[contains(@id, "__NEXT_DATA__")]');
            foreach ($nodes as $value) {
                $data = json_decode($value->nodeValue);
                $result = $LoanStoresBrandNearMeModel->reptile($data);
                if ($result['success']) {
                    $successMsg[] = $result['msg'];
                } else {
                    $errorMsg[] = $result['errorMsg'];
                }
            }
        }
        return [
            'success' => $errorMsg ? 'false' : 'true',
            'successMsg' => $successMsg,
            'errorMsg' => $errorMsg,
        ];
    }

    /**
     * @page https://weloans.com/ace-cash-express-near-me/tx
     * @return array
     */
    public function loanStoresBrandNearMeFound(): array
    {
        $brandList = (new \App\Models\LoanStoresBrandNearMeModel)->selectRaw('brand_path,state_brand_list')->get()->toArray();
        $curModel = new CurModel;
        $LoanStoresBrandNearMeFoundModel = new LoanStoresBrandNearMeFoundModel;
        $successMsg = $errorMsg = [];
        foreach ($brandList as $item) {
            $stateBrandList = json_decode($item['state_brand_list']);
            foreach ($stateBrandList as $value) {
                $url = 'https://weloans.com/' . $item['brand_path'] . '/' . mb_strtolower($value->short_name);
                $nodes = $curModel->getCrawler($url, '//script[contains(@id, "__NEXT_DATA__")]');
                foreach ($nodes as $v) {
                    $data = json_decode($v->nodeValue);
                    $result = $LoanStoresBrandNearMeFoundModel->reptile($data);
                    if ($result['success']) {
                        $successMsg[] = $result['msg'];
                    } else {
                        $errorMsg[] = $result['errorMsg'];
                    }
                }
            }
        }

        return [
            'success' => $errorMsg ? 'false' : 'true',
            'successMsg' => $successMsg,
            'errorMsg' => $errorMsg,
        ];
    }

    /**
     * @page https://weloans.com/ace-cash-express-near-me/tx/abilene
     * @return array
     */
    public function loanStoresBrandNearMeFoundPosition(): array
    {
        $foundList = (new \App\Models\LoanStoresBrandNearMeFoundModel())->where('id','>',1501)->selectRaw('query_brand_name,query_state,loan_brand_city_list')->get()->toArray();
        $curModel = new CurModel;
        $LoanStoresBrandNearMeFoundPositionModel = new LoanStoresBrandNearMeFoundPositionModel;
        $successMsg = $errorMsg = [];
        foreach ($foundList as $item) {
            $loanBrandCityList = json_decode($item['loan_brand_city_list']);
            foreach ($loanBrandCityList as $value) {
                $url = 'https://weloans.com/' . $item['query_brand_name'] . '/' . $item['query_state'] . '/' . $value->city_url;
                $nodes = $curModel->getCrawler($url, '//script[contains(@id, "__NEXT_DATA__")]');
                foreach ($nodes as $v) {
                    $data = json_decode($v->nodeValue);
                    $result = $LoanStoresBrandNearMeFoundPositionModel->reptile($data);
                    if ($result['success']) {
                        $successMsg[] = $result['msg'];
                    } else {
                        $errorMsg[] = $result['errorMsg'];
                    }
                }
            }
        }

        return [
            'success' => $errorMsg ? 'false' : 'true',
            'successMsg' => $successMsg,
            'errorMsg' => $errorMsg,
        ];
    }



}
