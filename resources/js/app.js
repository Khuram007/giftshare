import 'bootstrap/dist/css/bootstrap.min.css';
import './bootstrap';
import 'bootstrap';

import Alpine from 'alpinejs';

if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}
