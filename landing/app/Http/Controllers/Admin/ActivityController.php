<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JsonRpcClient;
use Carbon\Carbon;

class ActivityController extends Controller
{
    //
    protected $client;

    public function __construct(JsonRpcClient $client)
    {
        $this->client = $client;
    }

    public function sendToApi( $page_num ) {
        $data = $this->client->send('getPageUrls', ['page_num' => $page_num]);

        if (!isset($data['result'])) {
            return [];
        }

        return $data;
    }

    public function index(Request $request) {

        $data = $this->sendToApi( 1 );

        return view('activity', ['data' => $data['result']]);
    }

    public function index_pages(Request $request, $id) {

        $data = $this->sendToApi( $id );

        return view('activity', ['data' => $data['result']]);
    }

}
