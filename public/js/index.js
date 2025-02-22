document.addEventListener("DOMContentLoaded", function () {
    let url = "{{ route('languages') }}";

    const dropdown = document.getElementById("language-dropdown");
    const languageText = document.getElementById("language-text");

    dropdown.addEventListener("change", async function () {
        const languageId = dropdown.value;

        if (languageId) {
            languageText.textContent = "Loading..."; // Временный текст

            try {
                const response = await fetch(url);
                const data = await response.json();

                languageText.textContent = data.language || "Not found"; // Обновляем язык
            } catch (error) {
                console.error("Ошибка загрузки языка:", error);
                languageText.textContent = "Error"; // Если ошибка, показать "Error"
            }
        } else {
            languageText.textContent = "Please select a language"; // Если язык не выбран
        }
    });
});
