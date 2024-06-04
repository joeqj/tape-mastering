/*
  Mainly handles coupon logic
*/

export default () => ({
    csrf: "",
    coupon: "",
    hasDiscount: false,
    discount: 0,
    hasError: false,
    error: "",
    total: 0,
    displayedTotal: "",
    discountPrice: 0,

    async checkCoupon() {
        if (!this.csrf.length) return;

        this.coupon = this.$refs.coupon.value;

        if (this.coupon.length === 0) return;

        const userInput = new FormData();
        userInput.append("coupon", this.coupon);
        userInput.append("total", this.total);
        userInput.append("_token", this.csrf);

        const response = await fetch("/check-coupon", {
            method: "POST",
            body: userInput,
        });

        const data = await response.json();

        if (data.error) {
            this.hasError = true;
            this.error = data.error;
        } else {
            this.hasError = false;
            this.error = "";

            this.hasDiscount = true;
            this.discount = data.discount.toFixed(2);
            this.total = data.total.toFixed(2);
            this.displayedTotal = "£" + this.total.toString();
        }
    },

    init() {
        this.csrf = this.$el.querySelector("input[name='_token']").value;

        if (this.$refs.total) {
            this.total = parseFloat(this.$refs.total.textContent.slice(1));
            this.displayedTotal = this.$refs.total.textContent;
        }
    },
});
