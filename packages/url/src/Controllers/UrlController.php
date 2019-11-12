<?php

namespace Url\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Url\Models\Url;
use Url\Models\UrlDetail;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $urls = Url::query()->with('url_details')->latest()->paginate(20);

        return [
            'success' => true,
            'data' => $urls
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'origin_url' => 'required|string|active_url'
        ]);

        $originUrl = $request->get('origin_url');
        $slug = $this->makeShortLink($originUrl, auth()->user()->id);

        $result = Url::create([
            'origin_url' => $originUrl,
            'slug' => $slug,
            'user_id' => auth()->user()->id,
        ]);

        return [
            'success' => true,
            'data' => $result
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Url $id
     * @return array
     */
    public function getUrlDetail($id)
    {
        $urlDetails = UrlDetail::query()->where('url_id', $id)->latest()->paginate(20);

        return [
            'success' => true,
            'data' => $urlDetails
        ];
    }

    private function makeShortLink($origin, $userId)
    {
        return substr(base64_encode(md5(now() . $userId . $origin)), 0, 6) ;
    }
}
