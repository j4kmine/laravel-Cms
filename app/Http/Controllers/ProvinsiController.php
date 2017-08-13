<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Provinsi;
use App\Image;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Validator;
use Session;

class ProvinsiController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $provinsi = Provinsi::select(['id', 'name']);
            return Datatables::of($provinsi)
                ->addColumn('action', function($provinsi){
                    return view('datatable._action', [
                        'model'           => $provinsi,
                        'form_url'        => route('provinsi.destroy', $provinsi->id),
                        'edit_url' => route('provinsi.edit', $provinsi->id),
                        'confirm_message' => 'Yakin mau menghapus ' . $provinsi->name . '?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('provinsi.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('provinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'name' => 'required|max:255',
   
        ]);
        $provinsi = Provinsi::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $provinsi->name"
        ]);
        return redirect()->route('provinsi.index');
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
        $provinsi = Provinsi::find($id);
        $provinsi = $this->getImage($provinsi);
      
        return view('provinsi.edit')->with(compact('provinsi'));
    }
    private function getImage($provinsi){
        if(isset($provinsi->id_image) && $provinsi->id_image!= ""){
            $provinsi['image_detail'] = Image::find($provinsi->id_image);
        }else{
            $provinsi['image_detail'] ="";
        }
        return $provinsi;
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
    

      
            $this->validate($request, [
                'name' => 'required|max:255',
              
                
            ]);
      
            $provinsi = Provinsi::find($id);
            $provinsi->update($request->all());
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil mengupdate $provinsi->name"
            ]);
            return redirect()->route('provinsi.index');
  
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(!Provinsi::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Provinsi berhasil dihapus"
        ]);

        return redirect()->route('provinsi.index');
    }
}
