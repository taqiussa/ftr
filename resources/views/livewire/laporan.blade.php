<div>
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
        <div class="col-md-6">
            <label for="tahun" class="form-label">Tahun</label>
            <select wire:model="tahun" id="tahun" class="form-select">
                <option value="">Pilih Tahun</option>
                <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                <option value="{{ date('Y') }}">{{ date('Y') }}</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="pegawai" class="form-label">Pegawai</label>
            <select wire:model="pegawai" id="pegawai" class="form-select">
                <option value="1">Pilih Pegawai</option>
                @foreach ($listPegawai as $pegawai)
                    <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>: {{ $namaPegawai }}</th>
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
                    @if ($namaPegawai == 'Fendi')
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
                        <th colspan="2">{{ $loop->iteration }}. {{ hariTanggal($bon->tanggal) }} - {{ rupiah($bon->total) }}</th>
                    </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </x-card>
</div>
