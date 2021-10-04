<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Theloai;
use App\Models\Info;
use App\Models\ThuocDanh;
use App\Models\ThuocLoai;

class IndexController extends Controller
{
    public function timkiem_ajax(Request $request){
        $data = $request->all();

        if($data['keywords']){

            $truyen = Truyen::where('tinhtrang',0)->where('tentruyen','LIKE','%'.$data['keywords'].'%')->get();

            $output = '
            <ul class="dropdown-menu" style="display:block;">'
            ;

            foreach($truyen as $key => $tr){
             $output .= '
             <li class="li_search_ajax"><a href="#">'.$tr->tentruyen.'</a></li>';
         }

         $output .= '</ul>';
         echo $output;
     }
    }

    public function home(){
       /*  $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(8)->get(); */
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyenxemnhieu = Truyen::where('truyen_noibat',2)->take(20)->get();
        $truyendecu = Truyen::where('truyen_noibat',3)->take(20)->get();
        $truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->get();
        $slide_truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
        return view('pages.home')->with(compact('slide_truyen','danhmuc','truyen','theloai','truyenxemnhieu','truyendecu'));
    }
    public function danhmuc($slug){
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc',$slug)->first();
        $truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->where('danhmuc_id',$danhmuc_id->id)->get();
        $tendanhmuc =  $danhmuc_id->tendanhmuc;
        return view('pages.danhmuc')->with(compact('slide_truyen','danhmuc','truyen','theloai','tendanhmuc'));
    }
    public function theloai($slug){
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $theloai_id = Theloai::where('slug_theloai',$slug)->first();
        $truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->where('theloai_id',$theloai_id->id)->get();
        $tentheloai =  $theloai_id->tentheloai;
        return view('pages.theloai')->with(compact('slide_truyen','danhmuc','truyen','theloai','tentheloai'));
    }
    public function xemtruyen($slug){
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen = Truyen::with('danhmuctruyen','theloai')->where('slug_truyen',$slug)->where('kichhoat',0)->first();
        $chapter = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->get();
        $chapter_dau = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        $chapter_cuoi = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->first();
        $cungdanhmuc = Truyen::with('danhmuctruyen','theloai')->where('danhmuc_id',$truyen->danhmuctruyen->id)->whereNotIn('id',[$truyen->id])->get();
        $truyenxemnhieu = Truyen::where('truyen_noibat',2)->take(20)->get();
        $truyendecu = Truyen::where('truyen_noibat',3)->take(20)->get();
        return view('pages.truyen')->with(compact('truyendecu','truyenxemnhieu','slide_truyen','danhmuc','truyen','chapter','cungdanhmuc','chapter_dau','theloai','chapter_cuoi'));
    }
    public function xemchapter($slug){
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $truyen = Chapter::where('slug_chapter',$slug)->first();    
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $chapter = Chapter::with('truyen')->where('slug_chapter',$slug)->where('truyen_id',$truyen->truyen_id)->first();
        $tatca_chapter = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->truyen_id)->get();
        $chapter_sau = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug_chapter');
        $chapter_truoc = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug_chapter');  
    	$max_id =  Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
    	$min_id =  Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();
        //breadrumb
        $truyen_breadrumb = Truyen::with('danhmuctruyen','theloai')->where('id',$truyen->truyen_id)->first();
        //end
        return view('pages.chapter')->with(compact('slide_truyen','truyen_breadrumb','danhmuc','chapter','tatca_chapter','chapter_sau','chapter_truoc','max_id','min_id','theloai'));
    }
    public function timkiem(){
        $slide_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $tukhoa = $_GET['tukhoa'];
        $truyen = Truyen::with('danhmuctruyen','theloai')->where('tentruyen','LIKE','%'.$tukhoa.'%')->Orwhere('tomtattruyen','LIKE','%'.$tukhoa.'%')->Orwhere('tacgia','LIKE','%'.$tukhoa.'%')->get();
        return view('pages.timkiem')->with(compact('slide_truyen','danhmuc','truyen','theloai','tukhoa'));
    }
    public function tag($tag){
        $info = Info::find(1);
        $title = 'Tìm kiếm từ khóa';

        $meta_desc = 'Tìm kiếm từ khóa';
        $meta_keywords = 'Tìm kiếm từ khóa';
 
        
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $tags = explode("-", $tag);
       
        $truyen = Truyen::with('thuocnhieudanhmuctruyen','thuocnhieutheloaitruyen')->where(
            function ($query) use($tags) {
            for ($i = 0; $i < count($tags); $i++){
                $query->orwhere('tukhoa', 'like',  '%' . $tags[$i] .'%');
            }
            })->paginate(12);

        return view('pages.tag')->with(compact('danhmuc','truyen','theloai','slide_truyen','tag','info','title','meta_desc','meta_keywords'));
    }
}
