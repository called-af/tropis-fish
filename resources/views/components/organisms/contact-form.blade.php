<div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-xl">
    <form class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6">
            <x-atoms.input
                type="text"
                label="Nama Lengkap"
                placeholder="Masukkan nama Anda"
                name="name"
                required
            />

            <x-atoms.input
                type="email"
                label="Email"
                placeholder="email@example.com"
                name="email"
                required
            />
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <x-atoms.input
                type="tel"
                label="No. Telepon"
                placeholder="+62 812-xxxx-xxxx"
                name="phone"
                required
            />

            <x-atoms.input
                type="text"
                label="Subjek"
                placeholder="Topik pesan Anda"
                name="subject"
                required
            />
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Pesan
            </label>
            <textarea
                rows="5"
                name="message"
                placeholder="Tulis pesan Anda di sini..."
                class="w-full px-4 py-3 rounded-lg ring-1 ring-gray-300 focus:ring-2 focus:ring-blue-500 bg-white transition"
                required
            ></textarea>
        </div>

        <div class="flex justify-end">
            <x-atoms.button type="submit" variant="primary" size="lg">
                Kirim Pesan
            </x-atoms.button>
        </div>
    </form>
</div>
