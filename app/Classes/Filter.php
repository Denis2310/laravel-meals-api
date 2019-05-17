<?php
namespace App\Classes;

use App\Meal;
use Illuminate\Http\Request;

class Filter
{
    /**
     * Function for filtering api response
     *
     * @param  ApiRequest $request Api Request sent from user
     * @return Json Array $response Json response of requested meals
     */
    public static function apply($request)
    {
        //Set application language
        if ($request->lang) {
            app()->setlocale($request->lang);
        }

        //Create new database query
        $response = (new Meal)->newQuery();

        //Filter meals by diff_time
        if ($request->filled('diff_time')) {
            $fromDate = diff_to_date($request->diff_time);

            $response = $response->withTrashed()->where([
                ['created_at', '>=', $fromDate],
                ['updated_at', '>=', $fromDate],
            ])->where(function ($query) use ($fromDate) {
                $query->whereNull('deleted_at')
                    ->orwhere('deleted_at', '>=', $fromDate);
            });
        }

        //Filter meals by categories: NULL, !NULL, category_id
        if ($request->filled('category')) {
            $category = trim(strtolower($request->category));

            if ($category == 'null') {
                $response = $response->whereNull('category_id');
            } else if ($category == '!null') {
                $response = $response->whereNotNull('category_id');
            } else {
                $response = $response->whereCategoryId($category);
            }
        }

        //Filter meals by tags: 1,2,3...
        if ($request->filled('tags')) {
            $tag_ids = explode(',', $request->tags);
            $tag_ids = array_map('trim', $tag_ids);

            foreach ($tag_ids as $id) {
                $response->whereHas('tags', function ($query) use ($id) {
                    $query->where('tag_id', $id);
                });
            }
        }

        //Return paginated response
        $paginatedResponse = $response->paginate($request->per_page, ['*'], 'page', $request->page);
        return $paginatedResponse->appends($request->except('page'));
    }
}

/**
 * Convert integer to date
 *
 * @param  Integer $diff_time Integer for converting to date
 * @return String formated date
 */
function diff_to_date($diff_time)
{
    $diff_time = trim($diff_time);

    return date('Y-m-d H:i:s', $diff_time);
}
