<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class AdminController extends Controller
{
	private $perPage=10;
    public function index(){
    	return redirect('admin/page/index');
    }
    public function getSlug(Request $request, $what){
    	$title=$request->input('slug');
    	$slug=str_replace(' ', '_', $title);
    	if($what=='page'){
    		$cek=DB::table('page')->where('title','=',$title)->count();
    		if($cek > 0){
    			$slug.=$cek+1;
    		}
    	}else{
    		$cek=DB::table('article')->where('title','=',$title)->count();
    		if($cek > 0){
    			$slug.=$cek+1;
    		}
    	}
    	return $slug;
    }
    // PAGE
    public function pageIndex(){
    	$data=DB::table('page')->orderBy('updated_at','desc')->paginate($this->perPage);
    	return view('admin.index',['data'=>$data]);
    }
    public function pageAdd(){
    	return view('admin.page_add');	
    }
    public function pageInsert(Request $request){
        $file='';
        if($request->hasFile('upload')){
            $file=date('Y-m-d_H-i-s').'.'.$request->file('upload')->getClientOriginalName();
            Storage::putFileAs('public/files', $request->file('upload'), $file);
        }
    	DB::table('page')->insert([
    		'title'			=> $request->input('title'),
    		'slug'			=> $request->input('slug'),
    		'content'		=> $request->input('content'),
            'file'          => $file,
            'layout_code'   => $request->input('layout_code'),
    		'created_at'	=> date('Y-m-d H:i:s'),
    		'updated_at'	=> date('Y-m-d H:i:s'),
    	]);
        $last=DB::table('page')->orderBy('id','desc')->first();
        if($request->input('layout_code')==2 || $request->input('layout_code')==3){
            $i=0;
            foreach($request->input('list') as $row){
                $file='';
                if(!empty($request->file('file'))){
                    $file=date('Y-m-d_H-i-s').'.'.$request->file('file')[$i]->getClientOriginalName();
                    Storage::putFileAs('public/files', $request->file('file')[$i], $file);
                }
                DB::table('list')->insert([
                    'list'          => $row,
                    'description'   => $request->input('list')[$i],
                    'file'          => $file,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'page_id'       => $last->id,
                ]);
                $i++;
            }
        }
    	return redirect('admin/page/index');
    }
    public function pageEdit($id){
    	$data=DB::table('page')->where('id','=',$id)->first();
        $list=DB::table('list')->where('page_id','=',$id)->get();
    	return view('admin.page_edit',['data'=>$data, 'list'=>$list]);	
    }
    public function pageUpdate(Request $request, $id){
        $file='';
        if($request->hasFile('upload')){
            $file=date('Y-m-d_H-i-s').'.'.$request->file('upload')->getClientOriginalName();
            Storage::putFileAs('public/files', $request->file('upload'), $file);
            DB::table('page')->where('id','=',$id)->update([
                'title'         => $request->input('title'),
                'slug'          => $request->input('slug'),
                'content'       => $request->input('content'),
                'file'          => $file,
                'layout_code'   => $request->input('layout_code'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }else{
            DB::table('page')->where('id','=',$id)->update([
                'title'         => $request->input('title'),
                'slug'          => $request->input('slug'),
                'content'       => $request->input('content'),
                'layout_code'   => $request->input('layout_code'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
    	if($request->input('layout_code')==2 || $request->input('layout_code')==3){
            $i=0;
            foreach($request->input('list') as $row){
                $file='';
                if(!empty($request->file('file'))){
                    $file=date('Y-m-d_H-i-s').'.'.$request->file('file')[$i]->getClientOriginalName();
                    Storage::putFileAs('public/files', $request->file('file')[$i], $file);
                }
                DB::table('list')->insert([
                    'list'          => $row,
                    'description'   => $request->input('list')[$i],
                    'file'          => $file,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'page_id'       => $id,
                ]);
                $i++;
            }
        }
    	return redirect('admin/page/index');
    }
    public function pageDelete($id){
        $data=DB::table('page')->where('id','=',$id)->first();
        if($data->file != null || $data->file!=''){
            Storage::delete('public/files/'.$data->file);
        }
    	DB::table('page')->where('id','=',$id)->delete();

        $data=DB::table('list')->where('page_id','=',$id)->get();
        foreach($data as $row){
            if($row->file != null || $row->file!=''){
                Storage::delete('public/files/'.$row->file);
            }
        }
        DB::table('list')->where('page_id','=',$id)->delete();
    	return redirect('admin/page/index');
    }
    public function listDelete($id){
        $data=DB::table('list')->where('id','=',$id)->first();
        if($data->file != null || $data->file!=''){
            Storage::delete('public/files/'.$data->file);
        }
        DB::table('list')->where('id','=',$id)->delete();
        return 200;
    }
    // ARTICLE
    public function articleIndex(){
    	$data=DB::table('article')->orderBy('updated_at','desc')->paginate($this->perPage);
    	return view('admin.article_index',['data'=>$data]);
    }
    public function articleAdd(){
    	$category=DB::table('category')->get();
    	return view('admin.article_add',['category'=>$category]);	
    }
    public function articleInsert(Request $request){
        $img='';
        if($request->hasFile('upload')){
            $img=date('Y-m-d_H-i-s').'.'.$request->file('upload')->getClientOriginalName();
            Storage::putFileAs('public/images', $request->file('upload'), $img);
        }
    	DB::table('article')->insert([
    		'title'			=> $request->input('title'),
    		'slug'			=> $request->input('slug'),
    		'content'		=> $request->input('content'),
    		'img'			=> $img,
    		'category_id'	=> $request->input('category_id'),
    		'published'		=> $request->input('published'),
    		'headline'		=> $request->input('headline'),
            'slider'        => $request->input('slider'),
    		'created_at'	=> date('Y-m-d H:i:s'),
    		'updated_at'	=> date('Y-m-d H:i:s'),
    	]);
    	return redirect('admin/article/index');
    }
    public function articleEdit($id){
    	$data=DB::table('article')->where('id','=',$id)->first();
    	$category=DB::table('category')->get();
    	return view('admin.article_edit',['data'=>$data,'category'=>$category]);	
    }
    public function articleUpdate(Request $request, $id){
        if($request->hasFile('upload')){
            $img=date('Y-m-d_H-i-s').'.'.$request->file('upload')->getClientOriginalName();
            Storage::putFileAs('public/images', $request->file('upload'), $img);
            DB::table('article')->where('id','=',$id)->update([
                'title'         => $request->input('title'),
                'slug'          => $request->input('slug'),
                'content'       => $request->input('content'),
                'img'           => $img,
                'category_id'   => $request->input('category_id'),
                'published'     => $request->input('published'),
                'headline'      => $request->input('headline'),
                'slider'        => $request->input('slider'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }else{
            DB::table('article')->where('id','=',$id)->update([
                'title'         => $request->input('title'),
                'slug'          => $request->input('slug'),
                'content'       => $request->input('content'),
                'category_id'   => $request->input('category_id'),
                'published'     => $request->input('published'),
                'headline'      => $request->input('headline'),
                'slider'        => $request->input('slider'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
    	return redirect('admin/article/index');
    }
    public function articleDelete($id){
        $data=DB::table('article')->where('id','=',$id)->first();
        if($data->img != null || $data->img!=''){
            Storage::delete('public/images/'.$data->img);
        }
    	DB::table('article')->where('id','=',$id)->delete();
    	return redirect('admin/article/index');
    }
    // CATEGORY
    public function categoryIndex(){
    	$data=DB::table('category')->orderBy('updated_at','desc')->paginate($this->perPage);
    	return view('admin.category_index',['data'=>$data]);
    }
    public function categoryAdd(){
    	$category=DB::table('category')->get();
    	return view('admin.category_add',['category'=>$category]);	
    }
    public function categoryInsert(Request $request){
    	DB::table('category')->insert([
    		'category'		=> $request->input('category'),
    		'created_at'	=> date('Y-m-d H:i:s'),
    		'updated_at'	=> date('Y-m-d H:i:s'),
    	]);
    	return redirect('admin/category/index');
    }
    public function categoryEdit($id){
    	$data=DB::table('category')->where('id','=',$id)->first();
    	$category=DB::table('category')->get();
    	return view('admin.category_edit',['data'=>$data,'category'=>$category]);	
    }
    public function categoryUpdate(Request $request, $id){
    	DB::table('category')->where('id','=',$id)->update([
    		'category'		=> $request->input('category'),
    		'updated_at'	=> date('Y-m-d H:i:s'),
    	]);
    	return redirect('admin/category/index');
    }
    public function categoryDelete($id){
    	DB::table('category')->where('id','=',$id)->delete();
    	return redirect('admin/category/index');
    }
    // MENU
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

    public function menuIndex(){
        $menu=DB::table('menu')->get();
        $data=self::findChild($menu,0);
        return view('admin.menu_index',['data'=>$data, 'menu'=>$menu]);
    }

    public function menuInsert(Request $request){
        DB::table('menu')->insert([
            'menu'  => $request->input('menu'),
            'url'  => $request->input('url'),
            'parent_id'  => $request->input('parent_id'),
        ]);
        return redirect('admin/menu/index');
    }

    public function menuEdit($id){
        $data=DB::table('menu')->where('id','=',$id)->first();
        $response=[];
        $response['status']=200;
        $response['data']['id']=$data->id;
        $response['data']['menu']=$data->menu;
        $response['data']['url']=$data->url;
        return json_encode($response);
    }

    public function menuUpdate(Request $request, $id){
        DB::table('menu')->where('id','=',$id)->update([
            'menu'  => $request->input('menu'),
            'url'  => $request->input('url'),
        ]);
        return redirect('admin/menu/index');
    }

    public function menuDelete($id){
        $data=DB::table('menu')->where('id','=',$id)->delete();
        $response=[];
        $response['status']=200;
        return json_encode($response);
    }
}
