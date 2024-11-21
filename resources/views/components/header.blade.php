<?php
use Illuminate\Support\Facades\Auth;

$authUser = Auth::user();
?>

<header class="border-b border-[#eee] text-gray-700">
    <div class="container mx-auto min-h-[65px] px-2 flex items-center justify-between">
        <a href="/">
            <h1 class="font-semibold">ProjectName</h1>
        </a>

        <div class="flex items-center gap-4">
            <button class="hover:underline">
                Notifications (0)
            </button>

            <div class="relative group">
                <div class="flex items-center gap-1 cursor-pointer">
                    <div class="w-8 h-8 rounded-full bg-[#e1e5e9]"></div>
                    <div class="flex flex-col">
                        <span class="text-xs">{{ $authUser->name }}</span>
                        <span class="text-xs">{{ $authUser->email }}</span>
                    </div>
                </div>

                {{-- DropDown --}}
                <div class="hidden group-hover:block">
                    <div class="absolute right-0 px-0 py-2 w-[160px] rounded-md bg-white shadow z-50 border text-left">
                        <a href="/logout">
                            <div class="px-3 py-2 bg-white hover:bg-[#f1f2f3]">
                                <span class="whitespace-nowrap">Logout</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
