<template>
    <div class="bg-warning/20 dark:bg-darkmode-600 border border-warning dark:border-0 rounded-md relative p-5">
        <Lightbulb class="w-8 h-8 text-warning/80 absolute top-0 right-0 mt-5 mr-3" />
        <h2 class="font-medium">Wskazówka</h2>
        <div class="leading-relaxed text-xs mt-5 text-slate-600 dark:text-slate-500">
            <div>Zarządzanie plikami przez serwer FTP zastąpiliśmy wygodnym i szybkim protokołem WebDAV. Skonfiguruj go dla swojego sklepu i uzyskaj dostęp do wszystkich plików, ich aktualizacji i dodawania nowych.</div>
        </div>
    </div>
</template>

<script>
import { Lightbulb } from 'lucide-vue';

export default {
    components: {
        Lightbulb
    }
}
</script>
