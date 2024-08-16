<?php

namespace Modules\Book\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Modules\Book\App\Models\Book;
use Yajra\DataTables\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('book::index');
    }

    /**
     * Fetch data for DataTables.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBooks()
    {
        $books = Book::query();

        return DataTables::of($books)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('book.show', $row->id) . '" class="btn btn-info btn-sm">View</a>';
                $btn .= ' <a href="' . route('book.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                $btn .= ' <form action="' . route('book.destroy', $row->id) . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                        </form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('book::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'book_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Book::create($validatedData);

        return redirect()->route('book.index')->with('success', 'Book created successfully.');
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('book::show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('book::edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'book_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validatedData);

        return redirect()->route('book.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully.');
    }
}
