
// Filename: models/weight
define([
  'underscore',
  'backbone'
], function(_, Backbone){
  'use strict';
  console.log('weight model ran...');
  
  var Weight = Backbone.Model.extend({
    defaults: {
      name: "Harry Potter",
      weight: 233.33
    }
  });
  // Return the model for the module
  return Weight;
});