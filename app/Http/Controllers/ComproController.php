<?php

namespace App\Http\Controllers;

use App\Models\ComproBlog;
use App\Models\ComproCabang;
use App\Models\ComproGabung;
use App\Models\ComproKontak;
use App\Models\ComproKontakForm;
use App\Models\ComproLegal;
use App\Models\ComproPartner;
use App\Models\ComproPelanggan;
use App\Models\ComproProduk;
use App\Models\ComproSlide;
use App\Models\ComproTentang;
use App\Models\ComproTestimoni;
use App\Models\ComproTim;
use Complex\Complex;
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
        $kontak_form = ComproKontakForm::get();

        return view('pages.compro.kontak.index', ['kontaks' => $kontak, 'kontak_forms' => $kontak_form]);
    }

    public function kontakStore(Request $request)
    {
        $kontak = new ComproKontak;
        $kontak->icon = $request->create_icon;
        $kontak->title = $request->create_title;
        $kontak->deskripsi = $request->create_deskripsi;
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
        $kontak->icon = $request->edit_icon;
        $kontak->title = $request->edit_title;
        $kontak->deskripsi = $request->edit_deskripsi;
        $kontak->grup = $request->edit_grup;
        $kontak->save();

        return redirect()->route('compro.kontak');
    }

    public function kontakDelete(Request $request)
    {
        $kontak = ComproKontak::find($request->id);
        $kontak->delete();

        return response()->json([
          'status' => 200
        ]);
    }
    
    public function kontakFormDelete(Request $request)
    {
        $kontak = ComproKontakForm::find($request->id);
        $kontak->delete();

        return response()->json([
          'status' => 200
        ]);
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

      // dev
      if($request->hasFile('create_gambar')) {
        $file = $request->file('create_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/cabang/', $filename);
        $cabang->gambar = $filename;
      }

      // prod
      // if($request->hasFile('create_gambar')) {
      //     $file = $request->file('create_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/cabang/', $filename);
      //     $cabang->gambar = $filename;
      // }

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

        // dev
      if($request->hasFile('edit_gambar')) {
        if (file_exists("public/compro/cabang/" . $cabang->gambar)) {
            File::delete("public/compro/cabang/" . $cabang->gambar);
        }
        $file = $request->file('edit_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/cabang/', $filename);
        $cabang->gambar = $filename;
      }

      // prod
      // if($request->hasFile('edit_gambar')) {
      //     if (file_exists("compro/cabang/" . $cabang->gambar)) {
      //         File::delete("compro/cabang/" . $cabang->gambar);
      //     }
      //     $file = $request->file('edit_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/cabang/', $filename);
      //     $cabang->gambar = $filename;
      // }

      $cabang->save();

      return redirect()->route('compro.cabang');
    }

    public function cabangDelete(Request $request)
    {
      $cabang = ComproCabang::find($request->id);

        // dev
      if (file_exists("public/compro/cabang/" . $cabang->gambar)) {
        File::delete("public/compro/cabang/" . $cabang->gambar);
      }

      // prod
      // if (file_exists("compro/cabang" . $cabang->gambar)) {
      //     File::delete("compro/cabang" . $cabang->gambar);
      // }

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

    // produk
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
      $produk->kategori = $request->create_kategori;
      $produk->harga = str_replace(",", "", $request->create_harga);
      
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
      $produk->kategori = $request->edit_kategori;
      $produk->harga = str_replace(",", "", $request->edit_harga);
      
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

      // dev
      if (file_exists("public/compro/partner/" . $partner->foto)) {
        File::delete("public/compro/partner/" . $partner->foto);
      }

      // prod
      // if (file_exists("compro/partner" . $partner->foto)) {
      //     File::delete("compro/partner" . $partner->foto);
      // }

      $partner->delete();

      return response()->route('compro.partner');
    }

    // legal
    public function legal()
    {
      $legal = ComproLegal::get();

      return view('pages.compro.legal.index', ['legals' => $legal]);
    }

    public function legalStore(Request $request)
    {
      $legal = new ComproLegal;
      $legal->grup = $request->create_grup;
      $legal->nama = $request->create_nama;
      $legal->deskripsi = $request->create_deskripsi;
      $legal->save();

      return redirect()->route('compro.legal');
    }

    public function legalEdit($id)
    {
      $legal = ComproLegal::find($id);

      return view('pages.compro.legal.edit', ['legal' => $legal]);
    }

    public function legalUpdate(Request $request)
    {
      $legal = ComproLegal::find($request->edit_id);
      $legal->grup = $request->edit_grup;
      $legal->nama = $request->edit_nama;
      $legal->deskripsi = $request->edit_deskripsi;
      $legal->save();

      return redirect()->route('compro.legal');
    }

    public function legalDelete(Request $request)
    {
      $legal = ComproLegal::find($request->id);
      $legal->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // pelanggan
    public function pelanggan()
    {
      $pelanggan = ComproPelanggan::get();

      return view('pages.compro.pelanggan.index', ['pelanggans' => $pelanggan]);
    }

    public function pelangganStore(Request $request)
    {
      $pelanggan = new ComproPelanggan;
      $pelanggan->grup = $request->create_grup;
      $pelanggan->nama = $request->create_nama;

      // dev
      if($request->hasFile('create_gambar')) {
        $file = $request->file('create_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/pelanggan/', $filename);
        $pelanggan->gambar = $filename;
      }

      // prod
      // if($request->hasFile('create_gambar')) {
      //     $file = $request->file('create_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/pelanggan/', $filename);
      //     $pelanggan->gambar = $filename;
      // }

      $pelanggan->save();

      return redirect()->route('compro.pelanggan');
    }

    public function pelangganEdit($id)
    {
      $pelanggan = ComproPelanggan::find($id);

      return view('pages.compro.pelanggan.edit', ['pelanggan' => $pelanggan]);
    }

    public function pelangganUpdate(Request $request)
    {
      $pelanggan = ComproPelanggan::find($request->edit_id);
      $pelanggan->grup = $request->edit_grup;
      $pelanggan->nama = $request->edit_nama;

      // dev
      if($request->hasFile('edit_gambar')) {
        if (file_exists("public/compro/pelanggan/" . $pelanggan->gambar)) {
            File::delete("public/compro/pelanggan/" . $pelanggan->gambar);
        }
        $file = $request->file('edit_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/pelanggan/', $filename);
        $pelanggan->gambar = $filename;
      }

      // prod
      // if($request->hasFile('edit_gambar')) {
      //     if (file_exists("compro/pelanggan/" . $pelanggan->gambar)) {
      //         File::delete("compro/pelanggan/" . $pelanggan->gambar);
      //     }
      //     $file = $request->file('edit_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/pelanggan/', $filename);
      //     $pelanggan->gambar = $filename;
      // }

      $pelanggan->save();

      return redirect()->route('compro.pelanggan');
    }

    public function pelangganDelete(Request $request)
    {
      $pelanggan = ComproPelanggan::find($request->id);

      // dev
      if (file_exists("public/compro/pelanggan/" . $pelanggan->gambar)) {
        File::delete("public/compro/pelanggan/" . $pelanggan->gambar);
      }

      // prod
      // if (file_exists("compro/pelanggan" . $pelanggan->gambar)) {
      //     File::delete("compro/pelanggan" . $pelanggan->gambar);
      // }

      $pelanggan->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // blog
    public function blog()
    {
      $blog = ComproBlog::get();

      return view('pages.compro.blog.index', ['blogs' => $blog]);
    }

    public function blogStore(Request $request)
    {
      $blog = new ComproBlog;
      $blog->grup = $request->create_grup;
      $blog->judul = $request->create_judul;
      $blog->deskripsi = $request->create_deskripsi;
      $blog->tanggal = date('Y-m-d');

      // dev
      if($request->hasFile('create_gambar')) {
        $file = $request->file('create_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/blog/', $filename);
        $blog->gambar = $filename;
      }

      // prod
      // if($request->hasFile('create_gambar')) {
      //     $file = $request->file('create_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/blog/', $filename);
      //     $blog->gambar = $filename;
      // }

      $blog->save();

      return redirect()->route('compro.blog');
    }

    public function blogEdit($id)
    {
      $blog = ComproBlog::find($id);

      return view('pages.compro.blog.edit', ['blog' => $blog]);
    }

    public function blogUpdate(Request $request)
    {
      $blog = ComproBlog::find($request->edit_id);
      $blog->grup = $request->edit_grup;
      $blog->judul = $request->edit_judul;
      $blog->deskripsi = $request->edit_deskripsi;

      // dev
      if($request->hasFile('edit_gambar')) {
        if (file_exists("public/compro/blog/" . $blog->gambar)) {
            File::delete("public/compro/blog/" . $blog->gambar);
        }
        $file = $request->file('edit_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/blog/', $filename);
        $blog->gambar = $filename;
      }

      // prod
      // if($request->hasFile('edit_gambar')) {
      //     if (file_exists("compro/blog/" . $blog->gambar)) {
      //         File::delete("compro/blog/" . $blog->gambar);
      //     }
      //     $file = $request->file('edit_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/blog/', $filename);
      //     $blog->gambar = $filename;
      // }

      $blog->save();

      return redirect()->route('compro.blog');
    }

    public function blogDelete(Request $request)
    {
      $blog = ComproBlog::find($request->id);

      // dev
      if (file_exists("public/compro/blog/" . $blog->gambar)) {
        File::delete("public/compro/blog/" . $blog->gambar);
      }

      // prod
      // if (file_exists("compro/blog" . $blog->gambar)) {
      //     File::delete("compro/blog" . $blog->gambar);
      // }

      $blog->delete();

      return response()->json([
        'status' => 200
      ]);
    }

    // slide
    public function slide()
    {
      $slide = ComproSlide::get();

      return view('pages.compro.slide.index', ['slides' => $slide]);
    }

    public function slideStore(Request $request)
    {
      $slide = new ComproSlide;
      $slide->grup = $request->create_grup;

      // dev
      if($request->hasFile('create_gambar')) {
        $file = $request->file('create_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/slide/', $filename);
        $slide->gambar = $filename;
      }

      // prod
      // if($request->hasFile('create_gambar')) {
      //     $file = $request->file('create_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/slide/', $filename);
      //     $slide->gambar = $filename;
      // }

      $slide->save();

      return redirect()->route('compro.slide');
    }

    public function slideEdit($id)
    {
      $slide = ComproSlide::find($id);

      return view('pages.compro.slide.edit', ['slide' => $slide]);
    }

    public function slideUpdate(Request $request)
    {
      $slide = ComproSlide::find($request->edit_id);
      $slide->grup = $request->edit_grup;

      // dev
      if($request->hasFile('edit_gambar')) {
        if (file_exists("public/compro/slide/" . $slide->gambar)) {
            File::delete("public/compro/slide/" . $slide->gambar);
        }
        $file = $request->file('edit_gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move('public/compro/slide/', $filename);
        $slide->gambar = $filename;
      }

      // prod
      // if($request->hasFile('edit_gambar')) {
      //     if (file_exists("compro/slide/" . $slide->gambar)) {
      //         File::delete("compro/slide/" . $slide->gambar);
      //     }
      //     $file = $request->file('edit_gambar');
      //     $extension = $file->getClientOriginalExtension();
      //     $filename = time() . "." . $extension;
      //     $file->move('compro/slide/', $filename);
      //     $slide->gambar = $filename;
      // }

      $slide->save();

      return redirect()->route('compro.slide');
    }

    public function slideDelete(Request $request)
    {
      $slide = ComproSlide::find($request->id);

      // dev
      if (file_exists("public/compro/slide/" . $slide->gambar)) {
        File::delete("public/compro/slide/" . $slide->gambar);
      }

      // prod
      // if (file_exists("compro/slide" . $slide->gambar)) {
      //     File::delete("compro/slide" . $slide->gambar);
      // }

      $slide->delete();

      return response()->json([
        'status' => 200
      ]);
    }
}
