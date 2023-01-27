<?php

namespace App\Http\Controllers;

use Exception;
use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::user()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('categories.edit', $row) . '" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                    $route = route('categories.destroy', $row);
                    $btn .= '<a href="javascript:void(0)" onclick="getDeleteRoute(' . "'$route'" . ')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $category = new Category();
            $category->user_id = auth()->id();
            $category->category_name = $request->name;
            $category->save();
            return redirect()->back()->with('success', 'Item(s) created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            //Save data
            $category->category_name = $request->name;
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Item(s) updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Item(s) deleted successfully!');
    }
}
