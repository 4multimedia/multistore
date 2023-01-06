<template>
    <div>
        <button @click="addToRoot">Dodaj kategorię główną</button>
        <button @click="addToCategory">Dodaj podkategorię</button>
        <v-jstree :data="structure" allow-batch whole-row @item-click="itemClick"></v-jstree>

        <Dialog header="Dodaj kategorię" :visible.sync="dialog" :modal="true">
            <div style="width:600px; max-width: 100%;" class="intro-y box p-5">
                <input-text v-model="form.name" label="Nazwa kategorii" :column="true" />
                <dropdown :options="[]" v-model="form.id_parent" label="Kategoria nadrzędna" :column="true" />
            </div>
            <template #footer>
                <div class="col-span-12 flex items-center">
                    <button class="btn bg-white w-32 ml-auto" @click="onHideDialog">Anuluj</button>
                    <button class="btn btn-primary w-32 ml-2">Dodaj kategorię</button>
                </div>
            </template>
        </Dialog>
    </div>
</template>

<script>
    import VJstree from 'vue-jstree'

    export default {
        components: {
            VJstree
        },
        data() {
            return {
                dialog:false,
                form: {
                    name: ''
                },
                current: null,
                structure: []
            }
        },
        methods: {
            item() {
                const data = {id: 1, name: this.form.name};

                return {
                    id: data.id,
                    text: data.name,
                    opened: false,
                    icon: 'folder',
                    children : []
                };
            },
            itemClick (node) {
                this.current = node;
            },
            addToCategory() {
                this.dialog = true;
                // this.current.model.children.push(this.item());
            },
            addToRoot() {
                this.dialog = true;
                // this.structure.push(this.item());
            },
            onHideDialog() {
                this.dialog = false;
            }
        },
    }
</script>
