/**
 * App.js
 *
 * Loads in all of required files
 *
 * @author Matthew Oldfield
 *
 *
 */
'use strict';
require.config({
    baseUrl: vars.baseUrl,
    shim: {
        underscore: {
            exports: '_'
        },
        jquery: {
            exports: '$'
        },
        backbone: {
            deps: [
                'underscore',
                'jquery'
            ],
            exports: 'Backbone'
        }
    },
    paths: {
        jquery: 'libs/jquery/jquery.min',
        underscore: 'libs/underscore/underscore.min',
        backbone: 'libs/backbone/backbone.min',
        localstorage: 'libs/backbone/localstorage',
        text: 'libs/require/text'
    }
});

require([
	'backbone',
    'views/app',
    'routers/router'

], function(Backbone, AppView, Workspace) {
	
    new Workspace();
    Backbone.history.start();

    // Iinitialize application view
    new AppView();
});