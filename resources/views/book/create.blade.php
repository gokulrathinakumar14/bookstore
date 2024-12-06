@extends('layout.app')

@section('content')

<div class="bg-gray-200 h-screen flex justify-center items-center">
    <div class="bg-white w-[500px] p-8 rounded">
        <h4 class="text-lg text-center font-bold text-slate-500 my-3">Add Book</h4>
        
        @if ($errors->any())
            <div class="w-full text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-700">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form class="w-full max-w-md" action="/book" method="POST">
            @csrf
            {{-- Book Title --}}
            <div class="md:flex md:items-center mb-6 w-full">
              <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="book_title">
                  Book Title
                </label>
              </div>
              <div class="md:w-2/3">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="book_title" name="book_title" type="text" placeholder="Book title">
              </div>
            </div>
            {{-- Author Name --}}
            <div class="md:flex md:items-center mb-6">
              <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="author_name">
                  Author Name
                </label>
              </div>
              <div class="md:w-2/3">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="author_name" type="text" name="author_name" placeholder="Author Name">
              </div>
            </div>

            {{-- Genre --}}
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="genre">
                    Genre
                </label>
                </div>
                <div class="md:w-2/3">
                  <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="genre" name="genre">
                    @foreach($genres as $genre)
                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            {{-- Price Range --}}
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="price_range">
                    Price Range
                </label>
                </div>
                <div class="md:w-2/3">
                  <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="price_range" name="price_range">
                    @foreach($price_ranges as $price_range)
                        <option value="{{$price_range->id}}">{{$price_range->price_range}}</option>
                    @endforeach
                  </select>
                </div>
            </div>

            {{-- ISBN --}}
            <div class="md:flex md:items-center mb-6 w-full">
                <div class="md:w-1/3">
                  <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="isbn">
                    ISBN
                  </label>
                </div>
                <div class="md:w-2/3">
                  <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="isbn" name="isbn" type="text" placeholder="ISBN">
                </div>
            </div>

            <div class="w-full flex justify-end my-3">
                <button id="add_new_book_format" class="bg-blue-700 text-white px-3 py-2 rounded disabled:bg-slate-500 disabled:text-gray-400 disabled:cursor-not-allowed">Add Format</button>
            </div>

            <div id="format_container">

                <div class="flex flex-wrap -mx-3 mb-2">
                    {{-- Format Type --}}
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                          Format Type
                        </label>
                        <div class="relative">
                          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="format_type[]">
                            @foreach($format_types as $format_type)
                                <option value="{{$format_type->id}}">{{$format_type->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
    
                    {{-- Number of copies --}}
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Number of Copies
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Number of Copies" name="num_of_copies[]">
                    </div>
               
                    {{-- Prices --}}
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Price/Format $
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Price" name="prices[]">
                    </div>
                </div>
            </div>

            <div class="w-full flex justify-center mt-5">
                <button type="submit" class="bg-blue-700 text-white px-3 py-2 rounded">Save Book</button>
            </div>
        </form>
    </div>
</div>

<script>
    var format_types = @json($format_types);
    console.log(format_types,'___format types');
    $(document).on('click','#add_new_book_format',(e) => {
        e.preventDefault();
        if($('#format_container>div').length >= 3) return false;
        const template = `<div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                          Format Type
                        </label>
                        <div class="relative">
                          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="format_type[]">
                            @foreach($format_types as $format_type)
                                <option value="{{$format_type->id}}">{{$format_type->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
    
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Number of Copies
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Number of Copies" name="num_of_copies[]">
                    </div>
               
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Price/Format $
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Price" name="prices[]">
                    </div>
                </div>`
        $('#format_container').append(template);
        if($('#format_container>div').length == 3) {
            $('#add_new_book_format').prop('disabled', true);
        }
        console.log('___add format button clicked');
    });
</script>

@endsection