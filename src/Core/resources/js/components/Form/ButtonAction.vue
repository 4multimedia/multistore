<template>
    <div class="dropdown" style="position: relative;">
        <div class="flex dropdown-split">
			<button type="submit" class="btn btn-primary shadow-md flex items-center">
            Zapisz i wróć do listy
			</button>
			<button type="button" class="btn btn-primary shadow-md flex items-center dropdown-toggle button" aria-expanded="false" data-tw-toggle="dropdown">
				<ChevronDown class="w-4 h-4 ml-2" />
			</button>
		</div>
        <div class="dropdown-menu w-56">
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
