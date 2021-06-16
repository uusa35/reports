<?php

namespace App\Services\Search;

use App\Http\Resources\CategoryLightResource;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 2/7/17
 * Time: 8:40 AM
 */
class Filters extends QueryFilters
{
    public $category;

    public function __construct(Request $request, Category $category)
    {
        parent::__construct($request);
        $this->category = $category;
    }

    public function search($search)
    {
        return $this->builder
            ->where('id', 'like', "%{$search}%")
            ->orWhere('sku', 'like', "%{$search}%")
            ->orWhere('name_ar', 'like', "%{$search}%")
            ->orWhere('name_en', 'like', "%{$search}%")
            ->orWhere('description_ar', 'like', "%{$search}%")
            ->orWhere('description_en', 'like', "%{$search}%");
//            ->orWhere('notes_ar', 'like', "%{$search}%")
//            ->orWhere('notes_en', 'like', "%{$search}%");
    }

    public function slug($search)
    {
        return $this->builder
            ->where('slug_ar', 'like', "%{$search}%")
            ->orWhere('slug_en', 'like', "%{$search}%")
            ->orWhere('description_ar', 'like', "%{$search}%")
            ->orWhere('description_en', 'like', "%{$search}%");
//            ->orWhere('notes_ar', 'like', "%{$search}%")
//            ->orWhere('notes_en', 'like', "%{$search}%");
    }



    public function product_category_id()
    {
        if(request()->has('user_id')) {
            return $this->builder->whereHas('categories', function ($q) {
                return $q->where('id', request()->product_category_id);
            })->where('user_id', request()->user_id);
        } else {
            return $this->builder->whereHas('categories', function ($q) {
                return $q->where('id', request()->product_category_id);
            });
        }
    }

    public function service_category_id()
    {
        return $this->builder->whereHas('categories', function ($q) {
            return $q->where('id', request()->service_category_id);
        });
    }

    public function classified_category_id()
    {
        $category = $this->category->whereId(request()->classified_category_id)->with('children')->first();
        if ($category->children->isEmpty()) {
            return $this->builder->where('category_id', request()->classified_category_id);
        } else {
            $ids = $category->children->pluck('id')->merge($category->id)->toArray();
            return $this->builder->whereIn('category_id', $ids);
        }
//        return $this->builder->whereHas('categories', function ($q) {
//            return $q->where('category_id',request()->classified_category_id);
//        })->orWhere('category_id', request()->classified_category_id);
        return $this->builder->where('category_id', request()->classified_category_id);
    }

    public function user_category_id()
    {
//        return $this->builder->where('category_id', request()->user_category_id);
        return $this->builder->whereHas('categories', function ($q) {
            return $q->whereIn('category_id', is_array(request()->user_category_id) ? request()->user_category_id : [request()->user_category_id]);
        });
    }

    public function categories()
    {
        return $this->builder->whereHas('categories', function ($q) {
            return $q->whereIn('category_id', request()->categories);
        });
    }

    public function users()
    {
        return $this->builder->whereIn('user_id', request()->users);
    }

    public function user_id()
    {
        return $this->builder->where(['user_id' => request()->user_id]);
    }

    public function tag_id()
    {
        return $this->builder->whereHas('tags', function ($q) {
            return $q->where('tag_id', request()->tag_id);
        });
    }

    public function color_id()
    {
        if ($this->builder->has('product_attributes')) {
            return $this->builder->whereHas('product_attributes', function ($q) {
                return $q->where('color_id', request()->color_id);
            });
        }
    }

    public function size_id()
    {
        if ($this->builder->has('product_attributes')) {
            return $this->builder->whereHas('product_attributes', function ($q) {
                return $q->where('size_id', request()->size_id);
            });
        }
    }

    public function on_sale()
    {
        return $this->builder->where('on_sale', true)->whereDate('end_sale', '>', Carbon::now());
    }

    public function hot_deal()
    {
        return $this->builder->where('is_hot_deal', true)->whereDate('end_sale', '>', Carbon::now());
    }

    public function on_home()
    {
        return $this->builder->where('on_home', true);
    }

    public function on_new()
    {
        return $this->builder->where('on_new', true);
    }

    public function min()
    {
        return $this->builder->where('price', '>=' ,(double)request()->min);
    }


    public function page()
    {
        return $this->builder;
    }

    public function brand_id()
    {
        return $this->builder->where(['brand_id' => request('brand_id')]);
    }

    public function sort()
    {
        switch (request('sort')) {
            case 'name' :
                return $this->builder->orderBy('name_' . app()->getLocale(), 'asc');
            default :
                return $this->builder->orderBy('price', request('sort'));
        }
    }

    public function area_id()
    {
        // List of users that servie area_id
        return $this->builder->whereHas('areas', function ($q) {
            return $q->where(['area_id' => request('area_id')]);
        });
    }

    public function day_selected()
    {
        if ($this->builder->has('timings')) {
            return $this->builder->whereHas('timings', function ($q) {
                return $q->where(['day_no' => request('day_selected')]);
            });
        }

    }

    public function date_range() {
//        return $this->builder->whereDate('start_date', '>=', Carbon::today())->whereDate('end_date','>=', Carbon::parse(request('date_range')));
        return $this->builder->whereDate('end_date','>=', Carbon::parse(request('date_range')));
    }

    public function exact_date() {
        return $this->builder->whereDate('start_date','>=', Carbon::parse(request('exact_date')));
    }

    public function timing_value()
    {
        return $this->builder->whereHas('timings', function ($q) {
            return $q->whereDate('start', '>=', Carbon::parse(request('timing_id'))->format('h:i a'));
        });
    }

    public function timing_id()
    {
        if ($this->builder->has('timings')) {
            return $this->builder->whereHas('timings', function ($q) {
                return $q->whereId(request()->timing_id);
            });
        }
    }

    public function day_selected_format()
    {
        return $this->builder;
    }

    public function country_id()
    {
        if(env('EXPO')) {
            return $this->builder->whereHas('user', function ($q) {
                return $q->where(['country_id' => request('country_id')]);
            });
        }
        return $this->builder;
    }

    public function save()
    {
        if (request()->has('save') && request()->save) {
            session()->put('day_selected_format', request()->day_selected_format);
            session()->put('day_selected', request()->day_selected);
            session()->put('area_id', request()->area_id);
        }
        return $this->builder;
    }

    public function designer_id()
    {
        $productIds = User::whereId(request('designer_id'))->first()->collections()->with(['products' => function ($q) {
            return $q->active()->hasStock()->hasImage();
        }])->get()->pluck('products')->flatten()->unique('id')->pluck('id')->toArray();
        return $this->builder->whereIn('id', $productIds);
    }

    public function collection_id()
    {
        if (request()->has('collection_id')) {
            $element = Collection::whereId(request('collection_id'))->with('products')->first();
            $productIds = $element->products->pluck('id');
            return $this->builder->whereIn('id', $productIds);
        }
    }


    public function is_designer()
    {
        return $this->builder->whereHas('role', function ($q) {
            return $q->where('is_designer', request()->is_designer);
        });
    }

    public function is_company()
    {
        return $this->builder->whereHas('role', function ($q) {
            return $q->where('is_company', request()->is_company);
        });
    }

    public function is_celebrity()
    {
        return $this->builder->whereHas('role', function ($q) {
            return $q->where('is_celebrity', request()->is_celebrity);
        });
    }


    public function props()
    {
        foreach (request()->props as $key => $prop) {
            $prop = json_decode($prop, true);
            return $builder = $this->builder->whereHas('items', function ($q) use ($prop) {
                return $q->where(['property_id' => $prop['property_id'], 'category_group_id' => $prop['category_group_id'], 'value' => $prop['value']]);
            });
        }
    }
}
