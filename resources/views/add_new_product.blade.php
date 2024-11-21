@extends('layouts.global')


@section('content')
    <section class="container mx-auto px-2 text-gray-700">
        <div class="pt-10 pb-4 flex items-center justify-between">
            <h1 class="font-bold text-2xl">Add new product</h1>
        </div>


        {{-- Add New Form --}}
        <form action="/products/add" method="POST" class="max-w-xl bg-white shadow rounded-md p-4 flex flex-col gap-4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <label class="flex flex-col gap-1">
                <span>Name</span>
                <input name="product_name" type="text" class="border outline-none px-3 py-2" placeholder="Product name" required />
            </label>
            
            <label class="flex flex-col gap-1">
                <span>Price</span>
                <input name="product_price" type="number" class="border outline-none px-3 py-2" placeholder="0" required min="1" />
            </label>

            <label class="flex flex-col gap-1">
                <span>Quantity</span>
                <input name="product_quantity" type="number" class="border outline-none px-3 py-2" placeholder="0" required min="1" />
            </label>

            <div class="flex items-center gap-4">
                <button type="submit"
                    class="bg-[#2d54de] text-white rounded-md py-2 lg:px-6 md:px-4 px-2 flex items-center gap-2">
                    Save
                </button>

                <a href="/" class="bg-[#f1f2f3] text-gray-700 rounded-md py-2 lg:px-4 px-2 flex items-center gap-2">
                    Cancel
                </a>
            </div>
        </form>



    </section>
@endsection
