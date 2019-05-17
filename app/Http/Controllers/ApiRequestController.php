<?php

namespace App\Http\Controllers;

use App\Classes\Filter;
use App\Http\Requests\ApiRequest;
use App\Http\Resources\MealCollection;

class ApiRequestController extends Controller
{
    /**
     * Method for creating Resource Collection from Api request
     *
     * @param ApiRequest $request Request object
     * @return Resource Collection
     */
    public function index(ApiRequest $request)
    {
        return new MealCollection(Filter::apply($request));
    }
}
