<template>
    <div class="dropdown" style="position: relative;">
        <button class="dropdown-toggle btn btn-primary shadow-md flex items-center" type="button" aria-expanded="false" data-tw-toggle="dropdown">
            Zapisz i wróć do listy <ChevronDown class="w-4 h-4 ml-2" />
        </button>
        <div class="dropdown-menu w-56" id="_o877v7wuw">
            <ul class="dropdown-content">
                <li>
                    <a href="" class="dropdown-item"><ListEnd class="lucide-file-text w-4 h-4 mr-2" /> Zapisz i wróć do listy</a>
                </li>
                <li>
                    <a href="" class="dropdown-item"><ListVideo class="lucide-file-text w-4 h-4 mr-2" /> Zapisz i przejdź do edycji</a>
                </li>
                <li>
                    <a href="" class="dropdown-item"><ListPlus class="lucide-file-text w-4 h-4 mr-2" /> Zapisz i dodaj nowy</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { ChevronDown, ListEnd, ListPlus, ListVideo } from 'lucide-vue';

export default {
    components: {
		ChevronDown,
		ListEnd,
		ListPlus,
		ListVideo
	}
}
</script>
