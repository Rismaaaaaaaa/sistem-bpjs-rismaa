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
                        placeholder="0" required>
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
                    Upload Dokumen (PNG/JPG) <span class="text-red-500">*</span>
                </label>
                <div id="fileUploadArea"
                    class="file-upload border-2 border-dashed border-gray-300 rounded-xl p-5 text-center transition cursor-pointer hover:border-bpjs-primary hover:bg-blue-50 group">
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3 group-hover:text-bpjs-accent"></i>
                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload atau drag & drop file di sini</p>
                    <p class="text-xs text-gray-500">Format: PNG, JPG, JPEG (Maks. 5MB)</p>
                    <input type="file" name="dokumen[]" accept=".png,.jpg,.jpeg" class="hidden" id="fileInput" multiple>
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
document.addEventListener('DOMContentLoaded', () => {
    // Program selection handler
    const programSelect = document.getElementById("programSelect");
    const programInputWrapper = document.getElementById("programInputWrapper");
    const programInput = document.getElementById("programInput");

    if (programSelect) {
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
    }

    // Currency formatting
    const jumlahRupiahInput = document.getElementById('jumlahRupiah');
    const jumlahRupiahRaw = document.getElementById('jumlahRupiahRaw');

    if (jumlahRupiahInput) {
        jumlahRupiahInput.addEventListener('input', () => {
            formatCurrency(jumlahRupiahInput);
        });
    }

    // Multiple file upload handling
    const fileInput = document.getElementById('fileInput');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const filePreview = document.getElementById('filePreview');

    if (fileInput && fileUploadArea && filePreview) {
        // Click to open file input
        fileUploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, () => {
                fileUploadArea.classList.add('border-bpjs-primary', 'bg-blue-50');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, () => {
                fileUploadArea.classList.remove('border-bpjs-primary', 'bg-blue-50');
            }, false);
        });

        fileUploadArea.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            handleFiles(files);
        }, false);

        // File input change
        fileInput.addEventListener('change', () => {
            handleFiles(fileInput.files);
        });

        // Handle files function
        function handleFiles(files) {
            filePreview.innerHTML = '';
            filePreview.classList.remove('hidden');

            Array.from(files).forEach((file, index) => {
                // Validate file type
                const validTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    // Use native alert or console for now, assuming SweetAlert2 is available
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: `File ${file.name} bukan PNG/JPG!`,
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                    } else {
                        alert(`File ${file.name} bukan format PNG/JPG!`);
                    }
                    return;
                }

                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: `File ${file.name} melebihi 5MB!`,
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                    } else {
                        alert(`File ${file.name} melebihi ukuran 5MB!`);
                    }
                    return;
                }

                // Create preview
                const reader = new FileReader();
                reader.onload = (e) => {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'relative bg-gray-100 rounded-lg p-2 flex items-center gap-2 border border-gray-200';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="${file.name}" class="w-16 h-16 object-cover rounded-lg">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-700 truncate" title="${file.name}">${file.name}</p>
                            <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(2)} KB</p>
                        </div>
                        <button type="button" class="remove-file text-red-500 hover:text-red-700 p-1" onclick="removeFile(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                    filePreview.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            });
        }

        // Function to remove file (global for onclick)
        window.removeFile = function(index) {
            const dt = new DataTransfer();
            const currentFiles = Array.from(fileInput.files);
            currentFiles.splice(index, 1);
            currentFiles.forEach(f => dt.items.add(f));
            fileInput.files = dt.files;
            filePreview.innerHTML = '';
            handleFiles(fileInput.files);
            if (fileInput.files.length === 0) {
                filePreview.classList.add('hidden');
            }
        };
    }
});

// Format currency function
function formatCurrency(input) {
    let value = input.value.replace(/\D/g, "");
    if (value) {
        input.value = new Intl.NumberFormat('id-ID').format(value);
        document.getElementById('jumlahRupiahRaw').value = value;
    } else {
        input.value = "";
        document.getElementById('jumlahRupiahRaw').value = "";
    }
}
</script>

<?= $this->endSection() ?>