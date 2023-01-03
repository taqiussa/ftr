<?php

namespace App\Http\Livewire;

use App\Models\Bon;
use App\Models\User;
use App\Models\Libur;
use App\Models\Transaksi;
use Livewire\Component;

class Laporan extends Component
{
    public $bulan;
    public $tahun;
    public $pegawai = 1;
    public $totalPotong = 0;
    public $totalKupon = 0;
    public $totalLibur = 0;
    public $totalBon = 0;
    public $totalPemasukan = 0;
    public $totalPendapatan = 0;
    public $listLibur = [];
    public $listBon = [];
    public $listPegawai = [];
    public $namaPegawai = '';

    public function render()
    {
        return view('livewire.laporan');
    }

    public function mount()
    {
        $this->bulan = date('m');
        $this->tahun = date('Y');
        $this->listPegawai = User::where('username', '!=', 'admin')->get();
    }

    public function updated($property)
    {
        $this->namaPegawai = User::find($this->pegawai)->name;
        $this->listLibur = Libur::where('user_id', $this->pegawai)
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->get();
        $this->totalLibur = count($this->listLibur);
        $this->listBon =  Bon::where('user_id', $this->pegawai)
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->get();
        $this->totalBon = Bon::where('user_id', $this->pegawai)
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->sum('total');
        $this->totalPemasukan = Transaksi::where('user_id', $this->pegawai)
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->sum('total');
        $this->totalPotong = Transaksi::where('user_id', $this->pegawai)
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->sum('jumlah');
        $this->totalKupon = Transaksi::where('user_id', $this->pegawai)
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->sum('kupon');
        $this->totalPendapatan = $this->totalPemasukan;
    }
}
