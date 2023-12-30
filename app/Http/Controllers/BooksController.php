<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
	/*
	* List Of All Books
	*/
    public function index()
    {
    	try {
    		$books = Book::all();

    		if($books->isNotEmpty()){
	    		return response(['data'=>$books,'message'=>'Books List Successfully!']);		
    		}
	    	
	    	return response(['data'=>[],'message'=>'No Records Found']);		
    	} catch (Exception $e) {
    		return response()->json(['errors'=>$e],500);
    	}
    }

    /*
	* Store new Book
	*/
    public function store(Request $request)
    {
    	try {
 
    		$validated = \Validator::make($request->all(), [
		        'name' 			=> 	'required|unique:books|max:255',
		        'description' 	=> 	'nullable',
		        'price'			=>	'required|numeric',
		        'auther'		=> 	'required',
		    ]);

		    if($validated->fails()){
		    	return response(['errors'=>$validated->errors()],404);
		    }
	    	
	    	$books = Book::create([
    			'name' 			=> 	$request->name,
    			'description'	=>	$request->description,
    			'price'			=>	$request->price,
    			'auther'		=>	$request->auther
    		]);

	    	return response(['data'=>[],'message'=>'Book Added Successfully!'],201);		
    	} catch (Exception $e) {
    		return response()->json(['errors'=>$e],500);
    	}
    }

    /*
	* View Book
	*/
    public function view($id)
    {
    	try {

	    	$book = Book::where('id',$id)->get();

	    	return response(['data'=>$book, 'message'=>'Book View Successfully!'],200);
    	} catch (Exception $e) {
    		return response()->json(['errors'=>$e],500);	
    	}
    }

    /*
	* Update Book
	*/
    public function update(Request $request, $id)
    {
    	try{

    		$validated = \Validator::make($request->all(), [
		        'name' 			=> 	'required|max:255|unique:books,name,'.$id,
		        'description' 	=> 	'nullable',
		        'price'			=>	'required|numeric',
		        'auther'		=> 	'required',
		    ]);

		    if($validated->fails()){
		    	return response(['errors'=>$validated->errors()],404);
		    }
	    	
	    	$books = Book::where('id',$id)
	    	->update([
    			'name' 			=> 	$request->name,
    			'description'	=>	$request->description,
    			'price'			=>	$request->price,
    			'auther'		=>	$request->auther
    		]);

	    	return response(['data'=>[],'message'=>'Book Updated Successfully!'],200);		
    	} catch (Exception $e) {
    		return response()->json(['errors'=>$e],500);
    	}
    }

    /*
	* Delete Book
	*/
    public function delete($id)
    {
    	try {

    		Book::where('id',$id)->delete();
    		
    		return response(['data'=>[],'message'=>'Book Deleted Successfully!'],403);
    	} catch (Exception $e) {
    		return response()->json(['errors'=>$e],500);	
    	}
    }
}
