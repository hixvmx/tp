@extends('layouts.global')


@section('content')
    <section class="container mx-auto px-2 text-gray-700">
        <div class="pt-10 pb-4 flex items-center justify-between">
            <h1 class="font-bold text-2xl">Products List</h1>

            <div class="flex items-center gap-4">
                <button class="hover:underline">
                    Export
                </button>
                <button class="bg-[#2d54de] text-white rounded-md py-2 lg:px-4 px-2 flex items-center gap-2">
                    Add new
                </button>
            </div>
        </div>

        {{-- render products list --}}
        @include('components.productsList')
        

        {{-- render products pagination --}}
        @include('components.pagination')
    </section>
@endsection
