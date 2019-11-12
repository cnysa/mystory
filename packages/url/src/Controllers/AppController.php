<?php

namespace Url\Controllers;

use App\Helpers\QeoGuzzle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Url\Jobs\UrlTrackingRecord;
use Url\Models\Url;
use Url\Models\UrlDetail;

class AppController extends Controller
{
    const IPGEO_KEY = 'cb957a3d134d44a0b5ab2c43b4cb60cd';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('url::home');
    }

    /**
     * Redirect short url to origin url and track record
     *
     * @param string $slug
     * @return Response
     */
    public function redirect(string $slug)
    {
        if ($slug === 'dashboard') {
            return $this->dashboard();
        }

        $url = Url::query()->where('slug', $slug)->first();
        if (!$url) {
            return abort(404);
        }
        UrlTrackingRecord::dispatch($url->id, request()->getClientIp(), request()->userAgent());

        return redirect($url->origin_url, 301);
    }

    /**
     * Dashboard URL shortening
     *
     * @return Response
     */
    public function dashboard()
    {
        if (empty(auth()->user()) || auth()->user()->id !== 1) {
            return abort(401);
        }

        $backend = [
            'domain' => 'http' . (config('app.env') === 'production' ? 's' : null) . '://url.' . config('session.domain')
        ];

        return view('url::dashboard', compact('backend'));
    }

    /**
     * Tracking record when have a new visitor
     *
     * @param $urlId
     * @param $ip
     * @param $userAgent
     */
    public function trackingRecord($urlId, $ip, $userAgent)
    {
        $params = [
            'ip' => $ip,
            'user_agent' => $userAgent,
        ];
        $ipGeo = app(QeoGuzzle::class)->send('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey=' . self::IPGEO_KEY. '&ip=' . $ip);
        if ($ipGeo) {
            $params['ip_tracking'] = [
                'country_code2' => $ipGeo->country_code2,
                'country_name' => $ipGeo->country_name,
                'city' => $ipGeo->city,
                'district' => $ipGeo->district,
                'isp' => $ipGeo->isp
            ];
        }
        UrlDetail::query()->create([
           'url_id' => $urlId,
           'params' => $params
        ]);
    }

}
