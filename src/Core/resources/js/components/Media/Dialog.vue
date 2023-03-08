<template>
    <Dialog :visible.sync="display" :modal="true" appendTo="body" class="media-dialog" :closable="false" :closeOnEscape="false">
        <media root="" mode="dialog" :allow="allow" :selected="selected" @onSelect="onSelect"></media>
        <template #footer>
            <div class="col-span-12 flex items-center">
                <button class="btn bg-white w-32 ml-auto" @click="onHandleHideDialog">Anuluj</button>
                <button class="btn btn-primary w-32 ml-2" @click="onSelectFile">Wybierz</button>
            </div>
        </template>
    </Dialog>
</template>

<script>
    export default {
        props: {
            name: String,
            limit: {
                type: Number,
                default: -1
            },
            selected: {
                type: Array,
                default: () => []
            },
            display: {
                type: Boolean,
                default: false
            },
            allow: {
                type: Array,
                default: () => []
            }
        },
        methods: {
            onSelect(item) {
				if (this.limit == 1) {
					this.selected = [];
				}

                const index = this.selected.findIndex(e => e.hash === item.hash);
                if ((this.allow.length === 0 || this.allow.includes(item.extension)) && index === -1) {
                    if(this.limit == -1 || (this.limit > 0 && (this.selected.length < this.limit))) {
                        this.selected.push(item);

						if (this.limit == 1) {
							this.$emit('onSelect', this.selected);
							this.$emit('update:display', false);
						}
                    }
                } else if (index > -1) {
                    this.selected.splice(index, 1);
                }
            },
            onSelectFile(hash) {
				this.$emit('onSelect', this.selected);
                this.$emit('update:display', false);
            },
            onHandleHideDialog() {
                this.$emit('update:display', false);
                this.selected = [];
            }
        },
    }
</script>
