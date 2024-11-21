<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body>
    <main class="min-h-dvh flex flex-col items-center justify-center">
        <section class="max-w-xl w-full p-4 rounded-md shadow bg-white">
            <h1 class="mb-4 font-semibold text-xl">Login</h1>
            <form action="/login" method="POST" class="flex flex-col gap-4">
                @csrf
                <label class="flex flex-col gap-1">
                    <label>Email:</label>
                    <input type="email" name="email" class="border outline-none px-3 py-2" placeholder="ex@gmail.com" required>
                </label>

                <label class="flex flex-col gap-1">
                    <label>Password:</label>
                    <input type="password" name="password" class="border outline-none px-3 py-2" placeholder="***" required>
                </label>

                @error('email')
                    <div class="rounded-md p-4 bg-red-200 text-red-600">{{ $message }}</div>
                @enderror

                <button type="submit"
                    class="bg-[#2d54de] w-fit text-white rounded-md py-2 lg:px-6 md:px-4 px-2 flex items-center gap-2">
                    Login
                </button>
            </form>
        </section>
    </main>
</body>

</html>