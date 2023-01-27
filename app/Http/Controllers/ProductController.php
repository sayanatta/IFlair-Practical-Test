<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use DataTables;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::user()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image = '<img src="' . url('/') . $row->product_image . '" style="width: 150px;,height: 100px;">';
                    return $image;
                })
                ->addColumn('category', function ($row) {
                    if (isset($row->category)) {
                        $category = $row->category->category_name;
                    } else {
                        $category = '-';
                    }
                    return $category;
                })
                ->addColumn('status', function ($row) {
                    $status = '';
                    if ($row->product_status == 1) {
                        $status .= '<button type="button" class="btn btn-success btn-sm">Active</button>';
                    } else {
                        $status .= '<button type="button" class="btn btn-warning btn-sm">Inactive</button>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('products.edit', $row) . '" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                    $route = route('products.destroy', $row);
                    $btn .= '<a href="javascript:void(0)" onclick="getDeleteRoute(' . "'$route'" . ')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['image', 'category', 'status', 'action'])
                ->make(true);
        }
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::user()->get();
        return view('products.create', compact('categories'));
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
                'image' => 'required',
                'name' => 'required',
                'category' => 'required',
                'description' => 'required',
                'status' => 'required',
            ]);
            if (!empty($request->image)) {
                $file_name = rand(11111, 99999) . time() . '.' . $request->image->getClientOriginalExtension();
                $destinationPath = public_path('/image/');
                $request->image->move($destinationPath, $file_name);
            }
            $image = '/image/' . $file_name;
            $product = new Product();
            $product->user_id = auth()->id();
            $product->category_id = $request->category;
            $product->product_image = $image;
            $product->product_name = $request->name;
            $product->product_description = $request->description;
            $product->product_status = $request->status;
            $product->save();

            return redirect()->back()->with('success', 'Item(s) created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::user()->get();
        return view('products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'required',
                'category' => 'required',
                'description' => 'required',
                'status' => 'required',
            ]);
            $image = $product->product_image;
            if (!empty($request->image)) {
                $file_name = rand(11111, 99999) . time() . '.' . $request->image->getClientOriginalExtension();
                $destinationPath = public_path('/image/');
                $request->image->move($destinationPath, $file_name);
                $image = '/image/' . $file_name;
            }

            $product->category_id = $request->category;
            $product->product_image = $image;
            $product->product_name = $request->name;
            $product->product_description = $request->description;
            $product->product_status = $request->status;
            $product->save();

            return redirect()->back()->with('success', 'Item(s) updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Item(s) deleted successfully!');
    }
}
