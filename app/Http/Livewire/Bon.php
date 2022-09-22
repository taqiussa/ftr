<?php

namespace App\Http\Livewire;

use App\Models\Bon as ModelsBon;
use App\Models\User;
use Livewire\Component;

class Bon extends Component
{
    public $tanggal;
    public $pegawai = 1;
    public $total = 0;
    public $listPegawai = [];
    public $listBon = [];
    public function render()
    {
        return view('livewire.bon');
    }
    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->listPegawai = User::where('username', '!=', 'admin')->get();
        $this->get_bon();
    }

    public function updated($property)
    {
        $this->get_bon();
    }
    public function simpan()
    {
        try {
            ModelsBon::updateOrCreate(
                [
                    'tanggal' => $this->tanggal,
                    'user_id' => $this->pegawai,
                ],
                [
                    'total' => $this->total,
                ]
            );
        $this->get_bon();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function delete($id)
    {
        ModelsBon::find($id)->delete();
        $this->get_bon();
    }

    private function get_bon()
    {
        $this->listBon = ModelsBon::when(
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
