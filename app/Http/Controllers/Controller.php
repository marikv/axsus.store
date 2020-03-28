<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function standartPagination($s, Request $request)
    {

        if ($request->pagination['sortBy']) {
            $s = $s->orderBy(
                (string)($request->pagination['sortBy']),
                (boolean)($request->pagination['descending']) ? 'desc' : 'asc'
            );
        } else {
            $s = $s->orderBy('order_by', 'asc')->orderBy('id', 'desc');
        }

        if ($request->pagination['rowsPerPage'] > 0) {
            $s = $s->paginate($request->pagination['rowsPerPage'], ['*'], 'page', $request->pagination['page']);
        } else {
            $s = $s->paginate(50);
        }
        return $s;
    }
}
