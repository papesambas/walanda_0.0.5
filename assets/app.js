/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import 'bootstrap';
// Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap'
import bsCustomFileInput from 'bs-custom-file-input';
import * as Popper from "@popperjs/core"

// import Jquery
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'select2';
import 'select2/dist/css/select2.min.css';

import './scripts/select2/select2_nom'
import './scripts/select2/select2_prenom'
import './scripts/select2/select2_professions'
import './scripts/select2/select2_telephones'
import './scripts/select2/select2_peres_telephones_search'
import './scripts/select2/select2_meres_telephones_search'
