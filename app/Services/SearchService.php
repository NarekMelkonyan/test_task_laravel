<?php

namespace App\Services;

use App\Repositories\BookRepository;

class SearchService
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function search($req)
    {
        return $this->bookRepository->search($req);
    }
}
