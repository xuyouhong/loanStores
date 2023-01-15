<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresPageInfoModel extends Model
{
    protected $table = "loan_store_page_info";
    protected $fillable = ['id', 'page_url', 'page_info'];

    public function reptile(string $pageUrl, $data): array
    {
        $msg = '';
        $param = [
            'page_url' => $pageUrl,
            'page_info' => json_encode($data),
        ];
        try {
            self::firstOrCreate($param);
        } catch (\Exception $e) {
            $msg .= $e->getMessage() . PHP_EOL;
        }
        if (!empty($msg)) {
            return ['success' => false, 'msg' => $pageUrl . ' Crawler page info is failed.', 'errorMsg' => $msg];
        } else {
            return ['success' => true, 'msg' => $pageUrl . ' Crawler page info is completed.'];
        }
    }
}
