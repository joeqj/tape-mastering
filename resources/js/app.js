import "flowbite";
import Alpine from "alpinejs";

window.Alpine = Alpine;

import toastDialog from "./behaviours/toastDialog";
Alpine.data("toastDialog", toastDialog);

import orderForm from "./behaviours/orderForm";
Alpine.data("orderForm", orderForm);

Alpine.start();
