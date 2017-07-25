<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    private function findChild($data,$parentId){
        $result=[];
        foreach($data as $row){
            if($row->parent_id==$parentId){
                $new=[];
                $new['id']=$row->id;
                $new['menu']=$row->menu;
                $new['url']=$row->url;
                $new['parent_id']=$row->parent_id;
                $new['child']=self::findChild($data,$row->id);
                array_push($result, $new);
            }
        }
        return $result;
    }

    public function index(){
        $menu=DB::table('menu')->get();
        $menu=self::findChild($menu,0);
        $latest=DB::table('article')->orderBy('updated_at','desc')->where('published','=',1)->limit(10)->get();
        $headline=DB::table('article')->orderBy('updated_at','desc')->where('published','=',1)->where('headline','=',1)->limit(10)->get();
        $slider=DB::table('article')->orderBy('updated_at','desc')->where('published','=',1)->where('slider','=',1)->limit(10)->get();
    	return view('home',['latest'=>$latest,'headline'=>$headline, 'slider'=>$slider, 'menu'=>$menu]);
    }

    public function detail(){
        $menu=DB::table('menu')->get();
        $menu=self::findChild($menu,0);
    	return view('detail',['menu'=>$menu]);
    }

    public function pdf(){
        $menu=DB::table('menu')->get();
        $menu=self::findChild($menu,0);
    	return view('pdf',['menu'=>$menu]);
    }

    public function kontrak(){
        $menu=DB::table('menu')->get();
        $menu=self::findChild($menu,0);
    	return view('kontrak',['menu'=>$menu]);
    }

    public function faq(){
        $menu=DB::table('menu')->get();
        $menu=self::findChild($menu,0);
    	return view('faq',['menu'=>$menu]);
    }

    public function article($slug){
        $menu=DB::table('menu')->get();
        $menu=self::findChild($menu,0);
        $data=DB::table('article')->where('slug','=',$slug)->first();
        // calculate similarity
        $latest=DB::table('article')->orderBy('updated_at','desc')->where('published','=',1)->where('slug','<>',$slug)->limit(100)->get();
        $newarray=[];
        $i=0;
        foreach($latest as $row){
            $newarray[$i]['similarity']=similar_text($data->title, $row->title);
            $newarray[$i]['id']=$row->id;
            $newarray[$i]['slug']=$row->slug;
            $i++;
        }
        usort($newarray, function($a, $b){
            return strcmp($b["similarity"], $a["similarity"]);
        });
        $ids=[];
        foreach($newarray as $row){
            array_push($ids, $row['id']);
        }
        $ids_ordered = implode(',', $ids);
        $related=DB::table('article')->whereIn('id',$ids)->orderByRaw(DB::raw('FIELD(id,'.$ids_ordered.')'))->limit(10)->get();
        $headline=DB::table('article')->orderBy('updated_at','desc')->where('published','=',1)->where('headline','=',1)->limit(10)->get();
        return view('article',['data'=>$data, 'related'=>$related, 'headline'=>$headline, 'menu'=>$menu]);
    }

    public function page($slug){
        $menu=DB::table('menu')->get();
        $menu=self::findChild($menu,0);
        $data=DB::table('page')->where('slug','=',$slug)->first();
        $headline=DB::table('article')->orderBy('updated_at','desc')->where('published','=',1)->where('headline','=',1)->limit(10)->get();
        if($data->layout_code==1){
            return view('layout1',['data'=>$data,'headline'=>$headline,'menu'=>$menu]);
        }else if($data->layout_code==2){
            $list=DB::table('list')->where('page_id','=',$data->id)->get();
            return view('layout2',['data'=>$data,'list'=>$list,'headline'=>$headline,'menu'=>$menu]);
        }else if($data->layout_code==3){
            $list=DB::table('list')->where('page_id','=',$data->id)->get();
            return view('layout3',['data'=>$data,'list'=>$list,'headline'=>$headline,'menu'=>$menu]);
        }else{
            return view('layout4',['data'=>$data,'headline'=>$headline,'menu'=>$menu]);
        }
    }
}
