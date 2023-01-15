<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresStartWithSecondaryModel extends Model
{
    protected $table = "loan_stores_start_with_secondary";
    protected $fillable = ['id', 'group_id', 'initials_first_name', 'title', 'lower_title'];

    public function reptile($data): array
    {
        $msg = '';
        foreach ($data as $item) {
            $param = [
                'group_id' => trim($item->group_id),
                'initials_first_name' => trim($item->initials_first_name),
                'title' => trim($item->title),
                'lower_title' => trim($item->lower_title)
            ];
            try {
                self::firstOrCreate($param);
            } catch (\Exception $e) {
                $msg .= $e->getMessage() . PHP_EOL;
            }
        }

        if (!empty($msg)) {
            return ['success' => false, 'msg' => 'Crawler Loan Stores Start with code directory second data is failed.', 'errorMsg' => $msg];
        } else {
            return ['success' => true, 'msg' => 'Crawler Loan Stores Start with code directory second data is completed.'];
        }
    }

    public function show(string $alphabet, int $groupId): array
    {
        $list = self::where([['initials_first_name', $alphabet], ['group_id', $groupId]])->selectRaw('title,lower_title src')->get()->toArray();
        foreach ($list as $key => $value) {
            $list[$key]['src'] = '/store/' . $value['src'];
        }

        // get page info
        $pageUrl = '/loan-stores-start-with-' . $alphabet . '/' . $groupId;
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
