<div class="relative bg-white rounded-md shadow overflow-y-hidden overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    Sold Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    Available Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    By
                </th>
                <th scope="col" class="px-6 py-3 text-right">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $product->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $product->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $product->price }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->total_quantity }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->sold_quantity }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->available_quantity }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-[#f1f2f3]"></div>
                            <div class="flex flex-col">
                                @if ($product->createdBy)
                                    <h3>{{ $product->createdBy->name ?? 'Unknown Creator' }}</h3>
                                    <h3>{{ $product->createdBy->email ?? 'No Email' }}</h3>
                                @else
                                    <h3>Unknown Creator</h3>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex gap-2 justify-end">
                            <a class="hover:underline hover:text-green-500" href="/products/edit/{{$product->id}}">Edit</a>
                            <a class="hover:underline hover:text-red-500" href="/products/delete/{{$product->id}}">Delete</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
