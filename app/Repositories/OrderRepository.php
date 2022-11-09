<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

/**
 * @property Book $model
 */
class OrderRepository
{
    public function __construct()
    {
        $this->model = new Order();
    }

    /**
     * @param $req
     * @param $id
     * @return array|false
     */
    public function order($req, $id): array
    {
        $data['book_id'] = $id;
        $data['user_id'] = Auth::id();
        $data['type'] = $req['type'];
        $res = $this->model::create($data);
        if ($res) {
            return $data;
        }
        return false;
    }

    /**
     * @return object
     */
    public function getOrderList(): object
    {
        $query = $this->model::query()
            ->with('user', 'book');

        if (Auth::user()->role_id === 1) {
            return $query
                ->paginate(env('PAGINATION_COUNT', 16));
        }
        return $query
            ->where('user_id', Auth::id())
            ->paginate(env('PAGINATION_COUNT', 16));
    }

}
