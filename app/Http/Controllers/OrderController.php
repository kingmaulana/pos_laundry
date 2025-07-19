<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $orders = $this->orderRepository->getAll($request->search, $request->limit, true);
            return ResponseHelper::jsonResponse(true, 'Data Order Berhasil Diambil', OrderResource::collection($orders), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request)
    {
        $request = $request->validated();

        try {
            $paket = $this->orderRepository->create($request);
            return ResponseHelper::jsonResponse(true, 'Data order berhasil ditambahkan.', new OrderResource($paket), 201);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $order = $this->orderRepository->getById($id);
            if (!$order) {
                return ResponseHelper::jsonResponse(false, 'Data Order tidak ditemukan', null, 404);
            }
            return ResponseHelper::jsonResponse(true, 'Data Order Berhasil Diambil', new OrderResource($order), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, string $id)
    {
        $request = $request->validated();

        try {
            $order = $this->orderRepository->getById($id);
            if (!$order) {
                return ResponseHelper::jsonResponse(false, 'Data Order tidak ditemukan.', null, 404);
            }
            $order = $this->orderRepository->update($id, $request);

            return ResponseHelper::jsonResponse(true, 'Data Order berhasil diubah.', new OrderResource($order), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
