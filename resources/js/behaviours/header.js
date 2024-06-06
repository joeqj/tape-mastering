/*
  Handles scroll and mobile menu
*/

export default () => ({
    isScrolled: false,

    init() {
        if (window.scrollY > 20) {
            this.isScrolled = true;
        }

        window.addEventListener("scroll", (event) => {
            if (window.scrollY > 20) {
                this.isScrolled = true;
            } else {
                this.isScrolled = false;
            }
        });
    },
});
