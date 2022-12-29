<template>
    <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
        <Search class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-slate-500" />
        <input type="text" class="form-control w-full box px-10" placeholder="Wyszukaj...">
        <div class="inbox-filter dropdown absolute inset-y-0 mr-3 right-0 flex items-center" data-tw-placement="bottom-start">
            <ChevronDown class="dropdown-toggle w-4 h-4 cursor-pointer text-slate-500" role="button" aria-expanded="false" data-tw-toggle="dropdown" />
                                        <div class="inbox-filter__dropdown-menu dropdown-menu pt-2">
                                            <div class="dropdown-content">
                                                <div class="grid grid-cols-12 gap-4 gap-y-3 p-3">
                                                    <div class="col-span-6">
                                                        <label for="input-filter-1" class="form-label text-xs">Nazwa pliku</label>
                                                        <input id="input-filter-1" type="text" class="form-control flex-1" placeholder="Type the file name">
                                                    </div>
                                                    <div class="col-span-6">
                                                        <label for="input-filter-2" class="form-label text-xs">Typ pliku </label>
                                                        <input id="input-filter-2" type="text" class="form-control flex-1" placeholder="example@gmail.com">
                                                    </div>
                                                    <div class="col-span-6">
                                                        <label for="input-filter-3" class="form-label text-xs">Dodano</label>
                                                        <input id="input-filter-3" type="text" class="form-control flex-1" placeholder="Important Meeting">
                                                    </div>
                                                    <div class="col-span-6">
                                                        <label for="input-filter-4" class="form-label text-xs">Przeszukaj</label>
                                                        <select id="input-filter-4" class="form-select flex-1">
                                                            <option>10</option>
                                                            <option>25</option>
                                                            <option>35</option>
                                                            <option>50</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-span-12 flex items-center mt-3">
                                                        <button class="btn btn-secondary w-32 ml-auto">Create Filter</button>
                                                        <button class="btn btn-primary w-32 ml-2">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
</template>

<script>
import { Search, ChevronDown } from 'lucide-vue';

export default {
    components: {
        ChevronDown,
        Search
    }
}
</script>
