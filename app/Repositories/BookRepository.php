<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Writer;

/**
 * @property Book $model
 */
class BookRepository
{

    public function __construct()
    {
        $this->model = new Book();
    }


    /**
     * @return object
     */
    public function getByPaginate(): object
    {
        return $this->model::query()
            ->with('writer')
            ->paginate(env('PAGINATION_COUNT', 16));
    }

    /**
     * @param $req
     * @return object
     */
    public function search($req): object
    {
        $query = $this->model::query();

        $writers = Writer::query()
            ->select('book_id')
            ->where('name', 'like', '%' . $req . '%')
            ->get();

        $query
            ->orWhere('title', 'like', '%' . $req . '%')
            ->when($writers, function ($q) use ($writers) {
                $q->orWhereIn('id', $writers);
            });

        return $query
            ->with('writer')
            ->paginate(env('PAGINATION_COUNT', 16));
    }
}
