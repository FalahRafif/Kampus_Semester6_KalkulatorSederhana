const THEME_STORAGE_KEY = "kalkulator-theme";

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

function applyTheme(theme) {
    document.documentElement.setAttribute("data-theme", theme);
}

function updateToggleLabel(button) {
    const isDark = document.documentElement.getAttribute("data-theme") === "dark";
    button.textContent = isDark ? "Light Mode" : "Dark Mode";
    button.setAttribute("aria-label", isDark ? "Aktifkan mode terang" : "Aktifkan mode gelap");
    button.setAttribute("title", isDark ? "Pindah ke mode terang" : "Pindah ke mode gelap");
}

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

function initMultiInputForms() {
    const forms = document.querySelectorAll("[data-multi-input-form]");

    forms.forEach(function (form) {
        const container = form.querySelector("[data-values-container]");
        const addButton = form.querySelector("[data-add-input]");
        const minInput = Number(form.getAttribute("data-min-input") || "2");

        if (!container) {
            return;
        }

        function getRows() {
            return Array.from(container.querySelectorAll(".multi-input-row"));
        }

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

        if (addButton) {
            addButton.addEventListener("click", function () {
                container.appendChild(createRow(""));
                refreshRows();
            });
        }

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

applyTheme(resolveInitialTheme());

document.addEventListener("DOMContentLoaded", function () {
    createThemeToggle();
    initMultiInputForms();

    const cards = document.querySelectorAll(".operation-card");

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
