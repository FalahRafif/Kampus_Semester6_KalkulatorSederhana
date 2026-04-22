// Key localStorage untuk menyimpan preferensi tema user.
const THEME_STORAGE_KEY = "kalkulator-theme";

/*
ALUR BELAJAR (frontend interaksi):
1) Mulai dari bawah file: event DOMContentLoaded.
2) Lihat fungsi yang dipanggil berurutan:
    createThemeToggle() -> initMultiInputForms() -> efek hover kartu.
3) Kalau ingin tahu asal class/warna komponen, pindah ke assets/css/app.css.
4) Kalau ingin tahu alur submit backend, pindah ke file operator (mis. tambah.php).
*/

// Menentukan tema awal: prioritas dari localStorage, lalu preferensi sistem, default light.
function resolveInitialTheme() {
    const savedTheme = localStorage.getItem(THEME_STORAGE_KEY);

    if (savedTheme === "dark" || savedTheme === "light") {
        return savedTheme;
    }

    if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
        return "dark";
    }

    return "light";
}

// Menempelkan atribut tema pada root HTML agar variabel CSS ikut berubah.
function applyTheme(theme) {
    document.documentElement.setAttribute("data-theme", theme);
}

// Mengubah teks tombol toggle supaya sesuai kondisi tema saat ini.
function updateToggleLabel(button) {
    const isDark = document.documentElement.getAttribute("data-theme") === "dark";
    button.textContent = isDark ? "Light Mode" : "Dark Mode";
    button.setAttribute("aria-label", isDark ? "Aktifkan mode terang" : "Aktifkan mode gelap");
    button.setAttribute("title", isDark ? "Pindah ke mode terang" : "Pindah ke mode gelap");
}

// Membuat tombol toggle tema secara dinamis dan memasang event click.
function createThemeToggle() {
    const button = document.createElement("button");
    button.type = "button";
    button.className = "theme-toggle btn btn-sm";
    button.setAttribute("id", "themeToggle");

    updateToggleLabel(button);

    button.addEventListener("click", function () {
        const currentTheme = document.documentElement.getAttribute("data-theme") === "dark" ? "dark" : "light";
        const nextTheme = currentTheme === "dark" ? "light" : "dark";
        applyTheme(nextTheme);
        localStorage.setItem(THEME_STORAGE_KEY, nextTheme);
        updateToggleLabel(button);
    });

    document.body.appendChild(button);
}

// Menangani form multi-input: tambah kolom, hapus kolom, dan sinkronkan label/required.
function initMultiInputForms() {
    const forms = document.querySelectorAll("[data-multi-input-form]");

    forms.forEach(function (form) {
        const container = form.querySelector("[data-values-container]");
        const addButton = form.querySelector("[data-add-input]");
        const minInput = Number(form.getAttribute("data-min-input") || "2");

        if (!container) {
            return;
        }

        // Ambil semua baris input yang aktif saat ini.
        function getRows() {
            return Array.from(container.querySelectorAll(".multi-input-row"));
        }

        // Menjaga urutan label angka dan aturan minimal jumlah input.
        function refreshRows() {
            const rows = getRows();

            rows.forEach(function (row, index) {
                const label = row.querySelector(".input-group-text");
                const input = row.querySelector(".calc-value-input");
                const removeButton = row.querySelector(".remove-input-btn");

                if (label) {
                    label.textContent = "Angka " + (index + 1);
                }

                if (input) {
                    input.required = index < minInput;
                }

                if (removeButton) {
                    const shouldDisable = rows.length <= minInput || index < minInput;
                    removeButton.disabled = shouldDisable;
                }
            });
        }

        // Membuat satu baris input baru ketika user menekan tombol "Tambah Input".
        function createRow(value) {
            const row = document.createElement("div");
            row.className = "input-group multi-input-row";
            row.innerHTML =
                '<span class="input-group-text">Angka</span>' +
                '<input type="number" step="any" name="values[]" class="form-control calc-value-input" placeholder="Masukkan angka">' +
                '<button type="button" class="btn btn-outline-danger remove-input-btn">Hapus</button>';

            const input = row.querySelector(".calc-value-input");
            input.value = value || "";

            return row;
        }

        // Event tambah input.
        if (addButton) {
            addButton.addEventListener("click", function () {
                container.appendChild(createRow(""));
                refreshRows();
            });
        }

        // Event delegasi untuk tombol hapus input per baris.
        container.addEventListener("click", function (event) {
            const target = event.target;

            if (!(target instanceof HTMLElement) || !target.classList.contains("remove-input-btn")) {
                return;
            }

            const row = target.closest(".multi-input-row");

            if (!row) {
                return;
            }

            const rows = getRows();

            if (rows.length <= minInput) {
                return;
            }

            row.remove();
            refreshRows();
        });

        refreshRows();
    });
}

// Terapkan tema secepat mungkin untuk mencegah flicker saat halaman pertama kali muncul.
applyTheme(resolveInitialTheme());

document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi komponen interaktif setelah DOM siap.
    createThemeToggle();
    initMultiInputForms();

    const cards = document.querySelectorAll(".operation-card");

    // Efek spotlight mengikuti posisi kursor pada kartu menu di halaman utama.
    cards.forEach(function (card) {
        card.addEventListener("mousemove", function (event) {
            const rect = card.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;
            const rootStyle = getComputedStyle(document.documentElement);
            const hoverGlow = rootStyle.getPropertyValue("--card-hover-glow").trim() || "rgba(125, 211, 252, 0.28)";
            const cardBase = rootStyle.getPropertyValue("--operation-card-bg").trim() || "#ffffff";

            card.style.background = "radial-gradient(circle at " + x + "px " + y + "px, " + hoverGlow + ", " + cardBase + " 56%)";
        });

        card.addEventListener("mouseleave", function () {
            card.style.background = "";
        });
    });
});
