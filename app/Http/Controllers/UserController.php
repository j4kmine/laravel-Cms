<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Validator;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name','email']);
            return Datatables::of($users)
                ->addColumn('action', function($user){
                    return view('datatable._action', [
                        'model'           => $user,
                        'form_url'        => route('user.destroy', $user->id),
                        'edit_url' => route('user.edit', $user->id),
                        'confirm_message' => 'Yakin mau menghapus ' . $user->name . '?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
             ->addColumn(['data' => 'email', 'name'=>'email', 'title'=>'Email'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('user.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('user.create');
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        $user = User::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $user->name"
        ]);
        return redirect()->route('user.index');
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
        $user = User::find($id);
        return view('user.edit')->with(compact('user'));
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
    

      $user = User::find($id);
      $old_email = $user->email;
      $email = $request->input('email');
      $password = $request->input('password');
       if(isset($password) && $password != ''){
         if($old_email == $email){
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                 'password' => 'required|min:6|confirmed',
                
            ]);
          
            $user->update([
            'name' =>  $request->input('name'),
            'email' =>  $request->input('email'),
             'password' => bcrypt( $request->input('password')),
            ]);
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil mengupdate $user->name"
            ]);
        }else{
              $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                 'password' => 'required|min:6|confirmed',
                
            ]);
        
            $user->update([
            'name' =>  $request->input('name'),
            'email' =>  $request->input('email'),
            'password' => bcrypt( $request->input('password')),
            ]);
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil mengupdate $user->name"
            ]);
        }
            
            return redirect()->route('user.index');
       }else{
            if($old_email == $email){
                 $this->validate($request, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    
                ]);
            }else{
                 $this->validate($request, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    
                ]);
            }
            
            $user = User::find($id);
            $user->update($request->only('name','email'));
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil mengupdate $user->name"
            ]);
            return redirect()->route('user.index');
        }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(!User::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"User berhasil dihapus"
        ]);

        return redirect()->route('user.index');
    }
}
