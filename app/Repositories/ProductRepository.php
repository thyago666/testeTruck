<?php

namespace App\Repositories;

use App\Models\Historic;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ProductRepository
{

    public function update($code, array $data)
    {
        $product = Product::where('code', $code)->firstOrFail();
        $product->update($data);
        return $product;
    }

    public function trash($code)
    {
        $product = Product::where('code', $code)->firstOrFail();
        $product->status = 'trash';
        $product->save();
        return $product;
    }

    public function show($code)
    {
        return Product::where('code', $code)->firstOrFail();
    }

    public function index()
    {
        return Product::paginate(10);
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