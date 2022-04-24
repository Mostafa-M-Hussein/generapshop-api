<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Fqsen;

class TagController extends Controller
{


    public function index()
    {
        $tags = Tag::paginate(env('pagination_count'));
        return view('admin.tags.tags')->with([
            'tags' => $tags  ,
            'showLinks' => true ,

        ]);


    }

    public  function store ( Request  $request )
    {

        $request->validate(
            [
            'tag_name' => 'required' ,
            ]);

        $tagName = $request->input('tag_name') ;

        if ( !$this->TagNameExists($tagName) )
        {

            Session::flash('message' ,  'tag Name '.$tagName.' Already exists' ) ;
            return redirect()->back( ) ;
        }

        $unit = Tag::where (  'tag' , '=' ,  $tagName ) ;
        if ( $unit ) {
            Session::flash('message' , 'tag already exists ') ;
            return redirect()->back();

            }

        $newTag = new Tag() ;
        $newTag-> tag = $tagName ;
        $newTag->save( );
        Session::flash('message' , 'Tag'.$tagName. 'has been added ') ;
        return redirect()->back( ) ;


    }

    public function search ( Request  $request )
    {

        $request->validate([
            'tag_search' => 'required',
        ]);
        $searchTerm = $request->input('tag_search');
        $tags = Tag::where(
            'tag', 'LIKE', '%' . $searchTerm . '%'
        )->get();
        if (count($tags) > 0)
            return view('admin.tags.tags')->with(['tags' => $tags
                , 'showLinks' => false,
            ]);
        Session::flash('message', 'Nothing Found  :( ');
        return redirect()->back();

    }


    public function delete (Request  $request )
    {

            $request->validate([
               'tag_id' => 'required' ,
            ]);

            $tag = Tag::destroy($request->input('tag_id')) ;
            Session::flash('message' , 'tag has been deleted') ;
            return redirect()->back( ) ;


    }
    private function TagNameExists($tagName )
    {

        $unit = Tag::where(

            'tag', '=', $tagName
        )->first();

        return $unit ? true : false;


    }




    public function update (Request  $request )
    {
        $request->validate([
            'tag_name' => 'required' ,

        ]);


        $tagName = $request->input('tag_name') ;
        $tagID = $request->input('tag_id') ;

        if ( $this->TagNameExists($tagName) )
        {
            Session::flash('message' , 'Tag name already exists ') ;
            return redirect()->back( ) ;
        }


        $tag = Tag::find ($tagID) ;
        $tag->tag = $tagName ;
        $tag->save () ;
        Session::flash('message' , 'tag has been updated') ;
        return redirect()->back() ;




    }


}
