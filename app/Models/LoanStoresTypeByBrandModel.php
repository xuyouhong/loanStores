<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresTypeByBrandModel extends Model
{
    protected $table = "loan_store_type_brand";
    protected $fillable = ['id', '_id', 'title', 'alias', 'pic', 'services', 'rating', 'enable', 'reviews', 'type'];

    public function reptile($data): array
    {
        $msg = '';
        foreach ($data as $item) {
            $st = strripos(trim($item->pic), '/');
            $ed = strripos(trim($item->pic), '.');
            $param = [
                '_id' => trim($item->_id),
                'title' => trim($item->title),
                'alias' => substr(trim($item->pic), $st + 1, ($ed - $st) - 1),  // Inaccurate, pending correction
//                'alias' => substr(trim($item->pic),strripos(trim($item->pic),'/')+1,strripos(trim($item->pic),'.')-1),
                'pic' => trim($item->pic),
                'services' => implode(',', $item->services),
                'rating' => trim($item->rating),
                'enable' => trim($item->enable),
                'reviews' => trim($item->reviews),
                'type' => trim($item->type)
            ];

            try {
                self::firstOrCreate($param);
            } catch (\Exception $e) {
                $msg .= $e->getMessage() . PHP_EOL;
            }
        }

        if (!empty($msg)) {
            return ['success' => false, 'msg' => 'Crawler Loan Stores by alphabet is failed.', 'errorMsg' => $msg];
        } else {
            return ['success' => true, 'msg' => 'Crawler Loan Stores by alphabet is completed.'];
        }
    }
}
