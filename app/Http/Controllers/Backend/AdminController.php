<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('backend.admin.index');
    }

    public function create()
    {
        return view('backend.admin.create');
    }

    public function store(Request $req)
    {
        $admin = new Admin();
        $admin->name = $req->name;
        $admin->email = $req->email;
        $admin->phone = $req->phone;
        $admin->address = $req->address;
        $admin->city = $req->city;
        $admin->country = $req->country;
        $admin->role = $req->role;
        $filename = sprintf('admin_%s.jpg',random_int(1,1000));
        if($req->hasFile('image'))
            $filename = $req->file('image')->storeAs('admin',$filename, 'public');
        else
            $filename = "photos/dummy.jpg";

        $admin->image = $filename;

        $admin->save();
        Flashy::success('Admin Created Successfully');
        return redirect()->route('admin.index');
    }

}
