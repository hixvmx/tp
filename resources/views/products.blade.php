@extends('layouts.global')


@section('content')
    <section class="container mx-auto px-2 text-gray-700">
        <div class="pt-10 pb-4 flex items-center justify-between">
            <h1 class="font-bold text-2xl">Products List</h1>

            <div class="flex items-center gap-4">
                <button class="group relative hover:underline">
                    <span>Export</span>
                    {{-- DropDown --}}
                    <div class="hidden group-hover:block">
                        <div class="absolute right-0 px-0 py-2 w-xl rounded-md bg-white shadow z-50 border text-left">
                            <a href="/export-products-as-pdf">
                                <div class="px-3 py-2 bg-white hover:bg-[#f1f2f3]">
                                    <span class="whitespace-nowrap">Export as PDF</span>
                                </div>
                            </a>
                            <a href="/export-products-as-csv">
                                <div class="px-3 py-2 bg-white hover:bg-[#f1f2f3]">
                                    <span class="whitespace-nowrap">Export as CSV</span>
                                </div>
                            </a>
                            <a href="/export-products-as-excel">
                                <div class="px-3 py-2 bg-white hover:bg-[#f1f2f3]">
                                    <span class="whitespace-nowrap">Export as EXCEL</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </button>
                <button class="bg-[#2d54de] text-white rounded-md py-2 lg:px-4 px-2 flex items-center gap-2">
                    Add new
                </button>
            </div>
        </div>

        {{-- render products list --}}
        @include('components.productsList', $products)


        {{-- render products pagination --}}
        @include('components.pagination', $products)
    </section>
@endsection
