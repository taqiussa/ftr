<div>
    <x-card class="col-md-4">
        <div class="col-md-6">
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
                        <th>:</th>
                        <th>{{ ucwords(auth()->user()->name) }}</th>
                    </tr>
                    <tr>
                        <th>Bulan</th>
                        <th>:</th>
                        <th>{{ namaBulan($bulan) }}</th>
                    </tr>
                    <tr>
                        
                    </tr>
                </thead>
            </table>
        </div>
    </x-card>
</div>
