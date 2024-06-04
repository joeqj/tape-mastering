/*
  Shows a notification in the bottom left of the screen
  @params speed: number
*/

export default (speed = 4000) => ({
    open: true,

    init() {
        setTimeout(() => {
            this.open = false;
        }, speed);
    },
});
