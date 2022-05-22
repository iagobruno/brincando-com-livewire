document.addEventListener("alpine:init", () => {
    Alpine.data("tableState", () => ({
        areAllRowsSelected: false,
        hasAtLeastOneRowSelected: false,

        tableEl: null,

        init() {
            this.tableEl = this.$el;
        },

        /**
         * @example
         * <input type="checkbox" x-bind="checkAll">
         */
        checkAll: {
            "x-on:click": function (evt) {
                this.areAllRowsSelected = evt.currentTarget.checked;
                this.hasAtLeastOneRowSelected = evt.currentTarget.checked;

                this.tableEl
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
                    this.tableEl.querySelectorAll(
                        "tbody tr input[type=checkbox]"
                    )
                );
                const checkedCount = checkboxes.filter(
                    (el) => el.checked
                ).length;
                this.hasAtLeastOneRowSelected = checkedCount >= 1;
                this.areAllRowsSelected = checkedCount === checkboxes.length;
            },
        },

        removeOneRow(el) {
            el.classList.add(
                "opacity-60",
                "pointer-events-none",
                "line-through"
            );
            Livewire.emit("removeTodos", [el.id]);
        },
        removeAllSelectedRows() {
            const rows = Array.from(this.tableEl.querySelectorAll("tbody tr"));
            const selectedRows = rows.filter(
                (row) => row.querySelector("input[type=checkbox]").checked
            );
            const selectedids = selectedRows.map((el) => el.id);
            Livewire.emit("removeTodos", selectedids);

            this.areAllRowsSelected = false;
            this.hasAtLeastOneRowSelected = false;
        },
    }));

    Alpine.data("alertState", () => ({
        show: false,
        message: "",

        showTemporarily(message) {
            this.message = message;
            this.show = true;
            setTimeout(() => {
                this.show = false;
                this.message = "";
            }, 5000);
        },

        init() {
            Livewire.on("todosRemoved", (ids) => {
                const plural = ids.length > 1 ? "s" : "";
                this.showTemporarily(`✅ Todo${plural} removido${plural}!`);
            });
            Livewire.on("todoAdded", () =>
                this.showTemporarily("✅ Todo adicionado!")
            );
        },
    }));

    Alpine.data("dialogState", () => ({
        show: false,
        lastFocusedElemBeforeOpen: null,
        rootEl: null,

        openDialog() {
            this.lastFocusedElemBeforeOpen = document.activeElement;
            this.show = true;
        },
        closeDialog() {
            this.show = false;
            this.lastFocusedElemBeforeOpen?.focus();
            this.lastFocusedElemBeforeOpen = null;
        },

        init() {
            this.rootEl = this.$el;
            Livewire.on("todoAdded", () => this.closeDialog());
        },
    }));
});
