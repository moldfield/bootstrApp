// Filename: router.js
define([
  'jquery',
  'underscore',
  'backbone',
  'views/app'
  
], function($, _, Backbone, App){
  'use strict';

  var AppRouter = Backbone.Router.extend({

    routes: {
      // Define some URL routes
      'weights': 'showApp',
      //'/users': 'showUsers',

      // Default
      '': 'index',
      //'*notFound': 'index',
      '*else': 'index'
      
    },

    index: function() {
      //this.switchView(this.pageView);
      
    },

    currentView: null,

    showApp: function () {
      console.log('Show app router ran...');
      new App();
     
    }

    
  });

 return AppRouter;
});