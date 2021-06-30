<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Lazada;
use App\Models\LazadaDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LazadaProdController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $producs = Lazada::all();
        return view('lazadas.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request , [
            'nama'          => 'required|string',
            'sku_lazada'          => 'required|string'
        ]);

        $input = $request->all();

        Lazada::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Lazadas Created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $lazada = Lazada::find($id);
        return $lazada;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama'          => 'required|string',
            'sku_lazada'         => 'required',
        ]);

        $input = $request->all();
        $produk = Lazada::findOrFail($id);

        $produk->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Lazadas Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lazada = Lazada::findOrFail($id);

        if (!$lazada->image == NULL){
            unlink(public_path($lazada->image));
        }

        Lazada::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Lazadas Deleted'
        ]);
    }

    public function apiLazadas(){
        $lazada = Lazada::all();

        return Datatables::of($lazada)
        ->addColumn('action', function($product){
            return '<a href="lazadas/detail/'.$product->id.'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Detail</a> ' .
                '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        })->make(true);
 
    }

    public function detail($id)
    {
        $data = Lazada::find($id);
        $product = Product::orderBy('id','ASC')
            ->get()
            ->pluck('nama','id');
        return view('lazadas.detail', [
            "data"=>$data,
            "product"=>$product
        ]);
    }

    public function apiLazadasDetail($idlazada)
    {
        $lazada = LazadaDetail::where('id_lazada', $idlazada);

        return Datatables::of($lazada)
        ->addColumn('action', function($product){
            return '<a href="lazadas/detail/'.$product->id.'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Detail</a> ' .
                '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        })->make(true);
    }

    public function saveDetail(Request $request)
    {
        $this->validate($request , [
            'id_product' => 'required|string'
        ]);

        $input = $request->all();

        LazadaDetail::create($input);

        return redirect('lazadas/detail/'.$input['id_lazada']);
    }
}
