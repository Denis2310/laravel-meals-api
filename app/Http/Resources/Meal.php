<?php

namespace App\Http\Resources;

use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Ingredient as IngredientResource;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Meal extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'category' => $this->when($this->checkKey($request->with, 'category'),
                new CategoryResource($this->category)),
            'ingredients' => $this->when($this->checkKey($request->with, 'ingredients'),
                IngredientResource::collection($this->ingredients)),
            'tags' => $this->when($this->checkKey($request->with, 'tags'),
                TagResource::collection($this->tags)),
        ];
    }

    /**
     * Check if category, tags or ingredients exists in with key
     *
     * @param  String $with [With string from request]
     * @param  String $item Search string
     * @return Boolean  True if string exists, otherwise false
     */
    protected function checkKey($with, $item)
    {
        if ($with == null) {
            return false;
        }

        $arr = explode(',', $with);
        $arr = array_map('trim', $arr);
        $arr = array_map('strtolower', $arr);

        if (in_array($item, $arr)) {
            return true;
        }

        return false;
    }
}
