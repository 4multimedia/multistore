import axios from 'axios';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
window.Alpine = Alpine
window.axios = axios
Alpine.plugin(mask);
Alpine.start();
