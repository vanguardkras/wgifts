<?php

namespace App\Http\Controllers\Admin;

use App\Background;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic');
        $this->middleware('can:admin');
    }

    /**
     * Admin main page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        $backgrounds = Background::orderBy('name')->get();

        return view('admin.backgrounds', compact('backgrounds'));
    }

    /**
     * Save new background.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeBackground(Request $request)
    {
        $background = new Background;
        $background->dataUpdate($request);

        return $this->redirectTo();
    }

    /**
     * Update existing background.
     *
     * @param Request $request
     * @param Background $background
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editBackground(Request $request, Background $background)
    {
        if ($request->has('file')) {
            Storage::disk('public')->delete('backgrounds/'.$background->file);
        }

        $background->dataUpdate($request);

        return $this->redirectTo();
    }

    /**
     * Delete existing background.
     *
     * @param Background $background
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function deleteBackground(Background $background)
    {
        $background->delete();

        return $this->redirectTo();
    }

    public function settings()
    {
        $price = Setting::getPrice();
        $paymentRequired = Setting::isPaymentRequired();

        return view('admin.settings', compact(['price', 'paymentRequired']));
    }

    /**
     * Update current price
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePayment(Request $request)
    {
        Setting::updatePaymentRequirement($request->paymentRequired);

        return redirect('/admin/settings');
    }

    /**
     * Update current price
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePrice(Request $request)
    {
        Setting::updatePrice($request->price);

        return redirect('/admin/settings');
    }

    /**
     * Redirect path for admin pages.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function redirectTo()
    {
        return redirect('admin');
    }
}
