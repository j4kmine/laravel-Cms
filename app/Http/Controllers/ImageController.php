<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Image;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Validator;
use Session;
use Intervention\Image\ImageManager;
use Images;
use Illuminate\Support\Facades\Input;
use App\Library\Image_moo;
class ImageController extends Controller
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
            $image = Image::select(['id', 'name','path']);
            return Datatables::of($image)
                ->addColumn('action', function($image){
                    return view('datatable._action', [
                        'model'           => $image,
                        'form_url'        => route('image.destroy', $image->id),
                        'edit_url' => route('image.edit', $image->id),
                        'confirm_message' => 'Yakin mau menghapus ' . $image->name . '?'
                    ]);
                
                })->make(true);
        }
        $fom = url('/');
        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
            ->addColumn(['data' => 'path', 'name'=>'gambar', 'title'=>'gambar','render' => '"<img src=\"'.$fom.'/"+"image/original/"+data+"\" height=\"50\"/>"'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('image.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     

          return view('image.create');
    }
    public function createcrop(Request $request){

        return view('image.createcrop');
    }
     public function createcroppopup(Request $request){

        return view('image.createcroppopup');
    }
    public function listtinymce(){
      $image = Image::all();
      return view('image.listtinymce')->with(compact('image'));
    }
    public function searchlisttinymce($title){
     $title = $this->decodeURL($title);
     
     $image =  Image::where('name', 'like', '%'.$title.'%')
                ->get();
    return view('image.listtinymce')->with(compact('image'));
    }
    public function viewlist(){
      $image = Image::all();
      return view('image.viewlist')->with(compact('image'));
    }
    public function searchviewlist($title){
     $title = $this->decodeURL($title);
     
     $image =  Image::where('name', 'like', '%'.$title.'%')
                ->get();
    return view('image.viewlist')->with(compact('image'));
    }
    function decodeURL($url){  
        $url = rawurldecode($url);
        return urldecode($url);
    } 
    public function storecrop(Request $request){
      $this->validate($request, [
            'name' => 'required|max:255',
            'path' => 'mimes:jpeg,jpg,png,gif|required|max:10000' ,
   
        ]);
      $is_popup = $request['is_popup'];
      $name = $request['name'];
      $credit = $request['credit'];
      $description = $request['description'];
      $file = $request['path'];
      $fileName = $file->getClientOriginalName();
      $x1 =  $request['x1'];
      $x2  =   $request['x2'];
      $y1 =  $request['y1'];
      $y2 =  $request['y2'];
      $image = Input::file('path');
      $newfileName  = time() . '.' . $image->getClientOriginalExtension();
      $request->file('path')->move("image/original/", $newfileName);
      $this->crop_resize($image,$newfileName,$x1,$x2,$y1,$y2);
        $tambah = new Image();
        $tambah->name = $name;
        $tambah->tipe = 1;
        $tambah->credit = $credit;
        $tambah->description = $description;
        // Disini proses mendapatkan judul dan memindahkan letak gambar ke folder image
        $file       = $request->file('path');
        $fileName   = $file->getClientOriginalName();

        $tambah->path = $newfileName;
        $tambah->save();

       Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $tambah->name"
        ]);
        if($is_popup == 1){
          return view('image.createcroppopup');
        }else{
          return redirect()->route('image.index');
        }
        


      
    }
    public function updatecrop(Request $request, $id)
    { 
       
      if (isset($request['path']) && $request['path']  != "") {
       $this->validate($request, [
            'name' => 'required|max:255',
            'path' => 'mimes:jpeg,jpg,png,gif|required|max:10000' ,
   
        ]);
      }else{

        $this->validate($request, [
                  'name' => 'required|max:255',              
                  
        ]);
        
      }
      $extension ="";
      $filename="";
      $ex ="";
      $update = Image::where('id', $id)->first();
      $filename = $update->path;
      if (isset($request['path']) && $request['path']  != "") {
        if(isset($filename) && $filename != ''){
          $ex= explode(".", $filename);
          if(isset($ex) && count($ex)>0){
             $filesname = $ex[0];
             $extension = $ex[1];
             $image_dimension =array('1000x667','960x640','620x413','500x333','400x267','300x200','200x133','150x100');
             $original_file = public_path() . '/image/original/' . $filename ; 
             $cropped_file = public_path() . '/image/thumb/'.$filesname.'_crop'.".".$extension;   
             if(file_exists($original_file)){
                unlink($original_file);
             }
             if(file_exists($cropped_file)){
                unlink($cropped_file);
             }
             foreach ($image_dimension as $key => $value) {
                   $resize_file = public_path() . '/image/resize/'. $filesname.'_crop_'.$value.".".$extension;
                    if(file_exists($resize_file)){
                          unlink($resize_file);
                      }
             }
       
            $x1 =  $request['x1'];
            $x2  =  $request['x2'];
            $y1 =  $request['y1'];
            $y2 =  $request['y2'];
            $image = Input::file('path');
            $newfileName  = time() . '.' . $image->getClientOriginalExtension();
            $request->file('path')->move("image/original/", $newfileName);
            $this->crop_resize($image,$newfileName,$x1,$x2,$y1,$y2);
            $update->path = $newfileName;
          }
        }
      }
      $update->name = $request['name'];
      $update->credit = $request['credit'];
      $update->tipe = 0;
      $update->description = $request['description'];
      $update->update();
      Session::flash("flash_notification", [
          "level"=>"success",
          "message"=>"Berhasil mengupdate $update->name"
      ]);
      return redirect()->route('image.index');


    }
    private function crop_resize($image,$newfileName,$x1,$x2,$y1,$y2){
      $image_dimension =array('1000x667','960x640','620x413','500x333','400x267','300x200','200x133','150x100');
      $path = public_path('image\original/' . $newfileName);
      list($width, $height) = getimagesize($path);
      $width_resize = 600;
      $rasio = $width/$width_resize;
      $xx1 =  ($x1 * $rasio);
      $yy1 =  ($y1 * $rasio);
      $xx2 =  ($x2 * $rasio);
      $yy2 =  ($y2 * $rasio);
      $filenames = explode(".", $newfileName);
      $CropName  = $filenames[0].'_crop' . '.' . $image->getClientOriginalExtension(); 
      $crop_path = public_path('image\thumb/' . $CropName);      
      $image_moo = new Image_moo;
      if(file_exists($path)){
          $image_moo->load($path)
            ->crop($xx1,$yy1,$xx2,$yy2)
            ->save($crop_path);
      }
  
      if(file_exists($crop_path)){
           foreach($image_dimension as $key => $value){
              $size_file = explode('x',$value);
              $file_final_name_resize = $filenames[0].'_crop_'.$value . '.' . $image->getClientOriginalExtension();
              $des_path_resize =  public_path('image\resize/' . $file_final_name_resize);
              $image_moo
                  ->load($crop_path)
                  ->stretch($size_file[0],$size_file[1])
                  ->save($des_path_resize);
          }
      }   
      
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
            'path' => 'mimes:jpeg,jpg,png,gif|required|max:10000' ,
   
        ]);
        $tambah = new Image();
        $tambah->name = $request['name'];
        $tambah->credit = $request['credit'];
        $tambah->description = $request['description'];
        // Disini proses mendapatkan judul dan memindahkan letak gambar ke folder image
        $file       = $request->file('path');
        $fileName   = $file->getClientOriginalName();
        $request->file('path')->move("image/original/", $fileName);
        $tambah->tipe=0;
        $tambah->path = $fileName;
        $tambah->save();

       
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $tambah->name"
        ]);
        return redirect()->route('image.index');
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
        $image = Image::find($id);
        if($image->tipe == 1){
          return view('image.editcrop')->with(compact('image'));
        }else{
           return view('image.edit')->with(compact('image'));
        }
       
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
      
            $update = Image::where('id', $id)->first();
            $old_file = $update->path;
            $update->name = $request['name'];
            $update->credit = $request['credit'];
            $update->tipe = 0;
            $update->description = $request['description'];
            $original_file = public_path() . '/image/original/' . $old_file ; 
            if($request->hasFile('path'))
            {
                if(file_exists($original_file)){
                  unlink("image/original/".$old_file);
                }
                $file       = $request->file('path');
                $fileName   = $file->getClientOriginalName();
                $request->file('path')->move("image/original/", $fileName);
                $update->path = $fileName;

                
            } 
            else
            {
                $update->path = $update->path;
                
            }
            
            $update->update();
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil mengupdate $update->name"
            ]);
            return redirect()->route('image.index');
  
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 

      $img = Image::where('id', $id)->first();
      $filename = $img->path;
   
        if(isset($filename) && $filename != ''){
          $ex= explode(".", $filename);
          if(isset($ex) && count($ex)>0){
             $filesname = $ex[0];
             $extension = $ex[1];
             $image_dimension =array('1000x667','960x640','620x413','500x333','400x267','300x200','200x133','150x100');
             $original_file = public_path() . '/image/original/' . $filename ; 
             if(file_exists($original_file)){
              echo "exist";
             }else{
              echo"no exist";
             }
             $cropped_file = public_path() . '/image/thumb/'.$filesname.'_crop'.".".$extension;   
             if(file_exists($original_file)){
                unlink($original_file);
             }
             if(file_exists($cropped_file)){
                unlink($cropped_file);
             }
             foreach ($image_dimension as $key => $value) {
                   $resize_file = public_path() . '/image/resize/'. $filesname.'_crop_'.$value.".".$extension;
                    if(file_exists($resize_file)){
                          unlink($resize_file);
                      }
             }
           
          }
        }
      
       if(!Image::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Provinsi berhasil dihapus"
        ]);

        return redirect()->route('image.index');
    }
}
