<template>
    <div>
        <div class="flex mb-3 items-center justify-between">
            <h2 class="text-lg intro-y font-medium truncate mr-5">Kategorie</h2>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <Plus />
                    </span>
                </button>
                <div class="dropdown-menu w-64">
                    <ul class="dropdown-content">
                        <li><a href="javascript:;" @click="onHandleOpenDialog" class="dropdown-item"><FolderPlus class="w-4 h-4 mr-2" /> Dodaj kategorię</a></li>
                        <template v-if="current">
                            <li> <hr class="dropdown-divider"> </li>
                            <li> <a href="javascript:;" class="dropdown-item"><FolderPlus class="w-4 h-4 mr-2" /> Dodaj podkategorię</a> </li>
                            <li> <a href="javascript:;" class="dropdown-item"><Edit2 class="w-4 h-4 mr-2" /> Edytuj</a> </li>
                            <li> <a href="javascript:;" class="dropdown-item"><ArrowUpDown class="w-4 h-4 mr-2" /> Przenieś</a> </li>
                            <li> <a href="javascript:;" class="dropdown-item"><Copy class="w-4 h-4 mr-2" /> Duplikuj</a> </li>
                            <li> <hr class="dropdown-divider"> </li>
                            <li> <a href="javascript:;" class="dropdown-item text-red-600"><Trash class="w-4 h-4 mr-2" /> Usuń</a> </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
        <v-jstree :data="structure" allow-batch whole-row @item-click="itemClick">
            <template scope="_">
                <div class="flex justify-between w-full">
                    <span>{{_.model.text}}</span>
                    <div class="dropdown">
							<button class="dropdown-toggle text-slate-300 hover:text-slate-500" aria-expanded="false" data-tw-toggle="dropdown">
								<Settings />
							</button>
							<div class="dropdown-menu w-64">
								<ul class="dropdown-content">
									<li> <a href="javascript:;" class="dropdown-item"><FolderPlus class="w-4 h-4 mr-2" /> Dodaj podkategorię</a> </li>
									<li> <a href="javascript:;" class="dropdown-item"><Edit2 class="w-4 h-4 mr-2" /> Edytuj</a> </li>
									<li> <a href="javascript:;" class="dropdown-item"><ArrowUpDown class="w-4 h-4 mr-2" /> Przenieś</a> </li>
									<li> <a href="javascript:;" class="dropdown-item"><Copy class="w-4 h-4 mr-2" /> Duplikuj</a> </li>
									<li> <hr class="dropdown-divider"> </li>
									<li> <a href="javascript:;" class="dropdown-item text-red-600"><Trash class="w-4 h-4 mr-2" /> Usuń</a> </li>
								</ul>
							</div>
						</div>
                </div>
            </template>
        </v-jstree>

        <Dialog header="Dodaj kategorię" :visible.sync="dialog" :modal="true">
            <div style="width:600px; max-width: 100%;" class="intro-y box p-5">
                <input-text v-model="form.name" label="Nazwa kategorii" :column="true" />
                <dropdown :options="[]" v-model="form.id_parent" label="Kategoria nadrzędna" :column="true" />
            </div>
            <template #footer>
                <div class="col-span-12 flex items-center">
                    <button class="btn bg-white w-32 ml-auto" @click="onHideDialog">Anuluj</button>
                    <button class="btn btn-primary w-32 ml-2" @click="addToCategory">Dodaj kategorię</button>
                </div>
            </template>
        </Dialog>
    </div>
</template>

<script>
    import VJstree from 'vue-jstree';
    import { Edit2, Copy, Trash, FolderPlus, ArrowUpDown, Settings, Plus } from 'lucide-vue';

    export default {
        components: {
            ArrowUpDown,
            Edit2,
            Copy,
            Trash,
            FolderPlus,
            Plus,
            Settings,
            VJstree
        },
        data() {
            return {
                dialog:false,
                form: {
                    id_parent: null,
                    name: 'Test'
                },
                current: null,
                structure: []
            }
        },
        methods: {
            item() {
                const id = this.structure.length;
                const hash = `${id}sdasdasdas342dvcbvc`;
                const data = {id, name: this.form.name};

                return {
                    id,
                    hash,
                    text: data.name,
                    opened: false,
                    children : []
                };
            },
            itemClick (node) {
                this.current = node;
                window.history.replaceState({}, "", `/${window.globalConfig.backend}/product/category/${node.model.hash}`);
            },
            onHandleOpenDialog() {
                this.dialog = true;
            },
            addToCategory() {
                if (this.form.id_parent === null) {
                    this.structure.push(this.item());
                } else {
                    this.current.model.children.push(this.item());
                }
                this.onHideDialog();
            },
            onHideDialog() {
                this.dialog = false;
            }
        },
    }
</script>
