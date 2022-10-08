<div>
    <x-card>
        <div class="row my-1">
            <div class="col-md-4">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input wire:model="tanggal" type="date" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="pegawai" class="form-label">Pegawai</label>
                <select wire:model="pegawai" id="pegawai" class="form-select">
                    <option value="1">Pilih Pegawai</option>
                    @foreach ($listPegawai as $pegawai)
                        <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="harga" class="form-label">Harga</label>
                <select wire:model="harga" id="harga" class="form-select" >
                    <option value="">Pilih Harga</option>
                    <option value="6500">Rp. 6.500,-</option>\
                    <option value="12000">Rp. 12.000,-</option>
                </select>
            </div>
        </div>
        <div class="row my-1">
            <div class="col-md-4">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input wire:model="jumlah" type="number" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="kupon" class="form-label">Kupon</label>
                <input wire:model="kupon" type="number" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="total" class="form-label">Total</label>
                <input wire:model="total" type="number" class="form-control" disabled>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button wire:click.prevent="simpan" wire:loading.class="disabled" wire:target="simpan" class="btn btn-dark">Simpan</button>
        </div>
        <div class="table-responsive my-2">
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Kupon</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listTransaksi as $transaksi)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ hariTanggal($transaksi->tanggal) }}</td>
                        <td class="text-center">{{ $transaksi->jumlah }}</td>
                        <td class="text-center">{{ $transaksi->kupon }}</td>
                        <td>{{ rupiah($transaksi->total) }}</td>
                        <td>
                            <button wire:click.prevent="delete({{ $transaksi->id }})" class="btn btn-danger mx-1 my-1">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
</div>
