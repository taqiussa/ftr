<?php

namespace App\Http\Livewire;

use App\Models\Transaksi as ModelsTransaksi;
use App\Models\User;
use Livewire\Component;

class Transaksi extends Component
{
    public $tanggal;
    public $pegawai = 1;
    public $dewasa = 0;
    public $anak = 0;
    public $kupon = 0;
    public $total = 0;
    public $jumlah;

    public $listPegawai = [];
    public $listTransaksi = [];

    public function render()
    {
        return view('livewire.transaksi');
    }

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->listPegawai = User::where('username', '!=', 'admin')->get();
        $this->get_transaksi();
    }
    public function updated($property)
    {
        $this->kupon ?? 0;
        $this->jumlah ?? 0;
        if ($this->pegawai == 2) {
            $this->total = ($this->dewasa * 7500) + ($this->anak * 6500);
        } else {
            $this->total = ($this->dewasa * 15000) + ($this->anak * 12000);
        }
        $this->jumlah = $this->dewasa + $this->anak;
        $this->get_transaksi();
    }
    public function simpan()
    {
        try {
            ModelsTransaksi::updateOrCreate(
                [
                    'tanggal' => $this->tanggal,
                    'user_id' => $this->pegawai,
                ],
                [
                    'jumlah' => $this->jumlah,
                    'dewasa' => $this->dewasa,
                    'anak' => $this->anak,
                    'kupon' => $this->kupon,
                    'total' => $this->total,
                ]
            );
            $this->get_transaksi();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function delete($id)
    {
        ModelsTransaksi::find($id)->delete();
        $this->get_transaksi();
    }

    private function get_transaksi()
    {
        $this->listTransaksi = ModelsTransaksi::when(
            $this->pegawai != null,
            fn ($q) =>
            $q->where('user_id', $this->pegawai)
                ->whereMonth('tanggal', date('m', strtotime($this->tanggal)))
        )
            ->with('user')
            ->orderBy('tanggal', 'desc')
            ->get();
    }
}
