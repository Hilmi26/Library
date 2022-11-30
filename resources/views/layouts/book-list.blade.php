@include('layouts.app')

<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cover</th>
                <th>ISBN</th>
                <th>Judul</th>
                <th>Sinopsis</th>
                <th>Penerbit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookList as $item)
                @if ($item->status == 'Aktif')
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('/') }}storage/{{ $item->cover }}" alt="" style="width:100px">
                    </td>
                    <td>{{ $item->isbn }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->sinopsis }}</td>
                    <td>{{ $item->penerbit }}</td>
                </tr>
                @else

                @endif
            @endforeach
        </tbody>
    </table>
</div>

@include('layouts.footer')
