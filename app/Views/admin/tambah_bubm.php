<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="p-6 mt-14">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-3">
                <div class="p-2 rounded-lg bg-bpjs-accent/10">
                    <i class="fas fa-money-check-alt text-bpjs-accent text-xl"></i>
                </div>
                Tambah Data BUBM Baru
            </h1>
            <p class="text-gray-600 mt-2 ml-11">Tambahkan data BUBM ke dalam sistem</p>
        </div>
        <a href="<?= site_url('admin/bubm') ?>" 
           class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left"></i> Kembali ke Data BUBM
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white p-5">
            <div class="flex items-center gap-3">
                <i class="fas fa-info-circle text-bpjs-accent text-xl"></i>
                <h2 class="text-xl font-semibold">Formulir Input BUBM</h2>
            </div>
            <p class="text-blue-100 mt-2 ml-8">Lengkapi semua field yang wajib diisi (<span class="text-red-400">*</span>)</p>
        </div>

        <!-- Form Content -->
    <form action="<?= site_url('admin/bubm/store') ?>" method="post" enctype="multipart/form-data" 
        class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <?= csrf_field() ?>

        <!-- Nomor Voucher -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-ticket-alt text-bpjs-primary mr-1"></i>
                Nomor Voucher <span class="text-red-500">*</span>
            </label>
            <div class="relative group">
                <i class="fas fa-barcode absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 
                    group-focus-within:text-bpjs-accent"></i>
                <input type="text" name="voucher" 
                    class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl 
                    focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" 
                    placeholder="Contoh: RB018 01" required>
            </div>
            <p class="text-xs text-gray-500 mt-2 ml-1">
                <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                Kode transaksi akan digenerate otomatis: <?= date('d/m/Y') ?> - [Voucher]
            </p>
        </div>

        <!-- Program -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-list-alt text-bpjs-primary mr-1"></i>
                Program <span class="text-red-500">*</span>
            </label>
            <div class="relative group">
                <i class="fas fa-project-diagram absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 
                    group-focus-within:text-bpjs-accent"></i>
                <select name="program" id="programSelect"
                    class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl 
                    focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none bg-gray-50 hover:bg-white">
                    <option value="">-- Pilih Program --</option>
                    <option value="BUBM">BUBM</option>
                    <option value="lainnya">Lainnya...</option>
                </select>
                <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 
                    pointer-events-none group-focus-within:text-bpjs-accent"></i>
            </div>

            <!-- Input manual program -->
            <div class="relative mt-3 hidden" id="programInputWrapper">
                <i class="fas fa-keyboard absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 
                    group-focus-within:text-bpjs-accent"></i>
                <input type="text" name="program_manual" id="programInput"
                    class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl 
                    focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white"
                    placeholder="Masukkan program lain...">
            </div>
        </div>

        <!-- Jumlah Rupiah -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-money-bill-wave text-bpjs-primary mr-1"></i>
                Jumlah Rupiah (Rp) <span class="text-red-500">*</span>
            </label>
            <div class="relative group">
                <i class="fas fa-calculator absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 
                    group-focus-within:text-bpjs-accent"></i>
                <input type="text" id="jumlahRupiah"
                    class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl 
                    focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" 
                    placeholder="0" required oninput="formatCurrency(this)">
                <input type="hidden" name="jumlah_rupiah" id="jumlahRupiahRaw">
            </div>
        </div>

        <!-- Tanggal Input -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-calendar-day text-bpjs-primary mr-1"></i>
                Tanggal Input <span class="text-red-500">*</span>
            </label>
            <div class="relative group">
                <i class="fas fa-calendar-check absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 
                    group-focus-within:text-bpjs-accent"></i>
                <input type="date" name="tanggal_input" 
                    value="<?= date('Y-m-d') ?>" 
                    class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl 
                    focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" required>
            </div>
        </div>

        <!-- Nomor Rak -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-archive text-bpjs-primary mr-1"></i>
                Nomor Rak <span class="text-red-500">*</span>
            </label>
            <div class="relative group">
                <i class="fas fa-box absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 
                    group-focus-within:text-bpjs-accent"></i>
                <input type="text" name="nomor_rak" 
                    placeholder="Contoh: 14"
                    class="form-input w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 
                    focus:ring-bpjs-accent/50 bg-gray-50 hover:bg-white" required>
            </div>
        </div>

        <!-- Nomor Baris -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-stream text-bpjs-primary mr-1"></i>
                Nomor Baris <span class="text-red-500">*</span>
            </label>
            <div class="relative group">
                <i class="fas fa-th-list absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 
                    group-focus-within:text-bpjs-accent"></i>
                <input type="text" name="nomor_baris" 
                    placeholder="Contoh: 14"
                    class="form-input w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 
                    focus:ring-bpjs-accent/50 bg-gray-50 hover:bg-white" required>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-file-alt text-bpjs-primary mr-1"></i>
                Keterangan
            </label>
            <div class="relative group">
                <i class="fas fa-comment absolute left-3 top-3.5 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                <textarea name="keterangan" rows="3"
                    class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl 
                    focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white"
                    placeholder="Tambahkan keterangan (opsional)"></textarea>
            </div>
        </div>

        <!-- Upload Dokumen -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-file-upload text-bpjs-primary mr-1"></i>
                Upload Dokumen (PNG/JPG/PDF) <span class="text-red-500">*</span>
            </label>
            <div id="fileUploadArea"
                class="file-upload border-2 border-dashed border-gray-300 rounded-xl p-5 text-center transition cursor-pointer hover:border-bpjs-primary hover:bg-blue-50 group">
                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3 group-hover:text-bpjs-accent"></i>
                <p class="text-sm text-gray-600 mb-1">Klik untuk upload atau drag & drop file di sini</p>
                <p class="text-xs text-gray-500">Format: PNG, JPG, JPEG, PDF (Maks. 5MB)</p>
                <input type="file" name="dokumen[]" accept=".png,.jpg,.jpeg,.pdf" id="fileInput" class="hidden" multiple>
            </div>
            <div id="filePreview" class="mt-3 grid grid-cols-2 md:grid-cols-3 gap-3 hidden"></div>
        </div>

        <!-- Form Actions -->
        <div class="md:col-span-2 flex justify-end gap-4 pt-6 border-t border-gray-200 mt-4">
            <button type="reset" 
                class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
                <i class="fas fa-redo"></i> Reset Form
            </button>
            <button type="submit" 
                class="btn-submit flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition transform hover:scale-105">
                <i class="fas fa-save"></i> Simpan Data BUBM
            </button>
        </div>
    </form>

    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border-l-4 border-bpjs-primary p-4 rounded-r mt-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-bpjs-primary text-lg mt-1"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-bpjs-primary">Informasi Penting</h3>
                <div class="text-sm text-gray-600 mt-2">
                    <ul class="list-disc list-inside space-y-1">
                        <li>Pastikan nomor voucher sesuai dengan dokumen fisik</li>
                        <li>Jumlah rupiah harus sesuai dengan nilai yang tercantum dalam dokumen</li>
                        <li>Upload bukti dokumen pendukung untuk validasi data</li>
                        <li>Data yang sudah disimpan tidak dapat diubah langsung, harap hubungi administrator</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(228, 148, 60, 0.2);
        border-color: #e4943c;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(228, 148, 60, 0.4);
    }
    
    .file-upload:hover {
        border-color: #1c5ca4;
        background-color: #f0f7ff;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Program selection handler
    const programSelect = document.getElementById("programSelect");
    const programInputWrapper = document.getElementById("programInputWrapper");
    const programInput = document.getElementById("programInput");

    programSelect.addEventListener("change", () => {
        if (programSelect.value === "lainnya") {
            programInputWrapper.classList.remove("hidden");
            programInput.required = true;
        } else {
            programInputWrapper.classList.add("hidden");
            programInput.required = false;
            programInput.value = "";
        }
    });

    // File upload interaction
    const fileInput = document.getElementById('fileInput');
    const fileUploadArea = document.querySelector('.file-upload');
    const fileName = document.getElementById('fileName');

    fileUploadArea.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            showUploadedFile(this.files[0]);
        }
    });

    // Drag and drop for file upload
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileUploadArea.classList.add('border-bpjs-primary', 'bg-blue-100');
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileUploadArea.classList.remove('border-bpjs-primary', 'bg-blue-100');
    });

    fileUploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;

        if (files.length > 0) {
            showUploadedFile(files[0]);
        }
    }

    function showUploadedFile(file) {
        fileName.textContent = 'File terpilih: ' + file.name;
        fileName.classList.remove('hidden');
        fileUploadArea.classList.add('border-green-400', 'bg-green-50');
        fileUploadArea.innerHTML = `
            <i class="fas fa-check-circle text-3xl text-green-500 mb-3"></i>
            <p class="text-sm text-green-600 mb-1">File berhasil dipilih</p>
            <p class="text-xs text-green-500">${file.name}</p>
        `;
    }

    // Amount in words functionality
    const amountInput = document.querySelector('input[name="jumlah_rupiah"]');
    const amountInWords = document.getElementById('amountInWords');
    const jumlahRupiahRaw = document.getElementById('jumlahRupiahRaw');

    amountInput.addEventListener('input', function() {
        formatCurrency(this);
        if (jumlahRupiahRaw.value) {
            amountInWords.textContent = 'Terbilang: ' + numberToWords(jumlahRupiahRaw.value);
        } else {
            amountInWords.textContent = 'Terbilang: -';
        }
    });
});

// ✅ Format currency + simpan angka mentah
function formatCurrency(input) {
    let value = input.value.replace(/\D/g, ""); // hanya angka
    if (value) {
        input.value = new Intl.NumberFormat('id-ID').format(value);
        document.getElementById('jumlahRupiahRaw').value = value; // simpan angka mentah
    } else {
        input.value = "";
        document.getElementById('jumlahRupiahRaw').value = "";
    }
}

// ✅ Konversi angka ke kata
function numberToWords(num) {
    const satuan = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan"];
    const belasan = ["sepuluh", "sebelas", "dua belas", "tiga belas", "empat belas",
                     "lima belas", "enam belas", "tujuh belas", "delapan belas", "sembilan belas"];
    const puluhan = ["", "", "dua puluh", "tiga puluh", "empat puluh", "lima puluh",
                     "enam puluh", "tujuh puluh", "delapan puluh", "sembilan puluh"];
    const ribuan = ["", "ribu", "juta", "miliar", "triliun"];

    if (num === "0") return "nol";

    let str = "";
    let i = 0;

    while (num.length > 0) {
        let chunk = parseInt(num.slice(-3));
        num = num.slice(0, -3);

        if (chunk) {
            let chunkStr = "";

            let ratus = Math.floor(chunk / 100);
            let puluh = Math.floor((chunk % 100) / 10);
            let satu = chunk % 10;

            if (ratus > 0) {
                chunkStr += (ratus === 1 ? "seratus" : satuan[ratus] + " ratus") + " ";
            }

            if (puluh > 1) {
                chunkStr += puluhan[puluh] + " " + satuan[satu] + " ";
            } else if (puluh === 1) {
                chunkStr += belasan[satu] + " ";
            } else if (satu > 0) {
                chunkStr += satuan[satu] + " ";
            }

            str = chunkStr + ribuan[i] + " " + str;
        }

        i++;
    }

    return str.trim();
}
</script>

<?= $this->endSection() ?>