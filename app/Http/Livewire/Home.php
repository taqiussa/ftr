<?php

namespace App\Http\Livewire;

use App\Models\Bon;
use App\Models\Libur;
use App\Models\Transaksi;
use Livewire\Component;

class Home extends Component
{

    public $bulan;
    public $totalPotong = 0;
    public $totalKupon = 0;
    public $totalLibur = 0;
    public $totalBon = 0;
    public $totalPemasukan = 0;
    public $totalPendapatan = 0;
    public $listLibur = [];
    public $listBon = [];

    public function render()
    {
        return view('livewire.home');
    }

    public function mount()
    {
        $this->bulan = date('m');
        $this->get_data();
    }

    public function updated($property)
    {
        $this->get_data();
    }

    private function get_data()
    {
        $this->listLibur = Libur::where('user_id', auth()->user()->id)
            ->whereMonth('tanggal', $this->bulan)
            ->get();
        $this->totalLibur = count($this->listLibur);
        $this->listBon =  Bon::where('user_id', auth()->user()->id)
            ->whereMonth('tanggal', $this->bulan)
            ->get();
        $this->totalPemasukan = Transaksi::where('user_id', auth()->user()->id)
            ->whereMonth('tanggal', $this->bulan)
            ->sum('total');
        $this->totalPotong = Transaksi::where('user_id', auth()->user()->id)
            ->whereMonth('tanggal', $this->bulan)
            ->sum('jumlah');
        $this->totalKupon = Transaksi::where('user_id', auth()->user()->id)
            ->whereMonth('tanggal', $this->bulan)
            ->sum('kupon');
        $this->totalPendapatan = intval($this->totalPotong + $this->totalKupon) * 13000;
    }
}
