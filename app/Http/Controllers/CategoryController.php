<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Components\Recursive;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category  = $category;
    }

    public function create(){
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive();

        return view('category.add' , compact('htmlOption'));
    }

    public function index(){
        // latest => lấy ra những bản ghi mới nhất theo ngày tạo

        $categories = $this->category->latest()->paginate(5);
        return view('category.index' , compact('categories'));
    }

    public function store(Request $request){
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);

        return redirect()->route('categories.index');
    }

    public function edit($id){

    }

    public function delete($id){

    }
}