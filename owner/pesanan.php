<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pemilik') {
    header('Location: ../login.php');
    exit;
}

$user = $_SESSION['user'];

// Data produk dummy
$products = [
    ['id' => 1, 'name' => 'Kopi Arabika Premium', 'price' => 25000, 'image' => '☕'],
    ['id' => 2, 'name' => 'Kopi Robusta Lokal', 'price' => 20000, 'image' => '☕'],
    ['id' => 3, 'name' => 'Kopi Luwak Special', 'price' => 45000, 'image' => '☕'],
    ['id' => 4, 'name' => 'Paket Kopi Mix', 'price' => 60000, 'image' => '☕'],
];

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem POS - UMKMTerdekat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-600 p-2 rounded-xl">
                        <i class="fa-solid fa-store text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-green-700">UMKMTerdekat</h1>
                        <p class="text-xs text-gray-500">Sistem POS</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-gray-600 hover:text-gray-900">
                        <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <a href="../logout.php" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content (Daftar Produk) -->
            <div class="lg:col-span-2">
                <!-- Title -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Tambah Pesanan</h2>
                    <p class="text-gray-600">Pilih produk untuk membuat pesanan baru</p>
                </div>

                <!-- Daftar Produk -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <?php foreach ($products as $product): ?>
                        <div class="bg-white rounded-xl shadow-md p-4 border border-gray-100 hover:shadow-lg hover:border-green-300 transition cursor-pointer" onclick="addToCart(<?= $product['id'] ?>, '<?= addslashes($product['name']) ?>', <?= $product['price'] ?>)">
                            <div class="text-4xl mb-3"><?= $product['image'] ?></div>
                            <h4 class="font-semibold text-gray-900 mb-2"><?= $product['name'] ?></h4>
                            <p class="text-lg font-bold text-green-600">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                            <button type="button" onclick="event.stopPropagation(); addToCart(<?= $product['id'] ?>, '<?= addslashes($product['name']) ?>', <?= $product['price'] ?>)" class="w-full mt-3 bg-green-100 hover:bg-green-200 text-green-700 py-2 rounded-lg text-sm font-semibold transition">
                                <i class="fa-solid fa-plus mr-2"></i>Tambah
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Right Sidebar (Keranjang) -->
            <div>
                <!-- Keranjang Pesanan -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fa-solid fa-shopping-cart mr-2"></i>Keranjang Pesanan
                    </h3>

                    <!-- Daftar Item -->
                    <div id="cartItems" class="space-y-3 mb-6 max-h-96 overflow-y-auto">
                        <!-- List diisi JS -->
                        <div class="text-center py-8 text-gray-500">
                            <i class="fa-solid fa-inbox text-4xl mb-3"></i>
                            <p class="text-sm">Keranjang kosong</p>
                        </div>
                    </div>

                    <!-- Total -->
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

                    <!-- Form Input Pelanggan -->
                    <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan</label>
                            <input type="text" id="customerName" placeholder="Masukkan nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="text" id="customerPhone" placeholder="Nomor WhatsApp" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="space-y-3">
                        <button id="clearCartBtn" class="w-full bg-red-50 hover:bg-red-100 text-red-700 py-2 rounded-lg font-semibold text-sm transition">
                            <i class="fa-solid fa-trash mr-2"></i>Kosongkan
                        </button>
                        <button id="confirmOrderBtn" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Simpan Pesanan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Semua operasi keranjang + checkout dilakukan di browser (localStorage).
        const TAX_RATE = 0.1;
        const CART_KEY = 'pos_demo_cart';
        const ORDERS_KEY = 'pos_demo_orders';

        function currency(n) {
            return 'Rp ' + Number(n).toLocaleString('id-ID');
        }

        function loadCart() {
            try {
                return JSON.parse(localStorage.getItem(CART_KEY)) || [];
            } catch {
                return [];
            }
        }

        function saveCart(cart) {
            localStorage.setItem(CART_KEY, JSON.stringify(cart));
            renderCart();
        }

        function addToCart(id, name, price) {
            const cart = loadCart();
            const idx = cart.findIndex(i => i.id === id);
            if (idx > -1) cart[idx].qty += 1;
            else cart.push({ id, name, price, qty: 1 });
            saveCart(cart);
            flash(`${name} ditambahkan ke keranjang`);
        }

        function removeFromCart(index) {
            const cart = loadCart();
            if (!cart[index]) return;
            const name = cart[index].name;
            cart.splice(index, 1);
            saveCart(cart);
            flash(`${name} dihapus dari keranjang`);
        }

        function increaseQty(index) {
            const cart = loadCart();
            if (!cart[index]) return;
            cart[index].qty += 1;
            saveCart(cart);
        }

        function decreaseQty(index) {
            const cart = loadCart();
            if (!cart[index]) return;
            cart[index].qty = Math.max(1, cart[index].qty - 1);
            saveCart(cart);
        }

        function clearCart(confirmFirst = true) {
            if (!confirmFirst || confirm('Yakin ingin mengosongkan keranjang?')) {
                localStorage.removeItem(CART_KEY);
                renderCart();
                flash('Keranjang dikosongkan');
            }
        }

        function confirmOrder() {
            const name = document.getElementById('customerName').value.trim();
            const phone = document.getElementById('customerPhone').value.trim();
            const cart = loadCart();
            if (!name) { alert('Masukkan nama pelanggan'); return; }
            if (cart.length === 0) { alert('Keranjang kosong'); return; }

            const subtotal = cart.reduce((s, it) => s + it.price * it.qty, 0);
            const tax = Math.round(subtotal * TAX_RATE);
            const total = subtotal + tax;

            const orders = JSON.parse(localStorage.getItem(ORDERS_KEY) || '[]');
            const order = {
                id: Date.now(),
                customer: { name, phone },
                items: cart,
                subtotal, tax, total,
                created_at: new Date().toISOString()
            };
            orders.push(order);
            localStorage.setItem(ORDERS_KEY, JSON.stringify(orders));

            // clear cart and form
            clearCart(false);
            document.getElementById('customerName').value = '';
            document.getElementById('customerPhone').value = '';
            flash(`Pesanan untuk ${name} berhasil disimpan`);
        }

        function renderCart() {
            const cart = loadCart();
            const container = document.getElementById('cartItems');
            container.innerHTML = '';

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-inbox text-4xl mb-3"></i>
                        <p class="text-sm">Keranjang kosong</p>
                    </div>
                `;
            } else {
                cart.forEach((item, index) => {
                    const el = document.createElement('div');
                    el.className = 'border border-gray-200 rounded-lg p-3 hover:border-green-300 transition';
                    el.innerHTML = `
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">${escapeHtml(item.name)}</p>
                                <p class="text-xs text-gray-600">${currency(item.price)}</p>
                            </div>
                            <button class="text-red-600 hover:bg-red-50 p-1 rounded text-sm" data-remove="${index}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded text-xs" data-decrease="${index}">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input type="text" value="${item.qty}" class="w-10 text-center border border-gray-300 rounded text-xs" readonly>
                            <button class="bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded text-xs" data-increase="${index}">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <span class="text-xs font-semibold text-gray-900 ml-auto">
                                ${currency(item.price * item.qty)}
                            </span>
                        </div>
                    `;
                    container.appendChild(el);
                });

                // attach listeners using delegation
                container.querySelectorAll('[data-remove]').forEach(btn => {
                    btn.addEventListener('click', () => removeFromCart(Number(btn.getAttribute('data-remove'))));
                });
                container.querySelectorAll('[data-increase]').forEach(btn => {
                    btn.addEventListener('click', () => increaseQty(Number(btn.getAttribute('data-increase'))));
                });
                container.querySelectorAll('[data-decrease]').forEach(btn => {
                    btn.addEventListener('click', () => decreaseQty(Number(btn.getAttribute('data-decrease'))));
                });
            }

            // totals
            const subtotal = cart.reduce((s, it) => s + it.price * it.qty, 0);
            const tax = Math.round(subtotal * TAX_RATE);
            const total = subtotal + tax;
            document.getElementById('subtotal').textContent = currency(subtotal);
            document.getElementById('tax').textContent = currency(tax);
            document.getElementById('total').textContent = currency(total);
        }

        function escapeHtml(text) {
            return String(text).replace(/[&<>"']/g, function (m) {
                return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' })[m];
            });
        }

        function flash(msg) {
            if (!msg) return;
            const el = document.createElement('div');
            el.textContent = msg;
            el.className = 'fixed bottom-6 right-6 bg-gray-800 text-white px-4 py-2 rounded shadow';
            document.body.appendChild(el);
            setTimeout(() => el.classList.add('opacity-0'), 1600);
            setTimeout(() => el.remove(), 2200);
        }

        // init
        document.getElementById('clearCartBtn').addEventListener('click', () => clearCart(true));
        document.getElementById('confirmOrderBtn').addEventListener('click', confirmOrder);
        renderCart();
    </script>
</body>

</html>