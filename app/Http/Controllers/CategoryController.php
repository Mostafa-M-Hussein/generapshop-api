<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(15);

        return view('admin.categories.categories')->with([
            'categories' => $categories ,
            'showLinks' =>true ,

        ]);

    }
    private  function categoryNameExists ($category_name )
    {


       $category = Category::where (
           'name' , '=' , $category_name
       )->get()  ;
       if ( count ( $category )  > 0 )
       {
           return True ;
       }
       return  False ;

    }
    public function store(Request $request)
    {

        $request->validate([

            'category_name' => 'required' ,
        ]);

        $categoryName = $request->input('category_name') ;

        if ($this->categoryNameExists($categoryName) )
        {

            Session::flash('message' , 'Category name already exists ') ;
            return back() ;

        }
        $category =  new Category() ;

        $category->name = $categoryName ;
        $category->save () ;
        Session::flash('message' , 'Category has been added');
        return back() ;


    }

    public function update(Request $request)
    {
        $request->validate([
        'category_name' =>'required' ,
        'category_id' => 'required',


    ]);


        $categoryID = intval($request->input('category_id'));
        $category = Category::find($categoryID);


        $category->name = $request->input('category_name');

        $category->save();
        Session::flash('message', 'Category ' . $category->name . ' Has been updated');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        if (is_null($request->input('category_id')) || empty($request->input('category_id')))
            Session::flash("message", "category  is required ");


        $request->validate(
            [
                'category_id' => 'required'
            ]);

        $id = $request->input('category_id');
        Category::destroy($id);
        Session::flash('message', 'Category has been deleted');
        return redirect()->back();

    }

    public function search ( Request  $request )
    {

        $request->validate([
            'category_search' => 'required',
        ]);
        $searchTerm = $request->input('category_search');
        $categories = Category::where(
            'name', 'LIKE', '%' . $searchTerm . '%'
        )->get();
        if (count($categories) > 0)
            return view('admin.categories.categories')->with(['categories' => $categories
                , 'showLinks' => false,
            ]);
        Session::flash('message', 'Nothing Found  :( ');
        return redirect()->back();

    }

}

