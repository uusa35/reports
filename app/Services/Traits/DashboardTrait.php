<?php

namespace App\Services\Traits;

use App\Models\Country;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Questionnaire;
use App\Models\Role;
use App\Models\Timing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

trait DashboardTrait
{
    public function changeLanguage()
    {
        app()->setLocale(request('locale'));
        session()->put('locale', request('locale'));
        return redirect()->back();
    }
    public function toggleActivate(Request $request)
    {
        $className = 'App\Models\\' . ($request->has('strictMode') && $request->strictMode ? $request->model : title_case($request->model));
        $element = new $className();
        $element = $element->withoutGlobalScopes()->whereId($request->id)->first();
        $element->update([
            'active' => !$element->active
        ]);
        return redirect()->back()->with('success', 'Process Success');
    }

    public function toggleFeatured(Request $request)
    {
        $className = '\App\Models\\' . Str::title($request->model);
        $element = new $className();
        $element = $element->withoutGlobalScopes()->whereId($request->id)->first();
        if (isset($element->featured)) {
            $element->update([
                'featured' => !$element->featured
            ]);
            return redirect()->back()->with('success', 'Process Success');
        }
        return redirect()->back()->with('error', 'Process Failure .. no such thing');
    }

    public function toggleOnHome(Request $request)
    {
        $className = '\App\Models\\' . Str::title($request->model);
        $element = new $className();
        $element = $element->withoutGlobalScopes()->whereId($request->id)->first();
        if (isset($element->on_home)) {
            $element->update([
                'on_home' => !$element->on_home
            ]);
            return redirect()->back()->with('success', 'Process Success');
        }
        return redirect()->back()->with('error', 'Process Failure .. no such thing');
    }

    public function toggleOnSale(Request $request)
    {
        $className = '\App\Models\\' . Str::title($request->model);
        $element = new $className();
        $element = $element->withoutGlobalScopes()->whereId($request->id)->first();
        if (isset($element->on_sale)) {
            $element->update([
                'on_sale' => !$element->on_sale
            ]);
            return redirect()->back()->with('success', 'Process Success');
        }
        return redirect()->back()->with('error', 'Process Failure .. no such thing');
    }

    public function toggleAccessDashBoard(Request $request)
    {
        $className = '\App\Models\\' . Str::title($request->model);
        $element = new $className();
        $element = $element->withoutGlobalScopes()->whereId($request->id)->first();
        $element->update([
            'access_dashboard' => !$element->access_dashboard
        ]);
        return redirect()->back()->with('success', 'Process Success');
    }


    public function clearImage(Request $request)
    {
        $className = '\App\Models\\' . Str::title($request->model);
        $element = new $className();
        $element = $element->withoutGlobalScopes()->whereId($request->id)->first();
        $element->update([
            $request->has('colName') ? $request->colName : 'image' => ''
        ]);
        return redirect()->back()->with('success', 'Image Cleared!');
    }

    public function BackupDB()
    {
        Artisan::call('backup:db');
        return back()->with('success', 'db packed successfully');
    }

    public function exportTranslations()
    {
        Artisan::call('publish-trans');
        return redirect()->back()->with('success', 'translations exported');
    }

    public function createNotification($element)
    {
        $element = Product::active()->hasAttributes()->first();
        $this->notify(
            trans(
                'message.notification_message',
                [
                    'type' => 'testing',
                    'name' => $element->name,
                    'project_name' => $element->name
                ]
            ),
            '',
            [
                'path' => asset('storage/uploads/files/' . $element->path),
                'title' => $element->name,
                'type' => 'pdf'
            ]
        );
    }
}
