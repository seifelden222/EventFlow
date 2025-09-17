import './bootstrap';
// Import the page-specific CSS so Vite includes it in the manifest
import '../css/index.css';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
