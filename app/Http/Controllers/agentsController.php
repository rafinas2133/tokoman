<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use Auth;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Storage;
use Validator;

class agentsController extends Controller
{
    public function index()
    {
        $agents = Agents::all();
        return view('agents.index', compact('agents'));
    }

    public function add()
    {
        return view('agents.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'address' => 'required',
                'images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'noTelp' => 'required|numeric',
            ],
            [
                'noTelp.numeric' => 'No.Telepon harus angka',
                'name.required' => 'Nama wajib diisi.',
                'address.required' => 'Alamat wajib diisi.',
                'images.required' => 'Gambar wajib diunggah.',
                'noTelp.required' => 'Nomor telepon wajib diisi.',
                'images.image' => 'File harus berupa gambar.',
                'images.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
                'max.max' => 'Ukuran gambar tidak boleh lebih dari 2048 kilobytes.'
            ]
        );
        if ($validator->fails()) {
            return redirect('/agents')->with('error', $validator->errors()->first());
        }

        $file = $request->file('images');
        $filename = '-' . time() . '.' . $file->getClientOriginalExtension();
        Storage::disk('s3')->put('agents/' . $filename, file_get_contents($file));

        $agents = new Agents([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'images' => $filename,
            'noTelp' => $request->get('noTelp'),
        ]);

        //begin pusher
        $generatePusher = new pegawaiController();
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), config('broadcasting.connections.pusher.options'));
        $pusher->trigger('agent-channel', 'my-event', [
            'massage' => (Auth::user()->role_id == 0 ? 'Admin ' : 'Pegawai ') . Auth::user()->name .
                ' berhasil menambahkan agent ' . $agents->name,
            'user' => $generatePusher->generateDataPusher(Auth::user()),
            'id' => $agents->id,
        ]);

        $agents->save();

        return redirect('/agents')->with('success', 'agents saved!');
    }

    public function show(Agents $agents)
    {
        return view('agents.show', compact('agents'));
    }

    public function edit($id)
    {
        $agents=Agents::where('id',$id)->first();
        if(!$agents)
        return redirect()->route('agents.')->with('error','Agent not found');
        return view('agents.edit', compact('agents'));
    }

    public function update(Request $request, Agents $agents)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'address' => 'required',
                'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'noTelp' => 'required|numeric',
            ],
            [
                'noTelp.numeric' => 'No.Telepon harus angka',
                'name.required' => 'Nama wajib diisi.',
                'address.required' => 'Alamat wajib diisi.',
                'noTelp.required' => 'Nomor telepon wajib diisi.',
                'images.image' => 'File harus berupa gambar.',
                'images.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
                'images.max' => 'Ukuran gambar tidak boleh lebih dari 2048 kilobytes.'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $oldNama = $agents->name;
        $agents->update([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'noTelp' => $request->get('noTelp'),
        ]);

        if ($request->hasFile('images')) {
            $nameold = $agents->images;
            $file = $request->file('images');
            Storage::disk('s3')->delete('agents/' . $nameold);
            $filename = '-' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('s3')->put('agents/' . $filename, file_get_contents($file));
            $agents->images = $filename;
            $agents->save();
        }

        //begin pusher
        $generatePusher = new pegawaiController();
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), config('broadcasting.connections.pusher.options'));
        $pusher->trigger('agent-channel', 'my-event', [
            'massage' => (Auth::user()->role_id == 0 ? 'Admin ' : 'Pegawai ') . Auth::user()->name .
                ' berhasil mengubah agent ' . $oldNama,
            'user' => $generatePusher->generateDataPusher(Auth::user()),
            'id' => $agents->id,
        ]);

        return redirect()->back()->with('success', 'agents updated!');
    }

    public function destroy(Agents $agents)
    {
        $agents->delete();
        $generatePusher = new pegawaiController();
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), config('broadcasting.connections.pusher.options'));
        $pusher->trigger('agent-channel', 'my-event', [
            'massage' => (Auth::user()->role_id == 0 ? 'Admin ' : 'Pegawai ') . Auth::user()->name .
                ' berhasil menghapus agent ' . $agents->name,
            'user' => $generatePusher->generateDataPusher(Auth::user()),
            'id' => $agents->id,
        ]);
        return redirect('/agents')->with('success', 'agents deleted!');
    }
}

