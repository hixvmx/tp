@extends('layouts.global')


@section('content')
    <section class="container mx-auto px-2 text-gray-700">
        <div class="pt-10 pb-4 flex items-center justify-between">
            <h1 class="font-bold text-2xl">Edit product</h1>
        </div>

        {{-- Add New Form --}}
        <form action="/products/edit" method="POST" class="max-w-xl bg-white shadow rounded-md p-4 flex flex-col gap-4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" value="{{ $product->id }}" />
            <label class="flex flex-col gap-1">
                <span>Name</span>
                <input name="name" value="{{ $product->name }}" type="text" class="border outline-none px-3 py-2" placeholder="Product name" required />
            </label>
            
            <label class="flex flex-col gap-1">
                <span>Price</span>
                <input name="price" value="{{ str_replace('$','',$product->price) }}" type="number" class="border outline-none px-3 py-2" placeholder="0" required min="1" />
            </label>

            <label class="flex flex-col gap-1">
                <span>Total Quantity</span>
                <input name="total_quantity" value="{{ $product->total_quantity }}" type="number" class="border outline-none px-3 py-2" placeholder="0" required min="1" />
            </label>

            <label class="flex flex-col gap-1">
                <span>Sold Quantity</span>
                <input name="sold_quantity" value="{{ $product->sold_quantity }}" type="number" class="border outline-none px-3 py-2" placeholder="0" required min="1" />
            </label>

            <label class="flex flex-col gap-1">
                <span>Available Quantity</span>
                <input name="available_quantity" value="{{ $product->available_quantity }}" type="number" class="border outline-none px-3 py-2" placeholder="0" required min="1" />
            </label>

            <div class="flex items-center gap-4">
                <button type="submit"
                    class="bg-[#2d54de] text-white rounded-md py-2 lg:px-6 md:px-4 px-2 flex items-center gap-2">
                    Update
                </button>

                <a href="/" class="bg-[#f1f2f3] text-gray-700 rounded-md py-2 lg:px-4 px-2 flex items-center gap-2">
                    Cancel
                </a>
            </div>
        </form>
    </section>
@endsection
