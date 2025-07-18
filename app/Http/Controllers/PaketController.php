<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\PaketStoreRequest;
use App\Http\Requests\PaketUpdateRequest;
use App\Http\Resources\PaketResource;
use App\Interfaces\PaketRepositoryInterface;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    private PaketRepositoryInterface $paketRepository;

    public function __construct(PaketRepositoryInterface $paketRepository) {
        $this->paketRepository = $paketRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $paket = $this->paketRepository->getAll(
                $request->search,
                $request->limit,
                true
            );
            return ResponseHelper::jsonResponse(true, 'Data paket berhasil di ambil.', PaketResource::collection($paket), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, 'Data paket gagal di ambil.', null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaketStoreRequest $request)
    {
        $request = $request->validated();

        try {
            $paket = $this->paketRepository->create($request);
            return ResponseHelper::jsonResponse(true, 'Data paket berhasil ditambahkan.', new PaketResource($paket), 201);
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
            $paket = $this->paketRepository->getById($id);
            if (!$paket) {
                return ResponseHelper::jsonResponse(false, 'Data paket tidak ditemukan.', null, 404);
            }
            return ResponseHelper::jsonResponse(true, 'Data paket berhasil diambil.', new PaketResource($paket), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, 'Data paket gagal diambil.', null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaketUpdateRequest $request, string $id)
    {
        $request = $request->validated();

        try {
            $paket = $this->paketRepository->getById($id);
            if (!$paket) {
                return ResponseHelper::jsonResponse(false, 'Data paket tidak ditemukan.', null, 404);
            }
            $paket = $this->paketRepository->update($id, $request);

            return ResponseHelper::jsonResponse(true, 'Data paket berhasil diubah.', new PaketResource($paket), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $paket = $this->paketRepository->getById($id);
            if (!$paket) {
                return ResponseHelper::jsonResponse(false, 'Data paket tidak ditemukan.', null, 404);
            }

            $paket = $this->paketRepository->delete($id);
            return ResponseHelper::jsonResponse(true, 'Data paket berhasil dihapus.', null, 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
