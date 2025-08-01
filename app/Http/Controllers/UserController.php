<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $users = $this->userRepository->getAll(
                $request->search,
                $request->limit,
                true
            );
            return ResponseHelper::jsonResponse(true, 'Data user Berhasil Diambil', UserResource::collection($users), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $request = $request->validated();

        try {
            $user = $this->userRepository->create($request);
            return ResponseHelper::jsonResponse(true, 'Data user berhasil ditambahkan', new UserResource($user), 201);
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
            $user = $this->userRepository->getById($id);
            if (!$user) {
                return ResponseHelper::jsonResponse(false, 'Data user tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data user Berhasil Diambil', new UserResource($user), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $request = $request->validated();
        try {
            $user = $this->userRepository->getById($id);
            if (!$user) {
                return ResponseHelper::jsonResponse(false, 'User tidak ditemukan', null, 404);
            }

            $user = $this->userRepository->update($id, $request);

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Di Update', new UserResource($user), 200);
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
            $user = $this->userRepository->getById($id);
            if (!$user) {
                return ResponseHelper::jsonResponse(false, 'User tidak ditemukan', null, 404);
            }

            $user = $this->userRepository->delete($id);

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Di Hapus', new UserResource($user), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
