<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class CheckoutService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param $req
     * @param $id
     * @return object
     */
    public function checkout($req, $id): array
    {
        return $this->orderRepository->order($req, $id);
    }
}
