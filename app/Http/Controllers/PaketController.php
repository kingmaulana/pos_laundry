<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\PaketResource;
use App\Interfaces\PaketRepositoryInterface;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    private PaketRepositoryInterface $paketRepository;

    public function __construct(PaketRepositoryInterface $paketRepository)
    {
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
