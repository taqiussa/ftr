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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listLibur as $libur)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ hariTanggal($libur->tanggal) }}</td>
                        <td>
                            <button wire:click.prevent="delete({{ $libur->id }})" class="btn btn-danger mx-1 my-1">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
</div>
