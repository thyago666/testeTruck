<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Historic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function update(Request $request, $code)
    {
     $product = Product::where('code', $code)->first();
    if ($product) {
        $product->update($request->all());
        return response()->json([
            'message' => 'Product updated successfully.',
            'product' => $product
        ]);
    } else {
        return response()->json([
            'message' => 'Product not found.'
        ], 404);
    }
}

    public function trash($code)
    {
        $product = Product::where('code', $code)->first();
        $product->status = 'trash';
        $product->save();
        return response()->json([
            'message' => 'The product has been successfully disabled.',
            'product' => $product
        ]);
    }

    public function show($code)
    {
        $product = Product::where('code', $code)->first();
        return response()->json($product);
    }

    public function index()
    {
        $products = Product::paginate(10);
        return response()->json($products);
    }

    public function token(){
        return $token = csrf_token();
    }

    public function cron()
    {
        $currentDate = Carbon::now()->toDateString();
        $historic = Historic::whereDate('created_at', $currentDate)->first();

            if(!$historic)
            {
                set_time_limit(300); 
                $indexUrl = 'https://challenges.coode.sh/food/data/json/index.txt';

                        $indexResponse = Http::get($indexUrl);
                if ($indexResponse->successful())
                {
                                $files = explode("\n", $indexResponse->body());
                                $files = array_filter($files, 'strlen');
                                $lastFile = end($files);
        
                $url = 'https://challenges.coode.sh/food/data/json/'.$lastFile;

                   $tempDir = storage_path('/app/public/');
                     if (!file_exists($tempDir)){
                        mkdir($tempDir, 0777, true);
                    }
                     $tempFile = $tempDir . '/'.$lastFile;
                    $client = new Client();
                    $client->request('GET', $url, ['sink' => $tempFile]);
                    $jsonFile = $tempDir . '/lastBase.json';
                    $gz = gzopen($tempFile, 'rb');
                    $json = fopen($jsonFile, 'wb');
                        while (!gzeof($gz)) {
                            fwrite($json, gzread($gz, 4096));
                        }
                    fclose($json);
                    gzclose($gz);

                      $this->import();

                      $historic = new Historic;
                      $historic->status = 'OK';
                      $historic->time = 'OK';
                      $historic->save();
                      return 'Update completed successfully!';
            }
                }
                else
                {
                   return 'Automatic update has already been carried out today';
                }
    }

    public function import()
    {
        $file = fopen(storage_path('app/public/lastBase.json'), 'r');
        if ($file) {
            $count = 0;
     while (($line = fgets($file)) !== false && $count < 100) {
         $record = json_decode($line, true);
         if (!Product::where('code', $record['code'])->exists()) {
             $product = new Product;
             $product->code = $record['code'];
             $product->status = 'published';
             $product->imported_t = now();
             $product->url = $record['url'];
             $product->creator = $record['creator'];
             $product->created_t = $record['created_t'];
             $product->last_modified_t = $record['last_modified_t'];
             $product->product_name = $record['product_name'];
             $product->quantity = $record['quantity'];
             $product->brands = $record['brands'];
             $product->categories = $record['categories'];
             $product->labels = $record['labels'];
             $product->cities = $record['cities'];
             $product->purchase_places = $record['purchase_places'];
             $product->stores = $record['stores'];
             $product->ingredients_text = $record['ingredients_text'];
             $product->traces = $record['traces'];
             $product->serving_size = $record['serving_size'];
             $product->serving_quantity = $record['serving_quantity'];
             $product->nutriscore_score = $record['nutriscore_score'];
             $product->main_category = $record['main_category'];
             $product->image_url = $record['image_url'];
             $product->save();
             $count++;
         }
     }
     fclose($file);
     return 'Os primeiros 100 registros foram importados com sucesso.';
 } else {
     return 'Erro ao abrir o arquivo.';
 }

    }
}

