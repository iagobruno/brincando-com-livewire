import * as Turbo from "@hotwired/turbo";
import Alpine from "alpinejs";
import focusPlugin from "@alpinejs/focus";
import swipePlugin from "alpinejs-swipe";
import detectBackButton from "detect-browser-back-navigation";

Alpine.plugin(focusPlugin);
Alpine.plugin(swipePlugin);

/**
 * @example
 * <table x-data="tableState($el)">...</table>
 */
Alpine.data("tableState", (tableElement) => ({
    areAllRowsSelected: false,
    hasAtLeastOneRowSelected: false,

    /**
     * @example
     * <input type="checkbox" x-bind="checkAll">
     */
    checkAll: {
        "x-on:click": function (evt) {
            this.areAllRowsSelected = evt.currentTarget.checked;
            this.hasAtLeastOneRowSelected = evt.currentTarget.checked;

            tableElement
                .querySelectorAll("tbody tr input[type=checkbox]")
                .forEach((elem) => {
                    elem.checked = evt.currentTarget.checked;
                });
        },
        "x-effect": `
                $el.checked = hasAtLeastOneRowSelected;
                $el.indeterminate = hasAtLeastOneRowSelected && !areAllRowsSelected;
            `,
    },

    /**
     * @example
     * <input type="checkbox" x-bind="checkRow">
     */
    checkRow: {
        "x-on:click": function (evt) {
            const checkboxes = Array.from(
                tableElement.querySelectorAll("tbody tr input[type=checkbox]")
            );
            const checkedCount = checkboxes.filter((el) => el.checked).length;
            this.hasAtLeastOneRowSelected = checkedCount >= 1;
            this.areAllRowsSelected = checkedCount === checkboxes.length;
        },
    },

    removeOneRow(el) {
        el.classList.add("opacity-60", "pointer-events-none", "line-through");
        Livewire.emit("removeProducts", [el.id]);
    },
    removeAllSelectedRows() {
        const rows = Array.from(tableElement.querySelectorAll("tbody tr"));
        const selectedRows = rows.filter(
            (row) => row.querySelector("input[type=checkbox]").checked
        );
        const selectedids = selectedRows.map((el) => el.id);
        Livewire.emit("removeProducts", selectedids);

        this.areAllRowsSelected = false;
        this.hasAtLeastOneRowSelected = false;
    },
}));

/**
 * Estado reutilizável para dialogs totalmente acessíveis.
 */
Alpine.data("dialog", (rootElem) => ({
    show: false,

    init() {
        this.$nextTick(() => (this.show = true));
    },

    openDialog() {
        this.show = true;

        // this.unsubPopState = detectBackButton(() => {
        //     this.closeDialog();
        // });
    },
    closeDialog() {
        this.show = false;
        Livewire.emit("closeModal", rootElem.id);

        // this.unsubPopState();
    },
    closeFromSwipeGesture() {
        if (this.$refs.dialogEl.scrollTop === 0) {
            this.closeDialog();
        }
    },

    /**
     * @example
     * <button x-bind="trigger">...</button>
     */
    trigger: {
        "x-on:click": "openDialog",
    },
    /**
     * @example
     * <div x-bind="backdrop" class="backdrop">...</div>
     */
    backdrop: {
        "x-on:mousedown": "closeDialog",
        "x-on:touchstart": "closeDialog",
    },
    /**
     * @example
     * <div x-bind="dialogEl" role="dialog">...</div>
     */
    dialogEl: {
        "x-ref": "dialogEl",
        "x-trap.noscroll.inert": "show",
        "x-on:click.stop": "",
        "x-on:keydown.escape.prevent.stop": "closeDialog",
        // NEEDS -> https://www.npmjs.com/package/alpinejs-swipe
        "x-swipe:down.threshold.50px": "closeFromSwipeGesture",
        tabindex: "-1",
    },
}));

Alpine.data("dropdown", () => ({
    show: false,

    toggleDropdown() {
        this.show ? this.closeDropdown() : this.openDropdown();
    },
    openDropdown() {
        this.show = true;
    },
    closeDropdown() {
        this.show = false;
    },

    /**
     * @example
     * <button x-bind="trigger">...</button>
     */
    trigger: {
        "x-on:click": "toggleDropdown",
    },
    /**
     * @example
     * <div class="dropdown" x-bind="panel" role="menu">...</div>
     */
    menu: {
        "x-show": "show",
        "x-trap": "show",
        "x-on:click.outside": "closeDropdown",
        "x-on:keydown.escape.prevent.stop": "closeDropdown",
        "x-on:keydown.down.prevent.stop": "$focus.wrap().next()",
        "x-on:keydown.up.prevent.stop": "$focus.wrap().previous()",
        tabindex: "-1",
    },
    /**
     * @example
     * <button class="dropdown_item" x-bind="panelItem" role="menuitem">...</button>
     */
    menuItem: {
        "x-on:click": "closeDropdown",
    },
}));

/**
 * How to display a notification:
 * Alpine.store("notifications").showNotification({ text: 'Added!', type: 'success', duration: 5000 })
 */
Alpine.store("notifications", {
    notifications: [],

    init() {
        Livewire.on("notify", (text, type = "info") => {
            this.showNotification({ text, type });
        });
    },

    showNotification(data) {
        this.notifications.push({
            ...data,
            id: Date.now(),
        });
    },
    removeNotification(id) {
        this.notifications = this.notifications.filter(
            (notif) => notif.id !== id
        );
    },
});

Alpine.data("notificationState", () => ({
    show: false,
    init() {
        this.$nextTick(() => (this.show = true));
        setTimeout(() => {
            this.fadeOut();
        }, this.notification.duration ?? 5000);
    },
    fadeOut() {
        this.show = false;
        setTimeout(() => {
            Alpine.store("notifications").removeNotification(
                this.notification.id
            );
        }, 500);
    },
}));

Alpine.start();
window.Alpine = Alpine;
