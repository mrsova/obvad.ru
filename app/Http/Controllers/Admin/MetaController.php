<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meta;

class MetaController extends Controller
{
    public function index()
    {
        $meta = Meta::all();
        return view('admin.meta.index', compact('meta'));
    }

  /*  public function create()
    {
        return view('admin.meta.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required',
        ]);
        $meta = Meta::add($request->all());
        return redirect()->route('meta.index');
    }
  */


    public function edit($id)
    {
        $meta = Meta::find($id);
        return view('admin.meta.edit', compact('meta'));
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
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required',
        ]);
        $meta = Meta::find($id);
        $meta->edit($request->all());
        return redirect()->route('meta.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
   /* public function destroy($id)
    {
        $meta = Meta::find($id);
        $meta->delete();
        return redirect()->back();
    }*/
}
