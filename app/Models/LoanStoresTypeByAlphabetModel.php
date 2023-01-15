<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresTypeByAlphabetModel extends Model
{
    protected $table = "loan_store_type_alphabet";
    protected $fillable = ['id', 'type_name', 'mb_type_name'];

    public function reptile($data): array
    {
        $msg = '';
        foreach ($data as $item) {
            try {
                self::firstOrCreate($item);
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

    public function show($condition = [], $order = 'id ASC')
    {
        return $this->where($condition)->orderByRaw($order)->get()->toArray();
    }
}
