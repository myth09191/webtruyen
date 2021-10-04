<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Theloai;
use App\Models\ThuocDanh;
use App\Models\ThuocLoai;
use App\Models\Chapter;
use Carbon\Carbon;
use Storage;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_truyen = Truyen::with('danhmuctruyen','theloai')->orderBy('id','DESC')->get();   
        return view('admincp.truyen.index')->with(compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        return view('admincp.truyen.create')->with(compact('danhmuc','theloai'));
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
            'tentruyen'=>'required|unique:truyen|max:255',
            'slug_truyen'=>'required|unique:truyen|max:255',
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'tacgia'=>'required',
            'tomtattruyen'=>'required',
            'kichhoat'=>'required',
            'danhmuc'=>'required',
            'theloai'=>'required'
        ],
        [
            'tentruyen.required'=>'Không được để trống tên truyện!',
            'danhmuc.required'=>'Không được để trống tên truyện!',
            'theloai.required'=>'Không được để trống tên truyện!',
            'tentruyen.unique'=>'Tên truyện đã có xin chọn tên khác!',
            'slug_truyen.unique'=>'Slug truyện đã có xin chọn tên khác!',
            'slug_truyen.required'=>'Slug truyện không thể trống!',
            'tomtattruyen.required'=>'Không được để trống phần mô tả!',
            'hinhanh.required'=> 'Hình ảnh phải có!',
            'tacgia.required'=> 'Hình ảnh phải có!'
        ]
    );
    $data = $request->all();
    $truyen = new Truyen();
    $truyen->tentruyen = $data['tentruyen'];
    $truyen->tacgia = $data['tacgia'];
    $truyen->tukhoa = $data['tukhoa'];
    $truyen->tomtattruyen = $data['tomtattruyen'];
    $truyen->danhmuc_id = $data['danhmuc'];
    $truyen->theloai_id = $data['theloai'];
    $truyen->truyen_noibat = $data['truyennoibat'];
    
    $truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');
    
    foreach($data['danhmuc'] as $key => $danh){
        $truyen->danhmuc_id = $danh[0];
    }

    
    foreach($data['theloai'] as $key => $the){
        $truyen->theloai_id = $the[0];
    }

    $get_image = $request->hinhanh;
    $path = 'public/uploads/truyen/';
    $get_name_image = $get_image->getClientOriginalName();
    $name_image = current(explode('.',$get_name_image));
    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    $get_image->move($path,$new_image);
    
    $truyen->hinhanh = $new_image;

    $truyen->slug_truyen = $data['slug_truyen'];
    $truyen->kichhoat = $data['kichhoat'];
    $truyen->tinhtrang = $data['tinhtrang'];

   
    $truyen->save();

    
    $truyen->thuocnhieudanhmuctruyen()->attach($data['danhmuc']);
    $truyen->thuocnhieutheloaitruyen()->attach($data['theloai']);
    
    return  redirect()->back()->with('status','Thêm truyện thành công!');
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
    { $truyen = Truyen::find($id);
        
        $thuocdanhmuc = $truyen->thuocnhieudanhmuctruyen;
        $thuoctheloai = $truyen->thuocnhieutheloaitruyen;

        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();     
        return view('admincp.truyen.edit')->with(compact('truyen','danhmuc','theloai','thuocdanhmuc','thuoctheloai'));
        
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
        $data = $request->validate(
            [
            'tentruyen'=>'required|max:255',
            'slug_truyen'=>'required|max:255',
           /*  'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000', */
           'tacgia'=>'required',
            'tomtattruyen'=>'required',
            'kichhoat'=>'required',
            'theloai'=>'required',
            'danhmuc' => 'required',
            'theloai' => 'required',
            'tukhoa' => 'required',
            'truyennoibat' =>'required',
            'hoanthien'=>'required'
        ],
        [
            'tentruyen.required'=>'Không được để trống tên truyện!',
            'slug_truyen.required'=>'Slug truyện không thể trống!',
            'tomtattruyen.required'=>'Không được để trống phần mô tả!',
           /*  'hinhanh.required'=> 'Hình ảnh phải có!' */
           'tacgia.required'=> 'Tác giả phải có!',
           'theloai.required'=> 'Tác giả phải có!'
        ]
    );
    $truyen = Truyen::find($id);

    $truyen->thuocnhieudanhmuctruyen()->sync($data['danhmuc']);
    $truyen->thuocnhieutheloaitruyen()->sync($data['theloai']);

    $truyen->tentruyen = $data['tentruyen'];
    $truyen->tukhoa = $data['tukhoa'];
    $truyen->slug_truyen = $data['slug_truyen'];
    $truyen->hoanthien = $data['hoanthien']; 
  
    $truyen->tomtattruyen = $data['tomtattruyen'];
    $truyen->kichhoat = $data['kichhoat'];
    /* $truyen->views = $data['views']; */
    
    $truyen->tacgia = $data['tacgia'];

    $truyen->truyen_noibat = $data['truyennoibat']; 
    foreach($data['danhmuc'] as $key => $danh){
        $truyen->danhmuc_id = $danh[0];
    }
     foreach($data['theloai'] as $key => $the){
        $truyen->theloai_id = $the[0];
    }
    $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
    //them anh vao folder 
    $get_image = $request->hinhanh;
    if($get_image){
        $path = 'public/uploads/truyen/'.$truyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        
        $truyen->hinhanh = $new_image;
    }
    $truyen->save();

    return redirect()->back()->with('status','Cập nhật truyện thành công');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen = Truyen::find($id);
        $path = 'public/uploads/truyen/'.$truyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        $truyen->thuocnhieudanhmuctruyen()->detach($truyen->danhmuc_id);
        $truyen->thuocnhieutheloaitruyen()->detach($truyen->theloai_id);
        // $chapter = Chapter::whereIn('truyen_id',$id)->get();
        // if($chapter->count()>0){
        //     $chapter->delete();
        // }
        Truyen::find($id)->delete();

        return redirect()->back()->with('status','Xóa truyện thành công');
    }
    public function truyennoibat(Request $request){
        $data = $request->all();
        $truyen = Truyen::find($data['truyen_id']);
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->save();
    }
}
