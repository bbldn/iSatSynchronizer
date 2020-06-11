<?php

namespace App\Controller\API;

use App\Controller\Controller;
use App\Service\API\OrderService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class OrderBackController extends Controller
{
    /** @var OrderService $orderService */
    protected $orderService;

    /**
     * OrderBackController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function orderInformationAction(int $id): Response
    {
        try {
            $data = [
                'ok' => true,
                'data' => $this->orderService->getOrderInformation($id)
            ];
        } catch (Exception $e) {
            $data = [
                'ok' => false,
                'errors' => [$e->getMessage()]
            ];
        }

        return $this->json($data);
    }
}