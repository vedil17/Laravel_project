<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function save_slider(Request $request)
    {
        
            $this->validate($request,[
                'slider_image'=>'image|nullable|max:1999'
            ]);

            if($request->hasFile('slider_image')){

                //1: Get file name with extension
                $filenameWithExt=$request->file('slider_image')->getClientOriginalName();
                //2: Get just file name 
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                //3: Get only the extension
                $extension=$request->file('slider_image')->getClientOriginalExtension();
                //4: File name to store
                $fileNameToStore=$filename.'_'.time().'.'.$extension;
                //5: Store
                $path=$request->file('slider_image')->storeAs('public/cover_image',$fileNameToStore);
            }
            else
            {
                $fileNameToStore='noimage.png';
            }

            $data=array();
            $data['description1']=$request->description1;
            $data['description2']=$request->description1;
            $data['slider_image']=$fileNameToStore;
            $data['status']=$request->slider_status;

            DB::table('tbl_sliders')->insert($data);

            Session::put('message','The slider is added successfully');

            return redirect::to('/add_slider');
        
    }

    public function unactivate_slider($id)
    {
        $data=array();
        $data['status']=0;

        DB::table('tbl_sliders')
            ->where('id',$id)
            ->update($data);

        Session::put('message','Slider is unactivated successfully');

        return redirect::to('/sliders');
    }

    public function activate_slider($id)
    {
        $data=array();
        $data['status']=1;
        
        DB::table('tbl_sliders')
            ->where('id',$id)
            ->update($data);

        Session::put('message','Slider is activated successfully');

        return redirect::to('/sliders');
    }

    public function delete_slider($id)
    {
        DB::table('tbl_sliders')
            ->where('id',$id)
            ->delete();

        Session::put('message','Slider is deleted successfully');

        return redirect::to('/sliders');
    }

    public function edit_slider($id)
    {
        $select_slider=DB::table('tbl_sliders')
                            ->where('id',$id)
                            ->first();

        return view('admin.edit_slider')->with('select_slider',$select_slider);
    }

    public function update_slider(Request $request)
    {
        $this->validate($request,[
            'slider_image'=>'image|nullable|max:1999'
        ]);
        
        $data=array();
        if($request->hasFile('slider_image')){

            //1: Get file name with extension
            $filenameWithExt=$request->file('slider_image')->getClientOriginalName();
            //2: Get just file name 
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //3: Get only the extension
            $extension=$request->file('slider_image')->getClientOriginalExtension();
            //4: File name to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //5: Store
            $path=$request->file('slider_image')->storeAs('public/cover_image',$fileNameToStore);

            $select_image=DB::table('tbl_sliders')
                            ->where('id',$request->slider_id)
                            ->first();
            
            $data['slider_image']=$fileNameToStore;

            if($select_image->slider_image != 'noimage.png'){
                Storage::delete('public/cover_image/'.$select_image->slider_image);
            }
        }
        
        $data['description1']=$request->description1;
        $data['description2']=$request->description1;

        DB::table('tbl_sliders')
            ->where('id',$request->slider_id)
            ->update($data);

        Session::put('message','The slider is updated successfully');

        return redirect::to('/sliders');
    }
}
