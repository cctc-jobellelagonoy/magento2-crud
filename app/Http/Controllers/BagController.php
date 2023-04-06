<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagentoRequestBuilder;
use App\Models\BagProduct;
use Illuminate\Http\Request;
use  JustBetter\MagentoClient\Client\Magento;
use JustBetter\MagentoClient\Query\SearchCriteria;

class BagController extends Controller
{

    protected Magento $magento;
    protected $client;

    public function __construct()
    {
        $this->middleware('auth');
        $builder = new MagentoRequestBuilder();
        $this->magento = new Magento($builder);
    }

    public function create()
    {
        return view('products.create');
    }

    public function index()
    {
        //$products= Product::all();
        return view('products.index', ['products'=>$this->getProducts()]);
    }

    public function getProducts(){
        $searchCriteria = SearchCriteria::make()
            ->paginate(1, 36)
            ->where('type_id', '==', 'simple')
            ->where('attribute_set_id', '==', 15)
            ->get();
             // The JSON string from the Magento API response

            $data = json_decode($this->magento->get('products', $searchCriteria));

            $len = count((array)$data->items);
            
            $products = collect();
            for ($x = 0; $x < $len; $x++) {
                $item = $data->items[$x]; // Assuming you want the first item in the "items" array

                $bag = $this->createProduct($item);
                $products->push($bag);
            }
            
        return $products;

    }

    public function createProduct($item){
        $id = $item->id;
                $sku = $item->sku;
                $name = $item->name;
                $price = $item->price;
                $status = $item->status;
                $total_count = random_int(1, 1000);

                // Retrieve the file from media_gallery_entries
                if($item->media_gallery_entries){
                    $file = "http://localhost/magento2/pub/media/catalog/product/cache/7353db54c106168e8a5cf6455db22561/".$item->media_gallery_entries[0]->file;
                }
                else{
                    $file = "https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png";
                }
                
               
                // Retrieve the description from custom_attributes
                $description = '';
                $custom_attributes = $item->custom_attributes;

                foreach ($custom_attributes as $attribute) {
                    if ($attribute->attribute_code === 'description') {
                        $description = $attribute->value;
                        break;
                    }
                }

                $bag = new BagProduct($id, $sku, $name, $price, $status, $total_count, $description, $file);

            return $bag;
    }

    public function edit($id)
    {
        $searchCriteria = SearchCriteria::make()
        ->where('sku', '==', $id)
        ->get();
         // The JSON string from the Magento API response

        $data = json_decode($this->magento->get('products', $searchCriteria));
        $product = $this->createProduct($data->items[0]);
        
        return view('products.edit',['product'=>$product]);
    }

    public function show($id)
    {
        
        $this->edit($id);
    }

    public function update(Request $request, $sku)
    {
        $result= [
            'product' => [
                'name' => $request->name ? $request->name : "Bag",
                'price' => $request->price ? $request->price : 0,
                'status' => $request->status ? $request->status : 1,
                'custom_attributes' => [
                    14 => [
                        'attribute_code' => 'description',
                        'value' => $request->description ? $request->description : "None"
                    ]
                ]
            ],
        ];
        $this->magento->put("products/$sku", $result);
        return redirect()->route('products.index');
    }

    public function destroy($sku)
    {
        $this->magento->delete("products/$sku");
        return redirect()->route('products.index');
    }

    public function store(Request $request)
    {
       // dd($request);
       $data = [
        'product' => [
                'sku' => rand(1, 999999).'MB'.rand(0, 100),
                'name' => $request->name ? $request->name : "Bag",
                'price' => $request->price ? $request->price : 0,
                'status' => 1, // 1 for enabled, 2 for disabled
                'visibility' => 4, // 1 for not visible individually, 2 for catalog, 3 for search, 4 for both catalog and search
                'type_id' => 'simple', // simple, virtual, configurable, bundle, etc.
                'attribute_set_id' => 4, // 4 is the default attribute set for products, you can use other attribute set ID if needed
                'weight' => 1, // Only needed for simple, configurable, and downloadable products
                'extension_attributes' => [
                    'stock_item' => [
                        'qty' => 100,
                        'is_in_stock' => 1
                    ]
                ],
                'custom_attributes' => [
                    [
                        'attribute_code' => 'description',
                        'value' => $request->description ? $request->description : "None"
                    ],
                    [
                        'attribute_code' => 'short_description',
                        'value' => $request->description ? $request->description : "None"
                    ],
                    [
                        'attribute_code' => 'category_ids',
                        'value' => [2, 3] // Array of category IDs the product will belong to
                    ]
                ]
            ]
        ];
       
        $this->magento->post("products", $data);

        return redirect()->route('products.index');
    }
}
