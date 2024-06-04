import "flowbite";
import Alpine from "alpinejs";

window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("errorDialog", () => ({
        open: true,

        init() {
            setTimeout(() => {
                this.open = false;
            }, 4000);
        },
    }));
});

Alpine.start();
