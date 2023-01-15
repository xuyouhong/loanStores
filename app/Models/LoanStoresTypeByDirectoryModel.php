<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStoresTypeByDirectoryModel extends Model
{
    protected $table = "loan_store_type_directory";
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
            return ['success' => false, 'msg' => 'Crawler Loan Stores by directory is failed.', 'errorMsg' => $msg];
        } else {
            return ['success' => true, 'msg' => 'Crawler Loan Stores by directory is completed.'];
        }
    }
}
