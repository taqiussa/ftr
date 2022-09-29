<div>
    @if (auth()->user()->username != 'admin')
        
    <x-card class="col-md-4">
        <div class="col-md-6">
            <label for="bulan" class="form-label">Pilih Bulan</label>
            <select wire:model="bulan" id="bulan" class="form-select">
                <option value="">Pilih Bulan</option>
                <option value="01">{{ namaBulan(1) }}</option>
                <option value="02">{{ namaBulan(2) }}</option>
                <option value="03">{{ namaBulan(3) }}</option>
                <option value="04">{{ namaBulan(4) }}</option>
                <option value="05">{{ namaBulan(5) }}</option>
                <option value="06">{{ namaBulan(6) }}</option>
                <option value="07">{{ namaBulan(7) }}</option>
                <option value="08">{{ namaBulan(8) }}</option>
                <option value="09">{{ namaBulan(9) }}</option>
                <option value="10">{{ namaBulan(10) }}</option>
                <option value="11">{{ namaBulan(11) }}</option>
                <option value="12">{{ namaBulan(12) }}</option>
            </select>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>: {{ ucwords(auth()->user()->name) }}</th>
                    </tr>
                    <tr>
                        <th>Bulan</th>
                        <th>: {{ namaBulan($bulan) }}</th>
                    </tr>
                    <tr>
                        <th>Total Potong</th>
                        <th>: {{ $totalPotong }}</th>
                    </tr>
                    <tr>
                        <th>Total Kupon</th>
                        <th>: {{ $totalKupon }}</th>
                    </tr>
                    <tr>
                        <th>Total Pemasukan</th>
                        <th>: {{ rupiah($totalPemasukan) }}</th>
                    </tr>
                    @if (auth()->user()->name == 'Fendi')
                    <tr>
                        <th>Total Pendapatan</th>
                        <th>: {{ rupiah($totalPendapatan) }}</th>
                    </tr>
                    @endif
                    <tr>
                        <th>Total Libur</th>
                        <th>: {{ $totalLibur }}</th>
                    </tr>
                    <tr>
                        <th>Total Bon</th>
                        <th>: {{ rupiah($totalBon) }}</th>
                    </tr>
                    <tr>
                        <th colspan="2">Keterangan Libur</th>
                    </tr>
                    @foreach ($listLibur as $libur)
                    <tr>
                        <th colspan="2">{{ $loop->iteration }}. {{ hariTanggal($libur->tanggal) }}</th>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">Keterangan Bon</th>
                    </tr>
                    @foreach ($listBon as $bon)
                    <tr>
                        <th colspan="2">{{ $loop->iteration }}. {{ hariTanggal($bon->tanggal) }}</th>
                    </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </x-card>
    @endif
</div>
