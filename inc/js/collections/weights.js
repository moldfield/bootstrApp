// Filename: collections/weights
define([
  'underscore',
  'backbone',
  'localstorage',
  'models/weight'
], function(_, Backbone, Store, Weight){
  'use strict';
	console.log('weights collection ran...');
  
  var WeightCollection = Backbone.Collection.extend({
    
    model: Weight,

    localStorage: new Store('weights-backbone')
  });
  // You don't usually return a collection instantiated
  return new WeightCollection;
});