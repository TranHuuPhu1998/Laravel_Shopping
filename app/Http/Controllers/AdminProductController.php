<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Product;
use App\ProductImage;
use App\Components\Recursive;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use Storage;

class AdminProductController extends Controller
{
    use StorageImageTrait;

    private $category;
    private $product;
    private $productImage;

    public function __construct(Category $category,Product $product,ProductImage $productImage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = 0);
        return view('admin.product.add', compact('htmlOption'));
    }

    private function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive($parent_id);
        return $htmlOption;
    }

    public function store(Request $request)
    {
        $dataProductCreate = [
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->contents,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ];
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
        if(!empty($dataUploadFeatureImage)){
            $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }
        $product = $this->product->create($dataProductCreate);
        // Insert data to table product_image
        if(!empty($request->hasFile('image_path'))){
            foreach ($request->image_path as $fileItem) {
                $dataUploadImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');

                $product->images()->create([
                    'image_path' => $dataUploadImageDetail['file_path'],
                    'image_name' => $dataUploadImageDetail['file_name'],
                ]);
            }
        }

    }
}