<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\App\Models\Blog;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->getBlogsDataTable();
        }

        return view('blog::index');
    }

    /**
     * Get data for DataTables.
     *
     * @return \Yajra\DataTables\DataTables
     */
    protected function getBlogsDataTable()
    {
        $data = Blog::select(['id', 'title', 'detail', 'author']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return $this->getActionButtons($row);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Generate action buttons for DataTables.
     *
     * @param \Modules\Blog\App\Models\Blog $row
     * @return string
     */
    protected function getActionButtons($row)
    {
        $showButton = '<a href="'.route('blog.show', $row->id).'" class="btn btn-info btn-sm">Show</a>';
        $editButton = '<a href="'.route('blog.edit', $row->id).'" class="btn btn-primary btn-sm">Edit</a>';
        $deleteButton = '<form action="'.route('blog.destroy', $row->id).'" method="POST" style="display:inline-block;">'.
                            csrf_field().
                            method_field('DELETE').
                            '<button type="submit" class="btn btn-danger btn-sm">Delete</button>'.
                        '</form>';

        return $showButton . $editButton . $deleteButton;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateBlog($request);

        Blog::create($request->only('title', 'detail', 'author'));

        return redirect()->route('blog.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog::show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog::edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validateBlog($request);

        $blog = Blog::findOrFail($id);
        $blog->update($request->only('title', 'detail', 'author'));

        return redirect()->route('blog.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Validate the blog data.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'author' => 'required|string|max:255',
        ]);
    }
}
