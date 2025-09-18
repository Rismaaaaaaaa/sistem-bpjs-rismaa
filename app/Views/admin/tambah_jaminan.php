<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bpjs: {
                            primary: '#1c5ca4',
                            secondary: '#2c343c',
                            accent: '#e4943c',
                            light: '#93b0ca',
                            darkblue: '#0a1e3c'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
       
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }
       
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
</head>
<div class="mt-14 p-6">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-bpjs-accent/10">
                        <i class="fas fa-file-medical text-bpjs-accent text-xl"></i>
                    </div>
                    Input Data Jaminan Baru
                </h1>
                <p class="text-gray-600 mt-2 ml-11">Tambahkan data jaminan BPJS terbaru ke dalam sistem</p>
            </div>
           
        </div>
        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white p-5">
                <div class="flex items-center gap-3">
                    <i class="fas fa-info-circle text-bpjs-accent text-xl"></i>
                    <h2 class="text-xl font-semibold">Formulir Input Jaminan</h2>
                </div>
                <p class="text-blue-100 mt-2 ml-8">Lengkapi semua field yang wajib diisi (<span class="text-red-400">*</span>)</p>
            </div>
            <!-- Form Content -->
            <form action="/admin/jaminan/store" method="post" enctype="multipart/form-data" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nomor Penetapan -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-hashtag text-bpjs-primary mr-1"></i>
                        Nomor Penetapan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-file-signature absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="text" name="nomor_penetapan" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" placeholder="Masukkan nomor penetapan" required>
                    </div>
                </div>
                <!-- Tanggal Transaksi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar-day text-bpjs-primary mr-1"></i>
                        Tanggal Transaksi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="date" name="tanggal_transaksi" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" required>
                    </div>
                </div>
                <!-- Kode Transaksi / Voucher -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-ticket-alt text-bpjs-primary mr-1"></i>
                        Kode Transaksi / Voucher <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-barcode absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="text" name="kode_transaksi" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" placeholder="Masukkan kode transaksi" required>
                    </div>
                </div>
                <!-- Nomor KPJ -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-address-card text-bpjs-primary mr-1"></i>
                        Nomor KPJ <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-id-card absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="text" name="nomor_kpj" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" placeholder="Masukkan nomor KPJ" required>
                    </div>
                </div>
                <!-- Nomor Rak -->
                <!-- Nomor Rak -->
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-archive text-bpjs-primary mr-1"></i>
                    Nomor Rak <span class="text-red-500">*</span>
                </label>
                <div class="relative group">
                    <i class="fas fa-box absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 
                            group-focus-within:text-bpjs-accent"></i>
                    <input type="text" name="nomor_rak" placeholder="Contoh: 14"
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
                    <input type="text" name="nomor_baris" placeholder="Contoh: 14"
                        class="form-input w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 
                                focus:ring-bpjs-accent/50 bg-gray-50 hover:bg-white" required>
                </div>
                </div>

                <!-- Nama Tenaga Kerja -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-bpjs-primary mr-1"></i>
                        Nama Tenaga Kerja <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-id-badge absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="text" name="nama_tenaga_kerja" 
                            class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl 
                                    focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition 
                                    bg-gray-50 hover:bg-white" 
                            placeholder="Masukkan nama tenaga kerja" required>
                    </div>
                </div>

                <!-- Nama Perusahaan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-building text-bpjs-primary mr-1"></i>
                        Nama Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-landmark absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="text" name="nama_perusahaan" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" placeholder="Masukkan nama perusahaan" required>
                    </div>
                </div>
                <!-- PPh 21 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave text-bpjs-primary mr-1"></i>
                        PPh 21 (Rp) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-calculator absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="number" name="pph21" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" placeholder="Masukkan nilai PPh 21" required>
                    </div>
                </div>
                <!-- Jumlah Bayar -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-credit-card text-bpjs-primary mr-1"></i>
                        Jumlah Bayar (Rp) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-money-check absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="number" name="jumlah_bayar" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" placeholder="Masukkan jumlah bayar" required>
                    </div>
                </div>
                <!-- Nomor Rekening -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-wallet text-bpjs-primary mr-1"></i>
                        Nomor Rekening <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-credit-card absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="text" name="no_rekening" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" placeholder="Masukkan nomor rekening" required>
                    </div>
                </div>
                <!-- Rekening Atas Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user-circle text-bpjs-primary mr-1"></i>
                        Rekening Atas Nama <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-user-tie absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                        <input type="text" name="atas_nama" class="form-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" placeholder="Masukkan nama pemilik rekening" required>
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

                        <!-- multiple file input -->
                        <input type="file" name="dokumen[]" accept=".png,.jpg,.jpeg" class="hidden" id="fileInput" multiple>
                    </div>

                    <!-- Preview nama file -->
                    <div id="filePreview" class="mt-3 grid grid-cols-2 md:grid-cols-3 gap-3 hidden"></div>
                </div>


                <!-- Form Actions -->
                <div class="md:col-span-2 flex justify-end gap-4 pt-6 border-t border-gray-200 mt-4">
                    <button type="reset" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
                        <i class="fas fa-redo"></i>
                        Reset Form
                    </button>
                    <button type="submit" class="btn-submit flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition transform hover:scale-105">
                        <i class="fas fa-save"></i>
                        Simpan Data
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
                            <li>Pastikan semua data yang dimasukkan sudah benar sebelum disimpan</li>
                            <li>Data yang sudah disimpan tidak dapat diubah langsung, harap hubungi administrator</li>
                            <li>File upload maksimal 5MB dengan format PNG, JPG, atau JPEG</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('fileInput');
    const fileUploadArea = document.querySelector('.file-upload');
    const filePreview = document.getElementById('filePreview');

    fileUploadArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', handleFiles);

    function handleFiles() {
        if (fileInput.files.length > 0) {
            filePreview.innerHTML = '';
            filePreview.classList.remove('hidden');

            Array.from(fileInput.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const div = document.createElement('div');
                    div.className = "border rounded-lg p-2 bg-white shadow flex flex-col items-center";
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="${file.name}" class="w-full h-24 object-cover rounded mb-2">
                        <p class="text-xs text-gray-600 truncate w-full text-center">${file.name}</p>
                    `;
                    filePreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });

            // Ubah icon + teks status di upload area
            fileUploadArea.querySelector('i').className = "fas fa-check-circle text-3xl text-green-500 mb-3";
            fileUploadArea.querySelector('p.text-sm').textContent = "File berhasil dipilih";
            fileUploadArea.querySelector('p.text-xs').textContent = `${fileInput.files.length} file dipilih`;
            fileUploadArea.classList.add('border-green-400', 'bg-green-50');
        }
    }

    // drag & drop handler
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, () => {
            fileUploadArea.classList.add('border-bpjs-primary', 'bg-blue-100');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileUploadArea.addEventListener(eventName, () => {
            fileUploadArea.classList.remove('border-bpjs-primary', 'bg-blue-100');
        }, false);
    });

    fileUploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        fileInput.files = e.dataTransfer.files;
        handleFiles();
    }
});

    </script>
</div>
</html>
<?= $this->endSection() ?>