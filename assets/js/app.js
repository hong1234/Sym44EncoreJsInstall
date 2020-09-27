/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
///import '../css/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

///console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


import React from 'react';
import ReactDOM from 'react-dom';

//import DataHOC from './DataHOC.js';
//import LocationTable from './LocationTable.js';

//require('../css/custom.scss');

//import './app.scss';
//import './table.css';

//import 'bootstrap/scss/bootstrap.scss';

//import 'bootstrap/dist/css/bootstrap.min.css';
//import $ from 'jquery';
//import Popper from 'popper.js';
//import 'bootstrap/dist/js/bootstrap.bundle.min';

//const URL_TO_DATA = "http://localhost:8000/api/search";
//const LocationTableWithData = DataHOC(URL_TO_DATA, LocationTable)

import Location from './Location.js';

ReactDOM.render(<Location/>, document.getElementById('root'));
