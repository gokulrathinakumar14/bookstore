@extends('layout.app')

@section('content')
<div class="bg-gray-200 h-screen w-full flex justify-center items-center">
    <div class="h-3/4 w-fit bg-white rounded p-3 flex flex-col justify-between">
        <div class="flex justify-end my-2">
            <a href="/book/create" class="bg-blue-700 text-white px-3 py-2 rounded">Add Book</a>
        </div>
        <table class="table-auto">
            <thead>
                <th class="px-4 py-2">Book Title</th>
                <th class="px-4 py-2">Author Name</th>
                <th class="px-4 py-2">Genre</th>
                <th class="px-4 py-2">Price Range</th>
                <th class="px-4 py-2">ISBN</th>
                <th class="px-4 py-2">Action</th>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td class="px-4 py-2">{{ $book->book_title }}</td>
                    <td class="px-4 py-2">{{ $book->author->author_name }}</td>
                    <td class="px-4 py-2">{{ $book->genre->name }}</td>
                    <td class="px-4 py-2">{{ $book->price->price_range }}</td>
                    <td class="px-4 py-2">{{ $book->isbn }}</td>
                    <td>
                        <a class="bg-blue-700 text-white px-3 py-2 rounded" href="/book/{{$book->id}}/edit">Edit</a>
                        <button class="book_delete  bg-red-400 text-white px-3 py-2 rounded" data-book_id={{$book->id}}>Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="w-full mt-3">
            {{ $books->links() }}
        </div>
    </div>
</div>

<form action="" id="book_delete_form" method="POST">
    @method('DELETE')
    @csrf
</form>

<script>
$(document).on('click','.book_delete', (e) => {
    e.preventDefault();
    let book_id = $(e.currentTarget).data('book_id');
    Swal.fire({
        title: "Are you sure? ",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!"
    }).then((result) => {
        if (result.isConfirmed) {
            $('#book_delete_form').attr('action',`/book/${book_id}`);
            $('#book_delete_form').submit();
        }
    });
});
</script>
@endsection