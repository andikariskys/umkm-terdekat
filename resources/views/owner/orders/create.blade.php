@extends('templates.owner')
@section('title', 'Tambah Pesanan Baru')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Tambah Pesanan</h2>
                <p class="text-gray-600">Pilih produk untuk membuat pesanan baru</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                @forelse ($products as $product)
                    <div class="bg-white rounded-xl shadow-md p-4 border border-gray-100 hover:shadow-lg hover:border-green-300 transition cursor-pointer group"
                        onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})">

                        <div
                            class="mb-3 h-32 w-full overflow-hidden rounded-lg bg-gray-100 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover group-hover:scale-105 transition">
                            @else
                                <span class="text-4xl">☕</span>
                            @endif
                        </div>

                        <h4 class="font-semibold text-gray-900 mb-2 line-clamp-1">{{ $product->name }}</h4>
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-bold text-green-600">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</p>
                            <span class="text-xs text-gray-500">Stok: {{ $product->stock }}</span>
                        </div>

                        <button type="button"
                            onclick="event.stopPropagation(); addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})"
                            class="w-full mt-3 bg-green-100 hover:bg-green-200 text-green-700 py-2 rounded-lg text-sm font-semibold transition">
                            <i class="fa-solid fa-plus mr-2"></i>Tambah
                        </button>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                        <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Belum ada produk aktif.</p>
                        <a href="{{ route('owner.produk.create') }}" class="text-green-600 hover:underline text-sm">Tambah
                            Produk Dulu</a>
                    </div>
                @endforelse
            </div>
        </div>

        <div>
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 sticky top-24">
                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fa-solid fa-shopping-cart mr-2"></i>Keranjang Pesanan
                </h3>

                <div id="cartItems" class="space-y-3 mb-6 max-h-96 overflow-y-auto min-h-[150px]">
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-inbox text-4xl mb-3"></i>
                        <p class="text-sm">Keranjang kosong</p>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-600">Subtotal</span>
                        <span id="subtotal" class="font-semibold text-gray-900">Rp 0</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-600">Pajak (10%)</span>
                        <span id="tax" class="font-semibold text-gray-900">Rp 0</span>
                    </div>
                    <div class="flex items-center justify-between bg-green-50 p-4 rounded-lg">
                        <span class="font-bold text-gray-900">Total</span>
                        <span id="total" class="text-2xl font-bold text-green-600">Rp 0</span>
                    </div>
                </div>

                <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan</label>
                        <input type="text" id="customerName" placeholder="Masukkan nama"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon
                            (Opsional)</label>
                        <input type="text" id="customerPhone" placeholder="Nomor WhatsApp"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>

                <div class="space-y-3">
                    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
                    <button id="clearCartBtn"
                        class="w-full bg-red-50 hover:bg-red-100 text-red-700 py-2 rounded-lg font-semibold text-sm transition">
                        <i class="fa-solid fa-trash mr-2"></i>Kosongkan
                    </button>
                    <button id="confirmOrderBtn"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-check-circle"></i>
                        <span id="btnText">Simpan Pesanan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const TAX_RATE = 0.1;
        // Kita tidak pakai localStorage lagi untuk persistensi antar halaman karena POS bersifat sesi langsung,
        // Tapi kita pakai variabel global sederhana
        let cart = [];

        function currency(n) {
            return 'Rp ' + Number(n).toLocaleString('id-ID');
        }

        function addToCart(id, name, price) {
            const idx = cart.findIndex(i => i.id === id);
            if (idx > -1) {
                cart[idx].qty += 1;
            } else {
                cart.push({
                    id,
                    name,
                    price,
                    qty: 1
                });
            }
            renderCart();
            flash(`${name} ditambahkan`);
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            renderCart();
        }

        function updateQty(index, delta) {
            const newQty = cart[index].qty + delta;
            if (newQty < 1) return;
            cart[index].qty = newQty;
            renderCart();
        }

        function clearCart(confirmFirst = true) {
            if (!confirmFirst || confirm('Yakin ingin mengosongkan keranjang?')) {
                cart = [];
                renderCart();
            }
        }

        function renderCart() {
            const container = document.getElementById('cartItems');
            container.innerHTML = '';

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-inbox text-4xl mb-3"></i>
                        <p class="text-sm">Keranjang kosong</p>
                    </div>`;
            } else {
                cart.forEach((item, index) => {
                    const el = document.createElement('div');
                    el.className = 'border border-gray-200 rounded-lg p-3 hover:border-green-300 transition';
                    el.innerHTML = `
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-semibold text-gray-900 text-sm truncate max-w-[150px]">${item.name}</p>
                                <p class="text-xs text-gray-600">${currency(item.price)}</p>
                            </div>
                            <button onclick="removeFromCart(${index})" class="text-red-600 hover:bg-red-50 p-1 rounded text-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="updateQty(${index}, -1)" class="bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded text-xs">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input type="text" value="${item.qty}" class="w-10 text-center border border-gray-300 rounded text-xs" readonly>
                            <button onclick="updateQty(${index}, 1)" class="bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded text-xs">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <span class="text-xs font-semibold text-gray-900 ml-auto">
                                ${currency(item.price * item.qty)}
                            </span>
                        </div>
                    `;
                    container.appendChild(el);
                });
            }

            // Update Total
            const subtotal = cart.reduce((s, it) => s + it.price * it.qty, 0);
            const tax = Math.round(subtotal * TAX_RATE);
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = currency(subtotal);
            document.getElementById('tax').textContent = currency(tax);
            document.getElementById('total').textContent = currency(total);
        }

        // FUNGSI KIRIM DATA KE LARAVEL
        async function confirmOrder() {
            const name = document.getElementById('customerName').value.trim();
            const phone = document.getElementById('customerPhone').value.trim();

            if (!name) {
                alert('Masukkan nama pelanggan');
                return;
            }
            if (cart.length === 0) {
                alert('Keranjang kosong');
                return;
            }

            const btn = document.getElementById('confirmOrderBtn');
            const btnText = document.getElementById('btnText');

            // Loading State
            btn.disabled = true;
            btnText.textContent = 'Menyimpan...';
            btn.classList.add('opacity-75');

            try {
                url = "{{ route('owner.pesanan.store') }}";
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="csrf-token"]').getAttribute(
                            'value')
                    },
                    body: JSON.stringify({
                        customer_name: name,
                        customer_phone: phone,
                        items: cart
                    })
                });

                const result = await response.json();

                if (result.status === 'success') {
                    window.location.href = result.redirect_url;
                } else {
                    alert('Error: ' + result.message);
                }

            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan sistem');
            } finally {
                btn.disabled = false;
                btnText.textContent = 'Simpan Pesanan';
                btn.classList.remove('opacity-75');
            }
        }

        function flash(msg) {
            const el = document.createElement('div');
            el.textContent = msg;
            el.className = 'fixed bottom-6 right-6 bg-gray-800 text-white px-4 py-2 rounded shadow z-50 animate-bounce';
            document.body.appendChild(el);
            setTimeout(() => el.remove(), 2000);
        }

        // Listeners
        document.getElementById('clearCartBtn').addEventListener('click', () => clearCart(true));
        document.getElementById('confirmOrderBtn').addEventListener('click', confirmOrder);

        renderCart();
    </script>
@endsection
