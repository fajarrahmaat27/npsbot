<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeutraDC - Survey System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <div class="hidden lg:flex flex-col w-64 bg-red-700 text-white">
            <div class="flex items-center justify-center h-16 bg-red-800 font-bold text-xl">
                NEUTRA NPS
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="/" class="block py-2.5 px-4 rounded hover:bg-red-600 {{ request()->is('/') ? 'bg-red-900' : '' }}">
                    📊 Dashboard
                </a>
                <a href="/cms" class="block py-2.5 px-4 rounded hover:bg-red-600 {{ request()->is('cms') ? 'bg-red-900' : '' }}">
                    ⚙️ CMS Questions
                </a>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 bg-gray-100">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>