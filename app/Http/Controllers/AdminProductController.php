<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Product;
use App\ProductImage;
use App\Tag;
use App\ProductTag;
use App\Components\Recursive;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductAddRequest;
use DB;
use Storage;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;

    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }

    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
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

    public function store(ProductAddRequest $request)
    {

        try {
            DB::beginTransaction();

            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            $product = $this->product->create($dataProductCreate);
            // Insert data to table product_image
            if (!empty($request->hasFile('image_path'))) {
                foreach ($request->image_path as $fileItem) {
                    $dataUploadImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');

                    $product->images()->create([
                        'image_path' => $dataUploadImageDetail['file_path'],
                        'image_name' => $dataUploadImageDetail['file_name'],
                    ]);
                }
            }
            // Insert tags to table product_tag
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // Insert to tags
                    // if tag is not exist then insert to database

                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tagItem,
                    ]);
                    // $this->productTag->create([
                    //     'product_id' => $product->id,
                    //     'tag_id' => $tagInstance->id,
                    // ]);
                    $tagTds[] = $tagInstance->id;
                }

            }
            if ($tagTds) {
                // check tag already exist in product_tag then remove tag
                // kiểm tra tag đã tồn tại trong product_tag thì xóa tag
                $product->tags()->attach($tagTds);
            }

            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('msg: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);

        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('htmlOption', 'product'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            // Update product return boolean
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);
            // Insert data to table product_image
            if (!empty($request->hasFile('image_path'))) {
                // Delete all image detail
                $this->productImage->where('product_id', $id)->delete();

                foreach ($request->image_path as $fileItem) {
                    $dataUploadImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');

                    $product->images()->create([
                        'image_path' => $dataUploadImageDetail['file_path'],
                        'image_name' => $dataUploadImageDetail['file_name'],
                    ]);
                }
            }
            // Insert tags to table product_tag
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // Insert to tags
                    // if tag is not exist then insert to database

                    $tagInstance = $this->tag->firstOrCreate([
                        'name' => $tagItem,
                    ]);
                    // $this->productTag->create([
                    //     'product_id' => $product->id,
                    //     'tag_id' => $tagInstance->id,
                    // ]);
                    $tagTds[] = $tagInstance->id;
                }
            }

            // if ($tagTds) {
            //     $product->tags()->attach($tagTds);
            // }

            //check if tags id is already there , don't add it
            $product->tags()->sync($tagTds);

            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('msg: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id ,$this->product);
    }
}
