<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreDirectoryModel extends Model
{
    /**
     * @notes get Loan Store Directory data
     * @return array
     */
    public function show(): array
    {
        // Find Loan Stores by Type
        $alphabetList = (new \App\Models\LoanStoresTypeByAlphabetModel)->selectRaw('type_name,mb_type_name')->get()->toArray();
        foreach ($alphabetList as $key => $value) {
            $alphabetList[$key]['src'] = '/loan-stores-start-with-' . $value['mb_type_name'];
            unset($alphabetList[$key]['mb_type_name']);
        }

        // Find Loan Stores by Brand
        $brandList = (new \App\Models\LoanStoresTypeByBrandModel)->selectRaw('title,alias,type')->get()->toArray();
        $brandGroupList = ['Payday_Loans' => [], 'Installment_Loans' => [], 'Personal_Loans' => [], 'Title_Loans' => []];
        foreach ($brandList as $item) {
            $unit = [
                'title' => $item['title'],
                'src' => '/' . $item['alias'] . '-near-me'
            ];
            switch ($item['type']) {
                case 'payday loans':
                    $brandGroupList['Payday_Loans'][] = $unit;
                    break;
                case 'installment loans':
                    $brandGroupList['Installment_Loans'][] = $unit;
                    break;
                case 'loans':
                    $brandGroupList['Personal_Loans'][] = $unit;
                    break;
                case 'title loans':
                    $brandGroupList['Title_Loans'][] = $unit;
                    break;
            }
        }

        // Find Loan Stores by Name
        $directoryList = (new \App\Models\LoanStoresTypeByDirectoryModel)->selectRaw('group_id,title_start,title_end')->get()->toArray();
        foreach ($directoryList as $key => $value) {
            $directoryList[$key]['title'] = $value['title_start'] . ' - ' . $value['title_end'];
            unset($directoryList[$key]['title_start'], $directoryList[$key]['title_end']);
        }

        // Find Loan Stores by State
        $stateList = (new \App\Models\LoanStoresTypeByStateModel)->selectRaw('name,alias')->get()->toArray();

        // get page info
        $pageInfo = (new \App\Models\LoanStoresPageInfoModel)->where('page_url', '/store-directory')->selectRaw('page_info')->first()->toArray();

        //Returns:array
        return [
            'page' => '/store-directory',
            'pageProps' => [
                'alphabetData' => $alphabetList,
                'brandData' => $brandGroupList,
                'nameData' => $directoryList,
                'stateData' => $stateList
            ],
            'pageInfo' => json_decode($pageInfo['page_info'])
        ];
    }
}
