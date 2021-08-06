<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreRequest;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookRepository, $responseService;

    public function __construct(BookRepositoryInterface $bookRepository,
                                ResponseService $responseService)
    {
        $this->bookRepository = $bookRepository;
        $this->responseService = $responseService;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $book = $this->bookRepository->create($request->all());
        return $this->responseService->respond($book->toArray());
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $this->bookRepository->update($request->all(), $id);
        return $this->responseService->respond();
    }

    public function destroy(int $id): JsonResponse
    {
        $this->bookRepository->delete($id);
        return $this->responseService->respond();
    }
}
