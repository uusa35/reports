<?php

namespace App\Services\Traits;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Commercial;
use App\Models\OrderMeta;
use App\Models\Page;
use App\Models\Slide;
use App\Models\User;

trait HomePageTrait
{

    public function getMobileLayout()
    {
        $pages = Page::where(['on_menu_mobile' => true, 'on_footer' => true, 'active' => true])->get();
        return view('frontend.wokiee.four.home.mobile', compact('pages'));
    }

    public function getMallrHome()
    {
        $sliders = Slide::active()->onHome()->limit(SELF::TAKE_LESS)->get();
        $brands = Brand::active()->onHome()->orderBy('order', 'asc')->take(10)->get();
        $newProducts = $this->product->active()->available()->onHome()->onNew()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'favorites')->orderBy('created_at', 'desc')->limit(self::TAKE_LESS)->get();
        $onSaleProducts = $this->product->active()->available()->onSaleOnHome()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $bestSalesProducts = $this->product->whereIn('id', $this->product->active()->available()->hasImage()->serveCountries()->hasStock()->bestSalesProducts())->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user', 'favorites', 'user.country')->limit(self::TAKE_LESS)->get();;
        $productHotDeals = $this->product->active()->available()->onSale()->hotDeals()->hasImage()->serveCountries()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $bestSaleCollections = OrderMeta::bestSaleCollections();
        $designers = User::active()->onHome()->designers()->whereHas('collections', function ($q) {
            return $q->whereHas('products', function ($q) {
                return $q->active();
            }, '>', 0);
        }, '>', 0)->with('role')->with(['surveys' => function ($q) {
            return $q->where('is_order', true)->active();
        }])->notAdmins()->hasProducts()->get();
        $companies = User::active()->onHome()->companies()->notAdmins()->hasProducts()->whereHas('products', function ($q) {
            return $q->active();
        }, '>', 0)->with('role')->get();
        $categoriesHome = Category::active()->onHome()->isFeatured()->orderBy('order', 'desc')->limit(4)->get();
        $topDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $bottomDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $tripleCommercials = Commercial::active()->triple()->orderBy('order', 'desc')->limit(3)->get();
        return view('frontend.wokiee.four.home.mallr', compact(
            'sliders',
            'brands',
            'newProducts',
            'onSaleProducts',
            'bestSalesProducts',
            'productHotDeals',
            'categoriesHome',
            'topDoubleCommercials',
            'bottomDoubleCommercials',
            'tripleCommercials',
            'bestSaleCollections',
            'designers',
            'companies'
        ));
    }

    public function getEventKmHome()
    {
        $sliders = Slide::active()->onHome()->limit(6)->get();
        $newProducts = $this->product->active()->available()->onHome()->onNew()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'user', 'favorites')->orderBy('created_at', 'desc')->limit(self::TAKE_LESS)->get();
        $newServices = $this->service->serveCountries()->active()->available()->onHome()->onNew()->hasImage()->hasValidTimings()->hasAtLeastOneCategory()->with('images', 'user.country')->orderby('created_at', 'desc')->limit(self::TAKE_LESS)->get();
        $onSaleServices = $this->service->serveCountries()->active()->available()->onSaleOnHome()->hasValidTimings()->hasAtLeastOneCategory()->with('images', 'user.country')->orderby('created_at', 'desc')->limit(self::TAKE_LESS)->get();
        $serviceHotDeals = $this->service->active()->available()->onSale()->onHome()->hotDeals()->hasImage()->serveCountries()->hasValidTimings()->hasAtLeastOneCategory()->with('images', 'user.country')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $categoriesHome = Category::active()->onHome()->isFeatured()->orderBy('order', 'desc')->limit(4)->get();
        $topDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $bottomDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $tripleCommercials = Commercial::active()->triple()->orderBy('order', 'desc')->limit(3)->get();
        return view('frontend.wokiee.four.home.eventkm', compact(
            'sliders',
            'newServices',
            'onSaleServices',
            'serviceHotDeals',
            'newProducts',
            'categoriesHome',
            'topDoubleCommercials',
            'bottomDoubleCommercials',
            'tripleCommercials'
        ));
    }

    public function getDailyHome()
    {
        $sliders = Slide::active()->onHome()->limit(SElf::TAKE_LEAST)->get();
        $newProducts = $this->product->active()->available()->onHome()->onNew()->hasImage()->serveCountries()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'user', 'favorites')->orderBy('created_at', 'desc')->limit(self::TAKE_LESS)->get();
        $onSaleProducts = $this->product->active()->available()->onSaleOnHome()->hasImage()->serveCountries()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $bestSalesProducts = $this->product->whereIn('id', $this->product->active()->available()->hasImage()->serveCountries()->bestSalesProducts())->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'favorites', 'user.country')->limit(self::TAKE_LESS)->get();;
        $productHotDeals = $this->product->active()->available()->onSale()->hotDeals()->hasImage()->serveCountries()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $categoriesHome = Category::active()->onHome()->isFeatured()->orderBy('order', 'desc')->limit(4)->get();
        $topDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $bottomDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $tripleCommercials = Commercial::active()->triple()->orderBy('order', 'desc')->limit(3)->get();
        return view('frontend.wokiee.four.home.daily', compact(
            'sliders',
            'newProducts',
            'onSaleProducts',
            'bestSalesProducts',
            'productHotDeals',
            'categoriesHome',
            'topDoubleCommercials',
            'bottomDoubleCommercials',
            'tripleCommercials'
        ));
    }

    public function getDesigneratHome()
    {
        $sliders = Slide::active()->onHome()->limit(SElf::TAKE_LEAST)->get();
        $designers = User::active()->onHome()->designers()->whereHas('products', function ($q) {
            return $q->active();
        }, '>', 0)->with('role')->notAdmins()->hasProducts()->get();
        $elites = User::active()->onHome()->companies()->notAdmins()->hasProducts()->whereHas('products', function ($q) {
            return $q->active();
        }, '>', 0)->with('role')->get();
        $celebrities = User::active()->onHome()->celebrities()->notAdmins()->hasProducts()->whereHas('products', function ($q) {
            return $q->active();
        }, '>', 0)->with('role')->get();
        return view('frontend.wokiee.four.home.designerat', compact(
            'sliders',
            'designers',
            'elites',
            'celebrities'
        ));
    }

    public function getEscrapHome()
    {
//        $sliders = Slide::active()->onHome()->limit(SElf::TAKE_TINY)->get();
        $subCategories = Category::active()->onHome()->onlyForUsers()->onlyChildren()->orderBy('order', 'desc')->limit(SELF::TAKE_LESS)->get();
        $categoriesHome = Category::active()->onHome()->onlyForUsers()->onlyParent()->orderBy('order', 'desc')->limit(SELF::TAKE_TINY)->get();
        return view('frontend.wokiee.four.home.escrap', compact(
//            'sliders',
            'subCategories',
            'categoriesHome'
        ));
    }

    public function getNashKwHome()
    {
        $sliders = Slide::active()->onHome()->limit(SELF::TAKE_LESS)->get();
        $brands = Brand::active()->onHome()->orderBy('order', 'asc')->take(10)->get();
        $newProducts = $this->product->active()->available()->onHome()->onNew()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'favorites')->orderBy('created_at', 'desc')->limit(self::TAKE_LESS)->get();
        $onSaleProducts = $this->product->active()->available()->onSaleOnHome()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $bestSalesProducts = $this->product->whereIn('id', $this->product->active()->available()->hasImage()->serveCountries()->hasStock()->bestSalesProducts())->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user', 'favorites', 'user.country')->limit(self::TAKE_LESS)->get();;
        $productHotDeals = $this->product->active()->available()->onSale()->hotDeals()->hasImage()->serveCountries()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $bestSaleCollections = OrderMeta::bestSaleCollections();
        $designers = User::active()->onHome()->designers()->whereHas('collections', function ($q) {
            return $q->whereHas('products', function ($q) {
                return $q->active();
            }, '>', 0);
        }, '>', 0)->with('role')->with(['surveys' => function ($q) {
            return $q->where('is_order', true)->active();
        }])->notAdmins()->hasProducts()->get();
        $companies = User::active()->onHome()->companies()->notAdmins()->hasProducts()->whereHas('products', function ($q) {
            return $q->active();
        }, '>', 0)->with('role')->get();
        $categoriesHome = Category::active()->onHome()->isFeatured()->orderBy('order', 'desc')->limit(4)->get();
        $topDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $bottomDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $tripleCommercials = Commercial::active()->triple()->orderBy('order', 'desc')->limit(3)->get();
        return view('frontend.wokiee.four.home.nashkw', compact(
            'brands',
            'sliders',
            'newProducts',
            'onSaleProducts',
            'bestSalesProducts',
            'productHotDeals',
            'categoriesHome',
            'topDoubleCommercials',
            'bottomDoubleCommercials',
            'tripleCommercials',
            'bestSaleCollections',
            'designers',
            'companies'
        ));
    }

    public function getEmakeupHome()
    {
        $sliders = Slide::active()->onHome()->limit(SELF::TAKE_LESS)->get();
        $brands = Brand::active()->onHome()->orderBy('order', 'asc')->take(10)->get();
        $newProducts = $this->product->active()->available()->onHome()->onNew()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'favorites')->orderBy('created_at', 'desc')->limit(self::TAKE_LESS)->get();
        $onSaleProducts = $this->product->active()->available()->onSaleOnHome()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $bestSalesProducts = $this->product->whereIn('id', $this->product->active()->available()->hasImage()->serveCountries()->hasStock()->bestSalesProducts())->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user', 'favorites', 'user.country')->limit(self::TAKE_LESS)->get();;
        $productHotDeals = $this->product->active()->available()->onSale()->hotDeals()->hasImage()->serveCountries()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $bestSaleCollections = OrderMeta::bestSaleCollections();
        $designers = User::active()->onHome()->designers()->whereHas('collections', function ($q) {
            return $q->whereHas('products', function ($q) {
                return $q->active();
            }, '>', 0);
        }, '>', 0)->with('role')->with(['surveys' => function ($q) {
            return $q->where('is_order', true)->active();
        }])->notAdmins()->hasProducts()->get();
        $companies = User::active()->onHome()->companies()->notAdmins()->hasProducts()->whereHas('products', function ($q) {
            return $q->active();
        }, '>', 0)->with('role')->get();
        $categoriesHome = Category::active()->onHome()->isFeatured()->orderBy('order', 'desc')->limit(4)->get();
        $topDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $bottomDoubleCommercials = Commercial::active()->double()->orderBy('order', 'desc')->limit(2)->get();
        $tripleCommercials = Commercial::active()->triple()->orderBy('order', 'desc')->limit(3)->get();
        return view('frontend.wokiee.four.home.nashkw', compact(
            'brands',
            'sliders',
            'newProducts',
            'onSaleProducts',
            'bestSalesProducts',
            'productHotDeals',
            'categoriesHome',
            'topDoubleCommercials',
            'bottomDoubleCommercials',
            'tripleCommercials',
            'bestSaleCollections',
            'designers',
            'companies'
        ));
    }

    public function getHomekeyHome()
    {
        $sliders = Slide::active()->onHome()->limit(SELF::TAKE_LESS)->get();
        $companies = User::active()->onHome()->companies()->notAdmins()->whereHas('products', function ($q) {
            return $q->active();
        }, '>', 0)->with('role')->get();
        $categoriesHome = Category::active()->onHome()->onlyChildren()->orderBy('order', 'desc')->limit(10)->get();
        return view('frontend.wokiee.four.home.homekey', compact(
            'sliders',
            'categoriesHome',
            'companies'
        ));
    }

    public function getIstoresHome()
    {
        $sliders = Slide::active()->onHome()->limit(SELF::TAKE_LESS)->get();
        $brands = Brand::active()->onHome()->orderBy('order', 'asc')->take(10)->get();
        $newProducts = $this->product->active()->available()->onHome()->onNew()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'favorites')->orderBy('created_at', 'desc')->limit(self::TAKE_LESS)->get();
        $onSaleProducts = $this->product->active()->available()->onSaleOnHome()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $bestSalesProducts = $this->product->whereIn('id', $this->product->active()->available()->hasImage()->serveCountries()->hasStock()->bestSalesProducts())->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user', 'favorites', 'user.country')->limit(self::TAKE_LESS)->get();;
        $productHotDeals = $this->product->active()->available()->onSale()->hotDeals()->hasImage()->serveCountries()->hasAtLeastOneCategory()->with('brand', 'product_attributes.color', 'product_attributes.size', 'color', 'size', 'images', 'user.country', 'user', 'favorites')->orderby('end_sale', 'desc')->limit(self::TAKE_LESS)->get();
        $bestSaleCollections = OrderMeta::bestSaleCollections();
        $designers = User::active()->onHome()->designers()->with('role')->notAdmins()->hasProducts()->get();
        $companies = User::active()->onHome()->companies()->notAdmins()->hasProducts()->hasProducts()->with('role')->get();
        $homeCategoriesUser = Category::where(['is_user' => true ])->active()->onlyParent()->onHome()->isFeatured()->with(['children' => function ($q) {
            return $q->where(['is_user' => true ])->active()->with(['children' => function ($q) {
                return $q->where(['is_user' => true ])->active();
            }]);
        }])->orderBy('order', 'desc')->get();
        $homeCategoriesProduct = Category::where(['is_product' => true])->active()->onlyParent()->onHome()->isFeatured()->with(['children' => function ($q) {
            return $q->active()->with(['children' => function ($q) {
                return $q->where(['is_user' => true ])->active();
            }]);
        }])->orderBy('order', 'desc')->get();
        return view('frontend.wokiee.four.home.istores', compact(
            'sliders',
            'brands',
            'newProducts',
            'onSaleProducts',
            'bestSalesProducts',
            'productHotDeals',
            'homeCategoriesUser',
            'homeCategoriesProduct',
            'bestSaleCollections',
            'designers',
            'companies'
        ));
    }
}
