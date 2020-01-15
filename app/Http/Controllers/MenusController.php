<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        // $menus = Menu::where('parent_id', '=', 'id')->get();
        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('menu.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //* Cara pertama
        // $menu = new Menu;
        // $menu->title = $request->title;
        // $menu->parent_id = $request->parent_id;
        // $menu->url = $request->url;
        // $menu->icon = $request->icon;

        // $menu->save();

        // validasi form
        $request->validate([
            'title' => 'required',
            'parent_id' => 'required',
            'url' => 'required',
            'icon' => 'required'
        ]);

        //* Cara Kedua dengan model. Mass Assiment (menambah fillable)
        Menu::create([
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'url' => $request->url,
            'icon' => $request->icon,
            'order' => $request->order,
            'is_active' => $request->is_active
        ]);

        //hanya satu baris (kalo udah manambah fillable)


        // insert versi cepat
        // Menu::create($request->all());

        return redirect('/menus')->with('status', 'Data menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'icon' => 'required'
        ]);

        Menu::where('id', $menu->id)
            ->update([
                'title' => $request->title,
                'parent_id' => $request->parent_id,
                'url' => $request->url,
                'icon' => $request->icon,
                'is_active' => $request->is_active
            ]);

        return redirect('/menus')->with('status', 'Data menu berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);

        return redirect('/menus')->with('status', 'Data menu berhasil dihapus!');
    }

    public function showSortMenu()
    {
        $menus = Menu::orderBy('order', 'ASC')->select('id', 'title', 'created_at')->where('parent_id', '=', 0)->get();

        return view('menu.sort-menu', compact('menus'));
    }

    public function updateOrder(Request $request)
    {
        $menus = Menu::all();

        foreach ($menus as $task) {
            $task->timestamps = false; // To disable update_at field updation
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order' => $order['position']]);
                }
            }
        }
        // return response('Update Successfully.', 200);
        $request->session()->flash('status', 'Urutan Menu berhasil diubah!');
    }
}
