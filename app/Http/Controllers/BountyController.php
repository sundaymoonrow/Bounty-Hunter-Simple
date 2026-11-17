<?php

namespace App\Http\Controllers;

use App\Models\Bounty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BountyController extends Controller
{
    private const KATEGORI = [
        'Desain grafis',
        'Edit video',
        'Foto dan dokumentasi',
        'Ketik dan rapikan dokumen',
        'Bantuan teknis ekskul',
        'Les dan bimbingan',
    ];

    private const KATA_TERLARANG = ['joki', 'kerjakan tugas', 'contek', 'ujian'];

    public function index()
    {
        $bounties = Bounty::with(['pembuat', 'tawaran'])
            ->where('status', 'terbuka')
            ->latest()
            ->get();
        
        return view('bounty.index', compact('bounties'));
    }

    public function create()
    {
        return view('bounty.create', ['kategori' => self::KATEGORI]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'max:120'],
            'deskripsi' => ['required', 'min:20'],
            'kategori' => ['required', Rule::in(self::KATEGORI)],
            'budget' => ['required', 'integer', 'min:1000', 'max:100000'],
            'tenggat' => ['required', 'date', 'after:today'],
        ]);

        $teks = strtolower($data['judul']. ' '.$data['deskripsi']);
        foreach (self::KATA_TERLARANG as $kata) {
            if (str_contains($teks, $kata)) {
                return back()
                    ->withErrors(['judul' => 'Bounty melanggar aturan kategori.'])
                    ->withInput();
            }
        }

        $bounty = Bounty::create([
            'pembuat_id' => auth()->id(),
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'],
            'kategori' => $data['kategori'],
            'budget' => $data['budget'],
            'tenggat' => $data['tenggat'],
            'status' => 'terbuka',
        ]);

        return redirect()->route('bounties.store', $bounty);
    }

    public function show(Bounty $bounty)
    {
        $bounty->load(['pembuat', 'pengerja', 'tawaran.penawar']);

        return view('bounty.show', compact('bounty'));
    }
}
