// Filename: views/weights/list
define([
  'jquery',
  'underscore',
  'backbone',
  'collections/weights',
  'views/weights/weights',
  'common'
], function($, _, Backbone, Weights, WeightView, common){
  'use strict';

  console.log('app view ran...');

  var AppView = Backbone.View.extend({

    el: '#app',

    events: {
      
    },

    initialize: function () {
      this.$weightList = this.$('#weight-list');
      Weights.add({name: 'matt', weight: 237.99});
      this.listenTo(Weights, 'all', _.debounce(this.render, 0));

      this.addAll();
      this.$weightList.append('something appended');
      //Weights.fetch({reset:true});
    },

    render: function() {
      console.log('App view render ran...', this);

      // use this just to update values, set up html in init
      return this;
    },

    addOne: function () {
      var view = new WeightView();
      this.$weightList.append(view.render());
    },

    addAll: function () {
      this.$weightList.empty();
      Weights.each(this.addOne, this);
    }



  });

  // Returning instantiated views can be quite useful for having "state"
  return AppView;
});