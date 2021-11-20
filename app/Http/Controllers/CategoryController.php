<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recursive;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = 0);

        return view('admin.category.add', compact('htmlOption'));
    }

    public function index()
    {
        // latest => lấy ra những bản ghi mới nhất theo ngày tạo

        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name),
        ]);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->category->find($id);

        $htmlOption = $this->getCategory($category->parent_id);

        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function delete($id)
    {
        $this->category->find($id)->delete();

        return redirect()->route('categories.index');
    }

    public function update(Request $request, $id)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name),
        ]);

        return redirect()->route('categories.index');
    }

    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive($parent_id);
        return $htmlOption;
    }
}
