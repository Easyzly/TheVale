<?php

namespace App\Http\Controllers;

use App\Models\Scene;
use Illuminate\Http\Request;

class SceneController extends Controller
{
    public function index()
    {
        return view('scene.index');
    }

    public function show(Scene $scene)
    {
        $children = $scene->children;
        $redirect = $scene->redirect;

        $data = [
            'scene' => $scene,
            'help' => $scene->help ?? 'your fate is sealed pick the option you want',
            'children' => $children ?? null,
            'redirect' => $redirect ?? null
        ];

        return response()->json($data);
    }
}
