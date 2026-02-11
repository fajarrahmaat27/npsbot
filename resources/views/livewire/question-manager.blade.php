<div class="space-y-6">
    <div class="flex justify-between items-center border-b border-gray-200 pb-5">
        <h1 class="text-2xl font-black text-gray-800 border-l-8 border-red-700 pl-4 tracking-tight">
            MANAJEMEN PERTANYAAN SURVEY
        </h1>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded shadow-sm flex items-center">
            <span class="mr-2">✅</span> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded shadow-sm flex items-center">
            <span class="mr-2">⚠️</span> {{ session('error') }}
        </div>
    @endif

    @if(!$editingId)
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <form wire:submit.prevent="add" class="flex gap-4">
            <input type="text" wire:model="text" placeholder="Masukkan pertanyaan survey baru (contoh: Bagaimana layanan staf kami?)" 
                class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 p-4 border transition-all">
            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-10 py-4 rounded-xl font-bold transition-all shadow-md active:scale-95">
                TAMBAH PERTANYAAN
            </button>
        </form>
    </div>
    @endif

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-widest w-40">Status Aktif</th>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-widest">Pertanyaan</th>
                    <th class="px-6 py-5 text-right text-xs font-black text-gray-400 uppercase tracking-widest">Kontrol</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach($questions as $q)
                <tr class="{{ !$q->is_active ? 'bg-gray-50/50' : 'hover:bg-red-50/20' }} transition-colors">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <button wire:click="toggleStatus({{ $q->id }})" 
                                @if($q->is_active) wire:confirm="Nonaktifkan pertanyaan ini? Pertanyaan tidak akan muncul lagi di Bot Telegram." @endif
                                class="relative inline-flex h-6 w-12 items-center rounded-full transition-all duration-300 {{ $q->is_active ? 'bg-red-600' : 'bg-gray-300' }}">
                                <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-all duration-300 {{ $q->is_active ? 'translate-x-7' : 'translate-x-1' }}"></span>
                            </button>
                            <span class="text-[10px] font-bold uppercase {{ $q->is_active ? 'text-red-600' : 'text-gray-400' }}">
                                {{ $q->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        @if($editingId === $q->id)
                            <div class="flex gap-2">
                                <input type="text" wire:model="editText" class="flex-1 border-gray-300 rounded-lg p-2 focus:ring-red-500 border shadow-inner">
                                <button wire:click="update" class="bg-green-600 text-white px-4 rounded-lg text-xs font-bold shadow-sm">SIMPAN</button>
                                <button wire:click="cancelEdit" class="text-gray-400 text-xs font-bold px-2">BATAL</button>
                            </div>
                        @else
                            <span class="text-sm font-semibold {{ !$q->is_active ? 'text-gray-400 italic' : 'text-gray-800' }}">
                                {{ $q->text }}
                            </span>
                        @endisset
                    </td>
                    <td class="px-6 py-5 text-right space-x-4">
                        @if($editingId !== $q->id)
                            <button wire:click="edit({{ $q->id }})" class="text-blue-600 hover:text-blue-800 font-extrabold text-xs tracking-tighter">EDIT</button>
                            <button wire:click="delete({{ $q->id }})" 
                                wire:confirm="Apakah Anda yakin ingin menghapus permanen pertanyaan ini?"
                                class="text-red-600 hover:text-red-900 font-extrabold text-xs tracking-tighter {{ $q->responses_count > 0 ? 'opacity-20 cursor-not-allowed' : '' }}">
                                HAPUS
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>