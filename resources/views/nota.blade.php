<div class="container">
    <div class="col">
        <h2 style="text-align: center">18KCI</h2>
        <table id="transaksi-header">
            <tr>
                <td class="header-info">Id</td>
                <td>:</td>
                <td>{{ $transaksis->id }}</td>
            </tr>
            <tr>
                <td class="header-info">Kasir</td>
                <td>:</td>
                <td>{{ Auth::user()->nama }}</td>
            </tr>
            <tr>
                <td class="header-info">Tanggal</td>
                <td>:</td>
                <td>{{ $transaksis->created_at->format('m/d/Y') }}</td>
            </tr>
            <tr>
                <td class="header-info">Jam</td>
                <td>:</td>
                <td>{{ $transaksis->created_at->format('d:m:Y') }}</td>
            </tr>
        </table>
        <p class="border"></p>

        <table class="table" id="transaksi-produk">
            <thead>
                <tr>
                    <th align="left">Produk</th>
                    <th align="left">Jumlah</th>
                    <th align="left">Diskon</th>
                    <th align="left">Harga</th>
                    <th align="left">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itemtransaksis as $item)
                    <tr>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->jumlah_barang }} </td>
                        <td>{{ $item->diskon }}%</td>
                        <td>@toRP($item->harga)</td>
                        <td>@toRP($item->sub_total)</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="border"></p>
        <table>
            <tr>
                <td class="td-total">Total</td>
                <td>:</td>
                <td class="td-total">@toRP($transaksis->total_harga)</td>
            </tr>
            <tr>
                <td class="td-total">Bayar</td>
                <td>:</td>
                <td class="td-total">@toRP($transaksis->tunai)</td>
            </tr>
            <tr>
                <td class="td-total">Kembali</td>
                <td>:</td>
                <td class="td-total">@toRP($transaksis->kembali)</td>
            </tr>
        </table>
    </div>
</div>

<style>
    .header-info {
        padding-right: 30px;
    }

    .border {
        border: 1px dashed black;
    }

    .td-total {
        padding-right: 30px;
        font-weight: bold;
    }

    #transaksi-produk {
        margin: 10px 0 20px;
    }

    #transaksi-produk th {
        padding-right: 50px;
    }

    .container {
        display: grid;
        justify-content: center;
        align-content: center;
    }

    #total #header-total {
        padding-right: 30px;
    }

    .col {
        padding: 20px;
        border: 1px solid black;
    }
</style>
