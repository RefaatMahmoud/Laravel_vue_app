<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        $response = ProductResource::collection($products);
        return response()->json(
            [
                'products' => $response,
                'status'   => true
            ],
            Response::HTTP_OK
        );
    }

    public function create()
    {
        //
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            //create
            $file_name = time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('products', $file_name);
            Product::create(
                [
                    'name'  => $request->name,
                    'image' => $file_name,
                ]
            );
            DB::commit();

            //response
            return response()->json(
                [
                    'status' => true,
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            DB::rollBack();
            if (app()->environment()) {
                $message = $e->getMessage() . ' in file ' . $e->getFile() . ' in line' . $e->getLine();
            } else {
                $message = 'something went wrong !';
            }
            return response()->json(
                [
                    'data'   => $message,
                    'status' => false,
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            Storage::delete('products/' . $product->image);
            return response()->json(
                [
                    'status' => true,
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            DB::rollBack();
            if (app()->environment()) {
                $message = $e->getMessage() . ' in file ' . $e->getFile() . ' in line' . $e->getLine();
            } else {
                $message = 'something went wrong !';
            }
            return response()->json(
                [
                    'data'   => $message,
                    'status' => false,
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
