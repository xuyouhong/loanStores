<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresStartWithModel extends Model
{
    protected $table = "loan_stores_start_with";
    protected $fillable = ['id', 'group_id', 'initials_first_name', 'title_start', 'title_end'];

    public function reptile($data): array
    {
        $msg = '';
        foreach ($data as $item) {
            $param = [
                'group_id' => trim($item->group_id),
                'initials_first_name' => trim($item->initials_first_name),
                'title_start' => trim($item->title_start),
                'title_end' => trim($item->title_end)
            ];
            try {
                self::firstOrCreate($param);
            } catch (\Exception $e) {
                $msg .= $e->getMessage() . PHP_EOL;
            }
        }

        if (!empty($msg)) {
            return ['success' => false, 'msg' => 'Crawler Loan Stores Start with is failed.', 'errorMsg' => $msg];
        } else {
            return ['success' => true, 'msg' => 'Crawler Loan Stores Start with is completed.'];
        }
    }

    public function show(string $alphabet): array
    {
        $alphabetList = self::where('initials_first_name', $alphabet)->selectRaw('initials_first_name,title_start,title_end,group_id')->get()->toArray();
        $pageUrl = '/loan-stores-start-with-' . $alphabet;

        $list = [];
        foreach ($alphabetList as $key => $value) {
            $list[$key]['title'] = $value['title_start'] . ' - ' . $value['title_end'];
            $list[$key]['src'] = $pageUrl . '/' . $value['group_id'];
        }

        // get page info
        $pageInfo = (new \App\Models\LoanStoresPageInfoModel)->where('page_url', $pageUrl)->selectRaw('page_info')->first()->toArray();

        return [
            'page' => $pageUrl,
            'pageProps' => [
                'listData' => $list,
            ],
            'pageInfo' => json_decode($pageInfo['page_info'])
        ];
    }
}
