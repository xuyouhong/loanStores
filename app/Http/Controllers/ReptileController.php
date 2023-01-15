<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReptileController extends Controller
{
    /**
     * Reptile a page of the resource.
     * @page https://weloans.com/store-directory
     * @return JsonResponse
     */
    public function reptileStoreDirectory(): JsonResponse
    {
        $res = (new \App\Models\ReptileModel)->storeDirectory();
        return response()->json($res);
    }

    /**
     * Reptile a page of the resource.
     * @page https://weloans.com/loan-stores-start-with-a
     * @return JsonResponse
     */
    public function reptileLoanStoresStartWith(): JsonResponse
    {
        set_time_limit(0);
        $res = (new \App\Models\ReptileModel)->loanStoresStartWith();
        return response()->json($res);
    }

    /**
     * Reptile a page of the resource.
     * @page https://weloans.com/loan-stores-start-with-a/1
     * @return JsonResponse
     */
    public function reptileLoanStoresStartWithSecondary(): JsonResponse
    {
        set_time_limit(0);
        $res = (new \App\Models\ReptileModel)->loanStoresStartWithSecondary();
        return response()->json($res);
    }

    /**
     * Reptile a page of the resource.
     * @page https://weloans.com/store/a-1-acceptance-loan-b603129c
     * @return JsonResponse
     */
    public function reptileLoanStoresDetail(): JsonResponse
    {
        set_time_limit(0);
        $res = (new \App\Models\ReptileModel)->loanStoresDetail();
        return response()->json($res);
    }

    /**
     * Reptile a page of the resource.
     * @page https://weloans.com/1st-heritage-credit-near-me
     * @return JsonResponse
     */
    public function reptileLoanStoresBrandNearMe(): JsonResponse
    {
        set_time_limit(0);
        $res = (new \App\Models\ReptileModel)->loanStoresBrandNearMe();
        return response()->json($res);
    }

    /**
     * Reptile a page of the resource.
     * @page https://weloans.com/ace-cash-express-near-me/tx
     * @return JsonResponse
     */
    public function reptileLoanStoresBrandNearMeFound(): JsonResponse
    {
        set_time_limit(0);
        $res = (new \App\Models\ReptileModel)->loanStoresBrandNearMeFound();
        return response()->json($res);
    }

    /**
     * Reptile a page of the resource.
     * @page https://weloans.com/ace-cash-express-near-me/tx/abilene
     * @return JsonResponse
     */
    public function reptileLoanStoresBrandNearMeFoundPosition(): JsonResponse
    {
        set_time_limit(0);
        $res = (new \App\Models\ReptileModel)->loanStoresBrandNearMeFoundPosition();
        return response()->json($res);
    }


}
