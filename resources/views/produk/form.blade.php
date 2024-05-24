<!-- Modal -->
<div class="modal fade" id="form-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/produk/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image" class="fs-5">Add Image</label>
                              
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="number" class="form-control jumlah" name="harga">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Stok</label>
                                <input type="number" class="form-control jumlah" name="stock">
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="qty mt-5">
                                <span class="minus bg-dark">-</span>
                                <input type="number" class="count" name="qty" value="1">
                                <span class="plus bg-dark">+</span>
                            </div>
                        </div> --}}
                    </div>
                    <button type="submit" class="btn btn-outline-primary float-right">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
