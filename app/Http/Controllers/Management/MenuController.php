<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('management.menu')->with('menus', $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("management.createMenu")->with('categories',$categories);
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
            'name'=> 'required|unique:menus|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);

        //if user does not upload image use noimage.png for the menu
        $imageName = "noimage.png";

        //if the user uploads image
        if($request->image){
            $request->validate([
                'image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            $imageName = date('mdYHis').uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('menu_images'), $imageName);
        }

        //save information to menus table
        $menu = new Menu();
        $menu->name = $request-> name;
        $menu->price = $request->price;
        $menu->image = $imageName;
        $menu->description = $request->description;
        $menu->category_id = $request->category_id;
        $menu->save();

        $request->session()->flash('status', $request->name. ' has been saved successfully');
        return redirect('/management/menu');
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
        $menu = Menu::find($id);
        $categories = Category::all();
        return view('management.editMenu')->with('menu',$menu)->with('categories', $categories);
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
        //information validation
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id'=>'required|numeric'
        ]);

        $menu = Menu::find($id);

        //validate if user uploaded image

        if($request->image){
            $request->validate([
                'image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            if($menu->image != "noimage.png"){
                $imageName = $menu->image;
                unlink(public_path('menu_images').'/'.$imageName);
            }
            $imageName = date('mdYHis').uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('menu_images'), $imageName);
        } else {
            $imageName = $menu->image;
        }

        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->image = $imageName;
        $menu->description = $request->description;
        $menu->category_id = $request->category_id;
        $menu->save();
        $request->session()->flash('status', $request->name. ' has been updated successfully');
        return redirect('/management/menu');

        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        if($menu->image != "noimage.png"){
            unlink(public_path('menu_images').'/'.$menu->image);
        }
        $menuName = $menu->name;
        $menu->delete();
        Session()->flash('status', $menuName. ' has been deleted successfully');
        return redirect('/management/menu');
    }
}
