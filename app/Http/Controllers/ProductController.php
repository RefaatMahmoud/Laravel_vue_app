<?php

namespace App\Http\Controllers;

use App\Enums\UploadDirectoriesEnum;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $products = Product::latest()->paginate(config('app.pagination'));
        $data = ProductResource::collection($products);
        return $this->returnResponse($data,Response::HTTP_OK);
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create(
                [
                    'name'  => $request->name,
                    'image' => uploadFile($request->file('image'), UploadDirectoriesEnum::Product)
                ]
            );
            $data = new ProductResource($product);
            DB::commit();
            return $this->returnResponse($data, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            if (app()->environment()) {
                $message = $e->getMessage() . ' in file ' . $e->getFile() . ' in line' . $e->getLine();
            } else {
                $message = 'something went wrong !';
            }
            return $this->returnResponse($message,Response::HTTP_NOT_FOUND);
        }
    }

    public function show(Product $product)
    {
        $data = new ProductResource($product);
        return $this->returnResponse($data,Response::HTTP_OK);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            if (count($request->all())) {
                $data = [];
                if ($request->has('name')) {
                    $data['name'] = $request->name;
                }
                if ($request->has('image')) {
                    $data['image'] = uploadFile($request->file('image'), UploadDirectoriesEnum::Product);
                }
                $product->update($data);
            }
            $data = new ProductResource($product);
            return $this->returnResponse($data,Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            if (app()->environment() == "local") {
                $message = $e->getMessage() . ' in file ' . $e->getFile() . ' in line' . $e->getLine();
            } else {
                $message = 'something went wrong !';
            }
            return $this->returnResponse($message,Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            Storage::delete('products/' . $product->image);
            return $this->returnResponse('Product Deleted Successfully',Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            if (app()->environment()) {
                $message = $e->getMessage() . ' in file ' . $e->getFile() . ' in line' . $e->getLine();
            } else {
                $message = 'something went wrong !';
            }
            return $this->returnResponse($message,Response::HTTP_NOT_FOUND);
        }
    }
}
