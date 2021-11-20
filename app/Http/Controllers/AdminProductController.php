<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recursive;
use App\Category;

class AdminProductController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = 0);
        return view('admin.product.add' , compact('htmlOption'));
    }

    private function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive($parent_id);
        return $htmlOption;
    }
}
