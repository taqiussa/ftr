<?php

namespace App\Http\Livewire;

use App\Models\Transaksi as ModelsTransaksi;
use App\Models\User;
use Livewire\Component;

class Transaksi extends Component
{
    public $tanggal;
    public $pegawai = 1;
    public $jumlah = 0;
    public $harga = 0;
    public $kupon = 0;
    public $total = 0;

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
        if ($this->harga == 6500) {
            $this->total = ($this->jumlah * $this->harga) - ($this->kupon * $this->harga);
        } else {
            $this->total = $this->jumlah * $this->harga;
        }
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
