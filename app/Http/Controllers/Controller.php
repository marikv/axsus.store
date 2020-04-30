<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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


    protected function sendAutoRegisterEmail($password)
    {
        if (!Auth::guest()) {

            $details = [
                'type' => 'register',
                'password' => $password,
            ];

            Mail::to(Auth::user()->email)->send(new \App\Mail\StoreSendMail($details));
        }
    }

    protected function sendOrderEmail(Order $orderModel, array $orderProductModels)
    {
        if (!Auth::guest()) {
            $details = [
                'type' => 'order',
                'order' => $orderModel,
                'orderProducts' => $orderProductModels,
            ];

            Mail::to(Auth::user()->email)->send(new \App\Mail\StoreSendMail($details));
        }
    }
}
