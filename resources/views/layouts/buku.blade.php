@include('layouts.app')

<div class="container py-5">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formtambah">
        Tambah Buku
    </button>
    {{-- Model Form Tambah --}}
    <div class="modal fade" id="formtambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="formtambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formUpdate">Buku</h5>
                    <button type="button" class="rounded" style="width: 34px; border: 1px solid"
                        data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="/buku" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="col mb-2">
                            <label>isbn</label>
                            <input type="text" name="isbn" class="form-control ">
                        </div>
                        <div class="col mb-2">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control ">
                        </div>
                        <div class="col mb-2">
                            <label>sinopsis</label>
                            <textarea type="text" name="sinopsis" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col mb-2">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" class="form-control ">
                        </div>
                        <div class="col mb-2">
                            <label>cover</label>
                            <input type="file" name="cover" class="form-control">
                        </div>
                        <div class="col mb-2">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if (Auth::user()->role == 'Admin')
                            <div class="col mb-2">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary me-2">Tambah Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>ISBN</th>
                <th>Judul</th>
                <th>Sinopsis</th>
                <th>Penerbit</th>
                <th>Cover</th>
                <th>Kategori</th>
                @if (Auth::user()->role == 'Admin')
                    <th>Status</th>
                @endif
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buku as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->isbn }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->sinopsis }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td><img src="{{ asset('/') }}storage/{{ $item->cover }}" alt="" style="width:100px">
                    </td>
                    <td>{{ $item->Kategori->nama }}</td>
                    @if (Auth::user()->role == 'Admin')
                        <td>{{ $item->status }}</td>
                    @endif
                    <td>
                        <button type="button" class="btn btn-md btn-dark" style="width: 80px" data-bs-toggle="modal"
                            data-bs-target="#formUpdate{{ $item->id }}">
                            Edit
                        </button>
                        <form action="/buku/{{ $item->id }}" method="post" style="display: inline">
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
                                <h5 class="modal-title" id="formUpdate">Edit Buku</h5>
                                <button type="button" class="rounded" style="width: 34px; border: 1px solid"
                                    data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <form action="/buku/{{ $item->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="col mb-2">
                                        <label>isbn</label>
                                        <input type="text" name="isbn" class="form-control "
                                            value="{{ $item->isbn }}">
                                    </div>
                                    <div class="col mb-2">
                                        <label>Judul</label>
                                        <input type="text" name="judul" class="form-control "
                                            value="{{ $item->judul }}">
                                    </div>
                                    <div class="col mb-2">
                                        <label>sinopsis</label>
                                        <textarea type="text" name="sinopsis" class="form-control" rows="5">{{ $item->sinopsis }}</textarea>
                                    </div>
                                    <div class="col mb-2">
                                        <label>penerbit</label>
                                        <input type="text" name="penerbit" class="form-control "
                                            value="{{ $item->penerbit }}">
                                    </div>
                                    <div class="col mb-2">
                                        <label>Cover</label>
                                        <br>
                                        <img src="{{ asset('/') }}storage/{{ $item->cover }}" alt=""
                                            width="100px" class="mb-2">
                                        <input type="file" name="cover" class="form-control">
                                    </div>
                                    <div class="col mb-2">
                                        <label for="">Kategori</label>
                                        <select name="kategori_id" id="" class="form-control">
                                            <option value="{{ $item->Kategori->id }}">{{ $item->Kategori->nama }}
                                            </option>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if (Auth::user()->role == 'Admin')
                                        <div class="col mb-2">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="{{ $item->status }}">{{ $item->status }}</option>
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    @endif
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
