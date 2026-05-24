import "./bootstrap";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

// Pastikan DOM sudah siap sebelum menjalankan script
document.addEventListener("DOMContentLoaded", () => {
    const editorElement = document.querySelector("#editor");

    if (editorElement) {
        ClassicEditor.create(editorElement, {
            toolbar: [
                "heading",
                "|",
                "bold",
                "italic",
                "underline",
                "|",
                "alignment:left",
                "alignment:center",
                "alignment:right",
                "alignment:justify",
                "|",
                "bulletedList",
                "numberedList",
                "|",
                "undo",
                "redo",
            ],
        })
            .then((editor) => {
                const textarea = editorElement;
                const form = textarea.closest("form");
                if (form) {
                    form.addEventListener("submit", () => {
                        textarea.value = editor.getData();
                    });
                }
            })
            .catch((error) => {
                console.error("Ada masalah saat inisialisasi CKEditor:", error);
            });
    }
});
