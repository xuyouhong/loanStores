<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiDataController extends Controller
{
    /**
     * @notes get data from Loan Store Directory
     * @page https://weloans.com/store-directory
     * @return JsonResponse
     */
    public function getStoreDirectory(): JsonResponse
    {
        $response = (new \App\Models\StoreDirectoryModel)->show();
        return response()->json($response);
    }

    /**
     * @notes get data from Loan Stores Start with
     * @page https://weloans.com/loan-stores-start-with-a
     * @param string $alphabet
     * @return JsonResponse
     */
    public function getLoanStoresStartWith(string $alphabet): JsonResponse
    {
        $response = (new \App\Models\LoanStoresStartWithModel)->show($alphabet);
        return response()->json($response);
    }

    /**
     * @notes get data from Loan Stores Start with secondary
     * @page https://weloans.com/loan-stores-start-with-a/1
     * @param $alphabet
     * @param $groupId
     * @return JsonResponse
     */
    public function getLoanStoresStartWithSecondary($alphabet, $groupId): JsonResponse
    {
        $response = (new \App\Models\LoanStoresStartWithSecondaryModel)->show($alphabet, $groupId);
        return response()->json($response);
    }

    /**
     * @notes get data from Loan Stores Detail
     * @page https://weloans.com/store/a-1-acceptance-loan-b603129c
     * @param $lowerTitle
     * @return JsonResponse
     */
    public function getLoanStoresDetail($lowerTitle): JsonResponse
    {
        $response = (new \App\Models\LoanStoresDetailModel)->show($lowerTitle);
        return response()->json($response);
    }

    /**
     * @notes get data from Loan Stores Brand Near Me
     * @page https://weloans.com/ace-cash-express-near-me
     * @param $brandAlias
     * @return JsonResponse
     */
    public function getLoanStoresBrandNearMe($brandAlias): JsonResponse
    {
        $response = (new \App\Models\LoanStoresBrandNearMeModel)->show($brandAlias);
        return response()->json($response);
    }

    /**
     * @notes get data from Loan Stores Brand Near Me
     * @page https://weloans.com/ace-cash-express-near-me/tx
     * @param $brandAlias
     * @param $shortName
     * @return JsonResponse
     */
    public function getLoanStoresBrandNearMeFound($brandAlias, $shortName): JsonResponse
    {
        $response = (new \App\Models\LoanStoresBrandNearMeFoundModel)->show($brandAlias, $shortName);
        return response()->json($response);
    }

    /**
     * @notes get data from Loan Stores Brand Near Me
     * @page https://weloans.com/ace-cash-express-near-me/tx/abilene
     * @param $brandAlias
     * @param $shortName
     * @param $city
     * @return JsonResponse
     */
    public function getLoanStoresBrandNearMePosition($brandAlias, $shortName, $city): JsonResponse
    {
        $response = (new \App\Models\LoanStoresBrandNearMeFoundPositionModel)->show($brandAlias, $shortName, $city);
        return response()->json($response);
    }
}
