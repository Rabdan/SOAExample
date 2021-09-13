<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JsonRpcClient;
use Carbon\Carbon;

class PageController extends Controller
{
    protected $client;

    public function __construct(JsonRpcClient $client)
    {
        $this->client = $client;
    }

    public function sendToApi( $url ) {
        $ctime = Carbon::now();
        $data = [];
        $data = $this->client->send('setPageUrl', ['page_url' => $url, 'date' => $ctime->toDateTimeString()]);

        if (!isset($data['result'])) {
            return [];
        }

        return $data;
    }
    //
    public function page_show(Request $request, $slug) {

        $data = $this->sendToApi( $request->fullUrl() );
        return view('page', ['page_slug' => $slug, 'page_title' => ucfirst($slug), 'dta' => $data]);
    }

    public function home_show(Request $request) {

        $slug = 'home';
        $data = $this->sendToApi( $request->fullUrl() );
        return view('page', ['page_slug' => $slug, 'page_title' => ucfirst($slug), 'dta' => $data]);
    }
}
