@include('layouts.app')

<div class="container py-5">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formtambah">
        Tambah Kategori
    </button>
    {{-- Model Form Tambah --}}
    <div class="modal fade" id="formtambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="formtambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formUpdate">Kategori</h5>
                    <button type="button" class="rounded" style="width: 34px; border: 1px solid"
                        data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="/kategori" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="col mb-2">
                            <label>Kategori</label>
                            <input type="text" name="nama" class="form-control ">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary me-2">Tambah Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        <button type="button" class="btn btn-md btn-dark" style="width: 80px" data-bs-toggle="modal"
                            data-bs-target="#formUpdate{{ $item->id }}">
                            Edit
                        </button>
                        <form action="/kategori/{{ $item->id }}" method="post" style="display: inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-md btn-danger" style="width: 80px"
                                onclick="return confirm ('Yakin akan menghapus data?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Model Form Update --}}
                <div class="modal fade" id="formUpdate{{ $item->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="formUpdate" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="formUpdate">Edit Berita</h5>
                                <button type="button" class="rounded" style="width: 34px; border: 1px solid"
                                    data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <form action="/kategori/{{ $item->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="col mb-2">
                                        <label>Kategori</label>
                                        <input type="text" name="nama" class="form-control "
                                            value="{{ $item->nama }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@include('layouts.footer')
