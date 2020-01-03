<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Redirect;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index()
    {
        //  $data['products'] = Product::orderBy('id','desc')->paginate(10);
        //  //dd($data);
        //  return view('product.list',$data);


    // $rUrl = '';

    // $content = file_get_contents($rUrl);
    // $data = json_decode(file_get_contents($rUrl), true);


    //     return view('product.load')->withData($data);


    $json = '[
        {
            "title": "Professional JavaScript",
            "author": "Nicholas C. Zakas"
        },
        {
            "title": "JavaScript: The Definitive Guide",
            "author": "David Flanagan"
        },
        {
            "title": "High Performance JavaScript",
            "author": "Nicholas C. Zakas"
        }
    ]';


    $data = json_decode($json);

   //dd($data);


    return view('product.load', [ 'books' => $data ]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'product_code' => 'required',
            'description' => 'required',
        ]);

        Product::create($request->all());

        return Redirect::to('products')
       ->with('success','Greate! Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $data['product_info'] = Product::where($where)->first();

        return view('product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'product_code' => 'required',
            'description' => 'required',
        ]);

        $update = ['title' => $request->title, 'description' => $request->description];
        Product::where('id',$id)->update($update);

        return Redirect::to('products')
       ->with('success','Great! Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)->delete();

        return Redirect::to('products')->with('success','Product deleted successfully');
    }

}
