<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Historic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use App\Repositories\ProductRepository;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function update(Request $request, $code)
    {
        $product = $this->productRepository->update($code, $request->all());
        return response()->json([
            'message' => 'Product updated successfully.',
            'product' => $product
        ]);
    }

    public function trash($code)
    {
        $product = $this->productRepository->trash($code);
        return response()->json([
            'message' => 'The product has been successfully disabled.',
            'product' => $product
        ]);
    }

    public function show($code)
    {
        $product = $this->productRepository->show($code);
        return response()->json($product);
    }

    public function index()
    {
        $products = $this->productRepository->index();
        return response()->json($products);
    }
   
    public function token(){
        return csrf_token();
    }

    public function cron()
    {
        return $this->productRepository->cron();
    }
 }

