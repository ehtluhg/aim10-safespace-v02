<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function save(CategoryFormRequest $request)
    {
        $data = $request->validated();

        $category = new Category;
        $category->name = $data['name'];
        $category->description = $data['description'];

        if($request->hasfile('image'))
        {
            $upload = new File;
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $upload->file_name = $filename;
            $upload->save();
            $category->image = $upload->id;
        }

        $category->status = $request-> status == true ? '1':'0';
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('admin/category')->with('message', 'Category Added Successfully!');
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category_id)
    {
        $data = $request->validated();

        $category = Category::find($category_id);
        $category->name = $data['name'];
        $category->description = $data['description'];

        if($request->hasfile('image'))
        {
            $destination = 'uploads/category/' . $category->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            
            $upload = new File;
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $upload->file_name = $filename;
            $upload->save();
            $category->image = $upload->id;
        }

        $category->status = $request-> status == true ? '1':'0';
        $category->created_by = Auth::user()->id;
        $category->update();

        return redirect('admin/category')->with('message', 'Category Updated Successfully!');
    }

    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        $category->status = '2';
        $category->update();

        return redirect('admin/category')->with('message', 'Category Deleted Successfully!');

        // $category = Category::find($category_id);
        // if($category)
        // {
        //     $destination = 'uploads/category/' . $category->image;
        //     if(File::exists($destination))
        //     {
        //         File::destroy($destination);
        //     }
        //     $category->posts()->delete();
        //     $category->delete();
            
        //     return redirect('admin/category')->with('message', 'Category Deleted With Its Posts Successfully!');
        // }
        // else
        // {
        //     return redirect('admin/category')->with('message', 'Category ID Not Found');
        // }
    }
}
