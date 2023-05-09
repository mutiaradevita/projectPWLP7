<?php

namespace App\Http\Controllers;

use App\models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $mahasiswas = Mahasiswa::paginate(5);
        return view('mahasiswas.index', compact('mahasiswas','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create',['kelas' => $kelas]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        ///melakukan validasi data
        $request->validate([
        'Nim' => 'required',
        'Nama' => 'required',
        
        'Tanggal_Lahir' => 'required',
        'Kelas' => 'required',
        'Jurusan' => 'required',
        'Email' => 'required',
        'No_Handphone' => 'required',
        ]);

        if ($request->file('image')) {
            $image_name = $request->file('image')->store('mahasiswa', 'public');
        }

        //fungsi eloquent untuk menambah data
        $mahasiswas = new Mahasiswa;
        $mahasiswas->nim=$request->get("Nim");
        $mahasiswas->nama=$request->get("Nama");
        $mahasiswas->foto=$image_name;
        $mahasiswas->tanggal_lahir=$request->get("Tanggal_Lahir");
        $mahasiswas->jurusan=$request->get("Jurusan");
        $mahasiswas->email=$request->get("Email");
        $mahasiswas->no_handphone=$request->get("No_Handphone");

        //fungsi eloquent untuk menambah data dengan relasi belongs to
        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
           ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($Nim)
    {
        ///menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($Nim);
        $user = Auth::user();
        $kelas = Kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa','user','kelas'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $Nim)
    
    {$mahasiswas = Mahasiswa::with('kelas')->where('Nim',$Nim)->first();
        if ($mahasiswas->foto && file_exists(storage_path('app/public/' . $mahasiswas->foto))) {
            Storage::delete('public/' . $mahasiswas->foto);  
        }
        $image_name = $request->file('image')->store('mahasiswa', 'public');
        //melakukan validasi data
        $request->validate([
        'Nim' => 'required',
        'Nama' => 'required',
        'Tanggal_Lahir' => 'required',
        'Kelas' => 'required',
        'Jurusan' => 'required',
        'Email' => 'required',
        'No_Handphone' => 'required',
        ]);
        //fungsi eloquent untuk mengupdate data inputan kita
        $mahasiswa=Mahasiswa::find($Nim);
        $mahasiswa->nim=$request->get('Nim');
        $mahasiswa->nama=$request->get("Nama");
        $mahasiswa->foto=$image_name;
        $mahasiswa->tanggal_lahir=$request->get("Tanggal_Lahir");
        $mahasiswa->jurusan=$request->get("Jurusan");
        $mahasiswa->email=$request->get("Email");
        $mahasiswa->no_handphone=$request->get("No_Handphone");

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
          ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $Nim
    * @return \Illuminate\Http\Response
    */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswas.index')
        -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function nilai($Nim)
    {
        $mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.nilai', compact('mahasiswa'));
    }

    public function cetak_pdf($Nim){
        $mahasiswa = Mahasiswa::find($Nim);
        $pdf = PDF::loadview('mahasiswas.cetak_pdf', ['mahasiswa'=>$mahasiswa]);
        return $pdf->stream();
    }
};
