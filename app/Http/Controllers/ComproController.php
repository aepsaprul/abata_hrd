<?php

namespace App\Http\Controllers;

use App\Models\ComproCabang;
use App\Models\ComproGabung;
use App\Models\ComproKontak;
use App\Models\ComproPartner;
use App\Models\ComproProduk;
use App\Models\ComproTentang;
use App\Models\ComproTestimoni;
use App\Models\ComproTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class ComproController extends Controller
{
    // tentang
    public function tentang()
    {
        $tentang = ComproTentang::get();

        return view('pages.compro.tentang.index', [
            'tentangs' => $tentang
        ]);
    }
    
    public function tentangStore(Request $request)
    {
        $tentang = new ComproTentang;
        $tentang->nama = $request->create_nama;
        $tentang->deskripsi = $request->create_deskripsi;
        $tentang->grup = $request->create_grup;
        $tentang->save();

        return redirect()->route('compro.tentang');
    }

    public function tentangEdit($id)
    {
        $tentang = ComproTentang::find($id);

        return view('pages.compro.tentang.edit', ['tentang' => $tentang]);
    }

    public function tentangUpdate(Request $request)
    {
        $tentang = ComproTentang::find($request->edit_id);
        $tentang->nama = $request->edit_nama;
        $tentang->deskripsi = $request->edit_deskripsi;
        $tentang->grup = $request->edit_grup;
        $tentang->save();

        return redirect()->route('compro.tentang');
    }

    public function tentangDelete(Request $request)
    {
        $tentang = ComproTentang::find($request->id);
        $tentang->delete();

        return response()->json([
            'status' => 200
        ]);
    }

    // kontak
    public function kontak()
    {
        $kontak = ComproKontak::get();

        return view('pages.compro.kontak.index', ['kontaks' => $kontak]);
    }

    public function kontakStore(Request $request)
    {
        $kontak = new ComproKontak;
        $kontak->img = $request->create_img;
        $kontak->nomor = $request->create_nomor;
        $kontak->link = $request->create_link;
        $kontak->grup = $request->create_grup;
        $kontak->save();

        return redirect()->route('compro.kontak');
    }

    public function kontakEdit($id)
    {
        $kontak = ComproKontak::find($id);

        return view('pages.compro.kontak.edit', ['kontak' => $kontak]);
    }

    public function kontakUpdate(Request $request)
    {
        $kontak = ComproKontak::find($request->edit_id);
        $kontak->img = $request->edit_img;
        $kontak->nomor = $request->edit_nomor;
        $kontak->link = $request->edit_link;
        $kontak->grup = $request->edit_grup;
        $kontak->save();

        return redirect()->route('compro.kontak');
    }

    public function kontakDelete(Request $request)
    {
        $kontak = ComproKontak::find($request->id);
        $kontak->delete();

        return redirect()->route('compro.kontak');
    }

    // cabang
    public function cabang()
    {
        $cabang = ComproCabang::get();

        return view('pages.compro.cabang.index', ['cabangs' => $cabang]);
    }

    public function cabangStore(Request $request)
    {
        $cabang = new ComproCabang;
        $cabang->grup = $request->create_grup;
        $cabang->nama = $request->create_nama;
        $cabang->alamat = $request->create_alamat;
        $cabang->kontak = $request->create_kontak;
        $cabang->maps = $request->create_maps;
        $cabang->save();

        return redirect()->route('compro.cabang');
    }

    public function cabangEdit($id)
    {
        $cabang = ComproCabang::find($id);

        return view('pages.compro.cabang.edit', ['cabang' => $cabang]);
    }

    public function cabangUpdate(Request $request)
    {
        $cabang = ComproCabang::find($request->edit_id);
        $cabang->grup = $request->edit_grup;
        $cabang->nama = $request->edit_nama;
        $cabang->alamat = $request->edit_alamat;
        $cabang->kontak = $request->edit_kontak;
        $cabang->maps = $request->edit_maps;
        $cabang->save();

        return redirect()->route('compro.cabang');
    }

    public function cabangDelete(Request $request)
    {
        $cabang = ComproCabang::find($request->id);
        $cabang->delete();

        return redirect()->route('compro.cabang');
    }

    // testimoni
    public function testimoni()
    {
        $testimoni = ComproTestimoni::get();

        return view('pages.compro.testimoni.index', ['testimonis' => $testimoni]);
    }

    public function testimoniStore(Request $request)
    {
        $testimoni = new ComproTestimoni;
        $testimoni->grup = $request->create_grup;
        $testimoni->nama = $request->create_nama;
        $testimoni->komentar = $request->create_komentar;

        // dev
        if($request->hasFile('create_foto')) {
            $file = $request->file('create_foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('public/compro/testimoni/', $filename);
            $testimoni->foto = $filename;
        }

        // prod
        // if($request->hasFile('create_foto')) {
        //     $file = $request->file('create_foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . "." . $extension;
        //     $file->move('compro/testimoni/', $filename);
        //     $testimoni->foto = $filename;
        // }
        
        $testimoni->save();

        return redirect()->route('compro.testimoni');
    }

    public function testimoniEdit($id)
    {
        $testimoni = ComproTestimoni::find($id);

        return view('pages.compro.testimoni.edit', ['testimoni' => $testimoni]);
    }

    public function testimoniUpdate(Request $request)
    {
        $testimoni = ComproTestimoni::find($request->edit_id);
        $testimoni->grup = $request->edit_grup;
        $testimoni->nama = $request->edit_nama;
        $testimoni->komentar = $request->edit_komentar;

        // dev
        if($request->hasFile('edit_foto')) {
            if (file_exists("public/compro/testimoni/" . $testimoni->foto)) {
                File::delete("public/compro/testimoni/" . $testimoni->foto);
            }
            $file = $request->file('edit_foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('public/compro/testimoni/', $filename);
            $testimoni->foto = $filename;
        }

        // prod
        // if($request->hasFile('edit_foto')) {
        //     if (file_exists("compro/testimoni/" . $testimoni->foto)) {
        //         File::delete("compro/testimoni/" . $testimoni->foto);
        //     }
        //     $file = $request->file('edit_foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . "." . $extension;
        //     $file->move('compro/testimoni/', $filename);
        //     $testimoni->foto = $filename;
        // }

        $testimoni->save();

        return redirect()->route('compro.testimoni');
    }

    public function testimoniDelete(Request $request)
    {
        $testimoni = ComproTestimoni::find($request->id);

        // dev
        if (file_exists("public/compro/testimoni/" . $testimoni->foto)) {
            File::delete("public/compro/testimoni/" . $testimoni->foto);
        }

        // prod
        // if (file_exists("compro/testimoni" . $testimoni->foto)) {
        //     File::delete("compro/testimoni" . $testimoni->foto);
        // }

        $testimoni->delete();

        return redirect()->route('compro.testimoni');
    }

    public function produk()
    {
      $produk = ComproProduk::get();

      return view('pages.compro.produk.index', ['produks' => $produk]);
    }

    public function produkStore(Request $request)
    {
      $produk = new ComproProduk;
      $produk->grup = $request->create_grup;
      $produk->nama_produk = $request->create_nama_produk;
      
      // dev
      if($request->hasFile('create_gambar')) {
        $file = $request->file('create_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/produk/', $filename);
        $produk->gambar = $filename;
      }

      // prod
      // if($request->hasFile('create_gambar')) {
      //     $file = $request->file('create_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/produk/', $filename);
      //     $produk->gambar = $filename;
      // }

      $produk->save();

      return redirect()->route('compro.produk');
    }

    public function produkEdit($id)
    {
      $produk = ComproProduk::find($id);
      
      return view('pages.compro.produk.edit', ['produk' => $produk]);
    }

    public function produkUpdate(Request $request)
    {
      $produk = ComproProduk::find($request->edit_id);
      $produk->grup = $request->edit_grup;
      $produk->nama_produk = $request->edit_nama_produk;
      
      // dev
      if($request->hasFile('edit_gambar')) {
        if (file_exists("public/compro/produk/" . $produk->gambar)) {
            File::delete("public/compro/produk/" . $produk->gambar);
        }
        $file = $request->file('edit_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/produk/', $filename);
        $produk->gambar = $filename;
      }

      // prod
      // if($request->hasFile('edit_gambar')) {
      //     if (file_exists("compro/produk/" . $produk->gambar)) {
      //         File::delete("compro/produk/" . $produk->gambar);
      //     }
      //     $file = $request->file('edit_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/produk/', $filename);
      //     $produk->gambar = $filename;
      // }
      
      $produk->save();

      return redirect()->route('compro.produk');
    }

    public function produkDelete(Request $request)
    {
      $produk = ComproProduk::find($request->id);

      // dev
      if (file_exists("public/compro/produk/" . $produk->gambar)) {
        File::delete("public/compro/produk/" . $produk->gambar);
      }

      // prod
      // if (file_exists("compro/produk" . $produk->gambar)) {
      //     File::delete("compro/produk" . $produk->gambar);
      // }
      
      $produk->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // gabung
    public function gabung()
    {
      $gabung = ComproGabung::get();

      return view('pages.compro.gabung.index', ['gabungs' => $gabung]);
    }

    public function gabungStore(Request $request)
    {
      $gabung = new ComproGabung;
      $gabung->grup = $request->create_grup;
      $gabung->nama = $request->create_nama;
      $gabung->deskripsi = $request->create_deskripsi;

      // dev
      if($request->hasFile('create_gambar')) {
        $file = $request->file('create_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/gabung/', $filename);
        $gabung->gambar = $filename;
      }

      // prod
      // if($request->hasFile('create_gambar')) {
      //     $file = $request->file('create_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/gabung/', $filename);
      //     $gabung->gambar = $filename;
      // }

      $gabung->save();

      return redirect()->route('compro.gabung');
    }

    public function gabungEdit($id)
    {
      $gabung = ComproGabung::find($id);

      return view('pages.compro.gabung.edit', ['gabung' => $gabung]);
    }

    public function gabungUpdate(Request $request)
    {
      $gabung = ComproGabung::find($request->edit_id);
      $gabung->grup = $request->edit_grup;
      $gabung->nama = $request->edit_nama;
      $gabung->deskripsi = $request->edit_deskripsi;

      // dev
      if($request->hasFile('edit_gambar')) {
        if (file_exists("public/compro/gabung/" . $gabung->gambar)) {
            File::delete("public/compro/gabung/" . $gabung->gambar);
        }
        $file = $request->file('edit_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/gabung/', $filename);
        $gabung->gambar = $filename;
      }

      // prod
      // if($request->hasFile('edit_gambar')) {
      //     if (file_exists("compro/gabung/" . $gabung->gambar)) {
      //         File::delete("compro/gabung/" . $gabung->gambar);
      //     }
      //     $file = $request->file('edit_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/gabung/', $filename);
      //     $gabung->gambar = $filename;
      // }

      $gabung->save();

      return redirect()->route('compro.gabung');
    }

    public function gabungDelete(Request $request)
    {
      $gabung = ComproGabung::find($request->id);

      // dev
      if (file_exists("public/compro/gabung/" . $gabung->gambar)) {
        File::delete("public/compro/gabung/" . $gabung->gambar);
      }

      // prod
      // if (file_exists("compro/gabung" . $gabung->gambar)) {
      //     File::delete("compro/gabung" . $gabung->gambar);
      // }

      $gabung->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // tim
    public function tim()
    {
      $tim = ComproTim::get();

      return view('pages.compro.tim.index', ['tims' => $tim]);
    }

    public function timStore(Request $request)
    {
      $tim = new ComproTim;
      $tim->grup = $request->create_grup;
      $tim->nama = $request->create_nama;
      $tim->jabatan = $request->create_jabatan;
      $tim->deskripsi = $request->create_deskripsi;

      // dev
      if($request->hasFile('create_foto')) {
        $file = $request->file('create_foto');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/tim/', $filename);
        $tim->foto = $filename;
      }

      // prod
      // if($request->hasFile('create_foto')) {
      //     $file = $request->file('create_foto');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/tim/', $filename);
      //     $tim->foto = $filename;
      // }

      $tim->save();

      return redirect()->route('compro.tim');
    }

    public function timEdit($id)
    {
      $tim = ComproTim::find($id);

      return view('pages.compro.tim.edit', ['tim' => $tim]);
    }

    public function timUpdate(Request $request)
    {
      $tim = ComproTim::find($request->edit_id);
      $tim->grup = $request->edit_grup;
      $tim->nama = $request->edit_nama;
      $tim->jabatan = $request->edit_jabatan;
      $tim->deskripsi = $request->edit_deskripsi;
      
      // dev
      if($request->hasFile('edit_foto')) {
        if (file_exists("public/compro/tim/" . $tim->foto)) {
            File::delete("public/compro/tim/" . $tim->foto);
        }
        $file = $request->file('edit_foto');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/tim/', $filename);
        $tim->foto = $filename;
      }

      // prod
      // if($request->hasFile('edit_foto')) {
      //     if (file_exists("compro/tim/" . $tim->foto)) {
      //         File::delete("compro/tim/" . $tim->foto);
      //     }
      //     $file = $request->file('edit_foto');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/tim/', $filename);
      //     $tim->foto = $filename;
      // }

      $tim->save();

      return redirect()->route('compro.tim');
    }

    public function timDelete(Request $request)
    {
      $tim = ComproTim::find($request->id);

      // dev
      if (file_exists("public/compro/tim/" . $tim->foto)) {
        File::delete("public/compro/tim/" . $tim->foto);
      }

      // prod
      // if (file_exists("compro/tim" . $tim->foto)) {
      //     File::delete("compro/tim" . $tim->foto);
      // }

      $tim->delete();

      return redirect()->route('compro.tim');
    }

    // partner
    public function partner()
    {
      $partner = ComproPartner::get();

      return view('pages.compro.partner.index', ['partners' => $partner]);
    }

    public function partnerStore(Request $request)
    {
      $partner = new ComproPartner;
      $partner->grup = $request->create_grup;
      $partner->nama = $request->create_nama;

      // dev
      if($request->hasFile('create_gambar')) {
        $file = $request->file('create_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/partner/', $filename);
        $partner->gambar = $filename;
      }

      // prod
      // if($request->hasFile('create_gambar')) {
      //     $file = $request->file('create_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/partner/', $filename);
      //     $partner->gambar = $filename;
      // }

      $partner->save();

      return redirect()->route('compro.partner');
    }

    public function partnerEdit($id)
    {
      $partner = ComproPartner::find($id);

      return view('pages.compro.partner.edit', ['partner' => $partner]);
    }

    public function partnerUpdate(Request $request)
    {
      $partner = ComproPartner::find($request->edit_id);
      $partner->grup = $request->edit_grup;
      $partner->nama = $request->edit_nama;

      // dev
      if($request->hasFile('edit_gambar')) {
        if (file_exists("public/compro/partner/" . $partner->gambar)) {
            File::delete("public/compro/partner/" . $partner->gambar);
        }
        $file = $request->file('edit_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/partner/', $filename);
        $partner->gambar = $filename;
      }

      // prod
      // if($request->hasFile('edit_gambar')) {
      //     if (file_exists("compro/partner/" . $partner->gambar)) {
      //         File::delete("compro/partner/" . $partner->gambar);
      //     }
      //     $file = $request->file('edit_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/partner/', $filename);
      //     $partner->gambar = $filename;
      // }

      $partner->save();

      return redirect()->route('compro.partner');
    }

    public function partnerDelete(Request $request)
    {
      $partner = ComproPartner::find($request->id);
      $partner->delete();

      return response()->route('compro.partner');
    }
}
