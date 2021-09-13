<?php 

namespace App\Http\Controllers;

use App\Models\Data;

class DataController extends Controller
{
    public static function getPageUrls(array $params)
    {

        $page = $params['page_num'];
        $data = Data::groupBy('page_url')
            ->selectRaw('count(*) as total, page_url as count_page_url')
            ->addSelect(['latestdate' =>
                        Data::select('date')
                            ->whereColumn('page_url', 'count_page_url')
                            ->orderBy('id', 'desc')
                            ->limit(1)
            ])
            ->paginate(3,['*'],'page',$page);
        unset($data->links);
        unset($data->first_page_url);
        unset($data->last_page_url);
        unset($data->from);

        return $data;
    }

    public static function setPageUrl(array $params)
    {

        $data = Data::create($params);

        return $data;
    }
}