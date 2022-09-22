<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Libur as ModelsLibur;

class Libur extends Component
{
    public $tanggal;
    public $pegawai = 1;
    public $listLibur = [];
    public $listPegawai = [];

    public function render()
    {
        return view('livewire.libur');
    }
    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->listPegawai = User::where('username', '!=', 'admin')->get();

    }
    public function updated($property)
    {
        $this->get_libur();
    }
    public function simpan()
    {
        try {
            ModelsLibur::create(
                [
                    'tanggal' => $this->tanggal,
                    'user_id' => $this->pegawai,
                ],
            );
            $this->get_libur();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function delete($id)
    {
        ModelsLibur::find($id)->delete();
        $this->get_libur();

    }

    private function get_libur()
    {
        $this->listLibur = ModelsLibur::when(
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
