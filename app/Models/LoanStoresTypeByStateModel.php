<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresTypeByStateModel extends Model
{
    protected $table = "loan_store_type_state";
    protected $fillable = ['id', 'name', 'alias'];

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
            return ['success' => false, 'msg' => 'Crawler Loan Stores by state is failed.', 'errorMsg' => $msg];
        } else {
            return ['success' => true, 'msg' => 'Crawler Loan Stores by state is completed.'];
        }
    }
}
